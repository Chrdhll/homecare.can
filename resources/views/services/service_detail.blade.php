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
            {{-- <li><a href="{{ route('services') }}">Layanan</a></li> --}}
            <li class="current">{{ $service->name }}</li>
          </ol>
        </nav>
        <h1>Detail Layanan</h1>
      </div>
    </div>
    <section id="portfolio-details" class="portfolio-details section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        {{-- START: TOP SECTION (IMAGE & INFO BOX) --}}
        <div class="row gy-4">

            {{-- Left Column for Image --}}
            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true, "speed": 600, "autoplay": {"delay": 5000},
                            "slidesPerView": "auto",
                            "pagination": {"el": ".swiper-pagination", "type": "bullets", "clickable": true}
                        }
                    </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            <img src="{{ asset('assets/img/portfolio/portfolio-10.webp') }}" alt="{{ $service->name }}" loading="lazy">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            {{-- Right Column for Key Info --}}
            <div class="col-lg-4">
                <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                    <h3>Informasi Layanan</h3>
                    <ul>
                        @if($service->kategori ?? false)
                            <li><strong>Kategori</strong>: {{ $service->kategori }}</li>
                        @endif
                        <li><strong>Harga</strong>: Rp {{ number_format($service->price, 0, ',', '.') }}</li>
                        @if($service->durasi_menit ?? false)
                            <li><strong>Estimasi Durasi</strong>: {{ $service->durasi_menit }} menit</li>
                        @endif
                        <li><a href="#" class="btn btn-primary w-100 mt-3">Pesan Sekarang</a></li>
                    </ul>
                </div>
                <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                    <h2>{{ $service->name }}</h2>
                    <p>
                        {!! nl2br(e($service->description)) !!}
                    </p>
               </div>
            </div>

        </div>
        {{-- END: TOP SECTION --}}


        {{-- ========================================================== --}}
        {{-- START: NEW FULL-WIDTH SECTION FOR DESCRIPTION & BENEFITS --}}
        {{-- ========================================================== --}}
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                    <h2>{{ 'Manfaat Layanan' }}</h2>
                    @if($service->benefits)
                        <div class="mt-4">
                            <ul class="list-unstyled">
                                @foreach (explode("\n", $service->benefits) as $benefit)
                                    @if (strlen(trim($benefit)) > 0)
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="bi bi-check-circle-fill me-2" style="color: var(--accent-color);"></i>
                                            <span>{{ trim($benefit) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- END: NEW FULL-WIDTH SECTION --}}

    </div>
</section></main>
    </section>
@endsection