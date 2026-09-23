<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Koyonzo Family Care Clinic')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/clinic.css') }}">
</head>
<body>
    <script>document.documentElement.classList.add('js');</script>
    @auth
        <nav class="navbar navbar-expand-lg clinic-navbar mb-4">
            <div class="container-lg">
                <a class="navbar-brand clinic-brand" href="{{ route('dashboard') }}">
                    <span class="brand-mark">K</span>
                    Koyonzo Family Care Clinic
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        @if (auth()->user()->isStaff())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('patients.index') }}">Patients</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('patients.create') }}">Register Patient</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Waiting List</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <span class="nav-link role-badge text-uppercase">{{ auth()->user()->role }}</span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endauth

    <main class="container-lg pb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            document.querySelectorAll('.stat-card').forEach((card, i) => {
                card.style.transitionDelay = prefersReducedMotion ? '0s' : `${i * 80}ms`;
            });

            const counters = document.querySelectorAll('.stat-number[data-count]');
            if (!counters.length) return;

            const animate = (el) => {
                const target = parseFloat(el.dataset.count);
                const duration = prefersReducedMotion ? 0 : 900;
                const start = performance.now();

                const step = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    const value = target * eased;
                    el.textContent = Number.isInteger(target)
                        ? Math.round(value).toString()
                        : value.toFixed(1);
                    if (progress < 1) requestAnimationFrame(step);
                };

                requestAnimationFrame(step);
            };

            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    const card = entry.target.closest('.stat-card');
                    if (card) card.classList.add('is-visible');
                    animate(entry.target);
                    obs.unobserve(entry.target);
                });
            }, { threshold: 0.4 });

            counters.forEach((counter) => observer.observe(counter));
        });
    </script>
    @stack('scripts')
</body>
</html>