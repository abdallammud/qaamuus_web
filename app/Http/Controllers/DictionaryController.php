<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DictionaryController extends Controller
{
    /** Home / search landing page. */
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $domain = trim((string) $request->query('domain', ''));

        if ($q !== '') {
            $results = $this->runSearch($q);
            $discover = collect();
        } else {
            $results = collect();
            $discover = $this->discover($domain);
        }

        return view('dictionary.index', [
            'q' => $q,
            'domain' => $domain,
            'results' => $results,
            'discover' => $discover,
            'letters' => $this->letters(),
            'domains' => $this->domains(),
            'wordOfDay' => $this->wordOfDay(),
            'totalWords' => Entry::count(),
        ]);
    }

    /** A browsable sample list for the "Discover" column. */
    private function discover(string $domain)
    {
        $query = Entry::query()
            ->whereHas('definitions')
            ->with('definitions');

        if ($domain !== '') {
            $query->where('domain', $domain);
            return $query->orderBy('headword_lower')->limit(24)->get();
        }

        // Deterministic daily-rotating sample of interesting (domain-tagged) words.
        $seed = (int) now()->format('Ymd');
        return $query->whereNotNull('domain')
            ->orderByRaw('(id * ?) % 100003', [($seed % 9973) + 7])
            ->limit(15)
            ->get();
    }

    /** Featured "Word of the day", stable per calendar day. */
    private function wordOfDay(): ?Entry
    {
        $count = Entry::whereHas('definitions')->count();
        if ($count === 0) {
            return null;
        }
        $offset = crc32(now()->toDateString()) % $count;

        return Entry::whereHas('definitions')
            ->with('definitions')
            ->orderBy('id')
            ->skip($offset)
            ->first();
    }

    /** All subject domains (English) for the filter pills. */
    private function domains(): array
    {
        return array_keys($this->domainsWithCounts());
    }

    /** All subject domains with their word counts, ordered by size. */
    private function domainsWithCounts(): array
    {
        return cache()->remember('domain_counts', 3600, function () {
            return Entry::query()
                ->select('domain')
                ->selectRaw('COUNT(*) as total')
                ->whereNotNull('domain')
                ->groupBy('domain')
                ->orderByRaw('COUNT(*) desc')
                ->pluck('total', 'domain')
                ->all();
        });
    }

    /** Dedicated "Browse by domain" grid page. */
    public function domainsPage()
    {
        return view('dictionary.domains', [
            'domains' => $this->domainsWithCounts(),
            'navKey' => 'home',
        ]);
    }

    /** JSON autocomplete used by the search box. */
    public function autocomplete(Request $request)
    {
        $q = $this->normalize((string) $request->query('q', ''));
        if ($q === '') {
            return response()->json([]);
        }

        $rows = Entry::query()
            ->where('headword_lower', 'like', $q . '%')
            ->orderByRaw('LENGTH(headword) asc')
            ->orderBy('headword')
            ->limit(10)
            ->get(['id', 'headword', 'homonym_index', 'pos_category']);

        return response()->json($rows->map(fn ($e) => [
            'id' => $e->id,
            'headword' => $e->displayHeadword(),
            'pos' => $e->posLabel(),
            'url' => route('word.show', $e),
        ]));
    }

    /** Browse a single letter. */
    public function browse(Request $request, string $letter)
    {
        $letter = mb_strtoupper(mb_substr($letter, 0, 1));
        $entries = Entry::query()
            ->where('letter', $letter)
            ->orderBy('headword_lower')
            ->orderBy('homonym_index')
            ->paginate(60)
            ->withQueryString();

        return view('dictionary.browse', [
            'letter' => $letter,
            'entries' => $entries,
            'letters' => $this->letters(),
        ]);
    }

    /** Word detail view. */
    public function show(Entry $entry)
    {
        $entry->load([
            'definitions',
            'synonyms',
            'approvedContributions.user',
        ]);

        // Resolve synonym + redirect targets to linkable entries.
        $related = collect();
        foreach ($entry->synonyms as $syn) {
            if ($syn->target_entry_id) {
                $related->push($syn->target_entry_id);
            }
        }
        $relatedEntries = $related->isNotEmpty()
            ? Entry::whereIn('id', $related->all())->get()->keyBy('id')
            : collect();

        $redirectTarget = $entry->redirect_to_id
            ? Entry::with('definitions')->find($entry->redirect_to_id)
            : null;

        // Record history for signed-in users.
        if (Auth::check()) {
            History::updateOrCreate(
                ['user_id' => Auth::id(), 'entry_id' => $entry->id],
                ['viewed_at' => now()],
            );
        }

        $isFavorite = Auth::check()
            && Auth::user()->favorites()->where('entry_id', $entry->id)->exists();

        return view('dictionary.show', [
            'entry' => $entry,
            'otherForms' => $entry->otherForms(),
            'relatedEntries' => $relatedEntries,
            'redirectTarget' => $redirectTarget,
            'isFavorite' => $isFavorite,
        ]);
    }

    /* ------------------------------------------------------------------ */

    /** Weighted search across headword, synonyms and definition blob. */
    private function runSearch(string $raw)
    {
        $q = $this->normalize($raw);
        if ($q === '') {
            return collect();
        }
        $contains = '%' . $q . '%';
        $starts = $q . '%';

        return Entry::query()
            ->select('*')
            ->selectRaw(
                '((CASE WHEN headword_lower = ? THEN 140 ELSE 0 END) +
                  (CASE WHEN headword_lower LIKE ? THEN 90 ELSE 0 END) +
                  (CASE WHEN headword_lower LIKE ? THEN 50 ELSE 0 END) +
                  (CASE WHEN search_blob LIKE ? THEN 20 ELSE 0 END)) AS score',
                [$q, $starts, $contains, $contains]
            )
            ->where(function ($w) use ($contains) {
                $w->where('headword_lower', 'like', $contains)
                  ->orWhere('search_blob', 'like', $contains);
            })
            ->with('definitions')
            ->orderByDesc('score')
            ->orderByRaw('LENGTH(headword) asc')
            ->orderBy('headword')
            ->limit(30)
            ->get();
    }

    private function letters(): array
    {
        return Entry::query()
            ->select('letter')
            ->whereNotNull('letter')
            ->groupBy('letter')
            ->orderBy('letter')
            ->pluck('letter')
            ->all();
    }

    private function normalize(string $value): string
    {
        $value = mb_strtolower(trim($value), 'UTF-8');
        if (class_exists('Normalizer')) {
            $value = \Normalizer::normalize($value, \Normalizer::FORM_D);
            $value = preg_replace('/\p{Mn}/u', '', $value);
        }
        $value = preg_replace('/[^\p{L}\p{N}\s\']/u', ' ', $value);
        return trim(preg_replace('/\s+/', ' ', $value));
    }
}
