@extends('layouts.template')

@section('title', 'Riwayat Pesanan Saya')

@section('content')
    <main class="main" style="padding-top: 100px; padding-bottom: 60px; background-color: #f8f9fa; min-height: 100vh;">
        <div class="container-boxed">

            <div class="section-title text-center mb-5" data-aos="fade-up">
                <h2>Riwayat Pesanan</h2>
                <p>Pantau status pemesanan layanan kesehatan Anda di sini.</p>
            </div>

            @if ($orders->isEmpty())
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
                    @foreach ($orders as $order)
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden card-hover-effect">

                                {{-- Header Card: Status & Tanggal --}}
                                <div
                                    class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-start">
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
                                        $statusColor = match ($order->payment_status) {
                                            'Belum Lunas' => 'danger',
                                            'Lunas' => 'success',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span
                                        class="badge bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }} px-3 py-2 rounded-pill">
                                        {{ $order->payment_status }}
                                    </span>
                                </div>

                                {{-- Body Card: Info Layanan --}}
                                <div class="card-body px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        {{-- Gambar Layanan --}}
                                        @php
                                            $img =
                                                $order->service->gallery && count($order->service->gallery) > 0
                                                    ? $order->service->gallery[0]
                                                    : $order->service->image;
                                        @endphp
                                        <img src="{{ Storage::url($img) }}" class="rounded-3 object-fit-cover"
                                            width="60" height="60" alt="{{ $order->service->name }}">

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
                                            <span
                                                class="fw-medium">{{ date('d M Y', strtotime($order->service_schedule)) }}</span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Status Order</small>
                                            <span
                                                class="fw-medium {{ $order->status == 'Selesai' ? 'text-success' : 'text-warning' }}">
                                                {{ $order->status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Footer Card: Tombol Aksi --}}
                                <div class="card-footer bg-white border-top-0 px-4 pb-4 pt-0">
                                    <div class="d-grid gap-2">

                                        <a href="{{ route('my-orders.show', $order) }}"
                                            class="btn btn-outline-primary rounded-pill btn-sm fw-bold shadow-sm">
                                            <i class="bi bi-eye-fill me-1"></i> Lihat Detail & Invoice
                                        </a>

                                        {{-- LOGIKA TOMBOL REVIEW --}}
                                        @if ($order->status == 'Selesai' && !$order->review)
                                            {{-- Tombol Beri Ulasan (Muncul Jika Selesai & Belum Direview) --}}
                                            <button type="button"
                                                class="btn text-white rounded-pill btn-sm fw-bold shadow-sm btn-arsha"
                                                data-bs-toggle="modal" data-bs-target="#reviewModal-{{ $order->id }}">
                                                <i class="bi bi-star-fill me-1 text-warning"></i> Beri Ulasan
                                            </button>
                                        @elseif($order->review)
                                            <button type="button" class="btn btn-light rounded-pill btn-sm fw-bold border"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editReviewModal-{{ $order->id }}">
                                                <span class="text-warning">
                                                    @for ($i = 0; $i < $order->review->rating; $i++)
                                                        <i class="bi bi-star-fill"></i>
                                                    @endfor
                                                </span>
                                                <small class="ms-1 text-muted">(Edit Ulasan)</small>
                                            </button>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    @push('modals')
        @if (!$orders->isEmpty())
            @foreach ($orders as $order)
                @if ($order->status == 'Selesai' && !$order->review)
                    <div class="modal fade" id="reviewModal-{{ $order->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">

                                {{-- Header --}}
                                <div class="modal-header border-0 text-white"
                                    style="background-color: var(--heading-color); border-radius: 20px 20px 0 0;">
                                    <h5 class="modal-title fw-bold text-white">
                                        <i class="bi bi-star-fill me-2" style="color: #ffc107;"></i> Ulas Layanan
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                {{-- Form --}}
                                <form action="{{ route('reviews.store', $order) }}" method="POST">
                                    @csrf
                                    <div class="modal-body p-4 text-center">
                                        <h5 class="fw-bold mb-1" style="color: var(--heading-color);">
                                            {{ $order->service->name }}</h5>
                                        <p class="text-muted small mb-4">Bagaimana pengalaman Anda?</p>

                                        {{-- Rating --}}
                                        <div class="rating-css mb-4">
                                            <div class="star-icon">
                                                <input type="radio" name="rating" value="5"
                                                    id="rating5-{{ $order->id }}" checked>
                                                <label for="rating5-{{ $order->id }}" class="bi bi-star-fill"></label>
                                                <input type="radio" name="rating" value="4"
                                                    id="rating4-{{ $order->id }}">
                                                <label for="rating4-{{ $order->id }}" class="bi bi-star-fill"></label>
                                                <input type="radio" name="rating" value="3"
                                                    id="rating3-{{ $order->id }}">
                                                <label for="rating3-{{ $order->id }}" class="bi bi-star-fill"></label>
                                                <input type="radio" name="rating" value="2"
                                                    id="rating2-{{ $order->id }}">
                                                <label for="rating2-{{ $order->id }}" class="bi bi-star-fill"></label>
                                                <input type="radio" name="rating" value="1"
                                                    id="rating1-{{ $order->id }}">
                                                <label for="rating1-{{ $order->id }}" class="bi bi-star-fill"></label>
                                            </div>
                                        </div>

                                        {{-- Comment --}}
                                        <div class="form-group text-start">
                                            <textarea name="comment" class="form-control bg-light border-0" rows="3"
                                                placeholder="Tulis ulasan Anda disini..." style="border-radius: 10px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 justify-content-center pb-4 pt-0">
                                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit"
                                            class="btn text-white rounded-pill px-5 fw-bold shadow-sm btn-arsha">Kirim
                                            Ulasan</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    @endpush

    @push('modals')
        @foreach ($orders as $order)
            @if ($order->review)
                <div class="modal fade" id="editReviewModal-{{ $order->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">

                            {{-- Header --}}
                            <div class="modal-header border-0 text-white"
                                style="background-color: var(--heading-color); border-radius: 20px 20px 0 0;">
                                <h5 class="modal-title fw-bold text-white">
                                    <i class="bi bi-pencil-square me-2 text-warning"></i> Edit Ulasan
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>

                            {{-- FORM UPDATE --}}
                            <form method="POST" action="{{ route('reviews.update', $order) }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-body p-4 text-center">
                                    <h5 class="fw-bold mb-1">{{ $order->service->name }}</h5>
                                    <p class="text-muted small mb-4">Perbarui pengalaman Anda</p>

                                    {{-- RATING --}}
                                    <div class="rating-css mb-4">
                                        <div class="star-icon">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" name="rating" value="{{ $i }}"
                                                    id="edit-rating-{{ $order->id }}-{{ $i }}"
                                                    {{ $order->review->rating == $i ? 'checked' : '' }}>
                                                <label for="edit-rating-{{ $order->id }}-{{ $i }}"
                                                    class="bi bi-star-fill"></label>
                                            @endfor
                                        </div>
                                    </div>

                                    {{-- COMMENT --}}
                                    <textarea name="comment" class="form-control bg-light border-0" rows="3" style="border-radius: 10px;"
                                        placeholder="Tulis ulasan Anda...">{{ $order->review->comment }}</textarea>
                                </div>

                                <div class="modal-footer border-0 justify-content-center pb-4 pt-0">
                                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold"
                                        data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold btn-arsha">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endpush


    <style>      
        /* CSS Tambahan Khusus Halaman Ini */
        .font-small {
            font-size: 0.9rem;
        }

        .card-hover-effect {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
        }

        .rating-css div {
            color: #ffc107;
            font-size: 10px;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
        }

        .rating-css input {
            display: none;
        }

        .rating-css input+label {
            font-size: 35px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            color: #e4e4e4;
            transition: 0.2s all;
        }

        /* Saat dipilih, warnanya jadi kuning */
        .rating-css input:checked+label~label,
        .rating-css input:checked+label {
            color: #ffc107;
        }

        .rating-css label:active {
            transform: scale(0.8);
        }

        /* Reverse Flex biar CSS '~' selector jalan dari kanan ke kiri */
        .star-icon {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            gap: 8px;
        }

        .btn-arsha {
            background-color: var(--heading-color);
            border: none;
            transition: 0.3s;
        }

        .btn-arsha:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
        }

        .font-small {
            font-size: 0.9rem;
        }

        .card-hover-effect {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
        }
    </style>
@endsection
