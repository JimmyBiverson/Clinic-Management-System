@extends('frontend.layout')

@section('title', 'Login | Kenyan Hospital Management System')

@section('content')
<div class="login-shell">
    <div class="login-box" data-reveal>
        <div class="login-brand">
            <img src="{{ asset('assets/frontend/default/images/logo-1-b.png') }}" alt="Hospital Management System">
            <h2>Hospital Management System</h2>
        </div>
        <div class="login-form-wrap">
            <h3>Login</h3>
            <form class="login-form" action="{{ url('/login') }}" method="GET">
                <div class="form-group">
                    <label>Email*</label>
                    <input type="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label>Password*</label>
                    <input type="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <a href="{{ url('/login') }}" class="forgot-password">Go To Staff / Doctor Login</a>
        </div>
    </div>
</div>
@endsection
