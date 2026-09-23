<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function show(Visit $visit)
    {
        $visit->load(['patient', 'triage', 'consultation', 'prescriptions']);

        return view('consultations.show', compact('visit'));
    }

    public function update(Request $request, Visit $visit)
    {
        $data = $request->validate([
            'history' => ['nullable', 'string', 'max:5000'],
            'examination' => ['nullable', 'string', 'max:5000'],
            'diagnosis' => ['nullable', 'string', 'max:5000'],
            'treatment' => ['nullable', 'string', 'max:5000'],
            'referral' => ['nullable', 'boolean'],
            'facility' => ['nullable', 'string', 'max:100'],
            'next_appointment' => ['nullable', 'date', 'after:today'],
            'complete' => ['nullable', 'boolean'],
            'drugs' => ['nullable', 'array'],
            'drugs.*.drug_name' => ['nullable', 'string', 'max:100'],
            'drugs.*.dosage' => ['nullable', 'string', 'max:50'],
            'drugs.*.frequency' => ['nullable', 'string', 'max:50'],
            'drugs.*.duration' => ['nullable', 'string', 'max:50'],
            'drugs.*.quantity' => ['nullable', 'string', 'max:50'],
        ]);

        DB::transaction(function () use ($data, $visit) {
            $consultationData = [
                'history' => $data['history'] ?? null,
                'examination' => $data['examination'] ?? null,
                'diagnosis' => $data['diagnosis'] ?? null,
                'treatment' => $data['treatment'] ?? null,
                'referral' => (bool) ($data['referral'] ?? false),
                'facility' => $data['facility'] ?? null,
                'next_appointment' => $data['next_appointment'] ?? null,
                'doctor_id' => auth()->id(),
            ];

            // Ghost record prevention: only save if something meaningful was written.
            if (! empty($data['history']) || ! empty($data['examination'])) {
                Consultation::updateOrCreate(['visit_id' => $visit->id], $consultationData);
            }

            $visit->prescriptions()->delete();

            foreach (($data['drugs'] ?? []) as $drug) {
                if (empty($drug['drug_name'])) {
                    continue;
                }

                $visit->prescriptions()->create([
                    'drug_name' => $drug['drug_name'],
                    'dosage' => $drug['dosage'] ?? null,
                    'frequency' => $drug['frequency'] ?? null,
                    'duration' => $drug['duration'] ?? null,
                    'quantity' => $drug['quantity'] ?? null,
                    'status' => 'Pending',
                ]);
            }

            $completed = (bool) ($data['complete'] ?? false);

            if ($completed) {
                $visit->update([
                    'consultation_done' => true,
                    'completed' => true,
                ]);
            } elseif (! empty($data['history']) || ! empty($data['examination'])) {
                $visit->update(['consultation_done' => true]);
            }
        });

        return back()->with('success', 'Consultation saved.');
    }
}
