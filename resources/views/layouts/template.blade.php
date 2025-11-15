<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Homecare.can @yield('title')</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logokecil2.png') }}" rel="icon" />
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" defer rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets/img/logo_1.png') }}" alt="" />
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li class="dropdown">
                        <a href="#services"><span>Layanan</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Booster Complex</a></li>
                            <li><a href="#">Booster Vitamin</a></li>
                            <li><a href="#">Combo Booster</a></li>
                            <li><a href="#">Immune Booster Plus</a></li>
                            <li><a href="#">Immune Booster Premium</a></li>
                            <li><a href="#">Immune Booster Platinum</a></li>
                        </ul>
                    </li>
                    <li><a href="#portfolio">Promosi</a></li>
                    <li><a href="#contact">Kontak</a></li>

                    <li class="d-lg-none nav-button-container">
                        @auth
                            {{-- Tombol Logout (versi mobile) --}}
                            <a href="#" onclick="event.preventDefault(); confirmLogout();" class="nav-logout-button">
                                <span>Keluar</span>
                                <i class="bi bi-box-arrow-right"></i>
                            </a>
                        @else
                            {{-- Tombol Masuk (versi mobile) --}}
                            <a href="{{ route('login') }}" class="nav-login-button">
                                <span>Masuk</span>
                            </a>
                        @endguest
                    </li>
                </ul>

            </nav>

            {{-- Cek apakah user sudah login --}}
            @auth
                {{-- Jika SUDAH LOGIN, tampilkan dropdown profil --}}
                <div class="dropdown ms-3 d-none d-lg-flex"">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                        id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-2"
                            style="width: 32px; height: 32px; background-color: #eee; color: #666; font-weight: bold;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>

                    </a>

                    {{-- Isi Dropdown Menu --}}
                    <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser">
                        {{-- Tambahkan link ke profil nanti di sini --}}
                        {{-- <li><a class="dropdown-item" href="#">Profil Saya</a></li> --}}
                        {{-- <li><hr class="dropdown-divider"></li> --}}

                        {{-- Tombol Logout --}}
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            {{-- Ubah type jadi button, tambahkan onclick --}}
                            <button type="button" class="dropdown-item" onclick="confirmLogout()">
                                <i class="bi bi-box-arrow-right me-2"></i>Keluar
                            </button>
                        </form>
                        </li>
                    </ul>
                </div>
            @else
                {{-- Jika BELUM LOGIN, tampilkan tombol Masuk --}}
                <a class="btn-getstarted ms-3 d-none d-lg-block" href="{{ route('login') }}">Masuk</a>

            @endguest
        </div>

        <div class="mobile-search-trigger d-lg-none">
            <i class="bi bi-search"></i>
        </div>

        <i class="mobile-nav-toggle d-xl-none bi bi-list ml-3"></i>

    </header>
    <!-- MOBILE SEARCH BAR SLIDE DOWN -->
    <div id="mobile-search-panel" class="mobile-search-panel d-lg-none">
        <form id="mobileSearchForm" class="search-slide-inner">
            <input type="text" id="mobileSearchInput" placeholder="Ketik lalu tekan enter…" />
            <button type="button" id="closeSearch"><i class="bi bi-x-lg"></i></button>
        </form>
    </div>


    @yield('content')

    <footer id="footer" class="footer">
        {{-- <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>Dapatkan Info & Promo Terbaru</h4>
                        <p>
                            Berlangganan untuk mendapatkan informasi seputar kesehatan dan
                            penawaran khusus langsung ke email Anda.
                        </p>
                        <form action="forms/newsletter.php" method="post" class="php-email-form">
                            <div class="newsletter-form">
                                <input type="email" name="email" /><input type="submit" value="Subscribe" />
                            </div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">
                                Permintaan langganan Anda telah terkirim. Terima kasih!
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">Homecare.can</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Kemang, </p>
                        <p>Jakarta Selatan</p>
                        <p class="mt-3">
                            <strong>WhatsApp:</strong> <span>+62 822-8733-9437</span>
                        </p>
                        <p><strong>Email:</strong> <span>Mrican.ac@gmail.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Link Navigasi</h4>
                    <ul>
                        <li>
                            <i class="bi bi-chevron-right"></i> <a href="#hero">Beranda</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#about">Tentang Kami</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#services">Layanan</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#portfolio">Promosi</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#contact">Kontak</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#">Booster Complex</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#">Booster Vitamin</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#">Combo Booster</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#">Immune Booster Plus</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#">Immune Booster Premium</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#">Immune Booster Platinum</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Ikuti Kami</h4>
                    <p>
                        Ikuti kami di media sosial untuk mendapatkan update terbaru, tips
                        kesehatan, dan melihat testimoni dari pelanggan kami.
                    </p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>
                © <span>Copyright</span>
                <strong class="px-1 sitename">Homecare.can 2025</strong>
                <span>All Rights Reserved</span>
            </p>
            <!-- <div class="credits">
          Designed by
          <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by
          <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
        </div> -->
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0e4170',
                cancelButtonColor: '#555555',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek pesan sukses dari session
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Sukses!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });
            @endif
        });

        document.addEventListener("DOMContentLoaded", function() {

            const trigger = document.querySelector(".mobile-search-trigger");
            const panel = document.getElementById("mobile-search-panel");
            const closeBtn = document.getElementById("closeSearch");
            const form = document.getElementById("mobileSearchForm");
            const input = document.getElementById("mobileSearchInput");

            // Open search
            trigger?.addEventListener("click", () => {
                panel.classList.toggle("show");
                input.focus(); // otomatis focus
            });

            // Close search
            closeBtn?.addEventListener("click", () => {
                panel.classList.remove("show");
            });

            // Enter / Submit
            form?.addEventListener("submit", function(e) {
                e.preventDefault();

                const query = input.value.trim();

                if (query.length === 0) return;

                // Redirect ke route pencarian (ubah sesuai kebutuhan)
                window.location.href = `/search?q=${encodeURIComponent(query)}`;
            });

        });
    </script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
