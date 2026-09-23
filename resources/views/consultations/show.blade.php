@extends('layouts.app')

@section('title', 'Consultation — Koyonzo Family Care Clinic')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <a href="{{ route('dashboard') }}" class="text-decoration-none small">← Waiting List</a>
            <h1 class="h3 mb-0 text-dark mt-1">Consultation</h1>
        </div>
        <div class="text-end">
            <div class="text-muted small">Visit ID</div>
            <span class="visit-pulse">#{{ $visit->id }}</span>
        </div>
    </div>

    {{-- Staff summary shown to the doctor --}}
    <div class="client-detail mb-4">
        <div class="section-title">Patient Summary (from staff)</div>
        <div class="row small g-2 mt-1">
            <div class="col-md-3"><strong>Patient:</strong> {{ $visit->patient->full_name }}</div>
            <div class="col-md-3"><strong>Serial:</strong> {{ $visit->patient->serial_number }}</div>
            <div class="col-md-2"><strong>Visit:</strong> #{{ $visit->visit_no }}</div>
            <div class="col-md-2"><strong>Age:</strong> {{ $visit->patient->age() ?? '—' }}</div>
            <div class="col-md-2"><strong>Gender:</strong> {{ $visit->patient->gender ?? '—' }}</div>
            <div class="col-md-3"><strong>Phone:</strong> {{ $visit->patient->phone ?? '—' }}</div>
            <div class="col-md-3"><strong>Insurance:</strong> {{ $visit->patient->insurance ?? '—' }}</div>
            <div class="col-md-3"><strong>Arrived:</strong> {{ $visit->visit_date?->format('d M Y H:i') }}</div>
            <div class="col-md-3"><strong>Visit Type:</strong> {{ $visit->visit_type }}</div>
        </div>
    </div>

    @if ($visit->triage)
        <div class="row g-3 mb-4">
            <div class="col-md-7">
                <div class="card h-100">
                    <div class="card-header">Chief Complaint</div>
                    <div class="card-body">
                        {{ $visit->triage->chief_complaint ?: '—' }}
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card h-100">
                    <div class="card-header">Lab Tests</div>
                    <div class="card-body small">
                        {{ $visit->triage->lab_tests ?: '—' }}
                        @if ($visit->triage->lab_status)
                            <div class="mt-2"><span class="badge text-bg-info">{{ $visit->triage->lab_status }}</span></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Triage Vitals</div>
                    <div class="card-body">
                        <div class="row text-center small">
                            <div class="col-3 col-md-2">BP<br><strong>{{ $visit->triage->bp ?? '—' }}</strong></div>
                            <div class="col-3 col-md-2">Temp<br><strong>{{ $visit->triage->temp ?? '—' }}</strong></div>
                            <div class="col-3 col-md-2">Pulse<br><strong>{{ $visit->triage->pulse ?? '—' }}</strong></div>
                            <div class="col-3 col-md-2">Resp<br><strong>{{ $visit->triage->resp ?? '—' }}</strong></div>
                            <div class="col-4 col-md-2">Weight<br><strong>{{ $visit->triage->weight ?? '—' }}</strong></div>
                            <div class="col-4 col-md-2">BMI<br><strong>{{ $visit->triage->bmi ?? '—' }}</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('consultations.update', $visit) }}">
        @csrf
        @method('PUT')

        {{-- Part 1: Consultation --}}
        <div class="card mb-4">
            <div class="card-header">Part 1 — Consultation</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="history" class="form-label">History</label>
                    <textarea name="history" id="history" rows="4" class="form-control">{{ old('history', $visit->consultation?->history) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="examination" class="form-label">Examination</label>
                    <textarea name="examination" id="examination" rows="4" class="form-control">{{ old('examination', $visit->consultation?->examination) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis</label>
                    <textarea name="diagnosis" id="diagnosis" rows="3" class="form-control">{{ old('diagnosis', $visit->consultation?->diagnosis) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="treatment" class="form-label">Treatment</label>
                    <textarea name="treatment" id="treatment" rows="3" class="form-control">{{ old('treatment', $visit->consultation?->treatment) }}</textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" name="referral" id="referral" value="1" @checked(old('referral', $visit->consultation?->referral))>
                            <label class="form-check-label" for="referral">Referral to another facility</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="facility" class="form-label">Facility</label>
                        <input type="text" name="facility" id="facility" class="form-control" value="{{ old('facility', $visit->consultation?->facility) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="next_appointment" class="form-label">Next Appointment</label>
                        <input type="date" name="next_appointment" id="next_appointment" class="form-control" value="{{ old('next_appointment', $visit->consultation?->next_appointment?->format('Y-m-d')) }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Part 2: Prescription --}}
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Part 2 — Prescription</span>
                <button type="button" class="btn btn-sm btn-outline-secondary" id="addDrug">+ Add drug</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm align-middle prescription-table">
                        <thead>
                            <tr>
                                <th>Drug Name</th>
                                <th>Dosage</th>
                                <th>Frequency</th>
                                <th>Duration</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="drugRows">
                            @forelse ($visit->prescriptions as $prescription)
                                <tr>
                                    <td><input type="text" name="drugs[{{ $loop->index }}][drug_name]" class="form-control form-control-sm" value="{{ $prescription->drug_name }}"></td>
                                    <td><input type="text" name="drugs[{{ $loop->index }}][dosage]" class="form-control form-control-sm" value="{{ $prescription->dosage }}"></td>
                                    <td><input type="text" name="drugs[{{ $loop->index }}][frequency]" class="form-control form-control-sm" value="{{ $prescription->frequency }}"></td>
                                    <td><input type="text" name="drugs[{{ $loop->index }}][duration]" class="form-control form-control-sm" value="{{ $prescription->duration }}"></td>
                                    <td><input type="text" name="drugs[{{ $loop->index }}][quantity]" class="form-control form-control-sm" value="{{ $prescription->quantity }}"></td>
                                    <td class="text-end">
                                        <a href="{{ route('prescriptions.destroy', $prescription) }}" class="btn btn-sm btn-outline-danger"
                                           onclick="event.preventDefault(); if (confirm('Remove this line?')) document.getElementById('delete-prescription-{{ $prescription->id }}').submit();">Remove</a>
                                        <form id="delete-prescription-{{ $prescription->id }}" method="POST" action="{{ route('prescriptions.destroy', $prescription) }}" class="d-none">@csrf @method('DELETE')</form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-row">
                                    <td colspan="6" class="text-center text-muted small py-3">No drugs yet — click "+ Add drug".</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2 align-items-center">
            <button type="submit" name="complete" value="1" class="btn btn-teal px-4">Complete Visit</button>
            <button type="submit" class="btn btn-outline-secondary px-4">Save Draft</button>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Back to Waiting List</a>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    const tbody = document.getElementById('drugRows');
    const addBtn = document.getElementById('addDrug');
    let index = tbody.querySelectorAll('tr').length;

    addBtn.addEventListener('click', () => {
        if (tbody.querySelector('.empty-row')) {
            tbody.innerHTML = '';
            index = 0;
        }
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><input type="text" name="drugs[${index}][drug_name]" class="form-control form-control-sm" required></td>
            <td><input type="text" name="drugs[${index}][dosage]" class="form-control form-control-sm"></td>
            <td><input type="text" name="drugs[${index}][frequency]" class="form-control form-control-sm"></td>
            <td><input type="text" name="drugs[${index}][duration]" class="form-control form-control-sm"></td>
            <td><input type="text" name="drugs[${index}][quantity]" class="form-control form-control-sm"></td>
            <td class="text-end"><button type="button" class="btn btn-sm btn-outline-danger remove-row">Remove</button></td>
        `;
        tbody.appendChild(tr);
        index++;
    });

    tbody.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endpush