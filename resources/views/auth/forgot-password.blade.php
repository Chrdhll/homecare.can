@extends('layouts.template')

@section('title', 'Lupa Password')

@section('content')
    <section class="section_gap mt5">
        <main class="main">

            <div class="page-title" data-aos="fade">
                <div class="container-boxed">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li class="current">Lupa Password</li>
                        </ol>
                    </nav>
                    <h1>Reset Password</h1>
                </div>
            </div>
            <section id="forgot-password" class="section light-background d-flex align-items-center"
                style="min-height: 60vh;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-8" data-aos="fade-up" data-aos-delay="100">

                            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                                <div class="card-body p-5">

                                    {{-- Ikon Gembok --}}
                                    <div class="text-center mb-4">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle"
                                            style="width: 70px; height: 70px;">
                                            <i class="bi bi-shield-lock-fill fs-1"></i>
                                        </div>
                                        <h4 class="fw-bold mt-3" style="color: var(--heading-color);">Lupa Password?</h4>
                                        <p class="text-muted small">
                                            Jangan khawatir. Masukkan email yang terdaftar, dan kami akan mengirimkan link
                                            untuk mereset password Anda.
                                        </p>
                                    </div>

                                    {{-- Alert Sukses (Link Terkirim) --}}
                                    @if (session('status'))
                                        <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                                            <i class="bi bi-check-circle-fill me-2"></i>
                                            <div>{{ session('status') }}</div>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        {{-- Input Email --}}
                                        <div class="mb-4">
                                            <label for="email"
                                                class="form-label fw-bold small text-uppercase text-muted">Email
                                                Address</label>
                                            <div class="input-group hc-input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-envelope"></i>
                                                </span>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" placeholder="nama@email.com" required
                                                    autofocus>
                                            </div>
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Tombol Kirim --}}
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary rounded-pill py-2 fw-bold"
                                                style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                                <i class="bi bi-send me-2"></i> Kirim Link Reset
                                            </button>
                                        </div>

                                        {{-- Link Kembali --}}
                                        <div class="text-center mt-4">
                                            <a href="{{ route('login') }}"
                                                class="text-decoration-none small text-muted fw-bold">
                                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Login
                                            </a>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </main>
    </section>
@endsection
