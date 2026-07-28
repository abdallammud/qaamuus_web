<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entry extends Model
{
    public $timestamps = true;

    protected $guarded = [];

    protected $casts = [
        'noun_plural' => 'array',
        'domains' => 'array',
        'is_khabar_only' => 'boolean',
    ];

    /**
     * Raw dictionary domain codes → English subject names.
     *
     * This is the canonical list of codes; the displayed name comes from the
     * `ui.domain_labels` translation file, falling back to the values here.
     */
    public const DOMAIN_LABELS = [
        'daaw.'  => 'Medicine',
        'fiis.'  => 'Physics',
        'xis.'   => 'Mathematics',
        'baay.'  => 'Biology',
        'kiim.'  => 'Chemistry',
        'dii.'   => 'Religion',
        'juqr.'  => 'Geography',
        'jool.'  => 'Geology',
        'bot.'   => 'Botany',
        'muus.'  => 'Music',
        'siyaa.' => 'Politics',
        'taar.'  => 'History',
        'dhaq.'  => 'Commerce',
        'c.nafl' => 'Zoology',
        'qaan.'  => 'Law',
        'c.naf'  => 'Psychology',
    ];

    /**
     * Map a raw domain code to its label in the current interface language.
     *
     * Domain codes contain dots ("daaw."), which Laravel would read as nested
     * translation keys — so the whole group is fetched and indexed in PHP.
     */
    public static function domainName(?string $code): ?string
    {
        if (! $code) {
            return null;
        }

        $labels = trans('ui.domain_labels');

        if (is_array($labels) && isset($labels[$code])) {
            return $labels[$code];
        }

        return self::DOMAIN_LABELS[$code] ?? ucfirst(rtrim($code, '.'));
    }

    /** Translated label for this entry's domain. */
    public function domainLabel(): ?string
    {
        return self::domainName($this->domain);
    }

    public function definitions(): HasMany
    {
        return $this->hasMany(Definition::class)->orderBy('sense_number');
    }

    public function synonyms(): HasMany
    {
        return $this->hasMany(Synonym::class);
    }

    /** Community contributions, newest first, approved only by default. */
    public function contributions(): HasMany
    {
        return $this->hasMany(Contribution::class)->latest();
    }

    public function approvedContributions(): HasMany
    {
        return $this->contributions()->where('status', 'approved');
    }

    /**
     * Other entries that share the same headword (homonyms / other word forms).
     */
    public function otherForms()
    {
        return self::where('headword', $this->headword)
            ->where('id', '!=', $this->id)
            ->with('definitions')
            ->orderBy('homonym_index')
            ->get();
    }

    /* ---- Display helpers ---------------------------------------------- */

    public function posLabel(): string
    {
        return match ($this->pos_category) {
            'noun', 'verb', 'adjective', 'pronoun', 'particle', 'adverb',
            'exclamation', 'preposition', 'numeral'
                => __('ui.pos.' . $this->pos_category),
            default => ucfirst((string) $this->pos_category) ?: self::unknownLabel(),
        };
    }

    public function genderLabel(): string
    {
        if ($this->pos_category !== 'noun') {
            return self::notApplicableLabel();
        }
        return match ($this->gender) {
            'm', 'f', 'b' => __('ui.gender.' . $this->gender),
            default => self::unknownLabel(),
        };
    }

    public function pluralLabel(): string
    {
        if ($this->pos_category !== 'noun') {
            return self::notApplicableLabel();
        }
        if ($this->noun_plural_raw) {
            return $this->noun_plural_raw;
        }
        if (is_array($this->noun_plural) && ! empty($this->noun_plural)) {
            return implode(' ', array_filter($this->noun_plural));
        }
        return self::notApplicableLabel();
    }

    public function conjugationLabel(): string
    {
        if ($this->pos_category !== 'verb') {
            return self::notApplicableLabel();
        }
        $bits = array_filter([
            $this->conjugation_raw,
            $this->verb_class_label,
        ]);
        return $bits ? implode(' — ', $bits) : self::notApplicableLabel();
    }

    /** "n/a" in the current interface language — a field that does not apply. */
    public static function notApplicableLabel(): string
    {
        return __('ui.word.not_applicable');
    }

    /** A field that applies but has no recorded value. */
    public static function unknownLabel(): string
    {
        return __('ui.word.unknown');
    }

    public function displayHeadword(): string
    {
        return $this->homonym_index
            ? $this->headword . ' (' . $this->homonym_index . ')'
            : $this->headword;
    }
}
