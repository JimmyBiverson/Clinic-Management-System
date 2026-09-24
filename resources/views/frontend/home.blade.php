@extends('frontend.layout')

@section('title', 'Home | Kenyan Hospital Management System')

@section('content')
<div class="hero-section">
    <div class="hero-slider">
        <div class="hero-slide active" style="background-image: linear-gradient(rgba(6, 39, 56, 0.65), rgba(6, 39, 56, 0.65)), url('{{ asset('assets/frontend/default/images/slider/img-22.jpg') }}');">
            <div class="container hero-inner">
                <h2>Where Compassion and Healing Come Together</h2>
                <p>Dedicated to providing multidisciplinary medical care and backed by state-of-the-art facilities</p>
                <div class="hero-cta">
                    <a href="{{ url('/home/appointment') }}" class="btn btn-primary"><i class="fa-regular fa-calendar"></i> Book Appointment</a>
                    <a href="{{ url('/home/doctors') }}" class="btn btn-outline-light">Our Doctors</a>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="top-quick-info">
    <div class="container info-grid">
        <div class="info-card" data-reveal>
            <div class="info-icon"><i class="fa-solid fa-phone-volume"></i></div>
            <div>
                <h4>Emergency Contact</h4>
                <h3>1-800-400-7400</h3>
            </div>
        </div>
        <div class="info-card" data-reveal style="--reveal-delay:120">
            <div class="info-icon"><i class="fa-solid fa-calendar-check"></i></div>
            <div>
                <h4>Doctor Appointment</h4>
                <a href="{{ url('/home/appointment') }}">Book An Appointment</a>
            </div>
        </div>
        <div class="info-card" data-reveal style="--reveal-delay:240">
            <div class="info-icon"><i class="fa-regular fa-clock"></i></div>
            <div>
                <h4>Opening Hours</h4>
                <ul>
                    <li><span>Monday - Friday</span><strong>10.00-21.00</strong></li>
                    <li><span>Saturday</span><strong>10.00-18.00</strong></li>
                    <li><span>Sunday</span><strong>11.00-17.00</strong></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="stats-band">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item" data-reveal>
                <div class="icon"><i class="fa-solid fa-user-injured"></i></div>
                <div class="number" data-count="{{ $totalPatients }}">0</div>
                <div class="label">Registered Patients</div>
            </div>
            <div class="stat-item" data-reveal style="--reveal-delay:100">
                <div class="icon"><i class="fa-solid fa-clipboard-check"></i></div>
                <div class="number" data-count="{{ $totalVisits }}">0</div>
                <div class="label">Patient Visits</div>
            </div>
            <div class="stat-item" data-reveal style="--reveal-delay:200">
                <div class="icon"><i class="fa-solid fa-pills"></i></div>
                <div class="number" data-count="{{ $totalPrescriptions }}">0</div>
                <div class="label">Prescriptions Issued</div>
            </div>
            <div class="stat-item" data-reveal style="--reveal-delay:300">
                <div class="icon"><i class="fa-solid fa-user-doctor"></i></div>
                <div class="number" data-count="{{ $totalDoctors }}">0</div>
                <div class="label">Specialist Doctors</div>
            </div>
        </div>
    </div>
</section>

<section class="welcome-block">
    <div class="container welcome-grid">
        <div class="welcome-image" data-reveal>
            <img src="{{ asset('assets/frontend/default/images/team-medical-1.jpg') }}" alt="Medical team">
        </div>
        <div class="welcome-copy" data-reveal style="--reveal-delay:120">
            <h3>Welcome To Bayanno Diagnostic Center</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris quisque adipiscing lobortis aptent cras et justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris quisque adipiscing lobortis aptent cras et justo.</p>
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
            <article class="service-card" data-reveal style="--reveal-delay:300">
                <div class="icon-wrap"><i class="fa-solid fa-brain"></i></div>
                <h4>Neurology</h4>
                <p>Clinical expertise in diagnosis and care for neurological disorders and recovery plans.</p>
            </article>
        </div>
    </div>
</section>

<section class="section-block alt-bg">
    <div class="container">
        <div class="section-heading" data-reveal>
            <h3>Departments</h3>
        </div>
        <div class="department-grid">
            <a href="{{ url('/home/department/1') }}" class="department-card" data-reveal>
                <img src="{{ asset('assets/frontend/default/images/dep.jpg') }}" alt="Cardiology">
                <div class="caption">
                    <h5>Cardiology</h5>
                </div>
            </a>
            <a href="{{ url('/home/department/2') }}" class="department-card" data-reveal style="--reveal-delay:100">
                <img src="{{ asset('assets/frontend/default/images/img-15.jpg') }}" alt="Pediatrics">
                <div class="caption">
                    <h5>Pediatrics</h5>
                </div>
            </a>
            <a href="{{ url('/home/department/3') }}" class="department-card" data-reveal style="--reveal-delay:200">
                <img src="{{ asset('assets/frontend/default/images/img-1.jpg') }}" alt="Neurology">
                <div class="caption">
                    <h5>Neurology</h5>
                </div>
            </a>
        </div>
    </div>
</section>

<section class="section-block">
    <div class="container">
        <div class="section-heading" data-reveal>
            <h3>Our Awesome Doctors</h3>
        </div>
        <div class="doctor-grid">
            <article class="doctor-card" data-reveal>
                <div class="doctor-photo">
                    <img src="{{ asset('assets/frontend/default/images/doctors.png') }}" alt="Dr. Sarah Lee">
                    <a href="{{ url('/home/doctors/1') }}" class="doctor-profile-link">View Details</a>
                </div>
                <div class="doctor-content">
                    <span>Cardiology</span>
                    <h3><a href="{{ url('/home/doctors/1') }}">Dr. Sarah Lee</a></h3>
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                </div>
            </article>
            <article class="doctor-card" data-reveal style="--reveal-delay:100">
                <div class="doctor-photo">
                    <img src="{{ asset('assets/frontend/default/images/doctors.png') }}" alt="Dr. Daniel Kim">
                    <a href="{{ url('/home/doctors/2') }}" class="doctor-profile-link">View Details</a>
                </div>
                <div class="doctor-content">
                    <span>Neurology</span>
                    <h3><a href="{{ url('/home/doctors/2') }}">Dr. Daniel Kim</a></h3>
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                </div>
            </article>
            <article class="doctor-card" data-reveal style="--reveal-delay:200">
                <div class="doctor-photo">
                    <img src="{{ asset('assets/frontend/default/images/doctors.png') }}" alt="Dr. Lucy James">
                    <a href="{{ url('/home/doctors/3') }}" class="doctor-profile-link">View Details</a>
                </div>
                <div class="doctor-content">
                    <span>Pediatrics</span>
                    <h3><a href="{{ url('/home/doctors/3') }}">Dr. Lucy James</a></h3>
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container cta-row">
        <h3 data-reveal>Get In Touch With Our Professionals</h3>
        <a href="{{ url('/home/appointment') }}" class="btn btn-primary" data-reveal style="--reveal-delay:120">Make An Appointment</a>
    </div>
</section>
@endsection
