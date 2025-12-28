@extends('layouts.template')

@section('title', 'Profil Saya')

@section('content')
    <style>
        /* CUSTOM CSS BIAR TOMBOL MENGIKUTI TEMA ARSHA */
        .btn-theme {
            background-color: var(--accent-color);
            border: 1px solid var(--accent-color);
            color: #ffffff;
            transition: 0.3s;
        }

        .btn-theme:hover {
            background-color: var(--nav-hover-color);
            /* Warna hover bawaan Arsha */
            border-color: var(--nav-hover-color);
            color: #ffffff;
        }

        .btn-outline-theme {
            color: var(--accent-color);
            border: 1px solid var(--accent-color);
            background: transparent;
            transition: 0.3s;
        }

        .btn-outline-theme:hover {
            background-color: var(--accent-color);
            color: #ffffff;
        }

        .dropdown-menu-modern {
            border: none;
            border-radius: 12px;
            /* Sudut lebih bulat */
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            /* Bayangan halus */
            padding: 8px;
            margin-top: 10px !important;
            /* Jarak dikit dari tombol */
        }

        .dropdown-item-modern {
            border-radius: 8px;
            /* Item menu juga rounded */
            padding: 10px 15px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            color: #555;
        }

        /* Hover Effect: Abu-abu tipis + Teks warna tema */
        .dropdown-item-modern:hover,
        .dropdown-item-modern:focus {
            background-color: #f8f9fa;
            /* Abu-abu sangat muda */
            color: var(--accent-color);
        }

        /* Matikan background biru bawaan Bootstrap pas diklik */
        .dropdown-item-modern:active {
            background-color: #f8f9fa;
            color: var(--accent-color);
        }

        /* Khusus tombol hapus (Merah soft pas hover) */
        .dropdown-item-modern.text-danger:hover,
        .dropdown-item-modern.text-danger:focus,
        .dropdown-item-modern.text-danger:active {
            background-color: #fff5f5;
            /* Merah muda banget */
            color: #dc3545 !important;
        }

        /* Tombol Edit Profil (Pensil) */
        .btn-edit-profile {
            width: 38px;
            height: 38px;
            background: white;
            border: 1px solid #d5d4d4;
            color: #555;
            transition: 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-edit-profile:hover {
            background: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
            transform: scale(1.05);
            /* Efek zoom dikit */
        }

        html {
            scrollbar-gutter: stable;
        }

        body.modal-open {
            padding-right: 0 !important;
        }

        /* .modal,
                            .modal-backdrop {
                                zoom: 1.112 !important;
                            } */

        /* .modal-dialog {
                                zoom: 0.9 !important;
                                display: flex;
                                align-items: center;
                                min-height: calc(100% - 3.5rem);
                            } */

        /* Memaksa Modal tampil paling depan (Z-Index Perang) */
        .modal-backdrop {
            z-index: 2000 !important;
        }

        .modal {
            z-index: 2050 !important;
        }
    </style>

    <section class="section_gap mt5">
        <main class="main">

            <div class="page-title" data-aos="fade">
                <div class="container-boxed">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="current">Profil Saya</li>
                        </ol>
                    </nav>
                    <h1>Pengaturan Akun</h1>
                </div>
            </div>

            <section class="section profile-section" style="min-height: 80vh;">
                <div class="container-boxed" data-aos="fade-up" data-aos-delay="100">

                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                        id="profile-form">
                        @csrf
                        @method('patch')

                        <div class="row gy-4">
                            {{-- KOLOM KIRI: FOTO & MENU --}}
                            <div class="col-lg-4">
                                <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">

                                    <div class="card-header border-0 text-center pt-4 pb-0" style="background: white;">
                                        <div class="position-relative d-inline-block">

                                            {{-- AREA FOTO PROFIL --}}
                                            <div class="rounded-circle overflow-hidden d-flex align-items-center justify-content-center shadow-sm"
                                                style="width: 120px; height: 120px; background: var(--accent-color);">

                                                <img id="avatar-preview"
                                                    src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : '#' }}"
                                                    alt="Avatar"
                                                    class="{{ Auth::user()->avatar ? 'd-block' : 'd-none' }} w-100 h-100"
                                                    style="object-fit: cover;">

                                                <div id="avatar-initials"
                                                    class="{{ Auth::user()->avatar ? 'd-none' : 'd-flex' }} align-items-center justify-content-center text-white fw-bold"
                                                    style="font-size: 48px; width: 100%; height: 100%;">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                                </div>
                                            </div>

                                            {{-- TOMBOL EDIT (PENSIL) --}}
                                            <div class="position-absolute bottom-0 end-0">
                                                <button
                                                    class="btn btn-edit-profile rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-pencil-fill fs-6"></i>
                                                </button>

                                                {{-- DROPDOWN MODERN --}}
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-modern">
                                                    {{-- 1. Upload Foto --}}
                                                    <li>
                                                        <label for="avatar_input"
                                                            class="dropdown-item dropdown-item-modern d-flex align-items-center"
                                                            style="cursor: pointer;">
                                                            <i class="bi bi-camera me-2"></i> Ganti Foto
                                                        </label>
                                                    </li>

                                                    {{-- 2. Hapus Foto --}}
                                                    <li id="li-delete-avatar"
                                                        class="{{ Auth::user()->avatar ? '' : 'd-none' }}">
                                                        <div class="dropdown-divider my-1"></div>
                                                        <button type="button"
                                                            class="dropdown-item dropdown-item-modern text-danger d-flex align-items-center"
                                                            onclick="removeAvatar()">
                                                            <i class="bi bi-trash3 me-2"></i> Hapus Foto
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>

                                            {{-- INPUT FILE & HIDDEN INPUT --}}
                                            <input type="file" id="avatar_input" name="avatar" class="d-none"
                                                accept="image/*" onchange="previewImage(event)">
                                            <input type="hidden" name="delete_avatar" id="delete_avatar_input"
                                                value="0">
                                        </div>
                                    </div>

                                    <div class="card-body text-center p-4 mt-3">
                                        <h4 class="fw-bold" style="color: var(--heading-color);">{{ Auth::user()->name }}
                                        </h4>
                                        <p class="text-muted small mb-4">{{ Auth::user()->email }}</p>

                                        <hr class="my-4" style="opacity: 0.1">

                                        <div class="d-grid gap-3">
                                            <a href="{{ route('my-orders.index') }}"
                                                class="btn btn-outline-theme rounded-pill py-2">
                                                <i class="bi bi-clock-history me-2"></i> Riwayat Pesanan
                                            </a>
                                            <button type="submit" form="logout-form"
                                                class="btn btn-danger rounded-pill py-2">
                                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- KOLOM KANAN: FORM EDIT --}}
                            <div class="col-lg-8">

                                {{-- 1. FORM INFO PRIBADI --}}
                                <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px; overflow: hidden;">
                                    <div class="card-header py-3 px-4"
                                        style="color: white; background: var(--accent-color);">
                                        <h5 class="m-0 fw-bold text-white"><i class="bi bi-person-lines-fill me-2"></i>
                                            Informasi Pribadi</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row gy-3">
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold text-uppercase text-muted">Nama
                                                    Lengkap</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name', $user->name) }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label
                                                    class="form-label small fw-bold text-uppercase text-muted">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ old('email', $user->email) }}" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label small fw-bold text-uppercase text-muted">No.
                                                    WhatsApp</label>
                                                <input type="number" name="phone_number" class="form-control"
                                                    value="{{ old('phone_number', $user->phone_number) }}"
                                                    placeholder="08...">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label small fw-bold text-uppercase text-muted">Alamat
                                                    Utama</label>
                                                <textarea name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
                                            </div>

                                            {{-- TOMBOL SIMPAN (GANTI JADI BTN-THEME) --}}
                                            <div class="col-12 text-end mt-2">
                                                <button type="submit" class="btn btn-theme rounded-pill px-4">
                                                    Simpan Perubahan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </form> {{-- TUTUP FORM UTAMA --}}

                    {{-- 2. FORM PASSWORD --}}
                    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header py-3 px-4" style="color: white; background: var(--accent-color);">
                            <h5 class="m-0 fw-bold text-white">
                                <i class="bi bi-shield-lock-fill me-2"></i>
                                {{ is_null($user->password) ? 'Buat Password Baru' : 'Ganti Password' }}
                            </h5>
                        </div>
                        <div class="card-body p-4">

                            @if (is_null($user->password))
                                <div class="alert alert-info d-flex align-items-center mb-3">
                                    <i class="bi bi-info-circle-fill me-2 fs-4"></i>
                                    <div>
                                        Anda login menggunakan <strong>Google</strong>. Silakan buat password baru jika
                                        ingin login manual.
                                    </div>
                                </div>
                            @endif

                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <div class="row gy-3">
                                    @if (!is_null($user->password))
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-uppercase text-muted">Password Saat
                                                Ini</label>
                                            <input type="password" name="current_password"
                                                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror">
                                            @error('current_password', 'updatePassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-uppercase text-muted">Password
                                            Baru</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password', 'updatePassword') is-invalid @enderror">
                                        @error('password', 'updatePassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-uppercase text-muted">Konfirmasi
                                            Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>

                                    <div
                                        class="col-12 d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">

                                        {{-- Lupa Password --}}
                                        @if (!is_null($user->password))
                                            @if (!is_null($user->password))
                                                <small class="text-muted">
                                                    <i class="bi bi-question-circle me-1"></i>Lupa password?
                                                    <strong>Logout</strong> lalu gunakan fitur <em>Lupa
                                                        Password</em> di halaman login.
                                                </small>
                                            @endif

                                        @endif

                                        {{-- Tombol Update --}}
                                        <button type="submit" class="btn btn-outline-theme rounded-pill px-4">
                                            {{ is_null($user->password) ? 'Simpan Password' : 'Update Password' }}
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- 3. HAPUS AKUN --}}
                    <div class="card border-0 shadow-sm mt-4" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header py-3 px-4 bg-danger text-white">
                            <h5 class="m-0 fw-bold"><i class="bi bi-exclamation-triangle-fill me-2"></i> Hapus Akun</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="alert alert-warning border-0 text-dark" style="background-color: #fff3cd;">
                                <small><strong>Peringatan:</strong> Tindakan ini permanen. Semua data riwayat pesanan dan
                                    profil akan hilang.</small>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-outline-danger rounded-pill px-4"
                                    data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
                                    Hapus Akun Saya
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                </div>


                </div>
            </section>
        </main>
    </section>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
        @csrf
    </form>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px;">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
                    @csrf
                    @method('delete')
                    <h4 class="fw-bold text-danger mb-3">Yakin ingin menghapus akun?</h4>
                    <p class="text-muted mb-4">Masukkan password untuk konfirmasi.</p>

                    @if (!is_null($user->password))
                        <div class="mb-3">
                            <input type="password" name="password"
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                placeholder="Masukkan Password Anda" required>

                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">Ya, Hapus Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imageField = document.getElementById("avatar-preview");
            const initialsField = document.getElementById("avatar-initials");
            const deleteLi = document.getElementById("li-delete-avatar");
            const deleteInput = document.getElementById("delete_avatar_input");

            reader.onload = function() {
                if (reader.readyState == 2) {
                    imageField.src = reader.result;
                    imageField.classList.remove("d-none");
                    imageField.classList.add("d-block");

                    if (initialsField) {
                        initialsField.classList.remove("d-flex");
                        initialsField.classList.add("d-none");
                    }

                    // Reset hapus & Munculkan menu hapus
                    deleteInput.value = "0";
                    deleteLi.classList.remove("d-none");
                }
            }
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        function removeAvatar() {
            const imageField = document.getElementById("avatar-preview");
            const initialsField = document.getElementById("avatar-initials");
            const deleteInput = document.getElementById("delete_avatar_input");
            const fileInput = document.getElementById("avatar_input");
            const deleteLi = document.getElementById("li-delete-avatar");

            // Sembunyikan gambar
            imageField.classList.remove("d-block");
            imageField.classList.add("d-none");
            imageField.src = "#";

            // Munculkan inisial
            if (initialsField) {
                initialsField.classList.remove("d-none");
                initialsField.classList.add("d-flex");
            }

            // Set input hidden jadi TRUE
            deleteInput.value = "1";
            fileInput.value = "";

            // Sembunyikan menu hapus
            deleteLi.classList.add("d-none");
        }
    </script>


    @if ($errors->userDeletion->any())
        <script>
            window.addEventListener('load', function() {
                const modalEl = document.getElementById('confirmUserDeletionModal');
                if (modalEl) {
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
                }
            });
        </script>
    @endif


    <script>
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('modal-backdrop')) {
                closeDeleteModal();
            }
        });
    </script>


@endsection
