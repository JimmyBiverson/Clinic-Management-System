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
</head>
<body>
    <nav class="top-navbar">
        <div class="container">
            <div class="nav-wrap">
                <a class="brand" href="{{ url('/home') }}">Kenyan Hospital Management System</a>
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
</body>
</html>
