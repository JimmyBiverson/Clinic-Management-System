<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'serial_number',
    'full_name',
    'phone',
    'gender',
    'date_of_birth',
    'insurance',
    'nok_contact',
])]
class Patient extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function latestVisit(): ?Visit
    {
        return $this->visits()->latest('visit_date')->first();
    }

    public function age(): ?int
    {
        return $this->date_of_birth?->age;
    }

    public static function generateSerialNumber(): string
    {
        $prefix = 'PAT-'.now()->year.'-';
        $last = static::where('serial_number', 'like', $prefix.'%')
            ->orderByDesc('serial_number')
            ->value('serial_number');

        $next = $last ? ((int) substr($last, -4)) + 1 : 1;

        return $prefix.str_pad((string) $next, 4, '0', STR_PAD_LEFT);
    }
}
