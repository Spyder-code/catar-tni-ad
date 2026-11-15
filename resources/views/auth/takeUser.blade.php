@extends('layouts.app')

@section('title', 'Verifikasi Akun Calon - Penerimaan TNI AD')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.0/flatpickr.min.css">
<style>
    .calon-table {
        margin-bottom: 0;
        color: #e2e8f0;
    }
    .calon-table th {
        background: rgba(20, 50, 32, 0.7);
        color: var(--tni-gold-light);
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        border-bottom: 2px solid rgba(197, 155, 39, 0.35);
        padding: 0.85rem 1rem;
    }
    .calon-table td {
        padding: 0.95rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        background: transparent;
        color: #f1f5f9;
    }
    .calon-table tbody tr:hover td {
        background: rgba(255, 255, 255, 0.04);
    }
    .calon-mobile-card {
        background: rgba(20, 50, 32, 0.5);
        border: 1px solid rgba(197, 155, 39, 0.25);
        border-radius: 14px;
        padding: 1rem;
        margin-bottom: 0.85rem;
        transition: all 0.2s ease;
    }
    .calon-mobile-card:hover {
        background: rgba(20, 50, 32, 0.75);
        border-color: var(--tni-gold);
    }
</style>
@endsection

@section('content')
<div class="container py-2 py-lg-4">
    <div class="row align-items-center justify-content-center g-4 g-lg-5">
        <!-- Left Hero Column -->
        <div class="col-lg-5 text-center text-lg-start">
            <div class="d-inline-block text-center mb-3 mb-lg-4">
                <img src="{{ asset('images/tni-logo.png') }}" alt="Lambang TNI AD" class="auth-hero-crest mb-2 mb-lg-3">
                <div class="portal-badge">
                    <i class="fas fa-user-check text-warning"></i>
                    <span>Verifikasi Identitas</span>
                </div>
            </div>
            <h1 class="display-6 fw-bold gold-gradient-text mb-2">
                Pilih Akun Calon
            </h1>
            <p class="text-light opacity-90 mb-3 mb-lg-4" style="max-width: 480px; font-size: 0.98rem;">
                Ditemukan data calon prajurit yang cocok dengan Nomor Animo Anda. Silakan pilih akun dan verifikasi tanggal lahir Anda untuk masuk.
            </p>
            <div class="d-none d-lg-block">
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm py-2 px-3" style="border-radius: 10px;">
                    <i class="fas fa-arrow-left me-1"></i> Ganti Nomor Animo
                </a>
            </div>
        </div>

        <!-- Right Card Column -->
        <div class="col-lg-7">
            <div class="portal-card p-3 p-sm-4 p-md-5">
                <div class="d-flex align-items-center justify-content-between mb-3 mb-md-4 pb-3 border-bottom border-secondary border-opacity-50">
                    <div>
                        <span class="portal-badge portal-badge-green mb-1">
                            <i class="fas fa-list-check"></i> Hasil Pencarian
                        </span>
                        <h2 class="h5 h4-md fw-bold text-white mb-0 mt-1">Daftar Calon Peserta</h2>
                    </div>
                    <span class="badge bg-success bg-opacity-75 px-3 py-2 small">
                        {{ count($data) }} Ditemukan
                    </span>
                </div>

                @if ($message = Session::get('danger'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 d-flex align-items-center gap-2 mb-3" role="alert">
                        <i class="fas fa-exclamation-circle fa-lg"></i>
                        <div class="small fw-semibold flex-grow-1">{{ $message }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Desktop Table View (>= 768px) -->
                <div class="d-none d-md-block table-responsive rounded-3 overflow-hidden border border-secondary border-opacity-50 mb-3">
                    <table class="table calon-table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 50px;">#</th>
                                <th scope="col">No Animo</th>
                                <th scope="col">Nama Calon</th>
                                <th scope="col" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-muted fw-bold">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-dark border border-secondary px-2 py-1 font-monospace" style="letter-spacing: 0.5px;">
                                            {{ $item->no_animo }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-white">{{ $item->nama }}</div>
                                        <div class="small text-muted">Calon Prajurit TNI AD</div>
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-portal-primary btn-sm py-2 px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $item->id }}">
                                            <span>Verifikasi & Masuk</span>
                                            <i class="fas fa-arrow-right ms-1"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View (< 768px) -->
                <div class="d-block d-md-none mb-3">
                    @foreach ($data as $item)
                        <div class="calon-mobile-card">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-success bg-opacity-25 p-2 text-warning">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white" style="font-size: 1.05rem;">{{ $item->nama }}</div>
                                        <div class="small text-muted">Pendaftar #{{ $loop->iteration }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span class="badge bg-dark border border-secondary px-2 py-1 font-monospace text-warning">
                                    <i class="fas fa-id-card me-1"></i> {{ $item->no_animo }}
                                </span>
                            </div>
                            <button type="button" class="btn btn-portal-primary w-100 py-2"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal-{{ $item->id }}">
                                <i class="fas fa-calendar-check me-1"></i>
                                <span>Verifikasi Tanggal Lahir</span>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="d-block d-lg-none text-center mt-3 pt-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm w-100 py-2">
                        <i class="fas fa-arrow-left me-1"></i> Ganti Nomor Animo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals Placed at Root Level (Outside card & table to prevent stacking/backdrop blocking clicks) -->
@foreach ($data as $item)
    <div class="modal fade" id="exampleModal-{{ $item->id }}"
        aria-labelledby="exampleModal-{{ $item->id }}Label" aria-hidden="true">
        <form action="{{ route('login.calon') }}" method="POST" class="modal-dialog modal-dialog-centered text-start">
            @csrf
            <input type="hidden" name="no_animo" value="{{ $item->no_animo }}">
            <div class="modal-content modal-content-portal">
                <div class="modal-header">
                    <div class="d-flex align-items-center gap-2">
                        <div class="text-warning">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h5 class="modal-title fw-bold text-white mb-0" id="exampleModal-{{ $item->id }}Label">
                            Konfirmasi Tanggal Lahir
                        </h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 p-sm-4">
                    <div class="portal-info-box mb-3">
                        <div class="d-flex gap-2">
                            <i class="fas fa-shield-alt text-warning mt-1"></i>
                            <div class="small">
                                Silakan masukkan tanggal lahir <strong>{{ $item->nama }}</strong> sesuai data ijazah/akta kelahiran untuk autentikasi keamanan.
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="tgl_lahir-{{ $item->id }}" class="portal-label">
                            <i class="fas fa-calendar-alt"></i> Tanggal Lahir Calon
                        </label>
                        <input id="tgl_lahir-{{ $item->id }}" type="date"
                            class="form-control form-control-portal tgl_lahir @error('tgl_lahir') is-invalid @enderror"
                            name="tgl_lahir"
                            placeholder="Pilih Tanggal Lahir"
                            @if (optional($setting)->tertua) min="{{ $setting->tertua }}" @endif
                            @if (optional($setting)->termuda) max="{{ $setting->termuda }}" @endif
                            required autocomplete="off">
                        @error('tgl_lahir')
                            <span class="invalid-feedback d-block mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light btn-sm px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-portal-primary btn-sm px-4">
                        <i class="fas fa-check-circle me-1"></i> Buka Portal Peserta
                    </button>
                </div>
            </div>
        </form>
    </div>
@endforeach
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.0/flatpickr.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tertua = @json(optional($setting)->tertua);
        var termuda = @json(optional($setting)->termuda);

        flatpickr('.tgl_lahir', {
            dateFormat: 'Y-m-d',
            altFormat: 'd F Y',
            altInput: true,
            minDate: tertua || null,
            maxDate: termuda || null,
            allowInput: true,
            disableMobile: false
        });
    });
</script>
@endsection
