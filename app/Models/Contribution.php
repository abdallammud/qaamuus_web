<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contribution extends Model
{
    protected $guarded = [];

    /**
     * The canonical contribution types. Displayed names come from the
     * `ui.contributions.types` translation file — see typeOptions().
     */
    public const TYPES = [
        'explanation'      => 'More explanation',
        'synonym'          => 'Similar word',
        'example_sentence' => 'Example sentence',
        'dialect_variant'  => 'Dialect variant',
    ];

    /** Type => label in the current interface language, for the <select>. */
    public static function typeOptions(): array
    {
        $labels = trans('ui.contributions.types');

        if (! is_array($labels)) {
            return self::TYPES;
        }

        $options = [];
        foreach (self::TYPES as $type => $fallback) {
            $options[$type] = $labels[$type] ?? $fallback;
        }

        return $options;
    }

    public function typeLabel(): string
    {
        return self::typeOptions()[$this->type] ?? $this->type;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function entry(): BelongsTo
    {
        return $this->belongsTo(Entry::class);
    }
}
