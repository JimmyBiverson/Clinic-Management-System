<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kenyan Hospital Management System')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/hospital-theme.css') }}">
    <script>document.documentElement.classList.add('js');</script>
</head>
<body>
    <nav class="top-navbar">
        <div class="container">
            <div class="nav-wrap">
                <a class="brand" href="{{ url('/home') }}">Kenyan Hospital Management System</a>
                <button class="nav-toggle" type="button" aria-label="Toggle navigation menu" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
                <ul class="nav-list">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="#">Departments</a></li>
                    <li><a href="{{ url('/home/doctors') }}">Doctors</a></li>
                    <li><a href="{{ url('/home/about_us') }}">About</a></li>
                    <li><a href="{{ url('/home/appointment') }}">Appointment</a></li>
                    <li><a href="{{ url('/home/blog') }}">Blog</a></li>
                    <li><a href="{{ url('/home/contact_us') }}">Contact</a></li>
                    <li><a href="{{ url('/login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <div class="footer-brand">Kenyan Hospital Management System</div>
            </div>
            <div>
                <h4>Main Menu</h4>
                <ul>
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/home/doctors') }}">Doctors</a></li>
                    <li><a href="{{ url('/home/appointment') }}">Make An Appointment</a></li>
                    <li><a href="{{ url('/login') }}">Login</a></li>
                </ul>
            </div>
            <div>
                <h4>Help And Support</h4>
                <ul>
                    <li><a href="{{ url('/home/contact_us') }}">Contact Us</a></li>
                    <li><a href="{{ url('/home/about_us') }}">About Us</a></li>
                    <li><a href="{{ url('/home/blog') }}">Blog</a></li>
                </ul>
            </div>
            <div class="socials">
                <p>copyright@Hospital Management | 2026</p>
                <div class="social-icons">
                    <a href="http://facebook.com" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://twitter.com" target="_blank" rel="noopener"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://google.com" target="_blank" rel="noopener"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="https://youtube.com" target="_blank" rel="noopener"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            var toggle = document.querySelector('.nav-toggle');
            var wrap = document.querySelector('.nav-wrap');
            if (toggle && wrap) {
                toggle.addEventListener('click', function () {
                    var isOpen = wrap.classList.toggle('nav-open');
                    toggle.classList.toggle('open', isOpen);
                    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            }

            var revealEls = document.querySelectorAll('[data-reveal]');
            function show(el) { el.classList.add('in-view'); }
            if ('IntersectionObserver' in window) {
                var io = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) { show(entry.target); io.unobserve(entry.target); }
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -36px 0px' });
                revealEls.forEach(function (el) { io.observe(el); });
            } else {
                revealEls.forEach(show);
            }

            function runCount(el) {
                var target = parseFloat(el.getAttribute('data-count')) || 0;
                var suffix = el.getAttribute('data-suffix') || '';
                var dur = parseInt(el.getAttribute('data-duration') || '1800', 10);
                var start = null;
                function step(ts) {
                    if (start === null) start = ts;
                    var p = Math.min((ts - start) / dur, 1);
                    var eased = 1 - Math.pow(1 - p, 3);
                    var val = target * eased;
                    el.textContent = (Number.isInteger(target) ? Math.round(val) : val.toFixed(1)).toLocaleString() + suffix;
                    if (p < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }

            var counters = document.querySelectorAll('[data-count]');
            if ('IntersectionObserver' in window) {
                var cio = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) { runCount(entry.target); cio.unobserve(entry.target); }
                    });
                }, { threshold: 0.5 });
                counters.forEach(function (el) { cio.observe(el); });
            } else {
                counters.forEach(function (el) {
                    el.textContent = (parseFloat(el.getAttribute('data-count')) || 0).toLocaleString();
                });
            }
        })();
    </script>
</body>
</html>
