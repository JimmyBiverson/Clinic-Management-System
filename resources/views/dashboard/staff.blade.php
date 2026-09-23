<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <h1 class="h3 mb-0 text-dark">Staff Dashboard</h1>
    <div class="text-muted">{{ now()->format('l, j F Y') }}</div>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card" style="background:#0f766e;">
            <div class="stat-number">{{ $todayCount }}</div>
            <div class="stat-label">Visits Today</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card" style="background:#0ea5e9;">
            <div class="stat-number">{{ $waitingCount }}</div>
            <div class="stat-label">Awaiting Doctor</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card" style="background:#22c55e;">
            <div class="stat-number">{{ $completedCount }}</div>
            <div class="stat-label">Completed Cases</div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-4 d-grid">
        <a href="{{ route('patients.create') }}" class="btn btn-teal btn-lg py-3">Register New Patient</a>
    </div>
    <div class="col-12 col-md-4 d-grid">
        <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary btn-lg py-3">Find Patient</a>
    </div>
</div>

<h2 class="h5 text-dark mt-4 mb-3">Today's Visits</h2>

<div class="card">
    <div class="card-body p-0">
        @if ($todayVisits->isEmpty())
            <div class="text-center text-muted py-4 m-0">
                No visits recorded today yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle data-table mb-0">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Patient</th>
                            <th>Visit</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todayVisits as $visit)
                            <tr>
                                <td class="small">{{ $visit->patient->serial_number }}</td>
                                <td class="fw-semibold">{{ $visit->patient->full_name }}</td>
                                <td>#{{ $visit->visit_no }}</td>
                                <td>
                                    @if ($visit->completed)
                                        <span class="badge text-bg-success">Completed</span>
                                    @elseif ($visit->consultation_done)
                                        <span class="badge text-bg-info">Consulted</span>
                                    @elseif ($visit->triage_done)
                                        <span class="badge text-bg-warning">With Doctor</span>
                                    @else
                                        <span class="badge text-bg-secondary">Awaiting Triage</span>
                                    @endif
                                </td>
                                <td class="small">{{ $visit->visit_date?->format('H:i') }}</td>
                                <td class="text-end">
                                    @if ($visit->completed)
                                        <a href="{{ route('patients.show', $visit->patient) }}" class="btn btn-sm btn-teal">View Consultation</a>
                                    @elseif ($visit->triage_done)
                                        <a href="{{ route('triage.edit', $visit) }}" class="btn btn-sm btn-outline-secondary">Edit Triage</a>
                                    @else
                                        <a href="{{ route('triage.edit', $visit) }}" class="btn btn-sm btn-teal">Triage</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>