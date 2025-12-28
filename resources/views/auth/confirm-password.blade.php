@extends('layouts.template')

@section('title', 'Konfirmasi Password')

@section('content')
    <section class="section_gap mt5">
        <main class="main">

            {{-- Breadcrumbs --}}
            <div class="page-title" data-aos="fade">
                <div class="container-boxed">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="current">Konfirmasi Password</li>
                        </ol>
                    </nav>
                    <h1>Konfirmasi Akses</h1>
                </div>
            </div>

            {{-- Main Form --}}
            <section id="confirm-password" class="section light-background d-flex align-items-center"
                style="min-height: 60vh;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-8" data-aos="fade-up" data-aos-delay="100">

                            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                                <div class="card-body p-5">

                                    {{-- Ikon Shield/Keamanan --}}
                                    <div class="text-center mb-4">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle"
                                            style="width: 70px; height: 70px;">
                                            <i class="bi bi-shield-lock-fill fs-1"></i>
                                        </div>
                                        <h4 class="fw-bold mt-3" style="color: var(--heading-color);">Area Aman</h4>
                                        <p class="text-muted small">
                                            Ini adalah area aman aplikasi. Harap konfirmasi password Anda sebelum
                                            melanjutkan.
                                        </p>
                                    </div>

                                    <form method="POST" action="{{ route('password.confirm') }}">
                                        @csrf

                                        {{-- Input Password --}}
                                        <div class="mb-4">
                                            <label for="password"
                                                class="form-label fw-bold small text-uppercase text-muted">Password</label>
                                            <div class="input-group hc-input-group">
                                                <span class="input-group-text"><i class="bi bi-key"></i></span>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password"
                                                    placeholder="Masukkan password Anda">
                                            </div>
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Tombol Konfirmasi --}}
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary rounded-pill py-2 fw-bold"
                                                style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                                <i class="bi bi-unlock-fill me-2"></i> Konfirmasi
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
