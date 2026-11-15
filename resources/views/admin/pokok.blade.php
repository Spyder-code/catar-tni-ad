@extends('layouts.admin')
@section('page', 'Data Pokok')
@section('style')
<style>
    .pokok-actions { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: .75rem; }
    .pokok-actions-group { display: flex; flex-wrap: wrap; gap: .5rem; }
    .pokok-actions-group .btn { margin: 0 !important; }
    .pokok-filters { display: grid; grid-template-columns: repeat(4, minmax(160px, 1fr)); gap: .75rem; }
    .pokok-filters label { display: block; font-size: .82rem; font-weight: 600; margin-bottom: .3rem; }
    .pokok-search { margin-bottom: .85rem; }
    .pokok-search label { display: block; font-size: .82rem; font-weight: 600; margin-bottom: .3rem; }
    .pokok-search input { max-width: 620px; }
    .pokok-filter-actions { display: flex; flex-wrap: wrap; align-items: end; gap: .5rem; margin-top: .75rem; }
    .pokok-table-shell { max-height: 68vh; overflow: auto; border: 1px solid #dce4ec; border-radius: .65rem; scrollbar-color: #a5b8cc #edf2f7; }
    .pokok-table { width: max-content; min-width: 100%; border-collapse: separate; border-spacing: 0; margin: 0; }
    .pokok-table th, .pokok-table td { white-space: nowrap; padding: .7rem .85rem; border-bottom: 1px solid #e8edf2; vertical-align: middle; }
    .pokok-table thead th { position: sticky; top: 0; z-index: 2; background: #edf3f8; color: #33465a; font-size: .8rem; box-shadow: 0 1px 0 #dce4ec; }
    .pokok-table tbody td { background: #fff; }
    .pokok-table .pokok-id { width: 65px; min-width: 65px; max-width: 65px; }
    .pokok-table .pokok-no-animo { width: 190px; min-width: 190px; max-width: 190px; }
    .pokok-table .pokok-no-online { width: 170px; min-width: 170px; max-width: 170px; }
    .pokok-table .pokok-nama { width: 250px; min-width: 250px; max-width: 250px; }
    .pokok-table .pokok-row-actions { display: flex; gap: .4rem; }
    .pokok-table .pokok-row-actions form { margin: 0; }
    .pokok-table-note { color: #66788a; font-size: .8rem; margin: .45rem 0 0; }
    .pokok-table tbody .pokok-no-animo,
    .pokok-table tbody .pokok-no-online,
    .pokok-table tbody .pokok-nama { overflow: hidden; text-overflow: ellipsis; }
    .pokok-table .pokok-aksi { position: sticky; right: 0; z-index: 1; width: 155px; min-width: 155px; background: #fff; box-shadow: -3px 0 5px #dce4ec; }
    .pokok-table thead .pokok-aksi { z-index: 3; background: #edf3f8; }
    .pokok-table thead th a { color: inherit; text-decoration: none; display: flex; align-items: center; justify-content: space-between; gap: .35rem; }
    .pokok-table thead th a:hover { color: #0284c7; }
    .pokok-table thead th a .sort-icon { font-size: .75rem; }
    @media (max-width: 900px) { .pokok-filters { grid-template-columns: repeat(2, minmax(140px, 1fr)); } }
    @media (max-width: 500px) { .pokok-filters { grid-template-columns: 1fr; } }
</style>
@endsection
@section('breadcrumb')
    @if (Auth::user()->isSuperadmin())
        <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Dashboard</a></li>
    @endif
    <li class="breadcrumb-item active">{{ Auth::user()->isSuperadmin() ? '/ ' : '' }}Data Pokok</li>
@endsection
@section('content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">{{ $message }}</div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div>
    @endif

    <div class="white-box mt-3">
        <div class="pokok-actions mb-3">
            <h3 class="box-title mb-0">Data Pokok</h3>
            @if (Auth::user()->isSuperadmin())
            <div class="pokok-actions-group">
                <form action="{{ route('pokok.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".xlsx,.xls,.csv" onchange="this.form.submit()" id="file" hidden>
                    <label for="file" class="btn btn-primary text-white mb-0"><i class="fas fa-upload"></i> Import Excel</label>
                </form>
                <a href="{{ route('pokok.export', array_filter($filters)) }}" class="btn btn-outline-success"><i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="{{ route('pokok.create') }}" class="btn btn-success text-white"><i class="fas fa-plus"></i> Tambah Data</a>
                <form action="{{ route('pokok.destroy') }}" method="post">
                    @csrf
                    <button type="submit" onclick="return confirm('Hapus semua data pokok?')" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Hapus Semua</button>
                </form>
            </div>
            @endif
        </div>

        <form method="get" action="{{ route('pokok') }}" class="mb-3">
            <div class="pokok-search">
                <label for="filter-q">Cari data pokok</label>
                <input type="search" name="q" id="filter-q" class="form-control"
                    value="{{ $filters['q'] ?? '' }}" maxlength="100"
                    placeholder="No Animo, nama, No Validasi, NIK, email, nomor telepon, sekolah…">
            </div>
            <div class="pokok-filters">
                <div>
                    <label for="filter-jenis">Jenis</label>
                    <select name="jenis" id="filter-jenis" class="form-control">
                        <option value="">Semua jenis</option>
                        <option value="CABA" @selected(($filters['jenis'] ?? '') === 'CABA')>CABA (No Animo BA)</option>
                        <option value="CATA" @selected(($filters['jenis'] ?? '') === 'CATA')>CATA (No Animo TA)</option>
                    </select>
                </div>
                @foreach (['jalur_pendaftaran' => 'Jalur Masuk', 'kdpanda' => 'Panda', 'kodim' => 'Kodim'] as $column => $label)
                    <div>
                        <label for="filter-{{ $column }}">{{ $label }}</label>
                        <select name="{{ $column }}" id="filter-{{ $column }}" class="form-control">
                            <option value="">Semua {{ $label }}</option>
                            @foreach ($options[$column] as $option)
                                <option value="{{ $option }}" @selected(($filters[$column] ?? '') === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
            <div class="pokok-filter-actions">
                <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                <a href="{{ route('pokok') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
            @if (!empty($sort))
                <input type="hidden" name="sort" value="{{ $sort }}">
                <input type="hidden" name="direction" value="{{ $direction }}">
            @endif
            @if (!empty($perPage))
                <input type="hidden" name="per_page" value="{{ $perPage }}">
            @endif
        </form>

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-2 gap-2">
            <p class="mb-0 text-muted">Menampilkan {{ $data->firstItem() ?? 0 }}–{{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} data.@if (Auth::user()->isSuperadmin()) Export mengikuti pencarian dan filter aktif.@endif</p>
            <div class="d-flex align-items-center gap-2">
                <label for="filter-per-page" class="mb-0 text-muted" style="font-size: .82rem; font-weight: 600; white-space: nowrap;">Tampilkan:</label>
                <select id="filter-per-page" class="form-control form-control-sm" style="width: auto; min-width: 95px;" onchange="window.location.href=this.value">
                    @foreach ([10, 25, 50, 100] as $limit)
                        <option value="{{ request()->fullUrlWithQuery(['per_page' => $limit, 'page' => 1]) }}" @selected($perPage == $limit)>{{ $limit }} baris</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="pokok-table-shell" role="region" aria-label="Tabel data pokok, geser untuk melihat kolom lain" tabindex="0">
            <table class="pokok-table">
                <thead>
                    <tr>
                        <th class="pokok-id">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => ($sort === 'id' && $direction === 'asc') ? 'desc' : 'asc', 'page' => 1]) }}" title="Urutkan ID">
                                <span>ID</span>
                                <span class="sort-icon text-muted">@if ($sort === 'id'){!! $direction === 'asc' ? '▲' : '▼' !!}@else<span style="opacity:.35;">⇅</span>@endif</span>
                            </a>
                        </th>
                        @foreach (\App\Models\Pokok::EXCEL_COLUMNS as $column => $label)
                            <th class="{{ in_array($column, ['no_animo', 'no_online', 'nama']) ? 'pokok-' . str_replace('_', '-', $column) : '' }}">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => $column, 'direction' => ($sort === $column && $direction === 'asc') ? 'desc' : 'asc', 'page' => 1]) }}" title="Urutkan {{ $label }}">
                                    <span>{{ $label }}</span>
                                    <span class="sort-icon text-muted">@if ($sort === $column){!! $direction === 'asc' ? '▲' : '▼' !!}@else<span style="opacity:.35;">⇅</span>@endif</span>
                                </a>
                            </th>
                        @endforeach
                        @if (Auth::user()->isSuperadmin())<th class="pokok-aksi">Aksi</th>@endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td class="pokok-id">{{ $item->id }}</td>
                            @foreach (\App\Models\Pokok::EXCEL_COLUMNS as $column => $label)
                                <td class="{{ in_array($column, ['no_animo', 'no_online', 'nama']) ? 'pokok-' . str_replace('_', '-', $column) : '' }}"
                                    @if (in_array($column, ['no_animo', 'no_online', 'nama'])) title="{{ $item->{$column} ?? '' }}" @endif>{{ $item->{$column} ?? '-' }}</td>
                            @endforeach
                            @if (Auth::user()->isSuperadmin())<td class="pokok-aksi">
                                <div class="pokok-row-actions">
                                    <a href="{{ route('pokok.edit', $item) }}" class="btn btn-sm btn-primary text-white">Edit</a>
                                    <form action="{{ route('pokok.delete', $item) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus data ini?')" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>@endif
                        </tr>
                    @empty
                        <tr><td colspan="{{ Auth::user()->isSuperadmin() ? 31 : 30 }}" class="text-center py-4">Tidak ada data untuk filter ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p class="pokok-table-note">Geser tabel ke kanan untuk melihat seluruh kolom.</p>
        <div class="mt-3">{{ $data->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
@endsection
