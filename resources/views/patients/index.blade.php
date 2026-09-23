@extends('layouts.app')

@section('title', 'Patients — Koyonzo Family Care Clinic')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h1 class="h3 mb-0 text-dark">Patients</h1>
        <a href="{{ route('patients.create') }}" class="btn btn-teal">Register Patient</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('patients.index') }}" class="row g-2">
                <div class="col-md-9">
                    <input type="text"
                           name="q"
                           class="form-control"
                           placeholder="Search by name, phone or serial number…"
                           value="{{ $query ?? '' }}">
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-teal">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            @if ($patients->isEmpty())
                <div class="text-center text-muted py-5 m-0">
                    No patients found.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle data-table mb-0">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Age / Gender</th>
                                <th>Visits</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td class="small">{{ $patient->serial_number }}</td>
                                    <td class="fw-semibold">{{ $patient->full_name }}</td>
                                    <td class="small">{{ $patient->phone ?? '—' }}</td>
                                    <td class="small">
                                        {{ $patient->age() !== null ? $patient->age().' yrs' : '—' }}
                                        @if ($patient->gender) / {{ $patient->gender }} @endif
                                    </td>
                                    <td>{{ $patient->visits_count }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('patients.show', $patient) }}" class="btn btn-sm btn-teal">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="card-body border-top">
            {{ $patients->links() }}
        </div>
    </div>
@endsection