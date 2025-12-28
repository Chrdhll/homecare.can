@extends('layouts.template')

@section('title', 'Buat Password Baru')

@section('content')
    <section class="section_gap mt5">
        <main class="main">

            {{-- Breadcrumbs --}}
            <div class="page-title" data-aos="fade">
                <div class="container-boxed">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li class="current">Reset Password</li>
                        </ol>
                    </nav>
                    <h1>Buat Password Baru</h1>
                </div>
            </div>

            {{-- Form Section --}}
            <section id="reset-password" class="section light-background d-flex align-items-center"
                style="min-height: 60vh;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-8" data-aos="fade-up" data-aos-delay="100">

                            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                                <div class="card-body p-5">

                                    {{-- Ikon Kunci --}}
                                    <div class="text-center mb-4">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-warning-subtle text-warning rounded-circle"
                                            style="width: 70px; height: 70px;">
                                            <i class="bi bi-key-fill fs-1"></i>
                                        </div>
                                        <h4 class="fw-bold mt-3" style="color: var(--heading-color);">Set Password Baru</h4>
                                        <p class="text-muted small">
                                            Silakan masukkan password baru Anda untuk mengamankan akun.
                                        </p>
                                    </div>

                                    <form method="POST" action="{{ route('password.store') }}">
                                        @csrf

                                        {{-- Token Reset Password (WAJIB ADA & HIDDEN) --}}
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        {{-- Input Email (Readonly biar user gak salah edit) --}}
                                        <div class="mb-3">
                                            <label for="email" class="form-label fw-bold small text-uppercase text-muted">Email Address</label>
                                            <div class="input-group hc-input-group">
                                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                                    name="email" value="{{ old('email', $request->email) }}" required readonly>
                                            </div>
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Input Password Baru --}}
                                        <div class="mb-3">
                                            <label for="password" class="form-label fw-bold small text-uppercase text-muted">Password Baru</label>
                                            <div class="input-group hc-input-group">
                                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                                    name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                                            </div>
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Input Konfirmasi Password --}}
                                        <div class="mb-4">
                                            <label for="password_confirmation" class="form-label fw-bold small text-uppercase text-muted">Konfirmasi Password</label>
                                            <div class="input-group hc-input-group">
                                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                                    name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password baru">
                                            </div>
                                            @error('password_confirmation')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Tombol Submit --}}
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary rounded-pill py-2 fw-bold"
                                                style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                                <i class="bi bi-check-lg me-2"></i> Reset Password
                                            </button>
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