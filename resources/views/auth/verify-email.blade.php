@extends('layouts.template')

@section('title', 'Verifikasi Email')

@section('content')
    <section class="section_gap mt5">
        <main class="main">

            {{-- Breadcrumbs Section --}}
            <div class="page-title" data-aos="fade">
                <div class="container-boxed">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="current">Verifikasi Email</li>
                        </ol>
                    </nav>
                    <h1>Verifikasi Email</h1>
                </div>
            </div>

            {{-- Main Card Section --}}
            <section id="verify-email" class="section light-background d-flex align-items-center"
                style="min-height: 60vh;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8" data-aos="fade-up" data-aos-delay="100">

                            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                                <div class="card-body p-5">

                                    {{-- Ikon Amplop --}}
                                    <div class="text-center mb-4">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle"
                                            style="width: 80px; height: 80px;">
                                            <i class="bi bi-envelope-check-fill fs-1"></i>
                                        </div>
                                        <h4 class="fw-bold mt-3" style="color: var(--heading-color);">Verifikasi Email Kamu</h4>
                                        <p class="text-muted small mt-2">
                                            Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan ke email Anda.
                                        </p>
                                        <p class="text-muted small">
                                            Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkannya lagi.
                                        </p>
                                    </div>

                                    {{-- Alert Sukses (Link Dikirim Ulang) --}}
                                    @if (session('status') == 'verification-link-sent')
                                        <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                                            <i class="bi bi-check-circle-fill me-2"></i>
                                            <div class="small">
                                                Link verifikasi baru telah dikirim ke alamat email yang Anda gunakan saat pendaftaran.
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Tombol Kirim Ulang Verifikasi --}}
                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf
                                        <div class="d-grid gap-2 mb-3">
                                            <button type="submit" class="btn btn-primary rounded-pill py-2 fw-bold"
                                                style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                                <i class="bi bi-send-arrow-up me-2"></i> Kirim Ulang Email Verifikasi
                                            </button>
                                        </div>
                                    </form>

                                    {{-- Tombol Logout --}}
                                    <div class="text-center mt-4 pt-2 border-top">
                                        <p class="text-muted small mb-2">Ingin mengganti akun atau keluar?</p>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-decoration-none text-muted fw-bold p-0" style="font-size: 0.9rem;">
                                                <i class="bi bi-box-arrow-right me-1"></i> Log Out
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </main>
    </section>
@endsection