@extends('layouts.template')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section light-background">
            <div class="container-boxed">
                <div class="row gy-4 align-items-center">

                    <!-- ================= LEFT SIDE ================= -->
                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="zoom-out">
                        <h1>{{ settings('hero_title', 'INFUS IMMUNE BOOSTER') }}</h1>

                        <p>
                            {{ settings(
                                'hero_subtitle',
                                'Nikmati layanan infus immune booster terbaik bersama
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Homecare.can. Praktis, cepat, aman, dan nyaman langsung di rumah atau dikantor Anda',
                            ) }}
                        </p>
                        
                        <div class="hero-cta mt-2 d-flex justify-content-center justify-content-lg-start">
                            <a href="#services"
                                class="btn-hero-primary btn-hero-animated d-inline-flex align-items-center gap-2">
                                <span>Pesan Sekarang</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- ================= RIGHT SIDE ================= -->
                    <div class="col-lg-6 d-flex flex-column align-items-center" data-aos="zoom-out" data-aos-delay="200">

                        <!-- SEARCH BAR -->
                        <form class="search-bar d-flex mb-4 mt-3 mt-lg-0" method="GET" action="{{route('search')}}">
                            <input type="search" placeholder="Cari layanan kesehatan" name="q" value="{{request('q')}}" required />
                            <button type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>

                        <!-- TRUST INDICATOR -->
                        <div class="trust-indicators mt-3 d-flex gap-4">
                            <div class="indicator text-center">
                                <div class="icon-wrapper">
                                    <i class="bi bi-clipboard2-check"></i>
                                </div>
                                <p class="title">{{ settings('hero_indicator1_title', 'Certified') }}</p>
                                <p class="subtitle">{{ settings('hero_indicator1_subtitle', 'Health Professional') }}</p>
                            </div>

                            <div class="indicator text-center">
                                <div class="icon-wrapper">
                                    <i class="bi bi-check2-circle"></i>
                                </div>
                                <p class="title">{{ settings('hero_indicator2_title', 'Personalized') }}</p>
                                <p class="subtitle">{{ settings('hero_indicator2_subtitle', 'Treatment') }}</p>
                            </div>

                            <div class="indicator">
                                <div class="icon-wrapper">
                                    <i class="bi bi-lightning-charge"></i>
                                </div>
                                <p class="title">{{ settings('hero_indicator3_title', 'Fast & Safe') }}</p>
                                <p class="subtitle">{{ settings('hero_indicator3_subtitle', 'Home Service') }}</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- /Hero Section -->

        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section dark-background">
            <img src="assets/img/infus_room.webp" alt="" loading="lazy" style="opacity: 0.3" />
            <div class="container-boxed cta-container">
                <div class="row gy-5 align-items-center">
                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                        @if ($banners->isNotEmpty())
                            <div class="swiper init-swiper">
                                <script type="application/json" class="swiper-config">
                            {
                                "effect": "coverflow",
                                "grabCursor": true,
                                "centeredSlides": true,
                                "slidesPerView": "auto",
                                "loop": true,
                                "speed": 600,
                                "autoplay": {
                                "delay": 4000,
                                "disableOnInteraction": false
                                },
                                "coverflowEffect": {
                                "rotate": 0,
                                "stretch": 0,
                                "depth": 200,
                                "modifier": 1.5,
                                "slideShadows": true
                                },
                                "pagination": {
                                "el": ".swiper-pagination",
                                "clickable": true
                                },
                                "navigation": { 
                                    "nextEl": ".swiper-button-next", 
                                    "prevEl": ".swiper-button-prev" 
                                }
                          
                            }
                        </script>

                                <div class="swiper-wrapper">
                                    @foreach ($banners as $banner)
                                        <div class="swiper-slide">
                                            <img src="{{ Storage::url($banner->image_path) }}" alt="Galeri Layanan"
                                                loading="lazy" />
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>

                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        @else
                            {{-- Tampilan jika tidak ada banner --}}
                            <p class="text-white">Galeri belum tersedia.</p>
                        @endif
                    </div>
                    <div class="col-lg-6 text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
                        <h3>{{ settings('cta_title', 'Layanan Profesional Kami') }}</h3>
                        <p>
                            {{ settings(
                                'cta_text',
                                'Lihat beberapa dokumentasi dari layanan infus immune booster
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        yang telah kami berikan. Ditangani oleh tenaga medis profesional
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        untuk memastikan kenyamanan dan keamanan Anda.',
                            ) }}
                        </p>
                        <a class="cta-btn" href="#services">Cek Daftar Harga & Layanan</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================================================== --}}
        {{-- SECTION TENTANG KAMI --}}
        {{-- ================================================== --}}
        <section id="about" class="about section">
            <div class="container-boxed">
                <div class="row gy-5 gx-lg-5 align-items-center">

                    {{-- Kolom kiri: Teks & Poin Keunggulan --}}
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="about-content">
                            <div class="section-title">
                                <p class="sub-title">{{ settings('about_subtitle', 'Tentang Kami') }}</p>
                                <h2>{{ settings('about_title', 'Layanan Kesehatan Personal, Praktis, & Terpercaya') }}</h2>
                            </div>

                            <p class="tentang-p fst-italic">
                                {{ settings(
                                    'about_text',
                                    'Homecare.can lahir dari visi untuk menjadikan layanan kesehatan berkualitas lebih mudah
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                diakses. Kami membawa layanan infus immune booster premium langsung ke kenyamanan rumah dan
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                kantor
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                Anda.',
                                ) }}
                            </p>

                            {{-- Poin Keunggulan (UI Baru) --}}
                            <div class="about-features gy-4">
                                <div class="feature-item d-flex align-items-center">
                                    <i class="bi bi-patch-check-fill"></i>
                                    <div>
                                        <h5>{{ settings('about_point1_title', 'Tenaga Medis Profesional') }}</h5>
                                        <p>{{ settings('about_point1_text', 'Tim medis kami bersertifikat, berpengalaman, dan ramah.') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="feature-item d-flex align-items-center">
                                    <i class="bi bi-clock-history"></i>
                                    <div>
                                        <h5>{{ settings('about_point2_title', 'Praktis & Hemat Waktu') }}</h5>
                                        <p>{{ settings('about_point2_text', 'Tidak perlu antre atau macet di jalan. Kami yang datang ke Anda.') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="feature-item d-flex align-items-center">
                                    <i class="bi bi-shield-lock-fill"></i>
                                    <div>
                                        <h5>{{ settings('about_point3_title', 'Produk Steril & Terjamin') }}</h5>
                                        <p>{{ settings('about_point3_text', 'Kami hanya menggunakan produk vitamin berkualitas tinggi dan steril.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom kanan: Gambar Profesional Baru --}}
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="about-image-container">
                            {{-- Gambar baru yang lebih relevan dan profesional --}}
                            <div class="about-image-blob"></div>
                            <img src="{{ settings('about_image') ? Storage::url(settings('about_image')) : asset('assets/img/image_2.jpg') }}"
                                class="img-fluid about-main-image" alt="Tenaga medis profesional Homecare.can"
                                loading="lazy">
                        </div>
                    </div>


                </div>
            </div>
        </section>
        {{-- ================================================== --}}
        {{-- SECTION WHY US / FAQ  --}}
        {{-- ================================================== --}}
        <section id="why-us" class="why-us section light-background">
            <div class="container-boxed">
                <div class="container-boxed section-title" data-aos="fade-up">
                    <p class="sub-title">{{ settings('whyus_subtitle', 'Kenapa Homecare.can?') }}</p>
                    <h2>{{ settings('whyus_title', 'Semua Tentang Immune Booster') }}</h2>
                </div>

                <div class="row gy-5 gx-lg-5 align-items-center">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="faq-container">

                            {{-- Item 1: Apa itu? (faq-active = kebuka default) --}}
                            <div class="faq-item faq-active">
                                <h3>
                                    <i class="bi bi-question-circle me-2"></i>
                                    <span>{{ settings('faq1_q', 'Apa itu Infus Immune Booster?') }}</span>
                                </h3>
                                <div class="faq-content">
                                    <div>
                                        <div class="faq-content-inner">
                                            <p>{!! nl2br(
                                                e(
                                                    settings(
                                                        'faq1_a',
                                                        'Prosedur medis dimana vitamin & mineral diberikan langsung ke aliran darah. Ini
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        memungkinkan penyerapan nutrisi 100% lebih cepat dan efektif dibanding konsumsi
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        oral.',
                                                    ),
                                                ),
                                            ) !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>{{-- Item 2: Manfaat --}}
                            <div class="faq-item">
                                <h3>
                                    <i class="bi bi-gem me-2"></i>
                                    <span>{{ settings('faq2_q', 'Apa Saja Manfaat Utamanya?') }}</span>
                                </h3>
                                <div class="faq-content">
                                    <div>
                                        <div class="faq-content-inner">
                                            <ul class="faq-list">
                                                @foreach (explode("\n", settings('faq2_a', "Meningkatkan daya tahan tubuh\nMengatasi kelelahan dan meningkatkan energi\nMencegah kekurangan vitamin & mineral")) as $item)
                                                    @if (strlen(trim($item)) > 0)
                                                        <li>{{ trim($item) }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>{{-- Item 3: Waktu Tepat --}}
                            <div class="faq-item">
                                <h3>
                                    <i class="bi bi-clock me-2"></i>
                                    <span>{{ settings('faq3_q', 'Kapan Waktu Terbaik Untuk Infus?') }}</span>
                                </h3>
                                <div class="faq-content">
                                    <div>
                                        <div class="faq-content-inner">
                                            <ul class="faq-list">
                                                @foreach (explode("\n", settings('faq3_a', "Saat aktivitas sedang padat.\nKetika pergantian cuaca ekstrem.\nSetelah sembuh dari sakit.")) as $item)
                                                    @if (strlen(trim($item)) > 0)
                                                        <li>{{ trim($item) }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Gambar (Biarkan) --}}
                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="why-us-image-container">
                            <img src="{{ settings('whyus_image') ? Storage::url(settings('whyus_image')) : asset('assets/img/image.png') }}"
                                class="img-fluid" alt="Botol infus vitamin" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="services section">

            <div class="container-boxed section-title" data-aos="fade-up">
                <h2>{{ settings('services_title', 'Layanan Kami') }}</h2>
                <p>{{ settings('services_subtitle', 'Kami menyediakan berbagai layanan kesehatan profesional langsung di kenyamanan rumah Anda.') }}
                </p>
            </div>
            <div class="container-boxed">
                {{-- Kita tidak pakai slider dulu, pakai grid responsif --}}
                <div class="row gy-4 align-items-stretch">

                    @forelse ($services as $service)
                        {{-- Ambil 6 layanan saja --}}
                        <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up"
                            data-aos-delay="{{ $loop->iteration * 100 }}">

                            {{-- KITA UBAH TOTAL STRUKTUR KARTU DI DALAM SINI --}}
                            <div class="service-item position-relative w-100">
                                @php
                                    // Cek apakah service ini ada di daftar promo aktif
                                    $promo = $activePromos->get($service->id);
                                @endphp

                                @if ($promo)
                                    <div
                                        style="position: absolute; top: 15px; right: 15px; z-index: 10; background: #dc3545; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                                        @if ($promo->discount_type == 'percentage')
                                            HEMAT {{ intval($promo->discount_value) }}%
                                        @else
                                            HEMAT Rp {{ number_format($promo->discount_value / 1000, 0) }}K
                                        @endif
                                    </div>
                                @endif

                                {{-- 1. GAMBAR LAYANAN (Menggantikan ikon) --}}
                                <div class="service-image-wrapper">
                                    {{-- Logika untuk ambil gambar thumbnail --}}
                                    @php
                                        // Cek apakah 'gallery' ada DAN tidak kosong
                                        $thumbnail =
                                            $service->gallery && count($service->gallery) > 0
                                                ? $service->gallery[0] // Ambil gambar pertama dari galeri
                                                : $service->image; // Pakai gambar lama sebagai cadangan
                                    @endphp

                                    <img src="{{ Storage::url($thumbnail) }}" alt="{{ $service->name }}"
                                        loading="lazy">
                                </div>

                                {{-- 2. KONTEN TEKS --}}
                                <div class="service-content-wrapper">
                                    <h4>
                                        <a href="{{ route('services.show', $service) }}">{{ $service->name }}</a>
                                    </h4>
                                    <p>{{ Str::limit($service->description, 75) }}</p>

                                    {{-- 3. TOMBOL CTA (Call to Action) BARU --}}
                                    <a href="{{ route('services.show', $service) }}" class="read-more-btn">
                                        Lihat Detail <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>

                            </div>
                            {{-- AKHIR DARI KARTU BARU --}}

                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">Saat ini belum ada layanan yang tersedia.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </section>
        <!-- /Services Section -->

        <section id="testimonials" class="testimonials section light-background">
            <div class="container-boxed section-title" data-aos="fade-up">
                <h2>Apa Kata Mereka?</h2>
                <p>
                    Testimoni asli dari pelanggan yang telah merasakan manfaat layanan Homecare.can
                </p>
            </div>
            <div class="container-boxed" data-aos="fade-up" data-aos-delay="100">
                @if ($testimonials->isEmpty())
                    <div class="text-center">
                        <p class="text-muted">Belum ada testimonial yang ditampilkan.</p>
                    </div>
                @else
                    <div class="swiper init-swiper">
                        <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "breakpoints": {
                                "320": {
                                    "slidesPerView": 1,
                                    "spaceBetween": 40
                                },
                                "1200": {
                                    "slidesPerView": 1,
                                    "spaceBetween": 20
                                }
                            }
                        }
                        </script>
                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $review)
                                <div class="swiper-slide">
                                    <div class="testimonial-item">

                                        {{-- AREA FOTO USER (KONSISTEN BULAT) --}}
                                        <div class="testimonial-img-wrapper mx-auto mb-3"
                                            style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 1px solid var(--background-color); box-shadow: 0 4px 10px rgba(0,0,0,0.1);">

                                            @if ($review->user?->avatar)
                                                <img src="{{ Storage::url($review->user?->avatar) }}"
                                                    alt="{{ $review->user?->name }}"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center text-white fw-bold h-100 w-100"
                                                    style="background-color: var(--accent-color); font-size: 28px;">
                                                    {{ strtoupper(substr($review->user?->name, 0, 2)) }}
                                                </div>
                                            @endif
                                        </div>

                                        <h3>{{ $review->user?->name }}</h3>
                                        <h4>Pelanggan Terverifikasi</h4>

                                        <div class="stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="bi bi-star-fill"></i>
                                                @else
                                                    <i class="bi bi-star text-muted opacity-25"></i>
                                                @endif
                                            @endfor
                                        </div>

                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>{{ $review->comment }}</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                @endif
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact section">
            <!-- Section Title -->
            <div class="container-boxed section-title" data-aos="fade-up">
                <h2>{{ settings('contact_title', 'Kontak Kami') }}</h2>
                <p>{{ settings(
                    'contact_subtitle',
                    'Punya pertanyaan atau siap untuk memesan? Jangan ragu untuk
                                                                                                                                                                                                                                                                                                                                                                                                                                    menghubungi kami. Kami siap membantu Anda.',
                ) }}
                </p>
            </div>
            <!-- End Section Title -->

            <div class="container-boxed" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-5">
                        <div class="info-wrap">
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>{{ settings('contact_address_label', 'Lokasi Kami') }}</h3>
                                    <p>
                                        {{ settings('contact_address', 'Kemang, Jakarta Selatan') }}
                                    </p>
                                </div>
                            </div>
                            <!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>{{ settings('contact_phone_label', 'WhatsApp') }}</h3>
                                    <p>{{ settings('contact_phone', '+62 822-8733-94375') }}</p>
                                </div>
                            </div>
                            <!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>{{ settings('contact_email_label', 'Email Kami') }}</h3>
                                    <p>{{ settings('contact_email', 'Mrican.ac@gmail.com') }}</p>
                                </div>
                            </div>
                            <!-- End Info Item -->

                            <div class="gmaps-responsive-wrapper">
                                {!! settings(
                                    'gmaps_link',
                                    '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d32808.60953306585!2d106.79017025065507!3d-6.277541035477562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f18ca27987dd%3A0x6a032aaca638c397!2sKemang%2C%20Cipete%20Sel.%2C%20Kec.%20Cilandak%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1760406032442!5m2!1sid!2sid"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    frameborder="0" style="border: 0; width: 100%; height: 270px" allowfullscreen=""
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                                ) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="info-wrap">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert"
                                    data-aos="fade-up" data-aos-delay="200"
                                    style="padding: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 20px;">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                    data-aos="fade-up" data-aos-delay="200"
                                    style="padding: 15px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; margin-bottom: 20px;">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif


                            <form action="{{ route('contact.submit') }}" method="post" data-aos="fade-up"
                                data-aos-delay="200">
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <label for="name-field" class="pb-2">Nama Anda</label>
                                        <input type="text" name="name" id="name-field" class="form-control"
                                            value="{{ old('name') }}" required="" />
                                        @error('name')
                                            <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email-field" class="pb-2">Email Anda</label>
                                        <input type="email" class="form-control" name="email" id="email-field"
                                            value="{{ old('email') }}" required="" />
                                        @error('email')
                                            <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="subject-field" class="pb-2">Subjek Pesan</label>
                                        <input type="text" class="form-control" name="subject" id="subject-field"
                                            value="{{ old('subject') }}" required="" />
                                        @error('subject')
                                            <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="message-field" class="pb-2">Pesan Anda</label>
                                        <textarea class="form-control" name="message" rows="10" id="message-field" required="">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <div class="loading" style="display: none;">Loading</div>
                                        <div class="error-message" style="display: none;"></div>
                                        <div class="sent-message" style="display: none;">
                                            Pesan Anda telah terkirim. Terima kasih!
                                        </div>

                                        <button type="submit"
                                            style="background-color: #174272; color: white; border: none; padding: 12px 30px; border-radius: 50px; /* Nilai besar untuk membuat bulat */ font-size: 16px; cursor: pointer; text-decoration: none; /* Jika itu sebenarnya link */ display: inline-block; /* Untuk padding dan radius */">
                                            Kirim Pesan
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- End Contact Form -->
                </div>
            </div>
        </section>

        <!-- /Contact Section -->
    </main>
@endsection

@section('footer-newsletter')
    <section class="light-background">
        <div class="footer-newsletter">
            <div class="container-boxed">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <div class="consultation-box">
                            <i class="bi bi-headset mb-3" style="font-size: 48px; color: var(--accent-color);"></i>
                            <h4>{{ settings('consultation_title', 'Bingung Pilih Layanan yang Tepat?') }}</h4>
                            <p>
                                {{ settings('consultation_text', 'Jangan ragu untuk berkonsultasi dengan tim medis kami. Kami siap membantu Anda menentukan layanan kesehatan terbaik sesuai kondisi Anda.') }}
                            </p>

                            {{-- Tombol WA Konsultasi --}}
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', settings('contact_phone', '6282287339437')) }}?text=Halo%20Admin,%20saya%20ingin%20konsultasi%20layanan%20kesehatan"
                                target="_blank" class="btn-consultation">
                                <i class="bi bi-whatsapp me-2"></i>
                                {{ settings('consultation_btn_text', 'Konsultasi Gratis Sekarang') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
