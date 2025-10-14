<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register - {{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .main-container {
            position: relative;
            min-height: 100vh;
            background-color: #f8f9fa;
            background-image: 
                linear-gradient(to bottom, white 50%, transparent 50%), 
                url('{{ asset('assets/img/login_bg.jpg') }}');
            background-repeat: no-repeat;
            background-size: 100% 100%, cover;
            background-position: center, center;
        }
        .main-container::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 50%;
            background-color: rgba(6, 41, 55, 0.7);
        }
        .register-card {
            border-radius: 1.5rem;
        }
        .form-control.custom-input {
            background-color: #f1f1f1;
            border: none;
            padding: 0.85rem 1.5rem;
        }
        /* Penyesuaian untuk input dengan ikon */
        .password-wrapper .form-control {
            padding-right: 3.5rem; /* Beri ruang di kanan untuk ikon */
        }
        .btn-dark-custom {
            background-color: #547082;
            color: #f4f4f4;
            border: none;
        }
        .btn-dark-custom:hover {
            background-color: #2d3748;
            color: #f4f4f4;
            border: none;
        }

        .logo-container {
            position: absolute;
            top: 2rem;
            left: 2rem;
            z-index: 10;
        }
        .logo-image {
            max-width: 200px;
            height: auto;
        }
        .password-toggle-icon {
            position: absolute;
            top: 50%;
            right: 1.5rem;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 5;
        }
    </style>
</head>
<body class="antialiased">

    <div class="main-container d-flex align-items-center justify-content-center p-3">
        
        <div class="logo-container">
            <a href="/">
                <img src="{{ asset('assets/img/logo_1.png') }}" alt="Homecare.can Logo" class="logo-image">
            </a>
        </div>

        <div class="col-11 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card register-card shadow-lg border-0">
                <div class="card-body p-5">
                    
                    <h2 class="card-title text-center fw-bold mb-4" style="color: #062937">Sign Up</h2>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <input id="name" type="text" name="name" class="form-control rounded-pill custom-input" placeholder="Full Name" value="{{ old('name') }}" required autofocus autocomplete="name">
                            @error('name') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <input id="email" type="email" name="email" class="form-control rounded-pill custom-input" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="username">
                            @error('email') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3 position-relative password-wrapper">
                            <input id="password" type="password" name="password" class="form-control rounded-pill custom-input" placeholder="Password" required autocomplete="new-password">
                            <i class="bi bi-eye-slash password-toggle-icon" id="togglePassword"></i>
                            @error('password') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4 position-relative password-wrapper">
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control rounded-pill custom-input" placeholder="Confirm Password" required autocomplete="new-password">
                            <i class="bi bi-eye-slash password-toggle-icon" id="togglePasswordConfirm"></i>
                            @error('password_confirmation') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-dark-custom rounded-pill fw-bold py-2">Create Account</button>
                        </div>
                        
                        <div class="d-flex align-items-center my-3">
                            <hr class="flex-grow-1">
                            <span class="mx-3 text-muted small">Or</span>
                            <hr class="flex-grow-1">
                        </div>

                        <div class="d-grid">
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary rounded-pill fw-bold py-2">Log in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setupPasswordToggle(toggleId, passwordId) {
            const togglePassword = document.querySelector(toggleId);
            const password = document.querySelector(passwordId);

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function (e) {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }
        }

        setupPasswordToggle('#togglePassword', '#password');
        setupPasswordToggle('#togglePasswordConfirm', '#password_confirmation');
    </script>
</body>
</html>