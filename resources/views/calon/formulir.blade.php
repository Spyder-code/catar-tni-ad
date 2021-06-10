@extends('layouts.admin')
@section('page','Data Administrasi')
@section('breadcrumb')
    <li><a href="#" class="breadcrumb-item nav-link">Pendaftaran </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> Formulir</a></li>
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
                    <form action="{{ route('calon.form.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="hidden" name="calon_id" value="{{ $calon!=null?$calon->id:0 }}">
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
                                                <input type="text" name="no_online" class="form-control" value="{{ $calon!=null?$calon->no_online : Auth::guard('calon')->user()->no_online }}">
                                            </div>
                                            <div class="col">
                                                <label>Nama</label>
                                                <input type="text" name="nama" class="form-control" value="{{ $calon!=null?$calon->nama : Auth::guard('calon')->user()->nama }}">
                                            </div>
                                            <div class="col">
                                                <label>Agama</label>
                                                <input type="text" name="agama" class="form-control" value="{{ $calon!=null?$calon->agama : Auth::guard('calon')->user()->agama }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tempat lahir</label>
                                                <input type="text" name="tem_lahir" class="form-control" value="{{ $calon!=null?$calon->tem_lahir : Auth::guard('calon')->user()->tem_lahir }}">
                                            </div>
                                            <div class="col">
                                                <label>Tanggal lahir</label>
                                                <input type="date" name="tgl_lahir" class="form-control" value="{{ $calon!=null?$calon->tgl_lahir : Auth::guard('calon')->user()->tem_lahir }}">
                                            </div>
                                            <div class="col">
                                                <label>Suku</label>
                                                <input type="text" name="suku" class="form-control" value="{{ $calon!=null?$calon->suku : Auth::guard('calon')->user()->suku }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-8">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" class="form-control" value="{{ $calon!=null?$calon->alamat : Auth::guard('calon')->user()->alamat_c }}">
                                            </div>
                                            <div class="col">
                                                <label>RT</label>
                                                <input type="number" name="rt" class="form-control" value="{{ $calon!=null?$calon->rt :'' }}">
                                            </div>
                                            <div class="col">
                                                <label>RW</label>
                                                <input type="number" name="rw" class="form-control" value="{{ $calon!=null?$calon->rw :'' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>No rumah</label>
                                                <input type="text" name="no" class="form-control" value="{{ $calon!=null?$calon->no :'' }}">
                                            </div>
                                            <div class="col">
                                                <label>Dusun</label>
                                                <input type="text" name="dusun" class="form-control" value="{{ $calon!=null?$calon->dsn :'' }}">
                                            </div>
                                            <div class="col">
                                                <label>Desa</label>
                                                <input type="text" name="desa" class="form-control" value="{{ $calon!=null?$calon->ds :'' }}">
                                            </div>
                                            <div class="col">
                                                <label>Kecamatan</label>
                                                <input type="text" name="kecamatan" class="form-control" value="{{ $calon!=null?$calon->kec :'' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Kabupaten/Kota</label>
                                                <input type="text" name="kab" class="form-control" value="{{ $calon!=null?$calon->kab :'' }}">
                                            </div>
                                            <div class="col">
                                                <label>No telphone</label>
                                                <input type="text" name="telp" class="form-control" value="{{ $calon!=null?$calon->telp :'' }}">
                                            </div>
                                            <div class="col">
                                                <label>Daftar ke</label>
                                                <input type="text" name="daftar_ke" class="form-control" value="{{ $calon!=null?$calon->daftar_ke :'' }}">
                                            </div>
                                            <div class="col">
                                                <label>Aspek tidak lulus</label>
                                                <input type="text" name="aspek_tl" class="form-control" value="{{ $calon!=null?$calon->aspek_tl :'' }}">
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
                                                <input type="text" name="sd" class="form-control" value="{{ $pendidikan!=null?$pendidikan->sd : '' }}">
                                            </div>
                                            <div class="col-2">
                                                <label>Tahun lulus SD</label>
                                                <input type="number" name="l_sd" class="form-control" value="{{ $pendidikan!=null?$pendidikan->l_sd : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>SMP</label>
                                                <input type="text" name="smp" class="form-control" value="{{ $pendidikan!=null?$pendidikan->smp : '' }}">
                                            </div>
                                            <div class="col-2">
                                                <label>Tahun lulus SMP</label>
                                                <input type="number" name="l_smp" class="form-control" value="{{ $pendidikan!=null?$pendidikan->l_smp : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>SMA</label>
                                                <input type="text" name="sma" class="form-control" value="{{ $pendidikan!=null?$pendidikan->sma : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>Jurusan</label>
                                                <input type="text" name="jurusan" class="form-control" value="{{ $pendidikan!=null?$pendidikan->jur : '' }}">
                                            </div>
                                            <div class="col-2">
                                                <label>Tahun lulus SMA</label>
                                                <select name="l_sma" class="form-select">
                                                    @if ($pendidikan==null)
                                                        <option selected></option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2021">2021</option>
                                                    @else
                                                        <option></option>
                                                        <option {{ $pendidikan->l_sma==2019?'selected':'' }} value="2019">2019</option>
                                                        <option {{ $pendidikan->l_sma==2020?'selected':'' }} value="2020">2020</option>
                                                        <option {{ $pendidikan->l_sma==2021?'selected':'' }} value="2021">2021</option>
                                                    @endif
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
                                                <input type="text" name="ayah" class="form-control" value="{{ $wali!=null?$wali->ayah : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>Kerja ayah</label>
                                                <input type="text" name="kerja_ayah" class="form-control" value="{{ $wali!=null?$wali->a_kerja : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>Pangkat ayah</label>
                                                <input type="text" name="pangkat_ayah" class="form-control" value="{{ $wali!=null?$wali->a_pkt : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>Jabatan ayah</label>
                                                <input type="text" name="jabatan_ayah" class="form-control" value="{{ $wali!=null?$wali->a_jab : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>Satuan</label>
                                                <input type="text" name="satuan_ayah" class="form-control" value="{{ $wali!=null?$wali->a_sat : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Nama ibu</label>
                                                <input type="text" name="ibu" class="form-control" value="{{ $wali!=null?$wali->ibu : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>Kerja ibu</label>
                                                <input type="text" name="kerja_ibu" class="form-control" value="{{ $wali!=null?$wali->i_kerja : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>Pangkat ibu</label>
                                                <input type="text" name="pangkat_ibu" class="form-control" value="{{ $wali!=null?$wali->i_pkt : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>Jabatan ibu</label>
                                                <input type="text" name="jabatan_ibu" class="form-control" value="{{ $wali!=null?$wali->i_jab : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>Satuan</label>
                                                <input type="text" name="satuan_ibu" class="form-control" value="{{ $wali!=null?$wali->i_sat : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label>Telphone orang tua</label>
                                                <input type="text" name="phone" class="form-control" value="{{ $wali!=null?$wali->o_telp : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>Alamat orang tua</label>
                                                <input type="text" name="alamat_ortu" class="form-control" value="{{ $wali!=null?$wali->o_alamat : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Status wali</label>
                                                <input type="text" name="status_wali" class="form-control" value="{{ $wali!=null?$wali->status_wali : '' }}">
                                            </div>
                                            <div class="col">
                                                <label>Hubungan wali</label>
                                                <input type="text" name="hub_wali" class="form-control" value="{{ $wali!=null?$wali->hub_calon_wali : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="mx-2 btn btn-success my-3"><i class="fas fa-save"></i> Simpan data</button>
                            @if ($status==1)
                            <a href="#" class="mx-2 btn btn-info my-3"><i class="fas fa-save"></i> Verifikasi data</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
