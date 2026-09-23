<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'visit_id',
    'chief_complaint',
    'lab_tests',
    'lab_status',
    'bp',
    'temp',
    'pulse',
    'resp',
    'weight',
    'height',
    'bmi',
])]
class Triage extends Model
{
    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }
}
