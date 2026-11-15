@extends('layouts.app')

@section('title', 'Masuk Portal Administrator - Penerimaan TNI AD')

@section('content')
<div class="container py-2 py-lg-4">
    <div class="row align-items-center justify-content-center g-4 g-lg-5">
        <!-- Left Hero Column -->
        <div class="col-lg-6 text-center text-lg-start">
            <div class="d-inline-block text-center mb-4">
                <img src="{{ asset('images/tni-logo.png') }}" alt="Lambang TNI AD" class="auth-hero-crest mb-3">
                <div class="portal-badge">
                    <i class="fas fa-shield-alt text-warning"></i>
                    <span>Sistem Administrasi Terpadu</span>
                </div>
            </div>
            <h1 class="display-6 fw-bold gold-gradient-text mb-2">
                Portal Panitia Seleksi
            </h1>
            <p class="text-light opacity-90 mb-4" style="max-width: 520px; font-size: 1.05rem;">
                Akses terotorisasi untuk Panitia Pusat, Panitia Daerah Ajendam, dan Ajenrem dalam pengelolaan data pokok serta verifikasi administrasi calon prajurit TNI AD.
            </p>
            <div class="d-none d-lg-flex flex-column gap-2 text-muted small">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-shield-virus text-warning"></i>
                    <span>Verifikasi Berkas Calon & Validasi Nilai Seleksi</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-history text-warning"></i>
                    <span>Pencatatan Audit Trail & Riwayat Aktivitas Administrator</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-lock text-warning"></i>
                    <span>Keamanan Akses Tingkat Militer Terenkripsi</span>
                </div>
            </div>
        </div>

        <!-- Right Form Column -->
        <div class="col-lg-6 col-xl-5">
            <div class="portal-card p-3 p-sm-4 p-md-5">
                <div class="text-center mb-4">
                    <span class="portal-badge mb-2">
                        <i class="fas fa-user-shield"></i> Akses Petugas / Panitia
                    </span>
                    <h2 class="h3 fw-bold text-white mb-1">Login Admin</h2>
                    <p class="text-muted small mb-0">Masukkan Username & Kata Sandi Kedinasan</p>
                </div>

                @if ($message = Session::get('danger'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 d-flex align-items-center gap-2" role="alert">
                        <i class="fas fa-exclamation-circle fa-lg"></i>
                        <div class="small fw-semibold flex-grow-1">{{ $message }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="portal-label">
                            <i class="fas fa-user-circle"></i> Username atau Email
                        </label>
                        <input id="username" type="text"
                            class="form-control form-control-portal @error('username') is-invalid @enderror"
                            name="username"
                            value="{{ old('username') }}"
                            placeholder="Masukkan username atau email"
                            required autocomplete="username" autofocus>
                        @error('username')
                            <div class="text-danger small mt-1 d-flex align-items-center gap-1">
                                <i class="fas fa-info-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="portal-label">
                            <i class="fas fa-lock"></i> Kata Sandi
                        </label>
                        <input id="password" type="password"
                            class="form-control form-control-portal @error('password') is-invalid @enderror"
                            name="password"
                            placeholder="Masukkan kata sandi"
                            required autocomplete="current-password">
                        @error('password')
                            <div class="text-danger small mt-1 d-flex align-items-center gap-1">
                                <i class="fas fa-info-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-portal-secondary py-3 w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        <span>Autentikasi Administrator</span>
                    </button>
                </form>

                <div class="portal-info-box mt-4">
                    <div class="d-flex gap-2">
                        <i class="fas fa-shield-alt text-warning mt-1"></i>
                        <div class="small">
                            Aktivitas login dan manajemen data tercatat dalam sistem audit log secara otomatis.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
