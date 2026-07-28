<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Synonym extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function entry(): BelongsTo
    {
        return $this->belongsTo(Entry::class);
    }
}
