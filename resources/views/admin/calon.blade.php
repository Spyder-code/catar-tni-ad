@extends('layouts.admin')
@section('page', 'Data Calon')
@section('style')
<style>
    .calon-actions { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: .75rem; }
    .calon-actions-group { display: flex; flex-wrap: wrap; gap: .5rem; }
    .calon-actions-group .btn { margin: 0 !important; }
    .pokok-table-shell { max-height: 68vh; overflow: auto; border: 1px solid #dce4ec; border-radius: .65rem; scrollbar-color: #a5b8cc #edf2f7; }
    .pokok-table { width: max-content; min-width: 100%; border-collapse: separate; border-spacing: 0; margin: 0; }
    .pokok-table th, .pokok-table td { white-space: nowrap; padding: .7rem .85rem; border-bottom: 1px solid #e8edf2; vertical-align: middle; }
    .pokok-table thead th { position: sticky; top: 0; z-index: 2; background: #edf3f8; color: #33465a; font-size: .8rem; box-shadow: 0 1px 0 #dce4ec; }
    .pokok-table tbody td { background: #fff; }
    .pokok-table .calon-check { width: 45px; min-width: 45px; text-align: center; }
    .pokok-table .pokok-id { width: 65px; min-width: 65px; max-width: 65px; }
    .pokok-table .pokok-no-animo { width: 190px; min-width: 190px; max-width: 190px; }
    .pokok-table .pokok-nama { width: 250px; min-width: 250px; max-width: 250px; }
    .pokok-table-note { color: #66788a; font-size: .8rem; margin: .45rem 0 0; }
    .pokok-table tbody .pokok-no-animo,
    .pokok-table tbody .pokok-nama { overflow: hidden; text-overflow: ellipsis; }
    .pokok-table .pokok-aksi { position: sticky; right: 0; z-index: 1; width: 145px; min-width: 145px; background: #fff; box-shadow: -3px 0 5px #dce4ec; text-align: center; }
    .pokok-table thead .pokok-aksi { z-index: 3; background: #edf3f8; }
    .pokok-table .pokok-row-actions { display: flex; gap: .4rem; justify-content: center; }
    .pokok-table thead th a { color: inherit; text-decoration: none; display: flex; align-items: center; justify-content: space-between; gap: .35rem; }
    .pokok-table thead th a:hover { color: #0284c7; }
    .pokok-table thead th a .sort-icon { font-size: .75rem; }
</style>
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Dashboard</a></li>
    <li class="breadcrumb-item active">/ Data Calon</li>
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
        <div class="calon-actions mb-3">
            <h3 class="box-title mb-0">Data Calon</h3>
            <div class="calon-actions-group">
                <form action="{{ route('calon.data.exportAll') }}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-file-excel"></i> Export Excel</button>
                </form>
                @if (Auth::user()->isSuperadmin())
                <form action="{{ route('calon.deleteAll') }}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Hapus semua data calon?')" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Hapus Semua</button>
                </form>
                @endif
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-2 gap-2">
            <p class="mb-0 text-muted">Menampilkan {{ $data->firstItem() ?? 0 }}–{{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} data calon.@if (!Auth::user()->isSuperadmin() && Auth::user()->kodim) Kodim: {{ Auth::user()->kodim }}.@endif</p>
            <div class="d-flex align-items-center gap-2">
                <label for="calon-per-page" class="mb-0 text-muted" style="font-size: .82rem; font-weight: 600; white-space: nowrap;">Tampilkan:</label>
                <select id="calon-per-page" class="form-control form-control-sm" style="width: auto; min-width: 95px;" onchange="window.location.href=this.value">
                    @foreach ([10, 25, 50, 100] as $limit)
                        <option value="{{ request()->fullUrlWithQuery(['per_page' => $limit, 'page' => 1]) }}" @selected($perPage == $limit)>{{ $limit }} baris</option>
                    @endforeach
                </select>
            </div>
        </div>

        <form action="{{ route('calon.data.export') }}" method="post" id="form-export-selected">
            @csrf
            <div class="pokok-table-shell" role="region" aria-label="Tabel data calon, geser untuk melihat kolom lain" tabindex="0">
                <table class="pokok-table">
                    <thead>
                        <tr>
                            <th class="calon-check"><input type="checkbox" id="check-all" style="height: 18px; width: 18px"></th>
                            <th class="pokok-id">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => ($sort === 'id' && $direction === 'asc') ? 'desc' : 'asc', 'page' => 1]) }}" title="Urutkan ID">
                                    <span>ID</span>
                                    <span class="sort-icon text-muted">@if ($sort === 'id'){!! $direction === 'asc' ? '▲' : '▼' !!}@else<span style="opacity:.35;">⇅</span>@endif</span>
                                </a>
                            </th>
                            <th class="pokok-no-animo">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'no_animo', 'direction' => ($sort === 'no_animo' && $direction === 'asc') ? 'desc' : 'asc', 'page' => 1]) }}" title="Urutkan No animo">
                                    <span>No animo</span>
                                    <span class="sort-icon text-muted">@if ($sort === 'no_animo'){!! $direction === 'asc' ? '▲' : '▼' !!}@else<span style="opacity:.35;">⇅</span>@endif</span>
                                </a>
                            </th>
                            <th class="pokok-nama">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama', 'direction' => ($sort === 'nama' && $direction === 'asc') ? 'desc' : 'asc', 'page' => 1]) }}" title="Urutkan Nama">
                                    <span>Nama</span>
                                    <span class="sort-icon text-muted">@if ($sort === 'nama'){!! $direction === 'asc' ? '▲' : '▼' !!}@else<span style="opacity:.35;">⇅</span>@endif</span>
                                </a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'tgl_lahir', 'direction' => ($sort === 'tgl_lahir' && $direction === 'asc') ? 'desc' : 'asc', 'page' => 1]) }}" title="Urutkan Tanggal lahir">
                                    <span>Tanggal lahir</span>
                                    <span class="sort-icon text-muted">@if ($sort === 'tgl_lahir'){!! $direction === 'asc' ? '▲' : '▼' !!}@else<span style="opacity:.35;">⇅</span>@endif</span>
                                </a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'tem_lahir', 'direction' => ($sort === 'tem_lahir' && $direction === 'asc') ? 'desc' : 'asc', 'page' => 1]) }}" title="Urutkan Tempat lahir">
                                    <span>Tempat lahir</span>
                                    <span class="sort-icon text-muted">@if ($sort === 'tem_lahir'){!! $direction === 'asc' ? '▲' : '▼' !!}@else<span style="opacity:.35;">⇅</span>@endif</span>
                                </a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'updated_at', 'direction' => ($sort === 'updated_at' && $direction === 'asc') ? 'desc' : 'asc', 'page' => 1]) }}" title="Urutkan Tanggal daftar">
                                    <span>Tanggal daftar</span>
                                    <span class="sort-icon text-muted">@if ($sort === 'updated_at'){!! $direction === 'asc' ? '▲' : '▼' !!}@else<span style="opacity:.35;">⇅</span>@endif</span>
                                </a>
                            </th>
                            <th class="pokok-aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                        <tr>
                            <td class="calon-check">
                                <input type="checkbox" name="calon[]" value="{{ $item->id }}" style="height: 18px; width: 18px" class="form-check calon-item">
                            </td>
                            <td class="pokok-id">{{ $item->id }}</td>
                            <td class="pokok-no-animo" title="{{ $item->no_animo }}">{{ $item->no_animo ?? '-' }}</td>
                            <td class="pokok-nama" title="{{ $item->nama }}">{{ $item->nama ?? '-' }}</td>
                            <td>{{ $item->tgl_lahir ? date('d F Y', strtotime($item->tgl_lahir)) : '-' }}</td>
                            <td>{{ $item->tem_lahir ?? '-' }}</td>
                            <td>{{ $item->updated_at ? date('d F Y', strtotime($item->updated_at)) : '-' }}</td>
                            <td class="pokok-aksi">
                                <div class="pokok-row-actions">
                                    <a href="{{ route('calon.print', $item->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Print Surat Pendaftaran"><i class="fas fa-print"></i> Print</a>
                                    <button type="button" onclick="deleteCalon({{ $item->id }})" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Tidak ada data calon.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <p class="pokok-table-note">Geser tabel ke kanan untuk melihat seluruh kolom.</p>
            <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                <button type="submit" class="btn btn-primary text-white"><i class="fas fa-file-excel"></i> Export Terpilih (Excel)</button>
                <button type="button" class="btn btn-outline-secondary" id="uncheck">Uncheck All</button>
            </div>
            <div class="mt-3">{{ $data->links('pagination::bootstrap-5') }}</div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#check-all').on('change', function () {
        $('.calon-item').prop('checked', this.checked);
    });
    $('#uncheck').on('click', function () {
        $('.calon-item').prop('checked', false);
        $('#check-all').prop('checked', false);
    });
    $('.calon-item').on('change', function () {
        if (!this.checked) {
            $('#check-all').prop('checked', false);
        } else if ($('.calon-item:checked').length === $('.calon-item').length) {
            $('#check-all').prop('checked', true);
        }
    });

    $('#form-export-selected').on('submit', function (e) {
        if ($('.calon-item:checked').length === 0) {
            e.preventDefault();
            alert('Harap pilih data calon terlebih dahulu');
            return false;
        }
    });

    function deleteCalon(id) {
        if (!confirm('Hapus calon ini?')) {
            return;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const url = {!! json_encode(route('calon.destroy')) !!};
        $.ajax({
            type: 'DELETE',
            url: url,
            data: { id: id },
            success: function () {
                location.reload();
            },
            error: function (xhr) {
                alert(xhr.responseJSON?.message || 'Gagal menghapus calon.');
            }
        });
    }
</script>
@endsection
