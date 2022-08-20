@extends('layouts.admin')
@section('page','Data Pokok')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.0/flatpickr.min.css">
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Dashboard </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> Data pokok</a></li>
@endsection
@section('content')
    <div class="container-fluid">
        @if ($message = Session::get('success'))
        <div class="row">
            <div class="col mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="row">
            <div class="col mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0">Form Data pokok</h3>
                    </div>
                    <form action="{{ route('pokok.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col">
                                <label>ID</label>
                                <input type="text" style="text-transform:uppercase" name="id" id="id" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Nomor Animo</label>
                                <input type="text" style="text-transform:uppercase" name="no_online" id="no_online" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Nama</label>
                                <input type="text" style="text-transform:uppercase" name="nama" id="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Tempat Lahir</label>
                                <input type="text" style="text-transform:uppercase" name="tem_lahir" id="tem_lahir" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Tanggal Lahir</label>
                                <input type="text" style="text-transform:uppercase" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Suku</label>
                                <input type="text" style="text-transform:uppercase" name="suku" id="suku" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Agama</label>
                                <input type="text" style="text-transform:uppercase" name="agama" id="agama" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Jenis Sekolah</label>
                                <select name="jenis_sekolah" id="jenis_sekolah" class="form-control" required>
                                    <option></option>
                                    <option value="SMA">SMA</option>
                                    <option value="SMK">SMK</option>
                                    <option value="MA">MA</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Asal Sekolah</label>
                                <input type="text" style="text-transform:uppercase" name="nama_sekolah" id="nama_sekolah" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Tahun Lulus</label>
                                <input type="number" name="th_lulus" id="th_lulus" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Jurusan</label>
                                <input type="text" style="text-transform:uppercase" name="jur" id="jur" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Nama Orang Tua</label>
                                <input type="text" style="text-transform:uppercase" name="ortu1" id="ortu1" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Pekerjaan Orang Tua</label>
                                <input type="text" style="text-transform:uppercase" name="kerja" id="kerja" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#tgl_lahir', {
            dateFormat: 'Y-m-d',
            maxDate: 'today',
            altFormat: 'd/m/Y',
            // altInput: true,
            maxDate: '2005-12-30',
            minDate: '1999-01-01',
        });
</script>
@endsection
