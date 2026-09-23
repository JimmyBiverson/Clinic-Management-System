@extends('frontend.layout')

@section('title', 'Appointment | Kenyan Hospital Management System')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Appointment</h1>
        <nav class="breadcrumb-wrap">
            <a href="{{ url('/home') }}">Home</a>
            <span>/ Appointment</span>
        </nav>
    </div>
</div>

<section class="page-content-block">
    <div class="container appointment-wrap">
        <div class="appointment-box">
            <h3>Make An Appointment</h3>
            <form class="appointment-form">
                <div class="radio-group">
                    <label class="choice-item"><input type="radio" name="patient" checked> New Patient</label>
                    <label class="choice-item"><input type="radio" name="patient"> Old Patient</label>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label>Name</label>
                        <input type="text" placeholder="Name">
                    </div>
                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="email" placeholder="Email">
                    </div>
                    <div class="col-md-4">
                        <label>Phone</label>
                        <input type="text" placeholder="Phone">
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label>Date</label>
                        <input type="date">
                    </div>
                    <div class="col-md-6">
                        <label>Department</label>
                        <select>
                            <option>Select A Department</option>
                            <option>Cardiology</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label>Doctor</label>
                        <input type="text" value="Select A Department First" disabled>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label>Message</label>
                        <textarea rows="5" placeholder="Your Message To The Doctor"></textarea>
                    </div>
                </div>

                <div class="captcha-box">
                    <div class="g-recaptcha"></div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg"><i class="fa-regular fa-calendar"></i> Book Now</button>
            </form>
        </div>
    </div>
</section>
@endsection
