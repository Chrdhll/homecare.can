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
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}?v={{ filemtime(public_path('assets/css/main.css')) }}"
        rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @stack('styles')

    <style>
        /* HILANGKAN PANAH DROPDOWN BAWAAN BOOTSTRAP */
        /* .no-arrow::after {
            display: none !important;
        } */

        .profile-nav-container {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            overflow: hidden;
            /* border: 2px solid var(--accent-color); */

            /* Trik CSS biar border-radius gak bergerigi (Anti-aliasing) */
            transform: translateZ(0);
            -webkit-mask-image: -webkit-radial-gradient(white, black);
        }

        .profile-img-small {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* STYLE SAMA KAYAK DI HALAMAN PROFIL */
        .dropdown-menu-modern {
            border-radius: 12px;
            padding: 8px;
            margin-top: 10px !important;
        }

        .dropdown-item-modern {
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: 500;
            color: #555;
            transition: all 0.2s;
        }

        .dropdown-item-modern:hover {
            background-color: #f8f9fa;
            color: var(--accent-color);
        }

        .dropdown-item-modern.text-danger:hover {
            background-color: #fff5f5;
            color: #dc3545 !important;
        }

        /* KHUSUS MOBILE */
        @media (max-width: 1200px) {
            .mobile-user-info {
                background: #ffffff;
                padding: 0;
                /* Hapus padding container biar full */
                margin: 15px 0;
                border-radius: 12px;
                border: 1px solid #eee;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                /* Shadow halus */
                overflow: hidden;
            }

            /* Header Profil di Mobile */
            .mobile-profile-header {
                background: #f8f9fa;
                padding: 15px;
                display: flex;
                align-items: center;
                border-bottom: 1px solid #eee;
            }

            /* Style Tombol Mobile ala List Menu */
            .mobile-user-btn {
                display: flex;
                align-items: center;
                justify-content: space-between;
                /* Ikon+Teks di Kiri, Panah di Kanan */
                width: 100%;
                padding: 12px 20px;
                /* Padding yang nyaman buat jempol */
                background: white;
                border: none;
                border-bottom: 1px solid #f0f0f0;
                color: #444;
                text-decoration: none;
                transition: 0.2s;
                font-weight: 500;
                font-size: 14px;
            }

            /* Hapus border di item terakhir */
            .mobile-user-btn:last-child {
                border-bottom: none;
            }

            .mobile-user-btn:active {
                background-color: #f2f2f2;
            }

            /* Wrapper buat Ikon + Teks biar nempel rapi */
            .btn-content-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            /* Lingkaran Ikon Biar Estetik */
            .icon-circle {
                width: 32px;
                height: 32px;
                background: #f0f4ff;
                /* Biru muda banget */
                color: var(--accent-color);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
            }

            /* Khusus Logout */
            .btn-logout-mobile .icon-circle {
                background: #fff5f5;
                color: #dc3545;
            }

            .btn-logout-mobile {
                color: #dc3545 !important;
            }

            /* Tombol Masuk Besar */
            .btn-login-mobile-block {
                background: var(--accent-color);
                color: white !important;
                text-align: center;
                padding: 12px;
                border-radius: 8px;
                display: block;
                font-weight: 600;
                margin: 15px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            }
        }

        /* ICON SIZE & TEBAL */
        .mobile-right-actions i {
            font-size: 22px;
            font-weight: 900;
        }

        /* BADGE NOTIF */
        .mobile-right-actions .badge {
            position: absolute;
            top: -4px;
            right: -6px;

            min-width: 18px;
            height: 18px;
            padding: 0 5px;

            display: flex;
            align-items: center;
            justify-content: center;

            background-color: #dc3545;
            color: #fff;
            font-size: 10px;
            font-weight: 600;
            line-height: 1;

            border-radius: 999px;

        }

        .mobile-controls-wrapper {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            z-index: 9999;
        }
        .mobile-nav-toggle,
        .mobile-right-actions {
            position: static !important;
            transform: none !important;
            display: block;
        }

        .mobile-nav-toggle {
            font-size: 28px;
            color: #0d2757;
            cursor: pointer;
            margin: 0 !important;
        }

        .mobile-right-actions {
            margin-right: 15px;
        }

        /* KETIKA MENU DIBUKA (Silang X) */
        body.mobile-nav-active .mobile-nav-toggle {
            color: #fff;
        }
    </style>
</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-boxed container-xl position-relative d-flex align-items-center">

            <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assets/img/logo_1.png') }}" alt="" />
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('home') }}#hero" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                    </li>
                    <li><a href="{{ route('home') }}#about">Tentang</a></li>
                    <li class="dropdown">
                        <a href="{{ route('home') }}#services"><span>Layanan</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            @foreach ($navServices as $service)
                                <li><a href="{{ route('services.show', $service) }}">{{ $service->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('home') }}#testimonials">Testimoni</a></li>
                    <li><a href="{{ route('home') }}#contact">Kontak</a></li>

                    {{-- TAMPILAN KHUSUS MOBILE (D-LG-NONE) --}}
                    <li class="d-xl-none mt-3">
                        @auth
                            <div class="mobile-user-info mx-3">

                                {{-- HEADER PROFIL --}}
                                <div class="mobile-profile-header">
                                    <div class="rounded-circle overflow-hidden me-3 flex-shrink-0"
                                        style="width: 45px; height: 45px; border: 2px solid var(--accent-color);">
                                        @if (Auth::user()->avatar)
                                            <img src="{{ Storage::url(Auth::user()->avatar) }}"
                                                class="w-100 h-100 object-fit-cover">
                                        @else
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white fw-bold"
                                                style="background: var(--accent-color); font-size: 18px;">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="overflow-hidden">
                                        <div class="fw-bold text-dark text-truncate">
                                            {{ Str::limit(Auth::user()->name, 20) }}</div>
                                        <small class="text-muted" style="font-size: 12px;">
                                            {{ Auth::user()->role === 'admin' ? 'Administrator' : Auth::user()->email }}
                                        </small>
                                    </div>
                                </div>

                                {{-- MENU LIST ITEMS --}}
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ url('/admin') }}" class="mobile-user-btn">
                                        <div class="btn-content-left">
                                            <div class="icon-circle" style="background: #333; color: white;">
                                                <i class="bi bi-speedometer2"></i>
                                            </div>
                                            <span>Dashboard Admin</span>
                                        </div>
                                        <i class="bi bi-chevron-right text-muted" style="font-size: 12px;"></i>
                                    </a>
                                @endif

                                <a href="{{ route('profile.edit') }}" class="mobile-user-btn">
                                    <div class="btn-content-left">
                                        <div class="icon-circle">
                                            <i class="bi bi-person-gear"></i>
                                        </div>
                                        <span>Edit Profil</span>
                                    </div>
                                    <i class="bi bi-chevron-right text-muted" style="font-size: 12px;"></i>
                                </a>

                                <a href="{{ route('my-orders.index') }}" class="mobile-user-btn">
                                    <div class="btn-content-left">
                                        <div class="icon-circle">
                                            <i class="bi bi-clock-history"></i>
                                        </div>
                                        <span>Riwayat Pesanan</span>
                                    </div>
                                    <i class="bi bi-chevron-right text-muted" style="font-size: 12px;"></i>
                                </a>

                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="mobile-user-btn btn-logout-mobile">
                                        <div class="btn-content-left">
                                            <div class="icon-circle">
                                                <i class="bi bi-box-arrow-right"></i>
                                            </div>
                                            <span>Keluar</span>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        @else
                            {{-- TOMBOL LOGIN BESAR --}}
                            <a href="{{ route('login') }}" class="btn-login-mobile-block">
                                Masuk Sekarang
                            </a>
                        @endguest
                    </li>
                </ul>
                {{-- <i class="mobile-nav-toggle d-xl-none bi bi-list"></i> --}}
            </nav>

            <div class="mobile-controls-wrapper d-xl-none">
                <div class="mobile-right-actions position-relative me-3">
                    @auth
                        <div class="dropdown">
                            <a href="#" class="position-relative text-secondary" data-bs-toggle="dropdown"
                                aria-expanded="false">

                                {{-- ICON LONCENG TEBAL --}}
                                <i class="bi bi-bell fs-5 fw-bold"></i>

                                @if (Auth::user()->unreadNotifications->count() > 0)
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                        style="font-size: 9px; padding: 4px 6px;">
                                        {{ Auth::user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow border-0"
                                style="width: 92vw; max-height: 65vh; overflow-y: auto;">
                                <li class="px-3 py-2 border-bottom fw-bold small text-muted">
                                    Notifikasi
                                </li>

                                @forelse(Auth::user()->notifications->take(5) as $notification)
                                    <li>
                                        <a class="dropdown-item py-3 {{ $notification->read_at ? '' : 'bg-light' }}"
                                            href="{{ route('notification.read', $notification->id) }}">
                                            <strong class="d-block small">
                                                {{ $notification->data['title'] ?? 'Info' }}
                                            </strong>
                                            <small class="text-muted">
                                                {{ $notification->data['message'] ?? '' }}
                                            </small>
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-center py-4 text-muted small">
                                        <i class="bi bi-bell-slash fs-4 d-block mb-2"></i>
                                        Belum ada notifikasi
                                    </li>
                                @endforelse
                            </ul>

                        </div>
                    @endauth
                </div>
                <i class="mobile-nav-toggle bi bi-list"></i>
            </div>

            {{-- ========================================== --}}
            {{-- TAMPILAN KHUSUS DESKTOP (D-NONE D-LG-FLEX) --}}
            {{-- ========================================== --}}
            @auth
                {{-- Dropdown Profil Desktop --}}
                <div class="d-flex align-items-center ms-3 d-none d-xl-flex gap-3">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-secondary position-relative no-arrow"
                            id="dropdownNotif" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell" style="font-size: 22px;"></i>

                            {{-- Badge Merah (Hanya muncul jika ada notif belum dibaca) --}}
                            @if (Auth::user()->unreadNotifications->count() > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    style="font-size: 10px; padding: 3px 6px;">
                                    {{ Auth::user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-modern shadow border-0"
                            aria-labelledby="dropdownNotif"
                            style="min-width: 320px; max-height: 400px; overflow-y: auto;">

                            <li class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                                <span class="fw-bold small text-muted">Notifikasi</span>
                                @if (Auth::user()->unreadNotifications->count() > 0)
                                    <a href="{{ route('notification.read.all') }}"
                                        class="text-decoration-none small text-primary">Tandai semua dibaca</a>
                                @endif
                            </li>

                            @forelse(Auth::user()->notifications->take(5) as $notification)
                                <li>
                                    <a class="dropdown-item dropdown-item-modern d-flex align-items-start gap-3 py-3 {{ $notification->read_at ? '' : 'bg-light' }}"
                                        href="{{ route('notification.read', $notification->id) }}">

                                        {{-- Ikon Bulat --}}
                                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                            style="width: 35px; height: 35px; background-color: var(--accent-color); color: white;">
                                            <i class="bi {{ $notification->data['icon'] ?? 'bi-bell' }}"></i>
                                        </div>

                                        <div class="w-100">
                                            <div class="d-flex justify-content-between align-items-start gap-2">
                                                <strong
                                                    class="text-dark small d-block pe-2">{{ $notification->data['title'] ?? 'Info' }}</strong>
                                                <small class="text-muted text-nowrap"
                                                    style="font-size: 10px;">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="text-muted small mb-0 text-truncate" style="max-width: 200px;">
                                                {{ $notification->data['message'] ?? '' }}
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="text-center py-4 text-muted small">
                                    <i class="bi bi-bell-slash fs-4 d-block mb-2"></i>
                                    Belum ada notifikasi
                                </li>
                            @endforelse

                            {{-- Link ke semua (opsional) --}}
                            {{-- <li class="text-center border-top p-2">
                                <a href="#" class="small text-decoration-none fw-bold">Lihat Semua</a>
                            </li> --}}
                        </ul>
                    </div>

                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle no-arrow"
                            id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-nav-container me-1">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Storage::url(Auth::user()->avatar) }}" class="profile-img-small">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center fw-bold"
                                        style="background-color: #eee; color: #666;">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-modern" aria-labelledby="dropdownUser"
                            style="min-width: 220px;">
                            <li class="px-3 py-2 border-bottom mb-2">
                                <div class="fw-bold text-dark">{{ Str::limit(Auth::user()->name, 18) }}</div>
                                <small class="text-muted" style="font-size: 11px;">{{ Auth::user()->email }}</small>
                            </li>

                            @if (Auth::user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item dropdown-item-modern fw-bold text-primary"
                                        href="{{ url('/admin') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider my-1">
                                </li>
                            @endif

                            <li><a class="dropdown-item dropdown-item-modern" href="{{ route('profile.edit') }}"><i
                                        class="bi bi-person me-2 opacity-50"></i> Profil Saya</a></li>
                            <li><a class="dropdown-item dropdown-item-modern" href="{{ route('my-orders.index') }}"><i
                                        class="bi bi-clock-history me-2 opacity-50"></i> Riwayat Pesanan</a></li>
                            <li>
                                <hr class="dropdown-divider my-1">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item dropdown-item-modern text-danger"><i
                                            class="bi bi-box-arrow-right me-2"></i> Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                {{-- Tombol Login Desktop --}}
                <a class="btn-getstarted ms-3 d-none d-lg-block" href="{{ route('login') }}">Masuk</a>
            @endguest

        </div>
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
        @yield('footer-newsletter')
        <div class="container-boxed footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">Homecare.can</span>
                    </a>
                    <div class="footer-contact pt-3">
                        {!! nl2br(e(settings('contact_address', "Kemang,\nJakarta Selatan"))) !!}
                        <p class="mt-3">
                            <strong>{{ settings('contact_phone_label', 'WhatsApp') }}:</strong>
                            <span>{{ settings('contact_phone', '+62 822-8733-9437') }}</span>
                        </p>
                        <p><strong>{{ settings('contact_email_label', 'Email') }}:</strong>
                            <span>{{ settings('contact_email', 'Mrican.ac@gmail.com') }}</span>
                        </p>
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
                            <a href="#call-to-action">Galeri</a>
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
                        @foreach ($navServices as $service)
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <a href="{{ route('services.show', $service) }}">{{ $service->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Ikuti Kami</h4>
                    <p>
                        {{ settings('footer_social_text', 'Ikuti kami di media sosial untuk mendapatkan update terbaru, tips kesehatan, dan melihat testimoni dari pelanggan kami.') }}
                    </p>
                    <div class="social-links d-flex mt-2">
                        <a href="{{ settings('footer_link_twitter', '#') }}" target="_blank"><i
                                class="bi bi-twitter-x"></i></a>
                        <a href="{{ settings('footer_link_facebook', '#') }}" target="_blank"><i
                                class="bi bi-facebook"></i></a>
                        <a href="{{ settings('footer_link_instagram', '#') }}" target="_blank"><i
                                class="bi bi-instagram"></i></a>
                        <a href="{{ settings('footer_link_linkedin', '#') }}" target="_blank"><i
                                class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-boxed copyright text-center mt-4">
            <p>
                © <span>Copyright</span>
                <strong class="px-1 sitename">Homecare.can 2025</strong>
                <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                Designed by
                <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by
                <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
            </div>
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
        document.addEventListener('DOMContentLoaded', function() {

            // 1. HANDLE SUCCESS (Custom Kita)
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

            // 2. HANDLE ERROR (Custom Kita)
            @if (session('error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });
            @endif

            // 3. HANDLE VALIDATION ERROR (Form Kosong dll)
            @if ($errors->any())
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Periksa Inputan!',
                    text: "Ada kolom wajib yang belum diisi.",
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });
            @endif

            // ============================================================
            // 4. HANDLE STATUS (Bawaan Laravel Breeze / Profil / Password)
            // ============================================================
            @if (session('status'))
                // Kita translate pesan bawaan Laravel biar user friendly
                let message = "{{ session('status') }}";
                let title = 'Info';
                let icon = 'info';

                if (message === 'profile-updated') {
                    title = 'Berhasil';
                    message = 'Profil berhasil diperbarui.';
                    icon = 'success';
                } else if (message === 'password-updated') {
                    title = 'Berhasil';
                    message = 'Password berhasil diubah.';
                    icon = 'success';
                } else if (message === 'verification-link-sent') {
                    message = 'Link verifikasi baru telah dikirim.';
                }

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: icon,
                    title: title,
                    text: message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif
        });
    </script>

    @stack('modals')

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')

    {{-- SCRIPT PENGHILANG HASH URL (BIAR URL TETAP BERSIH) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // 1. TANGKAP SEMUA LINK NAVIGASI YANG PAKE PAGAR (#)
            const navLinks = document.querySelectorAll('a[href^="#"], a[href^="{{ route('home') }}#"]');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Cek apakah kita sedang berada di halaman home
                    const isHomePage = window.location.pathname === '/' || window.location
                        .pathname === '{{ parse_url(route('home'), PHP_URL_PATH) }}';

                    // Ambil target hash (misal: #services)
                    let href = this.getAttribute('href');
                    let hash = href.includes('#') ? href.substring(href.indexOf('#')) : '';

                    if (isHomePage && hash) {
                        e.preventDefault(); // STOP browser ganti URL

                        const targetSection = document.querySelector(hash);

                        if (targetSection) {
                            // Hitung tinggi header biar scroll gak ketutupan navbar
                            const header = document.querySelector('#header');
                            const headerOffset = header ? header.offsetHeight : 0;
                            const elementPosition = targetSection.getBoundingClientRect().top;
                            const offsetPosition = elementPosition + window.scrollY - headerOffset;

                            // Scroll manual yang mulus
                            window.scrollTo({
                                top: offsetPosition,
                                behavior: "smooth"
                            });

                            // Opsional: Tutup menu mobile kalo lagi kebuka
                            if (document.querySelector('body').classList.contains(
                                    'mobile-nav-active')) {
                                document.querySelector('body').classList.remove(
                                    'mobile-nav-active');
                                document.querySelector('.mobile-nav-toggle').classList.toggle(
                                    'bi-list');
                                document.querySelector('.mobile-nav-toggle').classList.toggle(
                                    'bi-x');
                            }
                        }
                    }
                });
            });

            // 2. BERSIHKAN URL KALAU USER DATANG DARI HALAMAN LAIN
            // Misal user dari Profil klik "Riwayat", pas nyampe Home hash-nya dihapus
            if (window.location.hash) {
                // Tunggu scroll selesai dikit, baru hapus hash
                setTimeout(() => {
                    history.replaceState(null, null, ' '); // Hapus #hash dari address bar
                }, 100);

                // Fix scroll position biar pas (karena kadang meleset pas load awal)
                const hash = window.location.hash;
                const targetSection = document.querySelector(hash);
                if (targetSection) {
                    setTimeout(() => {
                        const header = document.querySelector('#header');
                        const headerOffset = header ? header.offsetHeight : 0;
                        const elementPosition = targetSection.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.scrollY - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: "smooth"
                        });
                    }, 100);
                }
            }
        });
    </script>
</body>

</html>
