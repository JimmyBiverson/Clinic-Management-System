@extends('frontend.layout')

@section('title', 'Department | Kenyan Hospital Management System')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Department</h1>
        <nav class="breadcrumb-wrap">
            <a href="{{ url('/home') }}">Home</a>
            <span>/ Department</span>
        </nav>
    </div>
</div>

<section class="page-content-block">
    <div class="container department-page">
        <aside class="sidebar-panel">
            <h3>Department</h3>
            <ul class="side-links">
                <li class="active"><a href="#">Cardiology</a></li>
            </ul>
            <div class="sidebar-button">
                <a href="{{ url('/home/appointment') }}" class="btn btn-primary">Book an Appointment</a>
            </div>
        </aside>

        <div class="department-content">
            <h2>Cardiology</h2>
            <p>Cardiology is a specialized department focused on heart health, preventive care, diagnostics, and treatment planning for patients with cardiovascular conditions. We provide compassionate follow-up care and advanced evaluation tailored to each patient.</p>
            <p>Our team combines clinical expertise with modern technology to deliver patient-centered treatment for arrhythmias, heart disease, and long-term cardiac support. Care plans are designed to improve quality of life while maintaining excellent outcomes.</p>
        </div>
    </div>
</section>
@endsection
