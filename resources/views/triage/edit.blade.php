@extends('layouts.app')

@section('title', 'Staff Entry Form — Koyonzo Family Care Clinic')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h1 class="h3 mb-0 text-dark">Staff Entry Form</h1>
            <div class="text-muted small">
                Visit #{{ $visit->visit_no }} · {{ $visit->visit_type }} · {{ $visit->patient->serial_number }}
            </div>
        </div>
        <a href="{{ route('patients.show', $visit->patient) }}" class="btn btn-outline-secondary">View Patient Record</a>
    </div>

    <div class="client-detail mb-4">
        <div class="row small g-2">
            <div class="col-md-3"><strong>Patient:</strong> {{ $visit->patient->full_name }}</div>
            <div class="col-md-3"><strong>Phone:</strong> {{ $visit->patient->phone ?? '—' }}</div>
            <div class="col-md-3"><strong>Age:</strong> {{ $visit->patient->age() ?? '—' }}</div>
            <div class="col-md-3"><strong>Gender:</strong> {{ $visit->patient->gender ?? '—' }}</div>
        </div>
    </div>

    <form method="POST" action="{{ route('triage.update', $visit) }}">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center gap-2">
                <span>1. Chief Complaint</span>
            </div>
            <div class="card-body">
                <label for="chief_complaint" class="form-label">Chief Complaint</label>
                <textarea name="chief_complaint" id="chief_complaint" rows="3" class="form-control">{{ old('chief_complaint', $visit->triage?->chief_complaint) }}</textarea>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">2. Triage (Vitals)</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-md-4 col-lg-3">
                        <label for="bp" class="form-label">Blood Pressure (BP)</label>
                        <input type="text" class="form-control" id="bp" name="bp" placeholder="120/80" value="{{ old('bp', $visit->triage?->bp) }}">
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <label for="temp" class="form-label">Temperature (°C)</label>
                        <input type="number" step="0.1" class="form-control" id="temp" name="temp" value="{{ old('temp', $visit->triage?->temp) }}">
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <label for="pulse" class="form-label">Pulse (bpm)</label>
                        <input type="number" class="form-control" id="pulse" name="pulse" value="{{ old('pulse', $visit->triage?->pulse) }}">
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <label for="resp" class="form-label">Respirations</label>
                        <input type="number" class="form-control" id="resp" name="resp" value="{{ old('resp', $visit->triage?->resp) }}">
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <label for="weight" class="form-label">Weight (kg)</label>
                        <input type="number" step="0.1" class="form-control" id="weight" name="weight" value="{{ old('weight', $visit->triage?->weight) }}">
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <label for="height" class="form-label">Height (cm)</label>
                        <input type="number" step="0.1" class="form-control" id="height" name="height" value="{{ old('height', $visit->triage?->height) }}">
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <label for="bmi" class="form-label">BMI (auto)</label>
                        <input type="text" class="form-control" id="bmi" value="{{ $visit->triage?->bmi ?? '—' }}" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">3. Lab Tests</div>
            <div class="card-body">
                <label for="lab_tests" class="form-label">Lab Tests Requested</label>
                <textarea name="lab_tests" id="lab_tests" rows="3" class="form-control" placeholder="e.g. Full blood count, Malaria test, Urinalysis…">{{ old('lab_tests', $visit->triage?->lab_tests) }}</textarea>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label for="lab_status" class="form-label">Lab Status</label>
                        <select name="lab_status" id="lab_status" class="form-select">
                            <option value="">— Select —</option>
                            @foreach (['Pending', 'In Progress', 'Completed', 'Results Ready'] as $status)
                                <option value="{{ $status }}" @selected(old('lab_status', $visit->triage?->lab_status) === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-teal px-4">Save Triage</button>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>
        <div class="form-text mt-2">Once saved, this patient will appear on the doctor's waiting list.</div>
    </form>
@endsection

@push('scripts')
<script>
    const weight = document.getElementById('weight');
    const height = document.getElementById('height');
    const bmi = document.getElementById('bmi');

    function recalcBmi() {
        const w = parseFloat(weight.value);
        const h = parseFloat(height.value);
        if (w > 0 && h > 0) {
            const m = h / 100;
            bmi.value = (w / (m * m)).toFixed(2);
        } else {
            bmi.value = '—';
        }
    }

    weight.addEventListener('input', recalcBmi);
    height.addEventListener('input', recalcBmi);
</script>
@endpush