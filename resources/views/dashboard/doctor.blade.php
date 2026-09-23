<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <h1 class="h3 mb-0 text-dark">Doctor's Dashboard</h1>
    <div class="text-muted">{{ now()->format('l, j F Y') }}</div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card animate-fade-up delay-1" style="background:#0f766e;">
            <div class="stat-number" data-count="{{ $waitingCount }}">{{ $waitingCount }}</div>
            <div class="stat-label">Patients Waiting</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card animate-fade-up delay-2" style="background:#334155;">
            <div class="stat-number" data-count="{{ $waitingList->count() ?? 0 }}">{{ $waitingList->count() ?? 0 }}</div>
            <div class="stat-label">Triaged, Not Consulted</div>
        </div>
    </div>
</div>

<div class="card animate-fade-up delay-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Waiting List</span>
        <span class="badge text-bg-warning">{{ $waitingCount }} pending</span>
    </div>
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2 mb-3">
            <a href="#waiting-list" class="btn btn-teal">Waiting List</a>
        </div>

        @if ($waitingList->isEmpty())
            <div class="text-center text-muted py-4">
                No patients are waiting for consultation right now.
            </div>
        @else
            <div class="table-responsive" id="waiting-list">
                <table class="table table-hover align-middle data-table">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Patient</th>
                            <th>Visit</th>
                            <th>Chief Complaint</th>
                            <th>Lab Tests</th>
                            <th>Arrived</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($waitingList as $visit)
                            <tr>
                                <td class="small">{{ $visit->patient->serial_number }}</td>
                                <td class="fw-semibold">{{ $visit->patient->full_name }}</td>
                                <td><span class="visit-pulse">#{{ $visit->visit_no }}</span></td>
                                <td class="text-muted small">{{ Str::limit($visit->triage?->chief_complaint ?? '—', 45) }}</td>
                                <td class="text-muted small">{{ Str::limit($visit->triage?->lab_tests ?? '—', 35) }}</td>
                                <td class="small">{{ $visit->visit_date?->format('H:i') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('consultations.show', $visit) }}" class="btn btn-sm btn-teal">Open</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>