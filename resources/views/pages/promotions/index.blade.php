@extends('layouts.template')

@section('title', 'Promo Spesial')

@section('content')
    <main class="main" style="padding-top: 120px; padding-bottom: 60px; background-color: #f9f9f9;">

        <div class="page-title" data-aos="fade">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">Promo</li>
                    </ol>
                </nav>
                <h1>Penawaran Spesial</h1>
            </div>
        </div>

        <section id="promo-list" class="pricing section">
            <div class="container">

                @if ($promotions->isEmpty())
                    {{-- Tampilan Kosong --}}
                    <div class="text-center py-5" data-aos="fade-up">
                        <div class="mb-3">
                            <i class="bi bi-tag-fill text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                        </div>
                        <h3 class="text-muted">Belum ada promo aktif saat ini.</h3>
                        <p class="text-muted">Silakan cek kembali nanti atau lihat layanan kami.</p>
                        <a href="{{ route('home') }}#services" class="btn-getstarted mt-3"
                            style="display: inline-block; background: var(--accent-color); color: #fff; padding: 10px 30px; border-radius: 50px;">
                            Lihat Layanan
                        </a>
                    </div>
                @else
                    {{-- Grid Promo --}}
                    <div class="row gy-4">
                        @foreach ($promotions as $promo)
                            <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                                <div class="pricing-item featured h-100 d-flex flex-column">

                                    {{-- Badge Hemat --}}
                                    <div
                                        style="position: absolute; top: 15px; right: 15px; background: #dc3545; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                        @if ($promo->discount_type == 'percentage')
                                            HEMAT {{ $promo->discount_value }}%
                                        @else
                                            HEMAT Rp {{ number_format($promo->discount_value / 1000, 0) }}K
                                        @endif
                                    </div>

                                    <h3>{{ $promo->name }}</h3>

                                    {{-- Gambar Layanan --}}
                                    <div class="promo-img mb-3 rounded overflow-hidden" style="height: 180px; width: 100%;">
                                        @php
                                            $img =
                                                $promo->service->gallery && count($promo->service->gallery) > 0
                                                    ? $promo->service->gallery[0]
                                                    : $promo->service->image;
                                        @endphp
                                        <img src="{{ Storage::url($img) }}" alt="{{ $promo->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>

                                    {{-- Perhitungan Harga --}}
                                    @php
                                        $finalPrice =
                                            $promo->discount_type == 'percentage'
                                                ? $promo->service->price -
                                                    ($promo->service->price * $promo->discount_value) / 100
                                                : $promo->service->price - $promo->discount_value;
                                    @endphp

                                    <h4>
                                        <span
                                            style="font-size: 16px; text-decoration: line-through; color: #999; font-weight: normal;">
                                            Rp {{ number_format($promo->service->price, 0, ',', '.') }}
                                        </span>
                                        <br>
                                        <sup>Rp</sup>{{ number_format($finalPrice, 0, ',', '.') }}
                                    </h4>

                                    <ul class="mt-3 mb-4 flex-grow-1">
                                        <li><i class="bi bi-check"></i> <span>Layanan:
                                                <strong>{{ $promo->service->name }}</strong></span></li>
                                        <li><i class="bi bi-clock"></i> <span>Berlaku s/d:
                                                {{ date('d M Y', strtotime($promo->end_date)) }}</span></li>
                                        @if ($promo->description)
                                            <li class="fst-italic text-muted small">
                                                "{{ Str::limit($promo->description, 80) }}"</li>
                                        @endif
                                    </ul>

                                    {{-- Tombol Aksi --}}
                                    <div class="text-center mt-auto">
                                        <a href="{{ route('orders.create', $promo->service) }}" class="buy-btn w-100">
                                            Ambil Promo Ini
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </section>

    </main>
@endsection
