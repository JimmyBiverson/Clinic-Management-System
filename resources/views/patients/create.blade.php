@extends('layouts.app')

@section('title', 'Register Patient — Koyonzo Family Care Clinic')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-dark">Register New Patient</h1>
        <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    <div class="card">
        <div class="card-header">Patient Details</div>
        <div class="card-body">
            <form method="POST" action="{{ route('patients.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">— Select —</option>
                            <option value="Male" @selected(old('gender') === 'Male')>Male</option>
                            <option value="Female" @selected(old('gender') === 'Female')>Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="insurance" class="form-label">Insurance</label>
                        <input type="text" class="form-control" id="insurance" name="insurance" value="{{ old('insurance') }}" placeholder="NHIF, AAR, Private…">
                    </div>
                    <div class="col-md-6">
                        <label for="nok_contact" class="form-label">Next of Kin Contact</label>
                        <input type="text" class="form-control" id="nok_contact" name="nok_contact" value="{{ old('nok_contact') }}">
                    </div>
                </div>

                <hr>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="visit_type" class="form-label">Visit Type</label>
                        <select name="visit_type" id="visit_type" class="form-select">
                            <option value="Outpatient">Outpatient</option>
                            <option value="Inpatient">Inpatient</option>
                            <option value="Consultation">Consultation</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-teal px-4">Register & Start Triage</button>
                    <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
                <div class="form-text mt-2">A serial number (PAT-YYYY-####) and today's visit will be created automatically.</div>
            </form>
        </div>
    </div>
@endsection