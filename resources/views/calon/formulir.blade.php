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
                <div class="alert alert-info" role="alert">
                    <strong>Penting!</strong>
                    <ol>
                        <li>Harap lengkapi semua data</li>
                        <li>Jika data terkait tidak ada maka isi kolom dengan tanda (-)</li>
                        <li>Setelah mengisi kolom, jangan lupa klik tombol simpan data pada bagian bawah form</li>
                        <li>Anda dapat mengubah data berkali-kali dengan klik tombol simpan</li>
                    </ol>
                </div>
                <div class="white-box">
                    @if ($status==1)
                        <div class="alert alert-success" role="alert">
                            Terakhir di edit {{ date('d/m/Y H:i', strtotime($calon->updated_at)) }}
                        </div>
                    @endif
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
                                            <div class="col-sm">
                                                <label>No online</label>
                                                <input type="text" name="calon[no_online]" class="form-control" value="{{ $calon!=null?$calon->no_online : Auth::guard('calon')->user()->no_online }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Nama</label>
                                                <input type="text" name="calon[nama]" class="form-control" value="{{ $calon!=null?$calon->nama : Auth::guard('calon')->user()->nama }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Agama</label>
                                                <input type="text" name="calon[agama]" class="form-control" value="{{ $calon!=null?$calon->agama : Auth::guard('calon')->user()->agama }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm">
                                                <label>Tempat lahir</label>
                                                <input type="text" name="calon[tem_lahir]" class="form-control" value="{{ $calon!=null?$calon->tem_lahir : Auth::guard('calon')->user()->tem_lahir }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Tanggal lahir</label>
                                                <input type="date" name="calon[tgl_lahir]" class="form-control" value="{{ $calon!=null?$calon->tgl_lahir : Auth::guard('calon')->user()->tem_lahir }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Suku</label>
                                                <input type="text" name="calon[suku]" class="form-control" value="{{ $calon!=null?$calon->suku : Auth::guard('calon')->user()->suku }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-8">
                                                <label>Alamat</label>
                                                <input type="text" name="calon[alamat]" class="form-control" value="{{ $calon!=null?$calon->alamat : Auth::guard('calon')->user()->alamat_c }}">
                                            </div>
                                            <div class="col">
                                                <label>RT</label>
                                                <input type="number" name="calon[rt]" class="form-control" value="{{ $calon!=null?$calon->rt :'' }}">
                                            </div>
                                            <div class="col">
                                                <label>RW</label>
                                                <input type="number" name="calon[rw]" class="form-control" value="{{ $calon!=null?$calon->rw :'' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>No rumah</label>
                                                <input type="text" name="calon[no]" class="form-control" value="{{ $calon!=null?$calon->no :'' }}">
                                            </div>
                                            <div class="col">
                                                <label>Dusun</label>
                                                <input type="text" name="calon[dsn]" class="form-control" value="{{ $calon!=null?$calon->dsn :'' }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Desa</label>
                                                <input type="text" name="calon[ds]" class="form-control" value="{{ $calon!=null?$calon->ds :'' }}">
                                            </div>
                                            <div class="col">
                                                <label>Kecamatan</label>
                                                <input type="text" name="calon[kec]" class="form-control" value="{{ $calon!=null?$calon->kec :'' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Kabupaten/Kota</label>
                                                <input type="text" name="calon[kab]" class="form-control" value="{{ $calon!=null?$calon->kab :'' }}">
                                            </div>
                                            <div class="col">
                                                <label>No telphone</label>
                                                <input type="text" name="calon[telp]" class="form-control" value="{{ $calon!=null?$calon->telp :'' }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Daftar ke</label>
                                                <input type="text" name="calon[daftar_ke]" class="form-control" value="{{ $calon!=null?$calon->daftar_ke :'' }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Aspek tidak lulus</label>
                                                <input type="text" name="calon[aspek_tl]" class="form-control" value="{{ $calon!=null?$calon->aspek_tl :'' }}">
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
                                            <div class="col-lg-3 col-6 col-md-3">
                                                <label>SD</label>
                                                <input type="text" name="pendidikan[sd]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->sd : '' }}">
                                            </div>
                                            <div class="col-lg-3 col-6 col-md-3">
                                                <label>Tahun lulus SD</label>
                                                <input type="number" name="pendidikan[l_sd]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->l_sd : '' }}">
                                            </div>
                                            <div class="col-lg-3 col-6 col-md-3">
                                                <label>SMP</label>
                                                <input type="text" name="pendidikan[smp]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->smp : '' }}">
                                            </div>
                                            <div class="col-lg-3 col-6 col-md-3">
                                                <label>Tahun lulus SMP</label>
                                                <input type="number" name="pendidikan[l_smp]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->l_smp : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm">
                                                <label>SMA</label>
                                                <input type="text" name="pendidikan[sma]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->sma : '' }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Jurusan</label>
                                                <input type="text" name="pendidikan[jur]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->jur : '' }}">
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Tahun lulus SMA</label>
                                                <select name="pendidikan[l_sma]" class="form-select">
                                                    @if ($pendidikan==null)
                                                        <option selected></option>
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
                                        @include('calon.nilai')
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
                                            <div class="col-lg col-6">
                                                <label>Nama ayah</label>
                                                <input type="text" name="wali[ayah]" class="form-control" value="{{ $wali!=null?$wali->ayah : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Kerja ayah</label>
                                                <input type="text" name="wali[a_kerja]" class="form-control" value="{{ $wali!=null?$wali->a_kerja : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Pangkat ayah</label>
                                                <input type="text" name="wali[a_pkt]" class="form-control" value="{{ $wali!=null?$wali->a_pkt : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Jabatan ayah</label>
                                                <input type="text" name="wali[a_jab]" class="form-control" value="{{ $wali!=null?$wali->a_jab : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Satuan</label>
                                                <input type="text" name="wali[a_sat]" class="form-control" value="{{ $wali!=null?$wali->a_sat : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg col-6">
                                                <label>Nama ibu</label>
                                                <input type="text" name="wali[ibu]" class="form-control" value="{{ $wali!=null?$wali->ibu : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Kerja ibu</label>
                                                <input type="text" name="wali[i_kerja]" class="form-control" value="{{ $wali!=null?$wali->i_kerja : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Pangkat ibu</label>
                                                <input type="text" name="wali[i_pkt]" class="form-control" value="{{ $wali!=null?$wali->i_pkt : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Jabatan ibu</label>
                                                <input type="text" name="wali[i_jab]" class="form-control" value="{{ $wali!=null?$wali->i_jab : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Satuan</label>
                                                <input type="text" name="wali[i_sat]" class="form-control" value="{{ $wali!=null?$wali->i_sat : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label>Telphone orang tua</label>
                                                <input type="text" name="wali[o_telp]" class="form-control" value="{{ $wali!=null?$wali->o_telp : '' }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Alamat orang tua</label>
                                                <input type="text" name="wali[o_alamat]" class="form-control" value="{{ $wali!=null?$wali->o_alamat : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg col-6">
                                                <label>Nama wali</label>
                                                <input type="text" name="wali[wali]" class="form-control" value="{{ $wali!=null?$wali->wali : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Kerja wali</label>
                                                <input type="text" name="wali[w_kerja]" class="form-control" value="{{ $wali!=null?$wali->w_kerja : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Pangkat wali</label>
                                                <input type="text" name="wali[w_pkt]" class="form-control" value="{{ $wali!=null?$wali->w_pkt : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Jabatan wali</label>
                                                <input type="text" name="wali[w_jab]" class="form-control" value="{{ $wali!=null?$wali->w_jab : '' }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Satuan</label>
                                                <input type="text" name="wali[w_sat]" class="form-control" value="{{ $wali!=null?$wali->w_sat : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label>Telphone wali</label>
                                                <input type="text" name="wali[w_telp]" class="form-control" value="{{ $wali!=null?$wali->w_telp : '' }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Alamat wali</label>
                                                <input type="text" name="wali[w_alamat]" class="form-control" value="{{ $wali!=null?$wali->w_alamat : '' }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Status wali</label>
                                                <select name="wali[status_wali]" class="form-select">
                                                    @if ($wali!=null)
                                                        <option value="0"></option>
                                                        <option {{ $wali->status_wali==1?'selected':'' }} value="1">Wali</option>
                                                        <option {{ $wali->status_wali==2?'selected':'' }} value="2">Tiri</option>
                                                        <option {{ $wali->status_wali==3?'selected':'' }} value="3">Perwalian</option>
                                                        <option {{ $wali->status_wali==4?'selected':'' }} value="4">Numpang alamat</option>
                                                    @else
                                                        <option value="0"></option>
                                                        <option value="1">Wali</option>
                                                        <option value="2">Tiri</option>
                                                        <option value="3">Perwalian</option>
                                                        <option value="4">Numpang alamat</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-sm">
                                                <label>Hubungan wali</label>
                                                <input type="text" name="wali[hub_calon_wali]" class="form-control" value="{{ $wali!=null?$wali->hub_calon_wali : '' }}">
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
