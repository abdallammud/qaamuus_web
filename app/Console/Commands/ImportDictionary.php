<?php

namespace App\Console\Commands;

use App\Models\Entry;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportDictionary extends Command
{
    protected $signature = 'dict:import
        {file? : Path to the qaamuuska JSON (defaults to database/data/qaamuuska_full_v3.json)}
        {--fresh : Truncate dictionary tables before importing}';

    protected $description = 'Import the Qaamuuska dictionary dataset (entries, definitions, synonyms) into MySQL.';

    public function handle(): int
    {
        // The full dataset (~35MB JSON) needs headroom once decoded into PHP arrays.
        @ini_set('memory_limit', '1024M');

        $path = $this->argument('file')
            ?: database_path('data/qaamuuska_full_v3.json');

        if (! is_file($path)) {
            $this->error("Data file not found: {$path}");
            return self::FAILURE;
        }

        $this->info('Reading dataset… (this can take a moment for ~35MB)');
        $data = json_decode(file_get_contents($path), true);

        if (! is_array($data)) {
            $this->error('Could not decode JSON dataset.');
            return self::FAILURE;
        }

        if ($this->option('fresh')) {
            $this->warn('Truncating dictionary tables…');
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('definitions')->truncate();
            DB::table('synonyms')->truncate();
            DB::table('entries')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        $total = count($data);
        $this->info("Importing {$total} entries…");
        $bar = $this->output->createProgressBar($total);

        $now = now();
        $entryRows = $defRows = $synRows = [];
        $flush = function () use (&$entryRows, &$defRows, &$synRows) {
            if ($entryRows) DB::table('entries')->insert($entryRows);
            if ($defRows)   DB::table('definitions')->insert($defRows);
            if ($synRows)   DB::table('synonyms')->insert($synRows);
            $entryRows = $defRows = $synRows = [];
        };

        foreach ($data as $item) {
            $id = (int) $item['id'];
            $headword = (string) ($item['headword'] ?? '');

            $glosses = [];
            foreach (($item['definitions'] ?? []) as $d) {
                $glosses[] = $d['gloss'] ?? '';
            }
            $synWords = array_map(
                fn ($s) => $s['target_headword'] ?? '',
                $item['synonyms'] ?? []
            );

            $domains = [];
            if (! empty($item['domain'])) $domains[] = $item['domain'];
            foreach (($item['definitions'] ?? []) as $d) {
                if (! empty($d['domain'])) $domains[] = $d['domain'];
            }
            $domains = array_values(array_unique($domains));

            $searchBlob = $this->normalize(
                implode(' ', array_merge([$headword], $glosses, $synWords))
            );

            $entryRows[] = [
                'id'               => $id,
                'headword'         => $headword,
                'headword_lower'   => $this->normalize($headword),
                'letter'           => mb_strtoupper(mb_substr($headword, 0, 1)),
                'homonym_index'    => $item['homonym_index'] ?? null,
                'pos_code'         => $item['pos_code'] ?? null,
                'pos_category'     => $item['pos_category'] ?? null,
                'is_khabar_only'   => ! empty($item['is_khabar_only']),
                'gender'           => $item['gender'] ?? null,
                'verb_class'       => $item['verb_class'] ?? null,
                'verb_class_label' => $item['verb_class_label'] ?? null,
                'verb_transitivity' => $item['verb_transitivity'] ?? null,
                'conjugation_raw'  => $item['conjugation_raw'] ?? null,
                'noun_plural_raw'  => $item['noun_plural_raw'] ?? null,
                'noun_plural'      => isset($item['noun_plural']) ? json_encode($item['noun_plural']) : null,
                'domain'           => $item['domain'] ?? null,
                'domains'          => json_encode($domains),
                'redirect_to'      => $item['redirect_to'] ?? null,
                'redirect_to_id'   => $item['redirect_to_id'] ?? null,
                'source_page'      => $item['source_page'] ?? null,
                'raw_body'         => $item['raw_body'] ?? null,
                'search_blob'      => $searchBlob,
                'created_at'       => $now,
                'updated_at'       => $now,
            ];

            foreach (($item['definitions'] ?? []) as $d) {
                $defRows[] = [
                    'entry_id'        => $id,
                    'sense_number'    => $d['sense_number'] ?? 1,
                    'gloss_prefix'    => $d['gloss_prefix'] ?? null,
                    'gloss'           => $d['gloss'] ?? '',
                    'domain'          => $d['domain'] ?? null,
                    'partial_synonym' => $d['partial_synonym'] ?? null,
                ];
            }

            foreach (($item['synonyms'] ?? []) as $s) {
                $synRows[] = [
                    'entry_id'             => $id,
                    'target_headword'      => $s['target_headword'] ?? '',
                    'target_homonym_index' => $s['target_homonym_index'] ?? null,
                    'target_entry_id'      => $s['target_entry_id'] ?? null,
                ];
            }

            if (count($entryRows) >= 1000) {
                $flush();
            }
            $bar->advance();
        }

        $flush();
        $bar->finish();
        $this->newLine(2);
        $this->info('Done. Entries: ' . Entry::count()
            . ' | Definitions: ' . DB::table('definitions')->count()
            . ' | Synonyms: ' . DB::table('synonyms')->count());

        return self::SUCCESS;
    }

    /** Lower-case + strip accents/punctuation for searchable text. */
    private function normalize(?string $value): string
    {
        if (! $value) return '';
        $value = mb_strtolower($value, 'UTF-8');
        if (class_exists('Normalizer')) {
            $value = \Normalizer::normalize($value, \Normalizer::FORM_D);
            $value = preg_replace('/\p{Mn}/u', '', $value);
        }
        $value = preg_replace('/[^\p{L}\p{N}\s\']/u', ' ', $value);
        return trim(preg_replace('/\s+/', ' ', $value));
    }
}
