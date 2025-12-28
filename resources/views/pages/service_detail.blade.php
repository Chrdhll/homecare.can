@extends('layouts.template')

@section('title', 'Detail Layanan: ' . $service->name)

@section('content')

    <section class="section_gap mt5">
        <main class="main">
            <div class="page-title" data-aos="fade">
                <div class="container-boxed">
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
                <div class="container-boxed" data-aos="fade-up" data-aos-delay="100">
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
                                <a href="{{ route('orders.create', $service) }}"
                                    class="btn btn-primary w-100 btn-lg mb-3">Pesan Sekarang</a>

                                <div class="service-info-box">
                                    <h3 class="h5 mb-3">Ringkasan Layanan</h3>
                                    <ul class="list-unstyled service-info-list">
                                        <li class="align-items-start flex-column">
                                            <div class="d-flex justify-content-between w-100 mb-2 align-items-center">
                                                <strong>Harga Mulai</strong>
                                                <div class="text-end">
                                                    @if (isset($activePromo) && $activePromo)
                                                        {{-- 1. TAMPILAN JIKA ADA PROMO --}}

                                                        {{-- Badge Hemat --}}
                                                        <div class="mb-1">
                                                            <span class="badge bg-danger"
                                                                style="font-size: 0.75rem; color: #fff;">
                                                                @if ($activePromo->discount_type == 'percentage')
                                                                    Hemat {{ intval($activePromo->discount_value) }}%
                                                                @else
                                                                    Hemat Rp
                                                                    {{ number_format($activePromo->discount_value / 1000, 0) }}K
                                                                @endif
                                                            </span>
                                                        </div>

                                                        {{-- Harga Coret (Abu-abu) --}}
                                                        <small class="text-decoration-line-through text-muted d-block"
                                                            style="font-size: 13px;">
                                                            Rp {{ number_format($service->price, 0, ',', '.') }}
                                                        </small>

                                                        {{-- Harga Akhir (Hijau & Besar) --}}
                                                        <span class="fw-bold text-success fs-5">
                                                            Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                                        </span>
                                                    @else
                                                        {{-- 2. TAMPILAN NORMAL (GAK ADA PROMO) --}}
                                                        <span class="fw-bold text-primary fs-5">
                                                            Rp {{ number_format($service->price, 0, ',', '.') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        @if (isset($activePromo) && $activePromo)
                                            <div class="promo-info-box w-100">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="bi bi-ticket-perforated-fill text-danger me-2 fs-5"></i>
                                                    <h6 class="m-0 fw-bold text-dark">{{ $activePromo->name }}</h6>
                                                </div>

                                                @if ($activePromo->description)
                                                    <p class="promo-desc mb-2">
                                                        {{ $activePromo->description }}
                                                    </p>
                                                @endif

                                                <div class="promo-meta d-flex align-items-center justify-content-between">
                                                    <small class="text-muted">
                                                        <i class="bi bi-calendar-check me-1"></i>
                                                        Berlaku s/d
                                                        {{ date('d M Y', strtotime($activePromo->end_date)) }}
                                                    </small>
                                                    <small class="text-danger fw-bold" style="font-size: 11px;">
                                                        Terbatas!
                                                    </small>
                                                </div>
                                            </div>
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

            {{-- ============================================================ --}}
            {{-- BAGIAN ULASAN & RATING --}}
            {{-- ============================================================ --}}
            <section id="reviews" class="section bg-light py-5">
                <div class="container-boxed" data-aos="fade-up">

                    <div class="section-title text-center mb-4">
                        <h2>Ulasan Pelanggan</h2>
                        <p>Apa kata mereka yang sudah menggunakan layanan {{ $service->name }}?</p>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-8">

                            {{-- 1. RINGKASAN RATING (SCORE CARD) --}}
                            <div class="card border-0 shadow-sm rounded-4 mb-4">
                                <div class="card-body p-4 text-center">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 border-end-md">
                                            <h1 class="fw-bold text-primary display-3 mb-0">{{ $averageRating }}</h1>
                                            <div class="text-warning mb-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= round($averageRating))
                                                        <i class="bi bi-star-fill fs-5"></i>
                                                    @else
                                                        <i class="bi bi-star text-muted fs-5 opacity-25"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p class="text-muted small mb-0">Dari
                                                <strong>{{ $totalReviews }}</strong> ulasan</p>
                                        </div>
                                        <div class="col-md-8 text-start ps-md-4 mt-3 mt-md-0">
                                            <h5 class="fw-bold">Kepuasan Pelanggan</h5>
                                            <p class="text-muted small">
                                                Rating ini dikumpulkan murni dari pelanggan yang telah menyelesaikan
                                                pemesanan layanan melalui platform Homecare.can.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 2. DAFTAR ULASAN --}}
                            @if ($reviews->isEmpty())
                                <div class="text-center py-5">
                                    <i class="bi bi-chat-square-quote text-muted opacity-25" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-3">Belum ada ulasan untuk layanan ini.</p>
                                </div>
                            @else
                                <div class="d-flex flex-column gap-3">
                                    @foreach ($reviews as $review)
                                        <div class="card border-0 shadow-sm rounded-4">
                                            <div class="card-body p-4">
                                                <div class="d-flex justify-content-between align-items-start">

                                                    {{-- User Info --}}
                                                    <div class="d-flex align-items-center">
                                                        {{-- Avatar (Inisial Nama) --}}
                                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold me-3"
                                                            style="width: 50px; height: 50px; font-size: 1.2rem;">
                                                            {{ strtoupper(substr($review->user?->name ?? 'P', 0, 2)) }}
                                                        </div>
                                                        <div>
                                                            <h6 class="fw-bold mb-0">{{ $review->user?->name ?? 'Pengguna Tidak Diketahui'}}</h6>
                                                            <small
                                                                class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                                        </div>
                                                    </div>

                                                    {{-- Bintang Review --}}
                                                    <div class="text-warning bg-light px-2 py-1 rounded-pill border">
                                                        <small
                                                            class="fw-bold text-dark me-1">{{ $review->rating }}.0</small>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $review->rating)
                                                                <i class="bi bi-star-fill small"></i>
                                                            @else
                                                                <i class="bi bi-star text-muted small opacity-25"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>

                                                {{-- Isi Komentar --}}
                                                <div class="mt-3">
                                                    @if ($review->comment)
                                                        <p class="text-muted mb-0">"{{ $review->comment }}"</p>
                                                    @else
                                                        <p class="text-muted fst-italic mb-0 small">(Tidak ada komentar
                                                            tertulis)</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </section>
        </main>
    </section>
@endsection
