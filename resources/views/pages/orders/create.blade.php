@extends('layouts.template')

@section('title', 'Finalisasi Pesanan')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.11.0/dist/geosearch.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css"
        type="text/css">

    <style>
        #map {
            height: 400px;
            width: 100%;
            border-radius: 12px;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 15px;
            border: 2px solid #eee;
        }

        /* FIX: Reset style gambar di dalam peta */
        .leaflet-pane img {
            max-width: none !important;
        }

        /* --- CUSTOM MARKER (PAKAI BOOTSTRAP ICONS) --- */
        .custom-marker-icon {
            background: transparent;
            border: none;
            text-align: center;
        }

        .custom-marker-icon i {
            filter: drop-shadow(0px 3px 2px rgba(0, 0, 0, 0.4));
        }

        /* --- CUSTOM SEARCH BAR --- */
        .leaflet-control-geosearch form {
            background: #fff;
            border-radius: 8px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            /* Reset padding */
            border: 2px solid transparent;
            position: relative;
            /* Penting buat dropdown */
            margin-top: 10px;
            width: 100%;
            max-width: 400px;
            padding: 0 !important;
            height: 35px !important;
            overflow: visible !important;
            z-index: 9999;
        }

        .leaflet-control-geosearch form:focus-within {
            border-color: var(--accent-color, #0d6efd);
            /* Warna Biru Tema */
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
            /* Efek glow halus */
        }

        .leaflet-control-geosearch input {
            height: 100% !important;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            font-size: 14px;
            padding-left: 40px !important;
            width: 100%;
            background: transparent;
            color: #333;
            border-radius: 8px;
            margin: 0;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        /* Ikon Kaca Pembesar */
        .leaflet-control-geosearch form::before {
            content: "\F52A";
            font-family: "bootstrap-icons";
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #666;
            z-index: 10;
            pointer-events: none;
        }

        .leaflet-control-geosearch a.reset {
            position: absolute !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            height: 100% !important;
            width: 45px !important;
            margin: 0 !important;
            padding: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #999;
            font-weight: bold;
            text-decoration: none !important;
            font-size: 18px;
            line-height: 1 !important;
            cursor: pointer;
            z-index: 20 !important;

            background: #fff;
            border: none !important;
            border-top-right-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
        }

        .leaflet-control-geosearch a.reset:hover {
            background: #f9f9f9;
            color: #dc3545;
            /* Merah pas di-hover */
            text-decoration: none;
        }

        /* --- FIX: HASIL PENCARIAN DI BAWAH (DROPDOWN) --- */
        .leaflet-control-geosearch .results {
            background: #fff;
            position: absolute;
            top: 100%;
            /* Tepat di bawah input */
            left: 0;
            width: 100%;
            margin-top: 5px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid #eee;
            z-index: 99999 !important;
            /* Pastikan di atas peta */
        }

        .leaflet-control-geosearch .results>div {
            padding: 10px 15px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            font-size: 13px;
            transition: background 0.2s;
        }

        .leaflet-control-geosearch .results>div:hover {
            background-color: #f8f9fa;
            color: var(--accent-color);
            text-decoration: none;
            border: none;
        }

        .leaflet-control-geosearch .results>div:last-child {
            border-bottom: none;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        /* Sembunyikan class aktif yang bikin aneh */
        .leaflet-control-geosearch .results.active {
            display: block;
        }

        .leaflet-gesture-handling:after {
            color: #fff;
            background: rgba(0, 0, 0, 0.7);
            font-family: sans-serif;
            font-weight: bold;
        }
    </style>


    <main class="main"
        style="padding-top: 120px; padding-bottom: 60px; background-color: color-mix(
        in srgb,
        var(--default-color),
        transparent 96%
    );">
        <div class="container">

            <div class="section-title text-center mb-5" data-aos="fade-up">
                <h2>Finalisasi Pesanan</h2>
                <p>Lengkapi data di bawah ini untuk melanjutkan pemesanan layanan.</p>
            </div>

            <div class="row gy-4">

                {{-- KOLOM KIRI: FORM --}}
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                            <i class="bi bi-person-lines-fill fs-4 text-primary me-3"></i>
                            <h5 class="mb-0 fw-bold">Data Pemesan & Jadwal</h5>
                        </div>

                        <form action="{{ route('orders.store', $service) }}" method="POST" id="orderForm" target="_blank">
                            @csrf

                            {{-- Info Pasien --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Nama Pasien</label>
                                    <input type="text" class="form-control bg-light" value="{{ $user->name }}"
                                        readonly>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Email</label>
                                    <input type="text" class="form-control bg-light" value="{{ $user->email }}"
                                        readonly>
                                </div>
                            </div>

                            {{-- Kontak & Jadwal --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold text-uppercase">No. WhatsApp <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="phone_number" class="form-control"
                                        value="{{ old('phone_number', $user->phone_number) }}"
                                        placeholder="Contoh: 08123456789" required>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Rencana Jadwal
                                        (Preferensi) <span class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        <div class="col-7">
                                            <input type="date" name="schedule_date" class="form-control"
                                                value="{{ old('schedule_date') }}" min="{{ date('Y-m-d') }}" required>
                                        </div>
                                        <div class="col-5">
                                            <input type="time" name="schedule_time" class="form-control"
                                                value="{{ old('schedule_time') }}" required>
                                        </div>
                                    </div>
                                    <div class="form-text text-warning small mt-1">
                                        <i class="bi bi-info-circle"></i> Jam ini bersifat pengajuan. Kepastian jadwal akan
                                        dikonfirmasi Admin via WhatsApp.
                                    </div>
                                </div>
                            </div>

                            {{-- PETA & ALAMAT --}}
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label text-muted small fw-bold text-uppercase">
                                        <i class="bi bi-geo-alt-fill text-danger"></i> Lokasi Rumah (Wajib)
                                    </label>

                                    <button type="button" id="btn-my-location"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="bi bi-crosshair"></i> Gunakan Lokasi Saya
                                    </button>
                                </div>

                                <div class="alert alert-info d-flex align-items-center py-2 px-3 mb-2" role="alert"
                                    style="font-size: 13px;">
                                    <i class="bi bi-info-circle-fill me-2"></i>
                                    <div>
                                        Cari lokasi di peta, atau geser <strong>pin biru</strong> ke lokasi detail. Alamat
                                        akan terisi
                                        otomatis!
                                    </div>
                                </div>

                                {{-- CONTAINER PETA --}}
                                <div id="map"></div>

                                {{-- ALERT JARAK KEJAUHAN (Muncul via JS) --}}
                                <div id="distance-error" class="alert alert-danger mt-3 d-none align-items-center"
                                    role="alert">
                                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                                    <div>
                                        <strong>Lokasi di Luar Jangkauan!</strong><br>
                                        Jarak lokasi Anda <strong id="current-dist-text"></strong> km.
                                        Maksimal layanan kami adalah <strong>{{ $maxDistance }} km</strong>.
                                        Silakan pilih lokasi lain.
                                    </div>
                                </div>

                                <label class="form-label text-muted small fw-bold text-uppercase mt-3">Detail Alamat</label>
                                <textarea name="address" id="address_input" class="form-control" rows="3" placeholder="Sedang mengambil alamat..."
                                    required>{{ old('address', $user->address) }}</textarea>

                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                                <input type="hidden" name="distance" id="distance">
                                <input type="hidden" name="transport_cost" id="transport_cost_input">
                            </div>

                            {{-- Catatan --}}
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold text-uppercase">Catatan (Opsional)</label>
                                <textarea name="notes" class="form-control" rows="2" placeholder="Catatan tambahan">{{ old('notes') }}</textarea>
                            </div>

                        </form>
                    </div>
                </div>

                {{-- KOLOM KANAN: RINGKASAN --}}
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top"
                        style="top: 100px; z-index: 1;">
                        <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                            <i class="bi bi-receipt fs-4 text-primary me-3"></i>
                            <h5 class="mb-0 fw-bold">Ringkasan Pesanan</h5>
                        </div>

                        <div class="d-flex align-items-start mb-3">
                            @php
                                $thumbnail =
                                    $service->gallery && count($service->gallery) > 0
                                        ? $service->gallery[0]
                                        : $service->image;
                            @endphp
                            <img src="{{ Storage::url($thumbnail) }}" alt="{{ $service->name }}"
                                class="rounded-3 border" style="width: 70px; height: 70px; object-fit: cover;">
                            <div class="ms-3">
                                <h6 class="mb-1 fw-bold text-dark">{{ $service->name }}</h6>
                                <small class="text-muted">{{ $service->kategori ?? 'Layanan Kesehatan' }}</small>
                            </div>
                        </div>

                        <div class="card bg-light border-0 rounded-3 p-3 mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Harga Layanan</span>
                                <div class="text-end">
                                    @if (isset($activePromo) && $discountAmount > 0)
                                        {{-- Kalau ada promo, tampilkan harga coret --}}
                                        <small class="text-decoration-line-through text-muted d-block"
                                            style="font-size: 11px;">
                                            Rp {{ number_format($service->price, 0, ',', '.') }}
                                        </small>
                                        <span class="fw-bold small text-success">
                                            Rp {{ number_format($priceAfterDiscount, 0, ',', '.') }}
                                        </span>
                                    @else
                                        {{-- Harga Normal --}}
                                        <span class="fw-bold small">Rp
                                            {{ number_format($service->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                            </div>
                            @if (isset($activePromo) && $discountAmount > 0)
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-success small"><i class="bi bi-tag-fill"></i> Promo Hemat</span>
                                    <span class="fw-bold small text-success">- Rp
                                        {{ number_format($discountAmount, 0, ',', '.') }}</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Jarak (Est.)</span>
                                <span class="fw-bold small" id="ui-jarak">- km</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Ongkos Kirim</span>
                                <span class="fw-bold small text-danger" id="ui-ongkir">Rp 0</span>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark">Total Tagihan</span>
                                <span class="h5 fw-bold text-primary mb-0" id="ui-total">Rp
                                    {{ number_format($service->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button type="submit" form="orderForm"
                            class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <span>Lanjut ke WhatsApp</span>
                            <i class="bi bi-whatsapp"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.11.0/dist/geosearch.umd.js"></script>
    <script src="https://unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // DATA DARI CONTROLLER
            const adminLat = {{ is_numeric($adminLat) ? $adminLat : -6.2 }};
            const adminLng = {{ is_numeric($adminLng) ? $adminLng : 106.816666 }};
            const pricePerKm = {{ is_numeric($pricePerKm) ? $pricePerKm : 5000 }};
            const servicePrice = {{ $priceAfterDiscount ?? $service->price }};
            const maxDistance = {{ is_numeric($maxDistance) ? $maxDistance : 20 }};

            // INISIALISASI PETA
            var map = L.map('map', {
                center: [adminLat, adminLng],
                zoom: 13,
                gestureHandling: true // <--- AKTIFKAN FITUR INI
            });
            L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            // --- HELPER: BUAT CUSTOM MARKER ---
            const createCustomIcon = (iconClass, color) => {
                return L.divIcon({
                    className: 'custom-marker-icon',
                    html: `<i class="${iconClass} text-${color}" style="font-size: 3rem; display:block; margin-top: -1.5rem; margin-left: -0.75rem;"></i>`,
                    iconSize: [25, 40],
                    iconAnchor: [15, 42],
                    popupAnchor: [0, -40]
                });
            };
            const iconAdmin = createCustomIcon('bi bi-geo-alt-fill', 'danger'); // Merah
            const iconUser = createCustomIcon('bi bi-geo-alt-fill', 'primary'); // Biru

            // --- PASANG MARKER ---
            var adminMarker = L.marker([adminLat, adminLng], {
                icon: iconAdmin
            }).addTo(map).bindPopup("<b>Lokasi Admin</b>");

            var userMarker = L.marker([adminLat - 0.005, adminLng - 0.005], {
                icon: iconUser,
                draggable: true
            }).addTo(map).bindPopup("<b>Geser Saya</b> ke Rumah Anda").openPopup();

            // --- FUNGSI REVERSE GEOCODING (AMBIL ALAMAT DARI KOORDINAT) ---
            async function getAddressFromCoords(lat, lng) {
                const textarea = document.getElementById('address_input');
                textarea.value = "Mengambil alamat...";
                try {
                    // Pakai API Nominatim (Gratis)
                    const response = await fetch(
                        `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`);
                    const data = await response.json();
                    if (data && data.display_name) {
                        textarea.value = data.display_name;
                    } else {
                        textarea.value = "";
                        textarea.placeholder = "Alamat tidak ditemukan, silakan ketik manual";
                    }
                } catch (error) {
                    console.error(error);
                    textarea.value = "";
                    textarea.placeholder = "Gagal koneksi peta, ketik manual";
                }
            }

            // --- FUNGSI HITUNG HARGA ---
            function updatePricing(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                var R = 6371;
                var dLat = (lat - adminLat) * Math.PI / 180;
                var dLon = (lng - adminLng) * Math.PI / 180;
                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(adminLat * Math.PI / 180) * Math.cos(lat * Math.PI / 180) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var d = R * c;

                document.getElementById('ui-jarak').innerText = d.toFixed(2) + " km";
                document.getElementById('distance').value = d.toFixed(2);
                document.getElementById('current-dist-text').innerText = d.toFixed(1);

                // === LOGIKA VALIDASI JARAK ===
                const submitBtn = document.querySelector('button[type="submit"][form="orderForm"]');
                const errorAlert = document.getElementById('distance-error');
                const ongkirText = document.getElementById('ui-ongkir');
                const totalText = document.getElementById('ui-total');

                if (d > maxDistance) {
                    // 1. JIKA KEJAUHAN
                    errorAlert.classList.remove('d-none'); // Munculin Alert Merah
                    errorAlert.classList.add('d-flex');

                    submitBtn.disabled = true; // Matikan Tombol Submit
                    submitBtn.innerHTML = '<i class="bi bi-x-circle"></i> Lokasi Terlalu Jauh';
                    submitBtn.classList.replace('btn-primary', 'btn-secondary'); // Jadi abu-abu

                    ongkirText.innerText = "Tidak Terjangkau";
                    totalText.innerText = "-";
                    document.getElementById('transport_cost_input').value = 0;
                } else {
                    // 2. JIKA AMAN
                    errorAlert.classList.add('d-none'); // Sembunyikan Alert
                    errorAlert.classList.remove('d-flex');

                    submitBtn.disabled = false; // Hidupkan Tombol
                    submitBtn.innerHTML = '<span>Lanjut ke WhatsApp</span> <i class="bi bi-whatsapp"></i>';
                    submitBtn.classList.replace('btn-secondary', 'btn-primary'); // Balik jadi biru

                    // Hitung Harga Normal
                    var rawOngkir = d * pricePerKm;
                    var ongkir = Math.ceil(rawOngkir / 500) * 500;
                    document.getElementById('transport_cost_input').value = ongkir;

                    var formatter = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    });
                    ongkirText.innerText = formatter.format(ongkir);
                    totalText.innerText = formatter.format(servicePrice + ongkir);
                }
            }

            // --- EVENT: SAAT MARKER DIGESER (DRAG) ---
            userMarker.on('dragend', function(e) {
                var pos = userMarker.getLatLng();
                updatePricing(pos.lat, pos.lng);
                getAddressFromCoords(pos.lat, pos.lng); // Panggil fungsi alamat
            });

            // --- SETUP PENCARIAN ---
            const provider = new GeoSearch.OpenStreetMapProvider({
                params: {
                    countrycodes: 'id',
                    addressdetails: 1,
                },
            });
            const searchControl = new GeoSearch.GeoSearchControl({
                provider: provider,
                style: 'bar',
                autoClose: true, // Tutup hasil setelah dipilih
                searchLabel: 'Cari lokasi...',
                keepResult: true,
                updateMap: false,
                showMarker: false,
                marker: {
                    icon: iconUser,
                    draggable: true
                },
            });
            map.addControl(searchControl);

            // --- EVENT: SAAT HASIL PENCARIAN DIPILIH ---
            map.on('geosearch/showlocation', function(result) {
                var lat = result.location.y;
                var lng = result.location.x;

                // Pindahkan marker UTAMA kita (bukan marker plugin)
                userMarker.setLatLng([lat, lng]);

                // Update harga & alamat
                updatePricing(lat, lng);
                document.getElementById('address_input').value = result.location
                    .label; // Isi alamat dari hasil search

                // Zoom biar kelihatan
                var group = new L.featureGroup([adminMarker, userMarker]);
                map.fitBounds(group.getBounds(), {
                    padding: [50, 50]
                });
            });

            const btnLocation = document.getElementById('btn-my-location');
            if (btnLocation) {
                btnLocation.addEventListener('click', function() {
                    if (navigator.geolocation) {
                        btnLocation.innerHTML =
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mencari...';

                        const gpsOptions = {
                            enableHighAccuracy: true,
                            timeout: 10000,
                            maximumAge: 0
                        };

                        navigator.geolocation.getCurrentPosition(function(position) {
                            var lat = position.coords.latitude;
                            var lng = position.coords.longitude;
                            var accuracy = position.coords.accuracy;

                            console.log("GPS Found:", lat, lng, "Akurasi:", accuracy + "m");

                            // Pindahkan marker user ke lokasi GPS
                            userMarker.setLatLng([lat, lng]);

                            // Update Data & Zoom
                            updatePricing(lat, lng);
                            getAddressFromCoords(lat, lng);

                            map.setView([lat, lng], 15);

                            var group = new L.featureGroup([adminMarker, userMarker]);
                            map.fitBounds(group.getBounds(), {
                                padding: [50, 50]
                            });

                            btnLocation.innerHTML =
                                '<i class="bi bi-check-circle-fill"></i> Lokasi Ditemukan';
                            setTimeout(() => {
                                btnLocation.innerHTML =
                                    '<i class="bi bi-crosshair"></i> Gunakan Lokasi Saya';
                            }, 3000);

                        }, function(error) {
                            console.error("Error GPS:", error);
                            let msg = "Gagal mendapatkan lokasi.";
                            if (error.code == 1) msg = "Izin lokasi ditolak.";
                            else if (error.code == 2) msg = "Sinyal GPS lemah/tidak tersedia.";
                            else if (error.code == 3) msg = "Waktu habis (Timeout).";

                            alert(msg + " Silakan geser pin secara manual.");

                            btnLocation.innerHTML = originalText;
                            btnLocation.disabled = false;
                        }, gpsOptions);
                    } else {
                        alert("Browser Anda tidak mendukung Geolocation.");
                    }
                });
            }

            // --- INIT AWAL ---
            var initPos = userMarker.getLatLng();
            updatePricing(initPos.lat, initPos.lng);
            // Optional: Panggil getAddressFromCoords saat load pertama kalau mau auto-fill lokasi default
            // getAddressFromCoords(initPos.lat, initPos.lng); 

            // document.getElementById('orderForm').addEventListener('submit', function() {
            //     setTimeout(function() {
            //         window.location.href = "{{ route('home') }}";
            //     }, 1000);
            // });
        });
    </script>
@endsection
