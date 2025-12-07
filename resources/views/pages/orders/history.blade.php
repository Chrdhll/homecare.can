@extends('layouts.template')

@section('title', 'Riwayat Pesanan Saya')

@section('content')
<main class="main" style="padding-top: 100px; padding-bottom: 60px; background-color: #f8f9fa; min-height: 100vh;">
    <div class="container">
        
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Riwayat Pesanan</h2>
            <p>Pantau status pemesanan layanan kesehatan Anda di sini.</p>
        </div>

        @if($orders->isEmpty())
            {{-- TAMPILAN KOSONG (EMPTY STATE) --}}
            <div class="text-center py-5" data-aos="fade-up">
                <div class="mb-4">
                    <i class="bi bi-clipboard-x text-muted" style="font-size: 4rem;"></i>
                </div>
                <h4>Belum ada pesanan</h4>
                <p class="text-muted">Anda belum pernah memesan layanan apapun.</p>
                <a href="{{ route('home') }}#services" class="btn btn-primary rounded-pill px-4 mt-2">
                    Pesan Layanan Sekarang
                </a>
            </div>
        @else
            {{-- TAMPILAN GRID PESANAN --}}
            <div class="row gy-4">
                @foreach($orders as $order)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden card-hover-effect">
                            
                            {{-- Header Card: Status & Tanggal --}}
                            <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted small mb-1 text-uppercase fw-bold">
                                        #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                    </p>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar-event me-1"></i> 
                                        {{ date('d M Y, H:i', strtotime($order->created_at)) }}
                                    </small>
                                </div>
                                
                                {{-- Badge Status Pembayaran --}}
                                @php
                                    $statusColor = match($order->payment_status) {
                                        'Belum Lunas' => 'danger',
                                        'Lunas' => 'success',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }} px-3 py-2 rounded-pill">
                                    {{ $order->payment_status }}
                                </span>
                            </div>

                            {{-- Body Card: Info Layanan --}}
                            <div class="card-body px-4 py-3">
                                <div class="d-flex align-items-center">
                                    {{-- Gambar Layanan --}}
                                    @php
                                        $img = $order->service->gallery && count($order->service->gallery) > 0 
                                            ? $order->service->gallery[0] 
                                            : $order->service->image;
                                    @endphp
                                    <img src="{{ Storage::url($img) }}" 
                                         class="rounded-3 object-fit-cover" 
                                         width="60" height="60" 
                                         alt="{{ $order->service->name }}">
                                    
                                    <div class="ms-3">
                                        <h6 class="fw-bold mb-1 text-dark">{{ $order->service->name }}</h6>
                                        <p class="mb-0 text-primary fw-bold">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <hr class="border-light my-3">

                                {{-- Info Tambahan --}}
                                <div class="row g-2 font-small">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Jadwal</small>
                                        <span class="fw-medium">{{ date('d M Y', strtotime($order->service_schedule)) }}</span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Status Order</small>
                                        <span class="fw-medium {{ $order->status == 'Selesai' ? 'text-success' : 'text-warning' }}">
                                            {{ $order->status }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer Card: Tombol Aksi --}}
                            <div class="card-footer bg-white border-top-0 px-4 pb-4 pt-0">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', settings('contact_phone')) }}?text=Halo%20Admin,%20saya%20ingin%20tanya%20pesanan%20%23ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}" 
                                   target="_blank"
                                   class="btn btn-outline-primary w-100 rounded-pill btn-sm fw-bold">
                                    <i class="bi bi-whatsapp me-1"></i> Hubungi Homecare.can
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</main>

<style>
    /* CSS Tambahan Khusus Halaman Ini */
    .font-small { font-size: 0.9rem; }
    .card-hover-effect { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .card-hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
    }
</style>
@endsection