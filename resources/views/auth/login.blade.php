<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .main-container {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            width: 100%;
            background-color: #f8f9fa;
            background-image:
                linear-gradient(to bottom, white 50%, rgba(6, 41, 55, 0.7) 50%),
                url('{{ asset('assets/img/login_bg.jpg') }}');
            background-repeat: no-repeat;
            background-size: 100% 100%, cover;
            background-position: center, center;
        }


        .password-wrapper .form-control {
            padding-right: 3.5rem;
            /* Beri ruang di kanan untuk ikon */
        }

        .login-card {
            border-radius: 1.5rem;
            max-width: 420px;
        }

        .form-control.custom-input {
            background-color: #f1f1f1;
            border: none;
            padding: 0.85rem 1.5rem;
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
            max-width: 180px;
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

        .login-card .form-control {
            font-size: 0.9rem;
        }

        .login-card button {
            font-size: 0.9rem;
        }

        @media (max-width: 576px) {
            .main-container {
                padding: 1rem !important;
                /* Kurangi padding container utama */
            }

            .logo-container {
                top: 1rem;
                left: 1rem;
            }

            .logo-image {
                max-width: 140px;
                /* Logo lebih kecil di HP */
            }

            .login-card {
                margin-top: 3rem;
                /* Jarak biar gak nabrak logo */
            }

            .card-body {
                padding: 1.5rem !important;
                /* Padding dalam card DIKECILIN (tadinya p-5/3rem) */
            }

            .card-title {
                font-size: 1.5rem;
                /* Judul agak kecil dikit */
                margin-bottom: 1rem !important;
            }

            .form-control.custom-input {
                padding: 0.7rem 1.2rem;
                /* Input lebih compact */
                font-size: 0.9rem;
            }

            /* Fix teks Remember Me & Forgot Password */
            .remember-forgot-wrapper {
                flex-direction: row;
                /* Tetap sebaris */
                font-size: 0.75rem !important;
                /* Font KECILIN (12px) */
            }

            .remember-forgot-wrapper label,
            .remember-forgot-wrapper a {
                font-size: 0.8rem;
            }

            /* Tombol lebih tinggi biar enak dipencet */
            .btn-dark-custom,
            .btn-google {
                padding-top: 0.8rem !important;
                padding-bottom: 0.8rem !important;
                font-size: 1rem !important;
            }
        }
    </style>
</head>

<body class="antialiased">

    <div class="main-container d-flex align-items-center justify-content-center p-3">
        =
        <div class="logo-container">
            <a href="/">
                <img src="{{ asset('assets/img/logo_1.png') }}" alt="Homecare.can Logo" class="logo-image">
            </a>
        </div>

        <div class="col-11 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card login-card shadow-lg border-0">
                <div class="card-body p-5">

                    <h2 class="card-title text-center fw-bold mb-4" style="color: #062937">Log in</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control rounded-pill custom-input"
                                placeholder="Email" required autofocus value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative password-wrapper">
                            <input id="password" type="password" name="password"
                                class="form-control rounded-pill custom-input" placeholder="Password" required>
                            <i class="bi bi-eye-slash password-toggle-icon" id="togglePassword"></i>
                            @error('password')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label small" for="remember_me">
                                    Remember me
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot
                                    password?</a>
                            @endif
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-dark-custom rounded-pill fw-bold py-2">LOG
                                IN</button>
                        </div>

                        <div class="d-flex align-items-center my-4">
                            <hr class="flex-grow-1">
                            <span class="mx-3 text-muted small">OR</span>
                            <hr class="flex-grow-1">
                        </div>

                        <div class="d-grid">
                            <a href="{{ route('auth.google.redirect') }}"
                                class="btn btn-outline-secondary rounded-pill py-2">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg"
                                    alt="Google" width="20" class="me-2 align-middle">
                                <span class="align-middle">Sign in with Google</span>
                            </a>
                        </div>

                        <div class="text-center mt-4">
                            <p class="small mb-0">
                                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function setupPasswordToggle(toggleId, passwordId) {
            const togglePassword = document.querySelector(toggleId);
            const password = document.querySelector(passwordId);

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function(e) {
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
