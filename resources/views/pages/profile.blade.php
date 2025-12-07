@extends('layouts.template')

@section('title', 'Profil Saya')

@section('content')
<main class="main">

    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Profil Saya</li>
                </ol>
            </nav>
            <h1>Pengaturan Akun</h1>
        </div>
    </div>

    <section class="section profile-section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            {{-- Alert Sukses Global --}}
            @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> Perubahan berhasil disimpan!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row gy-4">

                {{-- KOLOM KIRI: MENU & FOTO (Opsional, buat visual aja) --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-5">
                            <div class="mb-4">
                                <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center text-white fw-bold" 
                                     style="width: 100px; height: 100px; font-size: 40px;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </div>
                            <h4>{{ Auth::user()->name }}</h4>
                            <p class="text-muted small mb-4">{{ Auth::user()->email }}</p>
                            
                            <hr>
                            
                            <div class="text-start mt-4">
                                <p class="small text-muted fw-bold text-uppercase mb-2">Riwayat</p>
                                <a href="{{ route('orders.history') }}" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-clock-history me-2"></i> Lihat Riwayat Pesanan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: FORM UPDATE --}}
                <div class="col-lg-8">
                    
                    {{-- 1. FORM UPDATE INFO DASAR --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="m-0 fw-bold text-dark">Informasi Pribadi</h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="post" action="{{ route('profile.update') }}">
                                @csrf
                                @method('patch')

                                <div class="row gy-3">
                                    {{-- Nama --}}
                                    <div class="col-md-6">
                                        <label class="form-label small text-muted fw-bold">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name', $user->name) }}" required>
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <label class="form-label small text-muted fw-bold">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email', $user->email) }}" required>
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    {{-- No HP (Penting buat Order) --}}
                                    <div class="col-md-6">
                                        <label class="form-label small text-muted fw-bold">No. WhatsApp</label>
                                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" 
                                               value="{{ old('phone_number', $user->phone_number) }}" placeholder="0812..." required>
                                        @error('phone_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    {{-- Alamat Utama --}}
                                    <div class="col-12">
                                        <label class="form-label small text-muted fw-bold">Alamat Utama (Default)</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" 
                                                  placeholder="Alamat lengkap untuk memudahkan pemesanan...">{{ old('address', $user->address) }}</textarea>
                                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-12 text-end mt-3">
                                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- 2. FORM GANTI PASSWORD --}}
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="m-0 fw-bold text-dark">Ganti Password</h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <div class="row gy-3">
                                    <div class="col-12">
                                        <label class="form-label small text-muted fw-bold">Password Saat Ini</label>
                                        <input type="password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror">
                                        @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small text-muted fw-bold">Password Baru</label>
                                        <input type="password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror">
                                        @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small text-muted fw-bold">Konfirmasi Password Baru</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>

                                    <div class="col-12 text-end mt-3">
                                        <button type="submit" class="btn btn-secondary px-4">Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>
@endsection