@extends('layouts.template')

@section('title', 'Hasil Pencarian')

@section('content')
    <section class="section py-5 light-background" style="margin-top: 70px;">
        <div class="container-boxed">

            <div class="mb-4">
                <h2 class="fw-bold">
                    Hasil pencarian untuk:
                    <span class="text-primary">"{{ $keyword }}"</span>
                </h2>
                <p class="text-muted">
                    {{ $services->count() }} layanan ditemukan
                </p>
            </div>

            @if ($services->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-search fs-1 text-muted opacity-50"></i>
                    <p class="mt-3 text-muted">
                        Layanan tidak ditemukan.
                    </p>
                </div>
            @else
                <div class="row gy-4">
                    @foreach ($services as $service)
                        <div class="col-md-6 col-lg-4">
                            <div class="service-item h-100">

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

                                <div class="service-content-wrapper">
                                    <h4>
                                        <a href="{{ route('services.show', $service) }}">
                                            {{ $service->name }}
                                        </a>
                                    </h4>

                                    <p>
                                        {{ Str::limit($service->description, 80) }}
                                    </p>

                                    <a href="{{ route('services.show', $service) }}" class="read-more-btn">
                                        Lihat Detail <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>
@endsection
