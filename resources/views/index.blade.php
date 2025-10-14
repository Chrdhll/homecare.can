@extends('layouts.template')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section light-background">
            <div class="container">
                <div class="row gy-4 align-items-center">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
                        <h1>INFUS IMMUNE BOOSTER</h1>
                        <p>
                            Nikmati layanan infus immune booster terbaik bersama
                            Homecare.can. Praktis, cepat, aman, dan nyaman langsung di rumah atau dikantor Anda
                        </p>
                        {{-- <p>
                            Home or office treatment 
                            <b>Always Fast & Always Safe</b>
                        </p> --}}
                        <!-- <div class="d-flex">
                                <a href="#about" class="btn-get-started">Get Started</a>
                                <a
                                  href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                                  class="glightbox btn-watch-video d-flex align-items-center"
                                  ><i class="bi bi-play-circle"></i><span>Watch Video</span></a
                                >
                              </div> -->
                    </div>

                    <div class="col-lg-6 order-1 order-lg-2 d-flex flex-column align-items-center" data-aos="zoom-out"
                        data-aos-delay="200">
                        <form class="search-bar d-flex" style="width: 80%; max-width: 450px; height: 40px">
                            <input type="search" placeholder="Search" aria-label="Search" />
                            <button type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>

                        <!-- LABEL / TRUST INDICATOR -->
                        <div class="trust-indicators mt-4">
                            <div class="indicator">
                                <i class="bi bi-clipboard2-check icon"></i>
                                <div class="text">
                                    <p class="title">Certified</p>
                                    <p class="subtitle">Health Professional</p>
                                </div>
                            </div>
                            <div class="indicator">
                                <i class="bi bi-check2-circle icon"></i>
                                <div class="text">
                                    <p class="title">Personalized</p>
                                    <p class="subtitle">Treatment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div
                              class="col-lg-6 order-1 order-lg-2 hero-img"
                              data-aos="zoom-out"
                              data-aos-delay="200"
                            >
                              <img
                                src="assets/img/hero-img.png"
                                class="img-fluid animated"
                                alt=""
                              />
                            </div> -->
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
                    }
                  }
                </script>

                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="assets/img/services/service1.webp" alt="Galeri Layanan 1" loading="lazy" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/img/services/service2.webp" alt="Galeri Layanan 2" loading="lazy" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/img/services/service3.webp" alt="Galeri Layanan 3" loading="lazy" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/img/services/service4.webp" alt="Galeri Layanan 4" loading="lazy" />
                                </div>
                            </div>
                        </div>
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

        <!-- About Section -->
        <section id="about" class="about section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang Kami</h2>
            </div>
            <!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-8 content" data-aos="fade-up" data-aos-delay="100">
                        <p class="tentang-p">
                            Homecare.can lahir dari sebuah visi sederhana yaitu menjadikan
                            layanan kesehatan berkualitas lebih mudah diakses, praktis, dan
                            personal. Kami memahami bahwa di tengah kesibukan sehari-hari,
                            menjaga daya tahan tubuh adalah sebuah tantangan. Pergi ke
                            klinik seringkali memakan waktu dan tenaga. Oleh karena itu,
                            kami hadir untuk membawa layanan infus immune booster premium
                            langsung ke kenyamanan rumah Anda. Ditangani oleh tim medis
                            profesional yang bersertifikat, kami memastikan setiap sesi
                            perawatan berjalan dengan aman, steril, dan nyaman, sehingga
                            Anda bisa tetap sehat tanpa perlu repot.
                        </p>
                        <ul>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Tenaga Medis Profesional & Bersertifikat</span>
                            </li>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Praktis, Hemat Waktu & Tenaga</span>
                            </li>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Produk Terjamin Kualitasnya</span>
                            </li>
                            <li>
                                <i class="bi bi-check2-circle"></i>
                                <span>Proses Mudah dan Transparan</span>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <img src="assets/img/foto-1.png" class="img-fluid" alt="Tentang Kami" loading="lazy" />
                    </div>
                </div>
            </div>
        </section>
        <!-- /About Section -->

        <!-- Why Us Section -->
        <section id="why-us" class="section why-us" data-builder="section">
            <div class="container-fluid">
                <div class="row gy-4">
                    <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">
                        <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
                            <h3>
                                <span>Apa itu </span><strong>Infus Immune Booster</strong>
                            </h3>
                            <p>
                                Infus Immune Booster merupakan prosedur medis dimana vitamin
                                dan mineral diberikan lansung ke dalam aliran darah melalui
                                infus intravena. Prosedur ini memungkinkan penyerapan nutrisi
                                lebih cepat dibandingkan dengan konsumsi vitamin oral.
                            </p>
                        </div>

                        <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">
                            <div class="faq-item faq-active">
                                <h3>
                                    <span>Manfaat Immune Booster</span>
                                </h3>
                                <div class="faq-content">
                                    <ul>
                                        <li>
                                            <span>Meningkatkan daya tahan tubuh </span>
                                        </li>
                                        <li>
                                            <span>Mengatasi kelelahan dan meningkatkan energi
                                            </span>
                                        </li>
                                        <li>
                                            <span>Mencegah kekurangan vitamin dan mineral dalam tubuh
                                            </span>
                                        </li>
                                        <li>
                                            <span>Meningkatkan kesehatan kulit </span>
                                        </li>
                                        <li>
                                            <span>Mempercepat proses recovery pasca sakit </span>
                                        </li>
                                        <li>
                                            <span>Sebagai antioksidan dalam tubuh </span>
                                        </li>
                                    </ul>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>
                            <!-- End Faq item-->

                            <div class="faq-item">
                                <h3>
                                    <span>Kapan sih waktu yang tepat untuk INFUS VITAMIN ?</span>
                                </h3>
                                <div class="faq-content">
                                    <ul>
                                        <li>
                                            <span>Saat aktivitas padat</span>
                                        </li>
                                        <li>
                                            <span>Pergantian cuaca extreme </span>
                                        </li>
                                        <li>
                                            <span>Setelah sembuh dari sakit </span>
                                        </li>
                                        <li>
                                            <span>Saat daya tahan tubuh mulai menurun</span>
                                        </li>
                                        <li>
                                            <span>Sebelum dan sesudah bepergian jauh</span>
                                        </li>
                                    </ul>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>
                            <!-- End Faq item-->
                        </div>
                    </div>

                    <div class="col-lg-5 order-1 order-lg-2 why-us-img">
                        <img src="assets/img/immune.jpg" class="img-fluid" alt=""
                            data-aos="zoom-in loading="lazy"" data-aos-delay="100" />
                    </div>
                </div>
            </div>
        </section>
        <!-- /Why Us Section -->

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan Kami</h2>
                <p>
                    Kami menyediakan berbagai layanan kesehatan profesional langsung di kenyamanan rumah Anda.
                </p>
            </div>
            <div class="container">
                <div class="row gy-4 align-items-stretch">

                    @forelse ($services as $service)
                        <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up"
                            data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="service-item position-relative">
                                <div class="icon"><img src="{{ asset('assets/img/logoKecil.png') }}" alt=""
                                        loading="lazy"></div>

                                {{-- Link mengarah ke halaman detail service yang sesuai --}}
                                <h4><a href="{{ route('services.show', $service) }}"
                                        class="stretched-link">{{ $service->name }}</a></h4>

                                {{-- Menampilkan deskripsi singkat (dibatasi 50 karakter) --}}
                                <p>{{ Str::limit($service->description, 50) }}</p>
                            </div>
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
                                frameborder="0" style="border: 0; width: 100%; height: 270px" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <label for="name-field" class="pb-2">Nama Anda</label>
                                    <input type="text" name="name" id="name-field" class="form-control"
                                        required="" />
                                </div>

                                <div class="col-md-6">
                                    <label for="email-field" class="pb-2">Email Anda</label>
                                    <input type="email" class="form-control" name="email" id="email-field"
                                        required="" />
                                </div>

                                <div class="col-md-12">
                                    <label for="subject-field" class="pb-2">Subjek Pesan</label>
                                    <input type="text" class="form-control" name="subject" id="subject-field"
                                        required="" />
                                </div>

                                <div class="col-md-12">
                                    <label for="message-field" class="pb-2">Pesan Anda</label>
                                    <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">
                                        Pesan Anda telah terkirim. Terima kasih!
                                    </div>

                                    <button type="submit">Kirim Pesan</button>
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
