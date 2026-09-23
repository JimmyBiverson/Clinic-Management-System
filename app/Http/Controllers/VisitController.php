<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function store(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'visit_type' => ['nullable', 'string', 'max:20'],
        ]);

        $visit = $patient->visits()->create([
            'visit_no' => $patient->visits()->max('visit_no') + 1,
            'visit_date' => now(),
            'visit_type' => $data['visit_type'] ?? 'Outpatient',
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('triage.edit', $visit)
            ->with('success', "Visit #{$visit->visit_no} opened. Please complete triage.");
    }
}
