@extends('frontend.layout')

@section('title', 'Doctor Profile | Kenyan Hospital Management System')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Doctors</h1>
        <nav class="breadcrumb-wrap">
            <a href="{{ url('/home') }}">Home</a>
            <span>/ Doctors</span>
        </nav>
    </div>
</div>

<section class="page-content-block">
    <div class="container">
        <div class="profile-layout">
            <aside class="sidebar-panel">
                <h3>Doctors Of</h3>
                <ul class="side-links">
                    <li><a href="{{ url('/home/doctors') }}">All Departments</a></li>
                    <li class="active"><a href="{{ url('/home/doctors/1') }}">Cardiology</a></li>
                </ul>
            </aside>

            <div class="doctor-profile-box">
                <div class="doctor-profile-header">
                    <img src="{{ asset('assets/frontend/default/images/doctors.png') }}" alt="Dr. Sarah Lee">
                    <div>
                        <h2>Dr. Sarah Lee</h2>
                        <p class="specialty">Cardiology</p>
                    </div>
                </div>
                <div class="doctor-profile-meta">
                    <ul>
                        <li><strong>Department:</strong> <span>Cardiology</span></li>
                        <li><strong>Availability:</strong> <span>Mon - Sat</span></li>
                        <li><strong>Experience:</strong> <span>12 Years</span></li>
                    </ul>
                </div>
                <div class="doctor-description">
                    <h5>About</h5>
                    <p>Dr. Sarah Lee is a dedicated cardiologist focused on providing personalized treatment plans for heart-related conditions. Her approach combines clinical excellence with compassionate patient care and advanced diagnostics.</p>
                </div>
                <div class="profile-button-row">
                    <a href="{{ url('/home/appointment') }}" class="btn btn-primary">Book Appointment</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
