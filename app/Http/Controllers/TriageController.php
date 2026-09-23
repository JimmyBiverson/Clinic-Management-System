<?php

namespace App\Http\Controllers;

use App\Models\Triage;
use App\Models\Visit;
use Illuminate\Http\Request;

class TriageController extends Controller
{
    public function edit(Visit $visit)
    {
        $visit->load(['patient', 'triage']);

        return view('triage.edit', compact('visit'));
    }

    public function update(Request $request, Visit $visit)
    {
        $data = $request->validate([
            'chief_complaint' => ['nullable', 'string', 'max:1000'],
            'lab_tests' => ['nullable', 'string', 'max:1000'],
            'lab_status' => ['nullable', 'string', 'max:20'],
            'bp' => ['nullable', 'string', 'max:20'],
            'temp' => ['nullable', 'numeric'],
            'pulse' => ['nullable', 'integer'],
            'resp' => ['nullable', 'integer'],
            'weight' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
        ]);

        $data['bmi'] = $this->calculateBmi($data['weight'] ?? null, $data['height'] ?? null);

        Triage::updateOrCreate(['visit_id' => $visit->id], $data);

        $visit->update(['triage_done' => true]);

        return back()
            ->with('success', 'Triage saved. Patient is now on the doctor\'s waiting list.');
    }

    private function calculateBmi(?float $weightKg, ?float $heightCm): ?float
    {
        if (! $weightKg || ! $heightCm || $heightCm <= 0) {
            return null;
        }

        $heightM = $heightCm / 100;

        return round($weightKg / ($heightM * $heightM), 2);
    }
}
