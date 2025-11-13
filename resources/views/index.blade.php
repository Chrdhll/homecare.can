@extends('layouts.template')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section light-background">
            <div class="container">
                <div class="row gy-4 align-items-center">
                    <div class="col-lg-6 order-1 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
                        <h1>INFUS IMMUNE BOOSTER</h1>
                        <p>
                            Nikmati layanan infus immune booster terbaik bersama
                            Homecare.can. Praktis, cepat, aman, dan nyaman langsung di rumah atau dikantor Anda
                        </p>
                        {{-- <p>
                            Home or office treatment 
                            <b>Always Fast & Always Safe</b>
                        </p> --}}
                    </div>

                    <div class="col-lg-6 order-2 order-lg-2 d-flex flex-column align-items-center" data-aos="zoom-out"
                        data-aos-delay="200">
                        <form class="search-bar d-flex">
                            <input type="search" placeholder="Search" aria-label="Search" />
                            <button type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>

                        <!-- LABEL / TRUST INDICATOR -->
                        <div class="trust-indicators mt-4">
    <div class="indicator">
        <div class="icon-wrapper">
            <i class="bi bi-clipboard2-check"></i>
        </div>
        <p class="title">Certified</p>
        <p class="subtitle">Health Professional</p>
    </div>

    <div class="indicator">
        <div class="icon-wrapper">
            <i class="bi bi-check2-circle"></i>
        </div>
        <p class="title">Personalized</p>
        <p class="subtitle">Treatment</p>
    </div>
