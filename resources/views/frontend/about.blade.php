@extends('frontend.layout')

@section('title', 'About Us | Kenyan Hospital Management System')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 data-reveal>About Us</h1>
        <nav class="breadcrumb-wrap" data-reveal style="--reveal-delay:100">
            <a href="{{ url('/home') }}">Home</a>
            <span>/ About Us</span>
        </nav>
    </div>
</div>

<section class="page-content-block">
    <div class="container">
        <div class="about-page">
            <h3 data-reveal>About Kenyan Hospital Management System</h3>
            <p data-reveal style="--reveal-delay:100">Viam sumi mo id erit objectioni mo de necessario crediderim imo terra vox alios aut lor quasi. Vim quaero aut videri pendam plures duo extat neque arcte re ad etiam ego infiniti reperero mutuatur formalem. Viam sumi mo id erit objectioni mo de necessario crediderim imo terra vox alios aut lor quasi. Vim quaero aut videri pendam plures duo extat neque arcte re ad etiam ego infiniti reperero mutuatur formalem. Viam sumi mo id erit objectioni mo de necessario crediderim imo terra vox alios aut lor quasi. Vim quaero aut videri pendam plures duo extat neque arcte re ad etiam ego infiniti reperero mutuatur formalem.</p>
            <p data-reveal style="--reveal-delay:180">Viam sumi mo id erit objectioni mo de necessario crediderim imo terra vox alios aut lor quasi. Vim quaero aut videri pendam plures duo extat neque arcte re ad etiam ego infiniti reperero mutuatur formalem. Viam sumi mo id erit objectioni mo de necessario crediderim imo terra vox alios aut lor quasi. Vim quaero aut videri pendam plures duo extat neque arcte re ad etiam ego infiniti reperero mutuatur formalem. Viam sumi mo id erit objectioni mo de necessario crediderim imo terra vox alios aut lor quasi. Vim quaero aut videri pendam plures duo extat neque arcte re ad etiam ego infiniti reperero mutuatur formalem.</p>
        </div>
    </div>
</section>

<section class="section-block">
    <div class="container">
        <div class="section-heading" data-reveal>
            <h3>Our World Class Services</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna. Ut enim ad minim veniam.</p>
        </div>
        <div class="service-grid">
            <article class="service-card" data-reveal>
                <div class="icon-wrap"><i class="fa-solid fa-heart-pulse"></i></div>
                <h4>Cardiology</h4>
                <p>Expert cardiovascular care combining advanced diagnostics with preventive treatment plans.</p>
            </article>
            <article class="service-card" data-reveal style="--reveal-delay:100">
                <div class="icon-wrap"><i class="fa-solid fa-stethoscope"></i></div>
                <h4>General Medicine</h4>
                <p>Full-spectrum primary care for adults and families, supporting long-term wellness.</p>
            </article>
            <article class="service-card" data-reveal style="--reveal-delay:200">
                <div class="icon-wrap"><i class="fa-solid fa-baby"></i></div>
                <h4>Pediatrics</h4>
                <p>Compassionate, child-focused care designed around growth, comfort, and prevention.</p>
            </article>
        </div>
    </div>
</section>

<div class="appointment-cta-wrap">
    <div class="container">
        <a href="{{ url('/home/appointment') }}" class="btn btn-primary btn-lg" data-reveal>Make An Appointment</a>
    </div>
</div>
@endsection
