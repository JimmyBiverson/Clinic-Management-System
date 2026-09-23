@extends('frontend.layout')

@section('title', 'Contact Us | Kenyan Hospital Management System')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Contact Us</h1>
        <nav class="breadcrumb-wrap">
            <a href="{{ url('/home') }}">Home</a>
            <span>/ Contact Us</span>
        </nav>
    </div>
</div>

<section class="page-content-block">
    <div class="container contact-wrap">
        <div class="contact-copy">
            <h2>Contact Us For Help</h2>
            <p>Please Call Us Or Complete The Form Below And We Will Get To You Shortly</p>
            <button class="btn btn-primary btn-lg" type="button"><i class="fa-solid fa-phone"></i> 1-800-400-7400</button>
        </div>

        <form class="contact-form">
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Your Name</label>
                    <input type="text" placeholder="Your Name">
                </div>
                <div class="col-md-6">
                    <label>Your Email</label>
                    <input type="email" placeholder="Your Email">
                </div>
            </div>
            <div class="row g-3 mt-1">
                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" placeholder="Phone">
                </div>
                <div class="col-md-6">
                    <label>Address</label>
                    <input type="text" placeholder="Address">
                </div>
            </div>
            <div class="row g-3 mt-1">
                <div class="col-md-12">
                    <label>Message</label>
                    <textarea rows="5" placeholder="Type your message here..."></textarea>
                </div>
            </div>
            <div class="captcha-box">
                <div class="g-recaptcha"></div>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</section>
@endsection