</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Hero Section -->

        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section dark-background">
            <img src="assets/img/infus_room.webp" alt="" loading="lazy" />
            <div class="container">
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
                        <h3>Layanan Profesional Kami</h3>
                        <p>
                            Lihat beberapa dokumentasi dari layanan infus immune booster
                            yang telah kami berikan. Ditangani oleh tenaga medis profesional
                            untuk memastikan kenyamanan dan keamanan Anda.
                        </p>
                        <a class="cta-btn" href="#services">Lihat Semua Layanan</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================================================== --}}
        {{-- SECTION TENTANG KAMI --}}
        {{-- ================================================== --}}
        <section id="about" class="about section">
            <div class="container">
                <div class="row gy-5 gx-lg-5 align-items-center">

                    {{-- Kolom kiri: Teks & Poin Keunggulan --}}
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="about-content">
                            <div class="section-title">
                                <p class="sub-title">Tentang Kami</p>
                                <h2>Layanan Kesehatan Personal, Praktis, & Terpercaya</h2>
                            </div>

                            <p class="tentang-p fst-italic">
                                Homecare.can lahir dari visi untuk menjadikan layanan kesehatan berkualitas lebih mudah
                                diakses. Kami membawa layanan infus immune booster premium langsung ke kenyamanan rumah dan
                                kantor
                                Anda.
                            </p>

                            {{-- Poin Keunggulan (UI Baru) --}}
                            <div class="about-features gy-4">
                                <div class="feature-item d-flex align-items-center">
                                    <i class="bi bi-patch-check-fill"></i>
                                    <div>
                                        <h5>Tenaga Medis Profesional</h5>
                                        <p>Tim medis kami bersertifikat, berpengalaman, dan ramah.</p>
                                    </div>
                                </div>
                                <div class="feature-item d-flex align-items-center">
                                    <i class="bi bi-clock-history"></i>
                                    <div>
                                        <h5>Praktis & Hemat Waktu</h5>
                                        <p>Tidak perlu antre atau macet di jalan. Kami yang datang ke Anda.</p>
                                    </div>
                                </div>
                                <div class="feature-item d-flex align-items-center">
                                    <i class="bi bi-shield-lock-fill"></i>
                                    <div>
                                        <h5>Produk Steril & Terjamin</h5>
                                        <p>Kami hanya menggunakan produk vitamin berkualitas tinggi dan steril.</p>
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
                            <img src="{{ asset('assets/img/image_2.jpg') }}" class="img-fluid about-main-image"
                                alt="Tenaga medis profesional Homecare.can" loading="lazy">
                        </div>
                    </div>


                </div>
            </div>
        </section>
        {{-- ================================================== --}}
        {{-- SECTION WHY US / FAQ  --}}
        {{-- ================================================== --}}
        <section id="why-us" class="why-us section light-background">
            <div class="container">
                <div class="container section-title" data-aos="fade-up">
                    <p class="sub-title">Kenapa Homecare.can?</p>
                    <h2>Semua Tentang Immune Booster</h2>
                </div>

                <div class="row gy-5 gx-lg-5 align-items-center">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="faq-container">

                            {{-- Item 1: Apa itu? (faq-active = kebuka default) --}}
                            <div class="faq-item faq-active">
                                <h3>
                                    <i class="bi bi-question-circle me-2"></i>
                                    <span>Apa itu Infus Immune Booster?</span>
                                </h3>
                                <div class="faq-content">
                                    <div class="faq-content-inner">
                                        <p>Prosedur medis dimana vitamin & mineral diberikan langsung ke aliran darah. Ini
                                            memungkinkan penyerapan nutrisi 100% lebih cepat dan efektif dibanding konsumsi
                                            oral.</p>
                                    </div>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>{{-- Item 2: Manfaat --}}
                            <div class="faq-item">
                                <h3>
                                    <i class="bi bi-gem me-2"></i>
                                    <span>Apa Saja Manfaat Utamanya?</span>
                                </h3>
                                <div class="faq-content">
                                    <div class="faq-content-inner">
                                        <ul class="faq-list">
                                            <li>Meningkatkan daya tahan tubuh</li>
                                            <li>Mengatasi kelelahan dan meningkatkan energi</li>
                                            <li>Mencegah kekurangan vitamin & mineral</li>
                                        </ul>
                                    </div>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>{{-- Item 3: Waktu Tepat --}}
                            <div class="faq-item">
                                <h3>
                                    <i class="bi bi-clock me-2"></i>
                                    <span>Kapan Waktu Terbaik Untuk Infus?</span>
                                </h3>
                                <div class="faq-content">
                                    <div class="faq-content-inner">
                                        <ul class="faq-list">
                                            <li>Saat aktivitas sedang padat.</li>
                                            <li>Ketika pergantian cuaca ekstrem.</li>
                                            <li>Setelah sembuh dari sakit.</li>
                                        </ul>
                                    </div>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Gambar (Biarkan) --}}
                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="why-us-image-container">
                            <img src="{{ asset('assets/img/image.png') }}" class="img-fluid" alt="Botol infus vitamin"
                                loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan Kami</h2>
                <p>
                    Kami menyediakan berbagai layanan kesehatan profesional langsung di kenyamanan rumah Anda.
                </p>
            </div>
            <div class="container">
                {{-- Kita tidak pakai slider dulu, pakai grid responsif --}}
                <div class="row gy-4 align-items-stretch">

                    @forelse ($services as $service)
                        {{-- Ambil 6 layanan saja --}}
                        <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up"
                            data-aos-delay="{{ $loop->iteration * 100 }}">

                            {{-- KITA UBAH TOTAL STRUKTUR KARTU DI DALAM SINI --}}
                            <div class="service-item position-relative w-100">

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

                                    <img src="{{ Storage::url($thumbnail) }}" alt="{{ $service->name }}" loading="lazy">
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

        <!-- Pricing Section -->
        <!-- <section id="pricing" class="pricing section light-background"> -->
        <!-- Section Title -->
        <!-- <div class="container section-title" data-aos="fade-up">
                                                                                                                                                      <h2>Pricing</h2>
                                                                                                                                                      <p>
                                                                                                                                                        Necessitatibus eius consequatur ex aliquid fuga eum quidem sint
                                                                                                                                                        consectetur velit
                                                                                                                                                      </p>
                                                                                                                                                    </div> -->
        <!-- End Section Title -->

        <!-- <div class="container">
                                                                                                                                                      <div class="row gy-4">
                                                                                                                                                        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                                                                                                                                                          <div class="pricing-item">
                                                                                                                                                            <h3>Free Plan</h3>
                                                                                                                                                            <h4><sup>$</sup>0<span> / month</span></h4>
                                                                                                                                                            <ul>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Quam adipiscing vitae proin</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Nec feugiat nisl pretium</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Nulla at volutpat diam uteera</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li class="na">
                                                                                                                                                                <i class="bi bi-x"></i>
                                                                                                                                                                <span>Pharetra massa massa ultricies</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li class="na">
                                                                                                                                                                <i class="bi bi-x"></i>
                                                                                                                                                                <span>Massa ultricies mi quis hendrerit</span>
                                                                                                                                                              </li>
                                                                                                                                                            </ul>
                                                                                                                                                            <a href="#" class="buy-btn">Buy Now</a>
                                                                                                                                                          </div>
                                                                                                                                                        </div> -->
        <!-- End Pricing Item -->

        <!-- <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                                                                                                                                                          <div class="pricing-item featured">
                                                                                                                                                            <h3>Business Plan</h3>
                                                                                                                                                            <h4><sup>$</sup>29<span> / month</span></h4>
                                                                                                                                                            <ul>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Quam adipiscing vitae proin</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Nec feugiat nisl pretium</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Nulla at volutpat diam uteera</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Pharetra massa massa ultricies</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Massa ultricies mi quis hendrerit</span>
                                                                                                                                                              </li>
                                                                                                                                                            </ul>
                                                                                                                                                            <a href="#" class="buy-btn">Buy Now</a>
                                                                                                                                                          </div>
                                                                                                                                                        </div> -->
        <!-- End Pricing Item -->

        <!-- <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                                                                                                                                                          <div class="pricing-item">
                                                                                                                                                            <h3>Developer Plan</h3>
                                                                                                                                                            <h4><sup>$</sup>49<span> / month</span></h4>
                                                                                                                                                            <ul>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Quam adipiscing vitae proin</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Nec feugiat nisl pretium</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Nulla at volutpat diam uteera</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Pharetra massa massa ultricies</span>
                                                                                                                                                              </li>
                                                                                                                                                              <li>
                                                                                                                                                                <i class="bi bi-check"></i>
                                                                                                                                                                <span>Massa ultricies mi quis hendrerit</span>
                                                                                                                                                              </li>
                                                                                                                                                            </ul>
                                                                                                                                                            <a href="#" class="buy-btn">Buy Now</a>
                                                                                                                                                          </div>
                                                                                                                                                        </div> -->
        <!-- End Pricing Item -->
        <!-- </div>
                                                                                                                                                    </div>
                                                                                                                                                  </section> -->
        <!-- /Pricing Section -->

        <!-- Testimonials Section -->
        {{-- <section id="testimonials" class="testimonials section"> --}}
        <!-- Section Title -->
        {{-- <div class="container section-title" data-aos="fade-up">
                    <h2>Testimonials</h2>
                    <p>
                        Necessitatibus eius consequatur ex aliquid fuga eum quidem sint
                        consectetur velit
                    </p>
                </div> --}}
        <!-- End Section Title -->

        {{-- <div class="container" data-aos="fade-up" data-aos-delay="100">
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
                }
              } --}}
            {{-- </script>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="assets/img/person/person-m-9.webp" class="testimonial-img"
                                        alt="" />
                                    <h3>Saul Goodman</h3>
                                    <h4>Ceo &amp; Founder</h4>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <span>Proin iaculis purus consequat sem cure digni ssim donec
                                            porttitora entum suscipit rhoncus. Accusantium quam,
                                            ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                            risus at semper.</span>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div> --}}
        <!-- End testimonial item -->

        {{-- <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="assets/img/person/person-f-5.webp" class="testimonial-img"
                                        alt="" />
                                    <h3>Sara Wilsson</h3>
                                    <h4>Designer</h4>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <span>Export tempor illum tamen malis malis eram quae irure
                                            esse labore quem cillum quid cillum eram malis quorum
                                            velit fore eram velit sunt aliqua noster fugiat irure amet
                                            legam anim culpa.</span>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div> --}}
        <!-- End testimonial item -->

        {{-- <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="assets/img/person/person-f-12.webp" class="testimonial-img"
                                        alt="" />
                                    <h3>Jena Karlis</h3>
                                    <h4>Store Owner</h4>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <span>Enim nisi quem export duis labore cillum quae magna enim
                                            sint quorum nulla quem veniam duis minim tempor labore
                                            quem eram duis noster aute amet eram fore quis sint
                                            minim.</span>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div> --}}
        <!-- End testimonial item -->

        {{-- <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="assets/img/person/person-m-12.webp" class="testimonial-img"
                                        alt="" />
                                    <h3>Matt Brandon</h3>
                                    <h4>Freelancer</h4>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <span>Fugiat enim eram quae cillum dolore dolor amet nulla
                                            culpa multos export minim fugiat minim velit minim dolor
                                            enim duis veniam ipsum anim magna sunt elit fore quem
                                            dolore labore illum veniam.</span>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div> --}}
        <!-- End testimonial item -->

        {{-- <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="assets/img/person/person-m-13.webp" class="testimonial-img"
                                        alt="" />
                                    <h3>John Larson</h3>
                                    <h4>Entrepreneur</h4>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <span>Quis quorum aliqua sint quem legam fore sunt eram irure
                                            aliqua veniam tempor noster veniam enim culpa labore duis
                                            sunt culpa nulla illum cillum fugiat legam esse veniam
                                            culpa fore nisi cillum quid.</span>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div> --}}
        <!-- End testimonial item -->
        {{-- </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section> --}}
        <!-- /Testimonials Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak Kami</h2>
                <p>
                    Punya pertanyaan atau siap untuk memesan? Jangan ragu untuk
                    menghubungi kami. Kami siap membantu Anda.
                </p>
            </div>
            <!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-5">
                        <div class="info-wrap">
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>Lokasi Kami</h3>
                                    <p>
                                        Kemang, Jakarta Selatan
                                    </p>
                                </div>
                            </div>
                            <!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>WhatsApp</h3>
                                    <p>+62 822-8733-94375</p>
                                </div>
                            </div>
                            <!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email Kami</h3>
                                    <p>Mrican.ac@gmail.com</p>
                                </div>
                            </div>
                            <!-- End Info Item -->
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d32808.60953306585!2d106.79017025065507!3d-6.277541035477562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f18ca27987dd%3A0x6a032aaca638c397!2sKemang%2C%20Cipete%20Sel.%2C%20Kec.%20Cilandak%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1760406032442!5m2!1sid!2sid"
                                frameborder="0" style="border: 0; width: 100%; height: 270px" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <div class="col-lg-7">

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
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-up"
                                data-aos-delay="200"
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
                                        <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email-field" class="pb-2">Email Anda</label>
                                    <input type="email" class="form-control" name="email" id="email-field"
                                        value="{{ old('email') }}" required="" />
                                    @error('email')
                                        <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="subject-field" class="pb-2">Subjek Pesan</label>
                                    <input type="text" class="form-control" name="subject" id="subject-field"
                                        value="{{ old('subject') }}" required="" />
                                    @error('subject')
                                        <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="message-field" class="pb-2">Pesan Anda</label>
                                    <textarea class="form-control" name="message" rows="10" id="message-field" required="">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
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
                    <!-- End Contact Form -->
                </div>
            </div>
        </section>
        <!-- /Contact Section -->
    </main>
@endsection
