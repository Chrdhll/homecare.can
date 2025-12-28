@extends('layouts.template')

@section('content')
    <div class="container-boxed py-5" style="margin-top: 80px;">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- 1. HEADER & NAVIGATION --}}
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('my-orders.index') }}" class="btn btn-light rounded-circle shadow-sm me-3"
                        style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-arrow-left text-dark"></i>
                    </a>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">Detail Pesanan</h4>
                        <p class="text-muted small mb-0">No. Invoice: #INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                </div>

                {{-- 2. STATUS CARD (HERO SECTION) --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden position-relative">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span
                                    class="badge rounded-pill px-3 py-2 mb-2 
                                {{ $order->status == 'Selesai'
                                    ? 'bg-success-subtle text-success'
                                    : ($order->status == 'Dibatalkan'
                                        ? 'bg-danger-subtle text-danger'
                                        : 'bg-warning-subtle text-warning') }}">
                                    {{ strtoupper($order->status) }}
                                </span>
                                <h2 class="fw-bold text-primary mb-1">
                                    {{ $order->service->name }}
                                </h2>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ \Carbon\Carbon::parse($order->service_schedule)->isoFormat('dddd, D MMMM Y, HH:mm') }}
                                    WIB
                                </p>
                            </div>
                            {{-- Icon Besar Transparan di Kanan --}}
                            <div class="d-none d-md-block opacity-10">
                                <i class="bi bi-heart-pulse-fill text-primary" style="font-size: 5rem;"></i>
                            </div>
                        </div>

                        {{-- Progress Tracker Sederhana --}}
                        @if ($order->status != 'Dibatalkan')
                            <div class="mt-4 pt-3 border-top">
                                <div class="progress" style="height: 6px;">
                                    @php
                                        $width = match ($order->status) {
                                            'Menunggu Konfirmasi' => '25%',
                                            'Diproses' => '50%',
                                            'Selesai' => '100%',
                                            default => '0%',
                                        };
                                    @endphp
                                    <div class="progress-bar bg-primary rounded-pill" role="progressbar"
                                        style="width: {{ $width }}"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 text-muted small fw-bold">
                                    <span>Order Dibuat</span>
                                    <span>Diproses</span>
                                    <span>Selesai</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row g-4">
                    {{-- 3. KOLOM KIRI: INFO DETAIL --}}
                    <div class="col-md-7">

                        {{-- Card Lokasi --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-body p-4">
                                <h6 class="text-uppercase text-muted fw-bold small mb-3">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i> Lokasi Kunjungan
                                </h6>
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <i class="bi bi-house text-dark"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="fw-bold mb-1">{{ Auth::user()->name }}</h6>
                                        <p class="text-muted small mb-0 lh-sm">{{ $order->address }}</p>
                                        @if ($order->distance)
                                            <span class="badge bg-light text-dark border mt-2">Jarak: {{ $order->distance }}
                                                km</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card Catatan --}}
                        @if ($order->notes)
                            <div class="card border-0 shadow-sm rounded-4 mb-4 bg-primary-subtle">
                                <div class="card-body p-4">
                                    <h6 class="text-uppercase text-primary fw-bold small mb-2">
                                        <i class="bi bi-journal-text me-1"></i> Catatan Pasien
                                    </h6>
                                    <p class="mb-0 text-dark opacity-75 fst-italic">"{{ $order->notes }}"</p>
                                </div>
                            </div>
                        @endif

                        {{-- Card Ulasan (Jika Ada) --}}
                        @if ($order->review)
                            <div class="card border-0 shadow-sm rounded-4 mb-4">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold mb-3">Ulasan Anda</h6>
                                    <div class="p-3 bg-light rounded-3">
                                        <div class="text-warning mb-2">
                                            @for ($i = 0; $i < $order->review->rating; $i++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                        <p class="mb-0 small text-muted">
                                            {{ $order->review->comment ?? 'Tidak ada komentar tertulis.' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                    {{-- 4. KOLOM KANAN: RINCIAN BIAYA (STICKY) --}}
                    <div class="col-md-5">
                        <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top: 100px;">
                            <div class="card-body p-4">
                                <h6 class="text-uppercase text-muted fw-bold small mb-4">Rincian Pembayaran</h6>

                                <ul class="list-group list-group-flush mb-4">
                                    <li
                                        class="list-group-item px-0 d-flex justify-content-between align-items-center border-bottom-0 py-1">
                                        <span class="text-muted small">Layanan Medis</span>
                                        <span class="fw-medium">Rp
                                            {{ number_format($order->base_price, 0, ',', '.') }}</span>
                                    </li>
                                    <li
                                        class="list-group-item px-0 d-flex justify-content-between align-items-center border-bottom-0 py-1">
                                        <span class="text-muted small">Transportasi</span>
                                        <span class="fw-medium">Rp
                                            {{ number_format($order->transport_cost, 0, ',', '.') }}</span>
                                    </li>
                                    @if ($order->discount_amount > 0)
                                        <li
                                            class="list-group-item px-0 d-flex justify-content-between align-items-center border-bottom-0 py-1 text-success">
                                            <span class="small"><i class="bi bi-tag-fill me-1"></i> Diskon</span>
                                            <span class="fw-bold">- Rp
                                                {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                                        </li>
                                    @endif
                                    <li
                                        class="list-group-item px-0 d-flex justify-content-between align-items-center border-top mt-2 pt-3">
                                        <span class="fw-bold text-dark">Total Tagihan</span>
                                        <span class="fw-bold text-primary fs-5">Rp
                                            {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    </li>
                                </ul>

                                {{-- ACTION BUTTONS --}}
                                <div class="d-grid gap-2">
                                    {{-- Tombol Invoice (Hanya jika status valid) --}}
                                    @if (in_array($order->status, ['Diproses', 'Selesai', 'Lunas']))
                                        <a href="{{ route('invoice.download', $order) }}" target="_blank"
                                            class="btn btn-primary py-2 rounded-pill fw-bold">
                                            <i class="bi bi-file-earmark-pdf-fill me-2"></i> Download Invoice
                                        </a>
                                    @endif

                                    {{-- Tombol WA --}}
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', settings('contact_phone', '62812345678')) }}?text=Halo%20Admin,%20mohon%20info%20pesanan%20{{ $order->id }}"
                                        target="_blank" class="btn btn-outline-success py-2 rounded-pill fw-bold">
                                        <i class="bi bi-whatsapp me-2"></i> Chat Admin
                                    </a>
                                </div>

                                <div class="text-center mt-3">
                                    <small class="text-muted" style="font-size: 10px;">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Butuh bantuan? Hubungi kami 24/7
                                    </small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- CSS Tambahan Khusus Halaman Ini --}}
    <style>
        .bg-primary-subtle {
            background-color: #cfe2ff;
        }

        .bg-success-subtle {
            background-color: #d1e7dd;
        }

        .bg-warning-subtle {
            background-color: #fff3cd;
        }

        .bg-danger-subtle {
            background-color: #f8d7da;
        }

        /* Sentuhan modern pada border */
        .card {
            border: 1px solid rgba(0, 0, 0, 0.03) !important;
        }

        /* Tombol Back yang responsive */
        .btn-light {
            background: #fff;
            border: 1px solid #eee;
            transition: all 0.2s;
        }

        .btn-light:hover {
            transform: translateX(-3px);
            background: #f8f9fa;
        }
    </style>
@endsection
