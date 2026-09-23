<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'visit_id',
    'history',
    'examination',
    'diagnosis',
    'treatment',
    'referral',
    'facility',
    'next_appointment',
    'doctor_id',
])]
class Consultation extends Model
{
    protected function casts(): array
    {
        return [
            'referral' => 'boolean',
            'next_appointment' => 'date',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
