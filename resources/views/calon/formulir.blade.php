@extends('layouts.admin')
@section('page','Data Administrasi')
@section('breadcrumb')
    <li><a href="#" class="breadcrumb-item nav-link">Pendaftaran </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> Formulir</a></li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <form action="" method="post">
                        @csrf
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Data diri
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body">
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>No online</label>
                                                <input type="text" name="no_online" class="form-control" value="{{ Auth::guard('calon')->user()->no_online }}">
                                            </div>
                                            <div class="col">
                                                <label>Nama</label>
                                                <input type="text" name="nama" class="form-control" value="{{ Auth::guard('calon')->user()->nama }}">
                                            </div>
                                            <div class="col">
                                                <label>Agama</label>
                                                <input type="text" name="agama" class="form-control" value="{{Auth::guard('calon')->user()->agama }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tempat lahir</label>
                                                <input type="text" name="tem_lahir" class="form-control" value="{{ Auth::guard('calon')->user()->tem_lahir }}">
                                            </div>
                                            <div class="col">
                                                <label>Tanggal lahir</label>
                                                <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir') }}">
                                            </div>
                                            <div class="col">
                                                <label>Suku</label>
                                                <input type="text" name="suku" class="form-control" value="{{Auth::guard('calon')->user()->suku }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-8">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}">
                                            </div>
                                            <div class="col">
                                                <label>RT</label>
                                                <input type="number" name="rt" class="form-control" value="{{ old('rt') }}">
                                            </div>
                                            <div class="col">
                                                <label>RW</label>
                                                <input type="number" name="rw" class="form-control" value="{{Auth::guard('calon')->user()->rw }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>No rumah</label>
                                                <input type="text" name="no" class="form-control" value="{{ old('no') }}">
                                            </div>
                                            <div class="col">
                                                <label>Dusun</label>
                                                <input type="text" name="dusun" class="form-control" value="{{ old('dusun') }}">
                                            </div>
                                            <div class="col">
                                                <label>Desa</label>
                                                <input type="text" name="desa" class="form-control" value="{{ old('desa') }}">
                                            </div>
                                            <div class="col">
                                                <label>Kecamatan</label>
                                                <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Kabupaten/Kota</label>
                                                <input type="text" name="kab" class="form-control" value="{{ old('kab') }}">
                                            </div>
                                            <div class="col">
                                                <label>No telphone</label>
                                                <input type="text" name="telp" class="form-control" value="{{ old('telp') }}">
                                            </div>
                                            <div class="col">
                                                <label>Daftar ke</label>
                                                <input type="text" name="daftar_ke" class="form-control" value="{{ old('daftar_ke') }}">
                                            </div>
                                            <div class="col">
                                                <label>Aspek tidak lulus</label>
                                                <input type="text" name="aspek_tl" class="form-control" value="{{ old('aspek_tl') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Pendidikan
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body">
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>SD</label>
                                                <input type="text" name="sd" class="form-control" value="{{ old('sd') }}">
                                            </div>
                                            <div class="col-2">
                                                <label>Tahun lulus SD</label>
                                                <input type="number" name="l_sd" class="form-control" value="{{ old('l_sd') }}">
                                            </div>
                                            <div class="col">
                                                <label>SMP</label>
                                                <input type="text" name="smp" class="form-control" value="{{ old('smp') }}">
                                            </div>
                                            <div class="col-2">
                                                <label>Tahun lulus SMP</label>
                                                <input type="number" name="l_sd" class="form-control" value="{{ old('l_smp') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>SMA</label>
                                                <input type="text" name="sma" class="form-control" value="{{ old('sma') }}">
                                            </div>
                                            <div class="col">
                                                <label>Jurusan</label>
                                                <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}">
                                            </div>
                                            <div class="col-2">
                                                <label>Tahun lulus SMA</label>
                                                <select name="l_sma" class="form-select">
                                                    <option selected></option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Orang tua / wali
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body">
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Nama ayah</label>
                                                <input type="text" name="ayah" class="form-control" value="{{ old('kab') }}">
                                            </div>
                                            <div class="col">
                                                <label>Kerja ayah</label>
                                                <input type="text" name="kerja_ayah" class="form-control" value="{{ old('kerja_ayah') }}">
                                            </div>
                                            <div class="col">
                                                <label>Pangkat ayah</label>
                                                <input type="text" name="pangkat_ayah" class="form-control" value="{{ old('pangkat_ayah') }}">
                                            </div>
                                            <div class="col">
                                                <label>Jabatan ayah</label>
                                                <input type="text" name="jabatan_ayah" class="form-control" value="{{ old('jabatan_ayah') }}">
                                            </div>
                                            <div class="col">
                                                <label>Satuan</label>
                                                <input type="text" name="satuan_ayah" class="form-control" value="{{ old('satuan_ayah') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Nama ibu</label>
                                                <input type="text" name="ibu" class="form-control" value="{{ old('kab') }}">
                                            </div>
                                            <div class="col">
                                                <label>Kerja ibu</label>
                                                <input type="text" name="kerja_ibu" class="form-control" value="{{ old('kerja_ibu') }}">
                                            </div>
                                            <div class="col">
                                                <label>Pangkat ibu</label>
                                                <input type="text" name="pangkat_ibu" class="form-control" value="{{ old('pangkat_ibu') }}">
                                            </div>
                                            <div class="col">
                                                <label>Jabatan ibu</label>
                                                <input type="text" name="jabatan_ibu" class="form-control" value="{{ old('jabatan_ibu') }}">
                                            </div>
                                            <div class="col">
                                                <label>Satuan</label>
                                                <input type="text" name="satuan_ibu" class="form-control" value="{{ old('satuan_ibu') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label>Telphone orang tua</label>
                                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                            </div>
                                            <div class="col">
                                                <label>Alamat orang tua</label>
                                                <input type="text" name="alamat_ortu" class="form-control" value="{{ old('alamat_ortu') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Status wali</label>
                                                <input type="text" name="status_wali" class="form-control" value="{{ old('status_wali') }}">
                                            </div>
                                            <div class="col">
                                                <label>Hubungan wali</label>
                                                <input type="text" name="hub_wali" class="form-control" value="{{ old('hub_wali') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-success my-3"><i class="fas fa-save"></i> Simpan data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
