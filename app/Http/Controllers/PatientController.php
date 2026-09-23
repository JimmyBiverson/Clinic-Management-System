<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q');

        $patients = Patient::query()
            ->withCount('visits')
            ->when($query, function ($builder) use ($query) {
                $builder->where('full_name', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%")
                    ->orWhere('serial_number', 'like', "%{$query}%");
            })
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('patients.index', compact('patients', 'query'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', 'string', 'max:10'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'insurance' => ['nullable', 'string', 'max:50'],
            'nok_contact' => ['nullable', 'string', 'max:50'],
        ]);

        $data['serial_number'] = Patient::generateSerialNumber();

        $patient = Patient::create($data);

        $visit = $patient->visits()->create([
            'visit_no' => 1,
            'visit_date' => now(),
            'visit_type' => $request->input('visit_type', 'Outpatient'),
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('triage.edit', $visit)
            ->with('success', "Patient registered as {$patient->serial_number}. Please complete triage.");
    }

    public function show(Patient $patient)
    {
        $patient->load(['visits' => fn ($query) => $query->with(['triage', 'consultation', 'prescriptions'])->latest('visit_date')]);

        return view('patients.show', compact('patient'));
    }
}
