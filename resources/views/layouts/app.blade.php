<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <meta name="description" content="Portal Resmi Penerimaan dan Pendaftaran Calon Prajurit TNI Angkatan Darat">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title', 'PENDAFTARAN TNI AD - Portal Penerimaan Calon Prajurit')</title>
    @yield('style')
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg portal-navbar">
        <div class="container">
            <a class="portal-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/tni-logo.png') }}" alt="Lambang TNI AD" class="portal-brand-logo">
                <div class="portal-brand-title">
                    <span class="portal-brand-sub">Republik Indonesia &bull; TNI AD</span>
                    <span class="portal-brand-main">Pendaftaran Calon Prajurit</span>
                </div>
            </a>
            <button class="navbar-toggler portal-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#portalNav" aria-controls="portalNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="portalNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link portal-nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link portal-nav-link {{ request()->is('home*') ? 'active' : '' }}" href="{{ url('/home') }}">
                            <i class="fas fa-info-circle me-1"></i> Informasi Seleksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link portal-nav-link {{ (request()->is('login') || request()->is('pilih/akun*')) ? 'active' : '' }}" href="{{ route('login') }}">
                            <i class="fas fa-user-check me-1"></i> Masuk Calon
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1 py-4 py-md-5">
        @yield('content')
    </main>

    <!-- Official Portal Footer -->
    <footer class="portal-footer">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-5 col-md-6 text-center text-md-start">
                    <div class="footer-brand justify-content-center justify-content-md-start">
                        <img src="{{ asset('images/tni-logo.png') }}" alt="TNI AD" class="footer-logo">
                        <div>
                            <div class="footer-motto">Kartika Eka Paksi</div>
                            <div class="fw-bold text-white small">Pusat Penerimaan Prajurit TNI AD</div>
                        </div>
                    </div>
                    <p class="mb-0 text-muted small">
                        Sistem informasi dan verifikasi pendaftaran calon prajurit TNI Angkatan Darat berbasis data terintegrasi nasional.
                    </p>
                </div>
                <div class="col-lg-7 col-md-6 text-center text-md-end">
                    <div class="anti-fraud-banner mb-2">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>GRATIS! Penerimaan Prajurit TNI AD Tidak Dipungut Biaya Apapun.</span>
                    </div>
                    <div class="small text-muted mt-2">
                        &copy; {{ date('Y') }} Panitia Pusat Penerimaan Calon Prajurit TNI AD. Hak Cipta Dilindungi.
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
    @yield('script')
</body>
</html>
