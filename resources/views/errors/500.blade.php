@extends('layouts.template')

@section('title', 'Server Error')

@section('content')
    <main class="main" style="padding-top: 120px; padding-bottom: 60px;">
        <div class="container">
            <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">

                <div class="container text-center" data-aos="fade-up">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            {{-- Ilustrasi/Ikon Besar --}}
                            <i class="bi bi-exclamation-triangle display-1 text-primary mb-4 d-block"
                                style="color: var(--accent-color) !important;"></i>

                            {{-- Judul Error --}}
                            <h1 class="display-1 fw-bold mb-0">500</h1>
                            <h2 class="mb-4">Terjadi Kesalahan Server</h2>

                            {{-- Pesan Penjelasan --}}
                            <p class="mb-4 text-muted lead">
                               Maaf, sedang terjadi masalah di sisi server kami. Silakan coba lagi nanti.
                            </p>

                            {{-- Tombol Kembali --}}
                            <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                            </a>

                            {{-- Link Bantuan Tambahan (Opsional) --}}
                            <div class="mt-4">
                                <p class="small text-muted">
                                    Butuh bantuan? <a href="{{ route('home') }}#contact"
                                        class="text-decoration-underline">Hubungi Kami</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>

    {{-- CSS Tambahan Khusus 404 --}}
    <style>
        .error-404 {
            padding: 60px 0;
        }

        .error-404 h1 {
            font-size: 8rem;
            line-height: 1;
            color: var(--accent-color);
            opacity: 0.5;
        }

        .error-404 h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--heading-color);
        }

        @media (max-width: 768px) {
            .error-404 h1 {
                font-size: 6rem;
            }

            .error-404 h2 {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection
