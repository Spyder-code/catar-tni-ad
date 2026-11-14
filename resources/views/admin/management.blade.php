@extends('layouts.admin')
@section('page', 'Manajemen Admin')
@section('breadcrumb')
    <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Dashboard</a></li>
    <li class="breadcrumb-item active">/ Manajemen Admin</li>
@endsection
@section('content')
<div class="container-fluid">
    @if (session('success'))<div class="alert alert-success mt-3">{{ session('success') }}</div>@endif
    @if ($errors->any())
        <div class="alert alert-danger mt-3"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <div class="white-box mt-3">
        <h3 class="box-title">Tambah Admin</h3>
        <p class="text-muted">Upload Data Pokok terlebih dahulu agar pilihan Kodim muncul di sini.</p>
        @if ($kodims->isEmpty())
            <div class="alert alert-warning">Belum ada Kodim di Data Pokok. <a href="{{ route('pokok') }}">Upload Data Pokok</a> sebelum menambah admin.</div>
        @else
            <form action="{{ route('admin-management.store') }}" method="post" data-nrp-form>
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3"><label for="new-name" class="form-label">Nama</label><input id="new-name" name="name" class="form-control" value="{{ old('name') }}" required></div>
                    <div class="col-md-6 mb-3"><label for="new-username" class="form-label">Username</label><input id="new-username" name="username" class="form-control" value="{{ old('username') }}" required></div>
                    <div class="col-md-6 mb-3"><label for="new-email" class="form-label">Email</label><input id="new-email" type="email" name="email" class="form-control" value="{{ old('email') }}" required></div>
                    <div class="col-md-6 mb-3"><label for="new-nrp" class="form-label">NRP</label><input id="new-nrp" name="nrp" class="form-control" value="{{ old('nrp') }}" maxlength="50" data-nrp><div class="form-text">Wajib jika menjadi penanggung jawab.</div></div>
                    <div class="col-md-6 mb-3"><label for="new-kodim" class="form-label">Kodim</label><select id="new-kodim" name="kodim" class="form-control" required><option value="">Pilih Kodim</option>@foreach ($kodims as $kodim)<option value="{{ $kodim }}" @selected(old('kodim') === $kodim)>{{ $kodim }}</option>@endforeach</select></div>
                    <div class="col-md-6 mb-3"><label for="new-password" class="form-label">Password</label><input id="new-password" type="password" name="password" class="form-control" minlength="8" required></div>
                    <div class="col-md-6 mb-3"><label for="new-password-confirmation" class="form-label">Konfirmasi Password</label><input id="new-password-confirmation" type="password" name="password_confirmation" class="form-control" minlength="8" required></div>
                </div>
                <fieldset class="mb-3"><legend class="fs-6">Penanggung jawab dan penandatangan dokumen</legend>
                    <label class="me-3"><input type="radio" name="penanggung_jawab" value="1" @checked(old('penanggung_jawab') === '1') required> Ya</label>
                    <label><input type="radio" name="penanggung_jawab" value="0" @checked(old('penanggung_jawab', '0') === '0')> Tidak</label>
                    <div class="form-text">Hanya satu admin per Kodim. Memilih Ya akan mengganti penanggung jawab sebelumnya.</div>
                </fieldset>
                <button class="btn btn-primary" type="submit">Tambah Admin</button>
            </form>
        @endif
    </div>

    <div class="white-box mt-3">
        <h3 class="box-title">Daftar Admin</h3>
        <div class="table-responsive"><table class="table table-striped align-middle">
            <thead><tr><th>Nama</th><th>Username</th><th>Email</th><th>NRP</th><th>Kodim</th><th>Penanggung jawab / TTD</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse ($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td><td>{{ $admin->username }}</td><td>{{ $admin->email }}</td><td>{{ $admin->nrp ?: '—' }}</td><td>{{ $admin->kodim }}</td>
                    <td>{{ $admin->isPenanggungJawab() ? 'Ya' : 'Tidak' }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#edit-admin-{{ $admin->id }}">Edit</button>
                        <form class="d-inline" action="{{ route('admin-management.destroy', $admin) }}" method="post" onsubmit="return confirm('Hapus admin ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button></form>
                    </td>
                </tr>
                <tr class="collapse" id="edit-admin-{{ $admin->id }}"><td colspan="7">
                    <form action="{{ route('admin-management.update', $admin) }}" method="post" class="p-3 border rounded" data-nrp-form>
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3"><label class="form-label" for="name-{{ $admin->id }}">Nama</label><input class="form-control" id="name-{{ $admin->id }}" name="name" value="{{ $admin->name }}" required></div>
                            <div class="col-md-6 mb-3"><label class="form-label" for="username-{{ $admin->id }}">Username</label><input class="form-control" id="username-{{ $admin->id }}" name="username" value="{{ $admin->username }}" required></div>
                            <div class="col-md-6 mb-3"><label class="form-label" for="email-{{ $admin->id }}">Email</label><input class="form-control" type="email" id="email-{{ $admin->id }}" name="email" value="{{ $admin->email }}" required></div>
                            <div class="col-md-6 mb-3"><label class="form-label" for="nrp-{{ $admin->id }}">NRP</label><input class="form-control" id="nrp-{{ $admin->id }}" name="nrp" value="{{ $admin->nrp }}" maxlength="50" data-nrp><div class="form-text">Wajib jika menjadi penanggung jawab.</div></div>
                            <div class="col-md-6 mb-3"><label class="form-label" for="kodim-{{ $admin->id }}">Kodim</label><select class="form-control" id="kodim-{{ $admin->id }}" name="kodim" required>@foreach ($kodims as $kodim)<option value="{{ $kodim }}" @selected($admin->kodim === $kodim)>{{ $kodim }}</option>@endforeach</select></div>
                            <div class="col-md-6 mb-3"><label class="form-label" for="password-{{ $admin->id }}">Password baru (kosongkan jika tetap)</label><input class="form-control" type="password" id="password-{{ $admin->id }}" name="password" minlength="8"></div>
                            <div class="col-md-6 mb-3"><label class="form-label" for="password-confirmation-{{ $admin->id }}">Konfirmasi password baru</label><input class="form-control" type="password" id="password-confirmation-{{ $admin->id }}" name="password_confirmation" minlength="8"></div>
                        </div>
                        <fieldset class="mb-3"><legend class="fs-6">Penanggung jawab dan penandatangan dokumen</legend>
                            <label class="me-3"><input type="radio" name="penanggung_jawab" value="1" @checked($admin->isPenanggungJawab()) required> Ya</label>
                            <label><input type="radio" name="penanggung_jawab" value="0" @checked(!$admin->isPenanggungJawab())> Tidak</label>
                        </fieldset>
                        <button class="btn btn-success" type="submit">Simpan Perubahan</button>
                    </form>
                </td></tr>
            @empty
                <tr><td colspan="7" class="text-center">Belum ada admin.</td></tr>
            @endforelse
            </tbody>
        </table></div>
    </div>
</div>
@endsection
@section('script')
<script>
    document.querySelectorAll('[data-nrp-form]').forEach(function (form) {
        var nrp = form.querySelector('[data-nrp]');
        function updateRequirement() {
            var selected = form.querySelector('input[name="penanggung_jawab"]:checked');
            nrp.required = selected && selected.value === '1';
        }
        form.querySelectorAll('input[name="penanggung_jawab"]').forEach(function (radio) {
            radio.addEventListener('change', updateRequirement);
        });
        updateRequirement();
    });
</script>
@endsection
