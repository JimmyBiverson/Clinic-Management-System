@extends('frontend.layout')

@section('title', 'Blog | Kenyan Hospital Management System')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Blog</h1>
        <nav class="breadcrumb-wrap">
            <a href="{{ url('/home') }}">Home</a>
            <span>/ Blog</span>
        </nav>
    </div>
</div>

<section class="page-content-block">
    <div class="container">
        <div class="blog-grid">
            <article class="blog-card">
                <div class="blog-image" style="background-image:url('{{ asset('assets/frontend/default/images/img-15.jpg') }}');"></div>
                <div class="blog-body">
                    <h3>Healthy Habits for Better Heart Care</h3>
                    <p>Learn simple daily routines that support your heart and reduce preventable risks over time.</p>
                </div>
            </article>
            <article class="blog-card">
                <div class="blog-image" style="background-image:url('{{ asset('assets/frontend/default/images/dep.jpg') }}');"></div>
                <div class="blog-body">
                    <h3>Why Preventive Care Matters</h3>
                    <p>Early screenings and regular checkups can help identify underlying issues before they become more serious.</p>
                </div>
            </article>
            <article class="blog-card">
                <div class="blog-image" style="background-image:url('{{ asset('assets/frontend/default/images/img-1.jpg') }}');"></div>
                <div class="blog-body">
                    <h3>Supporting Pediatric Wellness</h3>
                    <p>Practical advice for helping children build lifelong health habits with comfort and confidence.</p>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
