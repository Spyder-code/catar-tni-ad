@extends('layouts.app')

@section('title', ($setting->lp_heading ?? 'Penerimaan Calon Prajurit TNI AD') . ' - Portal Pendaftaran')

@section('content')
<div class="container py-3">
    <!-- Hero Header -->
    <div class="row justify-content-center text-center mb-4 mb-md-5">
        <div class="col-lg-10 col-xl-8">
            <div class="portal-badge mb-3">
                <i class="fas fa-certificate text-warning"></i>
                <span>Pusat Penerimaan Calon Prajurit TNI AD</span>
            </div>
            <h1 class="display-6 fw-bolder gold-gradient-text mb-3">
                {{ $setting->lp_heading ?? 'Penerimaan Calon Prajurit TNI AD' }}
            </h1>
            <p class="lead text-light opacity-90 mx-auto" style="max-width: 680px; font-size: 1.05rem;">
                Silakan pilih kategori jalur pendaftaran calon prajurit yang sesuai dengan kualifikasi
            </p>
        </div>
    </div>

    <!-- Registration Selection Cards -->
    <div class="row g-4 justify-content-center mb-5">
        <!-- Jalur Reguler -->
        <div class="col-md-6 col-lg-5">
            <div class="select-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="select-icon-box">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <span class="portal-badge portal-badge-green">
                        <i class="fas fa-star text-warning"></i> Jalur Umum
                    </span>
                </div>
                <h2 class="select-card-title">
                    {{ $setting->lp_title_reguler ?? 'Pendaftaran Jalur Reguler' }}
                </h2>
                <div class="mt-auto">
                    <a href="https://daftar.ajenram82.my.id/home" class="btn-portal-primary">
                        <span>Daftar / Masuk</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Jalur Santri / Keagamaan -->
        <div class="col-md-6 col-lg-5">
            <div class="select-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="select-icon-box" style="color: #6ee7b7;">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <span class="portal-badge">
                        <i class="fas fa-award text-warning"></i> Keagamaan & Khusus
                    </span>
                </div>
                <h2 class="select-card-title">
                    {{ $setting->lp_title_santri ?? 'Pendaftaran Jalur Santri' }}
                </h2>
                <div class="mt-auto">
                    <a href="https://daftar1.ajenram82.my.id/home" class="btn-portal-secondary">
                        <span>Daftar / Masuk</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Info Cards -->
    <div class="row g-3 justify-content-center">
        <div class="col-md-4">
            <div class="portal-card p-3 p-lg-4 text-center h-100">
                <div class="text-warning mb-2" style="font-size: 1.8rem;">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h5 class="fw-bold text-white mb-2" style="font-size: 1rem;">100% Bebas Biaya</h5>
                <p class="text-muted small mb-0">
                    Seluruh tahapan seleksi calon prajurit tidak dipungut biaya apapun. Jangan percaya pada pihak yang menjanjikan kelulusan.
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="portal-card p-3 p-lg-4 text-center h-100">
                <div class="text-success mb-2" style="font-size: 1.8rem;">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h5 class="fw-bold text-white mb-2" style="font-size: 1rem;">Obyektif & Transparan</h5>
                <p class="text-muted small mb-0">
                    Hasil seleksi ditentukan murni oleh integritas, kesehatan fisik, mental, akademik, dan psikologi calon prajurit.
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="portal-card p-3 p-lg-4 text-center h-100">
                <div class="text-info mb-2" style="font-size: 1.8rem;">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h5 class="fw-bold text-white mb-2" style="font-size: 1rem;">Pusat Bantuan & Pengaduan</h5>
                <p class="text-muted small mb-0">
                    Informasi detail tata cara pendaftaran, validasi berkas, dan jadwal kegiatan dapat diakses pada menu Informasi Seleksi.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
