@extends('frontend.layout')

@section('title', 'Doctors | Kenyan Hospital Management System')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 data-reveal>Doctors Of All Departments</h1>
        <nav class="breadcrumb-wrap" data-reveal style="--reveal-delay:100">
            <a href="{{ url('/home') }}">Home</a>
            <span>/ Doctors</span>
        </nav>
    </div>
</div>

<section class="page-content-block">
    <div class="container">
        <div class="team-layout">
            <aside class="sidebar-panel" data-reveal>
                <h3>Doctors Of</h3>
                <ul class="side-links">
                    <li class="active"><a href="{{ url('/home/doctors') }}">All Departments</a></li>
                    <li><a href="{{ url('/home/doctors/1') }}">Cardiology</a></li>
                </ul>
            </aside>

            <div class="team-listing">
                <article class="doctor-card wide-card" data-reveal style="--reveal-delay:100">
                    <div class="doctor-photo small-photo">
                        <img src="{{ asset('assets/frontend/default/images/doctors.png') }}" alt="Dr. Sarah Lee">
                        <a href="{{ url('/home/doctors/1') }}" class="doctor-profile-link">Profile</a>
                    </div>
                    <div class="doctor-content">
                        <h3><a href="{{ url('/home/doctors/1') }}">Dr. Sarah Lee</a></h3>
                        <span class="doctor-specialty">Cardiology</span>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="cta-band dotted-cta">
    <div class="container cta-row">
        <h3 data-reveal>Get In Touch With Our Specialists</h3>
        <a href="{{ url('/home/appointment') }}" class="btn btn-primary" data-reveal style="--reveal-delay:120"><i class="fa-regular fa-calendar"></i> Book Appointment</a>
    </div>
</section>
@endsection
