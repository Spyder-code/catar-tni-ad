@extends('layouts.app')

@section('title', 'Masuk Portal Calon - Penerimaan TNI AD')

@section('content')
<div class="container py-2 py-lg-4">
    <div class="row align-items-center justify-content-center g-4 g-lg-5">
        <!-- Left Hero Column -->
        <div class="col-lg-6 text-center text-lg-start">
            <div class="d-inline-block text-center mb-4">
                <img src="{{ asset('images/tni-logo.png') }}" alt="Lambang TNI AD" class="auth-hero-crest mb-3">
                <div class="portal-badge">
                    <i class="fas fa-shield-alt text-warning"></i>
                    <span>TNI Angkatan Darat</span>
                </div>
            </div>
            <h1 class="display-6 fw-bold gold-gradient-text mb-2">
                Kartika Eka Paksi
            </h1>
            <p class="text-light opacity-90 mb-4" style="max-width: 520px; font-size: 1.05rem;">
                Portal resmi akses data calon prajurit TNI Angkatan Darat. Silakan verifikasi nomor animo pendaftaran Anda untuk memantau status administrasi dan nilai.
            </p>
            <div class="d-none d-lg-flex flex-column gap-2 text-muted small">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-check-circle text-success"></i>
                    <span>Sistem Terintegrasi Data Pokok & Kelengkapan Administrasi</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-check-circle text-success"></i>
                    <span>Transparan, Bebas Biaya, dan Akuntabel</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-check-circle text-success"></i>
                    <span>Dukungan Panitia Daerah Ajendam & Ajenrem Seluruh Indonesia</span>
                </div>
            </div>
        </div>

        <!-- Right Form Column -->
        <div class="col-lg-6 col-xl-5">
            <div class="portal-card p-3 p-sm-4 p-md-5">
                <div class="text-center mb-4">
                    <span class="portal-badge portal-badge-green mb-2">
                        <i class="fas fa-user-check"></i> Akses Calon Peserta
                    </span>
                    <h2 class="h3 fw-bold text-white mb-1">Masuk Portal</h2>
                    <p class="text-muted small mb-0">Masukkan Nomor Animo Pendaftaran Anda</p>
                </div>

                @if ($message = Session::get('danger'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 d-flex align-items-center gap-2" role="alert">
                        <i class="fas fa-exclamation-circle fa-lg"></i>
                        <div class="small fw-semibold flex-grow-1">{{ $message }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.takeUser') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="no_animo" class="portal-label">
                            <i class="fas fa-id-card"></i> Nomor Animo Pendaftaran
                        </label>
                        <div class="position-relative">
                            <input id="no_animo" type="text"
                                class="form-control form-control-portal @error('no_animo') is-invalid @enderror"
                                name="no_animo"
                                value="{{ old('no_animo') }}"
                                placeholder="Contoh: BA/00001/MOJOKERTO"
                                required autocomplete="off" autofocus>
                        </div>
                        @error('no_animo')
                            <div class="text-danger small mt-1 d-flex align-items-center gap-1">
                                <i class="fas fa-info-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <div class="form-text text-muted small mt-1">
                            Format sesuai tanda bukti pendaftaran dari Ajenrem.
                        </div>
                    </div>

                    <button type="submit" class="btn-portal-primary py-3 w-100">
                        <span>Lanjutkan Verifikasi</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="portal-info-box mt-4">
                    <div class="d-flex gap-2">
                        <i class="fas fa-info-circle text-warning mt-1"></i>
                        <div>
                            <strong class="text-white d-block mb-1">Belum Memiliki Nomor Animo?</strong>
                            Nomor Animo diperoleh setelah menyerahkan berkas persyaratan awal secara fisik ke panitia Ajenrem terdekat.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
