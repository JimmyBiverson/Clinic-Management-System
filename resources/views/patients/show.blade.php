@extends('layouts.app')

@section('title', $patient->full_name.' — Koyonzo Family Care Clinic')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <a href="{{ route('patients.index') }}" class="text-decoration-none small">← Patients</a>
            <h1 class="h3 mb-0 text-dark mt-1">{{ $patient->full_name }}</h1>
            <div class="text-muted small">{{ $patient->serial_number }} · {{ $patient->age() !== null ? $patient->age().' yrs' : '—' }} · {{ $patient->gender ?? '—' }}</div>
        </div>
        <div class="d-flex gap-2">
            @if (auth()->user()->isStaff())
                <form method="POST" action="{{ route('visits.store', $patient) }}">
                    @csrf
                    <button type="submit" class="btn btn-teal">New Visit</button>
                </form>
            @endif
        </div>
    </div>

    @if ($patient->phone || $patient->insurance || $patient->nok_contact)
        <div class="client-detail mb-4 d-flex flex-wrap gap-4">
            @if ($patient->phone)<span><strong>Phone:</strong> {{ $patient->phone }}</span>@endif
            @if ($patient->insurance)<span><strong>Insurance:</strong> {{ $patient->insurance }}</span>@endif
            @if ($patient->nok_contact)<span><strong>Next of Kin:</strong> {{ $patient->nok_contact }}</span>@endif
        </div>
    @endif

    <h2 class="h5 text-dark mt-4 mb-3">Visit History ({{ $patient->visits->count() }} total)</h2>

    @foreach ($patient->visits as $visit)
        <div class="card mb-3">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span>
                    Visit #{{ $visit->visit_no }}
                    <span class="badge text-bg-{{ $visit->completed ? 'success' : ($visit->consultation_done ? 'info' : ($visit->triage_done ? 'warning' : 'secondary')) }} ms-2">
                        {{ $visit->completed ? 'Completed' : ($visit->consultation_done ? 'Consulted' : ($visit->triage_done ? 'With Doctor' : 'Awaiting Triage')) }}
                    </span>
                </span>
                <span class="text-muted small">{{ $visit->visit_date?->format('d M Y H:i') }} · {{ $visit->visit_type }}</span>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="section-title">Staff Entry — Triage</div>
                        @if ($visit->triage)
                            <ul class="list-unstyled small mb-0">
                                <li><strong>Chief Complaint:</strong><br>{{ $visit->triage->chief_complaint ?? '—' }}</li>
                                <li><strong>Lab Tests:</strong><br>{{ $visit->triage->lab_tests ?? '—' }}</li>
                            </ul>
                            <hr>
                            <div class="row text-center small">
                                <div class="col-4">BP<br>{{ $visit->triage->bp ?? '—' }}</div>
                                <div class="col-4">Temp<br>{{ $visit->triage->temp ?? '—' }}</div>
                                <div class="col-4">Pulse<br>{{ $visit->triage->pulse ?? '—' }}</div>
                                <div class="col-4 mt-2">Resp<br>{{ $visit->triage->resp ?? '—' }}</div>
                                <div class="col-4 mt-2">Weight<br>{{ $visit->triage->weight ?? '—' }}</div>
                                <div class="col-4 mt-2">BMI<br>{{ $visit->triage->bmi ?? '—' }}</div>
                            </div>
                        @else
                            <div class="text-muted small">No triage recorded.</div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <div class="section-title">Doctor's Consultation</div>
                        @if ($visit->consultation)
                            <ul class="list-unstyled small mb-0">
                                <li><strong>History:</strong><br>{{ $visit->consultation->history ?? '—' }}</li>
                                <li><strong>Examination:</strong><br>{{ $visit->consultation->examination ?? '—' }}</li>
                                <li><strong>Diagnosis:</strong><br>{{ $visit->consultation->diagnosis ?? '—' }}</li>
                                <li><strong>Treatment:</strong><br>{{ $visit->consultation->treatment ?? '—' }}</li>
                                @if ($visit->consultation->referral)
                                    <li><strong>Referral:</strong> {{ $visit->consultation->facility ?? '—' }}</li>
                                @endif
                                @if ($visit->consultation->next_appointment)
                                    <li><strong>Next Appointment:</strong> {{ $visit->consultation->next_appointment->format('d M Y') }}</li>
                                @endif
                                <li class="text-muted mt-2"><em>By: {{ $visit->consultation->doctor?->name ?? '—' }}</em></li>
                            </ul>
                        @else
                            <div class="text-muted small">Not yet consulted.</div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <div class="section-title">Prescription</div>
                        @if ($visit->prescriptions->isEmpty())
                            <div class="text-muted small">No prescriptions.</div>
                        @else
                            <table class="table table-sm small align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Drug</th>
                                        <th>Dosage</th>
                                        <th>Freq</th>
                                        <th>Dur</th>
                                        <th class="text-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visit->prescriptions as $p)
                                        <tr>
                                            <td class="fw-semibold">{{ $p->drug_name }}</td>
                                            <td>{{ $p->dosage ?? '—' }}</td>
                                            <td>{{ $p->frequency ?? '—' }}</td>
                                            <td>{{ $p->duration ?? '—' }}</td>
                                            <td class="text-end">
                                                <span class="badge text-bg-{{ $p->status === 'Dispensed' ? 'success' : 'warning' }}">{{ $p->status }}</span>
                                                @if (auth()->user()->isStaff() && $visit->consultation)
                                                    <form method="POST" action="{{ route('prescriptions.dispense', $p) }}" class="d-inline ms-1">
                                                        @csrf
                                                        <button type="submit" class="btn btn-xs btn-outline-secondary">Toggle</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection