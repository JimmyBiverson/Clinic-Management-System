<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'patient_id',
    'visit_no',
    'visit_date',
    'visit_type',
    'triage_done',
    'consultation_done',
    'completed',
    'created_by',
])]
class Visit extends Model
{
    protected function casts(): array
    {
        return [
            'visit_date' => 'datetime',
            'triage_done' => 'boolean',
            'consultation_done' => 'boolean',
            'completed' => 'boolean',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function triage(): HasOne
    {
        return $this->hasOne(Triage::class);
    }

    public function consultation(): HasOne
    {
        return $this->hasOne(Consultation::class);
    }

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeInWaitingList($query)
    {
        return $query->where('triage_done', true)
            ->where('consultation_done', false);
    }
}
