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
                        <h3 class="box-title mb-0">Form Edit Data</h3>
                    </div>
                    <form action="{{ route('pokok.update', $pokok) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col">
                                <label>Nomor Animo</label>
                                <input type="text" value="{{ $pokok->no_online }}" style="text-transform:uppercase" name="no_online" id="no_online" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Nama</label>
                                <input type="text" value="{{ $pokok->nama }}" style="text-transform:uppercase" name="nama" id="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Tempat Lahir</label>
                                <input type="text" value="{{ $pokok->tem_lahir }}" style="text-transform:uppercase" name="tem_lahir" id="tem_lahir" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Tanggal Lahir</label>
                                <input type="text" value="{{ $pokok->tgl_lahir }}" style="text-transform:uppercase" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Suku</label>
                                <input type="text" value="{{ $pokok->suku }}" style="text-transform:uppercase" name="suku" id="suku" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Agama</label>
                                <input type="text" value="{{ $pokok->agama }}" style="text-transform:uppercase" name="agama" id="agama" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Jenis Sekolah</label>
                                <select name="jenis_sekolah" id="jenis_sekolah" class="form-control" required>
                                    <option></option>
                                    <option {{ $pokok->jenis_sekolah == 'SMA' ?'selected':'' }} value="SMA">SMA</option>
                                    <option {{ $pokok->jenis_sekolah == 'SMK' ?'selected':'' }} value="SMK">SMK</option>
                                    <option {{ $pokok->jenis_sekolah == 'MA' ?'selected':'' }} value="MA">MA</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Asal Sekolah</label>
                                <input type="text" value="{{ $pokok->nama_sekolah }}" style="text-transform:uppercase" name="nama_sekolah" id="nama_sekolah" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Tahun Lulus</label>
                                <input type="number" name="th_lulus" value="{{ $pokok->th_lulus }}" id="th_lulus" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Jurusan</label>
                                <input type="text" value="{{ $pokok->jur }}" style="text-transform:uppercase" name="jur" id="jur" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Nama Orang Tua</label>
                                <input type="text" value="{{ $pokok->ortu1 }}" style="text-transform:uppercase" name="ortu1" id="ortu1" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Pekerjaan Orang Tua</label>
                                <input type="text" value="{{ $pokok->kerja }}" style="text-transform:uppercase" name="kerja" id="kerja" class="form-control" required>
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
