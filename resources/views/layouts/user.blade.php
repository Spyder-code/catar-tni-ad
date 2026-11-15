@extends('layouts.app')

@section('title', ($data->heading_1 ?? 'Informasi Pendaftaran') . ' - TNI AD')

@section('style')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<style>
    .announcement-box {
        background: rgba(14, 36, 23, 0.92);
        border: 1px solid var(--tni-card-border);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.45);
        color: #e2e8f0;
    }
    .announcement-body {
        font-size: 0.95rem;
        line-height: 1.65;
        color: #cbd5e1;
        max-height: 380px;
        overflow-y: auto;
        padding-right: 8px;
    }
    .announcement-body::-webkit-scrollbar {
        width: 6px;
    }
    .announcement-body::-webkit-scrollbar-thumb {
        background: rgba(197, 155, 39, 0.4);
        border-radius: 4px;
    }
    .announcement-body p {
        margin-bottom: 0.75rem;
    }
    .slider-badge-overlay {
        position: absolute;
        bottom: 15px;
        left: 20px;
        z-index: 10;
        background: rgba(8, 22, 14, 0.85);
        border: 1px solid rgba(197, 155, 39, 0.35);
        padding: 0.35rem 0.85rem;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: var(--tni-gold-light);
        backdrop-filter: blur(8px);
    }
</style>
@endsection

@section('content')
<div class="container py-2">
    <!-- Header Titles -->
    <div class="row justify-content-center text-center mb-4">
        <div class="col-lg-10">
            <div class="portal-badge mb-2">
                <i class="fas fa-info-circle text-warning"></i>
                <span>Informasi Resmi Penerimaan Prajurit TNI AD</span>
            </div>
            <h1 class="display-6 fw-bolder gold-gradient-text mb-1">
                {{ $data->heading_1 }}
            </h1>
            <h2 class="h4 text-light fw-semibold opacity-90">
                {{ $data->heading_2 }}
            </h2>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="row g-4 align-items-stretch">
        <!-- Swiper Carousel -->
        <div class="col-lg-8">
            <div class="swiper-container h-100 position-relative">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('images/t_1.jpg') }}" alt="Dokumentasi TNI AD 1" loading="lazy">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/t_5.jpg') }}" alt="Dokumentasi TNI AD 2" loading="lazy">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/t_6.jpg') }}" alt="Dokumentasi TNI AD 3" loading="lazy">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/t_8.jpg') }}" alt="Dokumentasi TNI AD 4" loading="lazy">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/t_10.jpg') }}" alt="Dokumentasi TNI AD 5" loading="lazy">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/t_13.jpg') }}" alt="Dokumentasi TNI AD 6" loading="lazy">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/t_20.jpg') }}" alt="Dokumentasi TNI AD 7" loading="lazy">
                    </div>
                </div>

                <!-- Overlay Badge -->
                <div class="slider-badge-overlay d-none d-sm-inline-flex align-items-center gap-1">
                    <i class="fas fa-camera text-warning"></i>
                    <span>DOKUMENTASI KEGIATAN PRAJURIT TNI AD</span>
                </div>

                <!-- Navigation -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        <!-- Announcement / Content Card -->
        <div class="col-lg-4">
            <div class="announcement-box h-100 d-flex flex-column justify-content-between p-3 p-sm-4 p-lg-4">
                <div>
                    <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom border-secondary">
                        <div class="d-flex align-items-center gap-2">
                            <div class="text-warning fs-5">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <span class="fw-bold text-white letter-spacing-1">Pengumuman & Petunjuk</span>
                        </div>
                        <span class="badge bg-success bg-opacity-75 small">Terbaru</span>
                    </div>

                    <div class="announcement-body">
                        {!! $data->content !!}
                    </div>
                </div>

                <div class="pt-4 border-top border-secondary mt-3">
                    @if (Auth::check())
                        <a href="{{ route('home') }}" class="btn-portal-secondary mb-2">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Buka Dashboard Admin</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-portal-primary mb-2">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Masuk Portal Calon</span>
                        </a>
                    @endif
                    <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm w-100 py-2" style="border-radius: 10px;">
                        <i class="fas fa-th-large me-1"></i> Pilih Jalur Pendaftaran
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            pagination: {
                el: '.swiper-pagination',
                dynamicBullets: true,
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
@endsection
