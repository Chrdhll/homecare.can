@extends('layouts.template')

@section('title', 'Detail Layanan: ' . $service->name)

@section('content')

    <section class="section_gap mt5">
        <main class="main">

            <div class="page-title" data-aos="fade">
                <div class="container">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="current">{{ $service->name }}</li>
                        </ol>
                    </nav>
                    <h1>Detail Layanan</h1>
                </div>
            </div>
            <section id="service-details" class="portfolio-details section">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row gy-4 gy-lg-5">

                        {{-- ============================================= --}}
                        {{-- KIRI: KONTEN UTAMA (GAMBAR & DESKRIPSI) --}}
                        {{-- ============================================= --}}
                        <div class="col-lg-8">

                            <div class="portfolio-details-slider swiper init-swiper">
                                <script type="application/json" class="swiper-config">
                                    {
                                        "loop": true, "speed": 600, "autoplay": {"delay": 5000},
                                        "slidesPerView": "auto",
                                        "pagination": {"el": ".swiper-pagination", "type": "bullets", "clickable": true},
                                        "grabCursor": true, 
                                        "simulateTouch": true
                                    }
                                </script>
                                <div class="swiper-wrapper align-items-center">

                                    {{-- Loop data dari kolom 'gallery' --}}
                                    @if (!empty($service->gallery) && count($service->gallery) > 0)
                                        @foreach ($service->gallery as $imagePath)
                                            <div class="swiper-slide">
                                                <img src="{{ Storage::url($imagePath) }}" alt="{{ $service->name }}"
                                                    loading="lazy">
                                            </div>
                                        @endforeach
                                    @else
                                        {{-- Fallback kalau galeri kosong, pakai gambar lama (jika ada) --}}
                                        <div class="swiper-slide">
                                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}"
                                                loading="lazy">
                                        </div>
                                    @endif
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>

                            <div class="service-description-content mt-4">

                                {{-- Judul Utama --}}
                                <h2 class="h3 fw-bold mb-3">{{ $service->name }}</h2>

                                {{-- Deskripsi --}}
                                <div class="service-description-text">
                                    {!! nl2br(e($service->description)) !!}
                                </div>

                                {{-- Manfaat --}}
                                @if ($service->benefits)
                                    <div class="service-benefits-content mt-4">
                                        <h3 class="h4 fw-bold mb-3">Manfaat Layanan</h3>
                                        <ul class="list-unstyled">
                                            @foreach (explode("\n", $service->benefits) as $benefit)
                                                @if (strlen(trim($benefit)) > 0)
                                                    <li class="d-flex align-items-start mb-2">
                                                        <i class="bi bi-check-circle-fill me-2"
                                                            style="color: var(--accent-color); margin-top: 4px;"></i>
                                                        <span>{{ trim($benefit) }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- ============================================= --}}
                        {{-- KANAN: KARTU PEMESANAN (CTA & INFO) --}}
                        {{-- ============================================= --}}
                        <div class="col-lg-4">
                            <div class="service-booking-card" data-aos="fade-up" data-aos-delay="200">

                                {{-- Tombol CTA ditaruh di paling atas --}}
                                <a href="#" class="btn btn-primary w-100 btn-lg mb-3">Pesan Sekarang</a>

                                <div class="service-info-box">
                                    <h3 class="h5 mb-3">Ringkasan Layanan</h3>
                                    <ul class="list-unstyled service-info-list">
                                        <li>
                                            <strong>Harga Mulai</strong>
                                            <span>Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                                        </li>
                                        @if ($service->kategori ?? false)
                                            <li>
                                                <strong>Kategori</strong>
                                                <span>{{ $service->kategori }}</span>
                                            </li>
                                        @endif
                                        @if ($service->durasi_menit ?? false)
                                            <li>
                                                <strong>Estimasi Durasi</strong>
                                                <span>{{ $service->durasi_menit }} menit</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                {{-- Kontak Bantuan (Opsional tapi UI/UX bagus) --}}
                                <div class="text-center mt-3 pt-3 border-top">
                                    <p class="mb-1 small">Butuh konsultasi dulu?</p>
                                    {{-- GANTI DENGAN LINK WA --}}
                                    <a href="#" class="fw-bold">
                                        <i class="bi bi-whatsapp me-1"></i> Hubungi Kami
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- HAPUS SECTION FULL-WIDTH YANG LAMA --}}
                </div>
            </section>
        </main>
    </section>
@endsection
