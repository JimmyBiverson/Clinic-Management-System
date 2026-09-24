<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Koyonzo Family Care Clinic</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/clinic.css') }}">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: 0;
            border-radius: 18px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
        }
        .login-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: #0f766e;
            color: #fff;
            font-size: 1.6rem;
            font-weight: 800;
        }
        .js .login-card {
            opacity: 0;
            transform: translateY(18px);
            animation: fadeInUp 0.6s ease forwards;
        }
        .js .login-logo {
            animation: visitPulse 2s ease infinite;
        }
        @media (max-width: 575.98px) {
            body {
                padding: 0.75rem;
                align-items: flex-start;
                padding-top: 6vh;
            }
        }
    </style>
</head>
<body>
    <script>document.documentElement.classList.add('js');</script>
    <div class="card login-card">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="login-logo mb-3">K</div>
                <h1 class="h4 mb-1 text-dark fw-bold">Koyonzo Family Care Clinic</h1>
                <p class="text-muted mb-0">Sign in to continue</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text"
                           name="username"
                           id="username"
                           class="form-control form-control-lg @error('username') is-invalid @enderror"
                           value="{{ old('username') }}"
                           required
                           autofocus
                           autocomplete="username">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                           required
                           autocomplete="current-password">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-teal btn-lg">Sign In</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="{{ url('/home') }}" class="text-decoration-none small fw-semibold" style="color:#0f766e;">← Back to website</a>
            </div>
        </div>
    </div>
</body>
</html>