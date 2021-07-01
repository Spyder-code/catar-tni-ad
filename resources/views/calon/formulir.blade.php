@extends('layouts.admin')
@section('page','Data Administrasi')
@section('breadcrumb')
    <li><a href="#" class="breadcrumb-item nav-link">Pendaftaran </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> Formulir</a></li>
@endsection
@section('content')
<style>
    label{
        margin-top: 5px;
    }
</style>
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
                        <li>Harap simpan pdf setelah mengisi formulir</li>
                    </ol>
                </div>
                <div class="white-box">
                    @if ($status==1)
                        <div class="alert alert-success" role="alert">
                            Terakhir di edit {{ date('d/m/Y H:i', strtotime($calon->updated_at)) }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            <strong class="text-danger">Silahkan cek data kembali, pastikan data sesuai !</strong>
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
                                                @error('calon.no_online')
                                                    <div>
                                                        <strong class="text-danger small">Nomor Online tidak boleh kosong</strong>
                                                    </div>
                                                @enderror
                                                <input @error('calon.no_online') autofocus @enderror type="text" name="calon[no_online]" class="form-control" value="{{ $calon!=null?$calon->no_online : Auth::guard('calon')->user()->no_online }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Nama</label>
                                                @error('calon.nama')
                                                    <div>
                                                        <strong class="text-danger small">Nama tidak boleh kosong</strong>
                                                    </div>
                                                @enderror
                                                <input @error('calon.nama') autofocus @enderror type="text" name="calon[nama]" class="form-control" value="{{ $calon!=null?$calon->nama : Auth::guard('calon')->user()->nama }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>No KTP</label>
                                                @error('calon.ktp')
                                                    <div>
                                                        <strong class="text-danger small">{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                                <input @error('calon.ktp') autofocus @enderror type="number" name="calon[ktp]" class="form-control ktp" onkeypress="return this.value.length < 16;" oninput="if(this.value.length>=16) { this.value = this.value.slice(0,16); }" value="{{ $calon!=null?$calon->ktp : old('calon.ktp') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm">
                                                <label>Tempat lahir</label>
                                                @error('calon.tem_lahir')
                                                    <div>
                                                        <strong class="text-danger small">Tempat lahir tidak boleh kosong</strong>
                                                    </div>
                                                @enderror
                                                <input @error('calon.tem_lahir') autofocus @enderror type="text" name="calon[tem_lahir]" class="form-control" value="{{ $calon!=null?$calon->tem_lahir : Auth::guard('calon')->user()->tem_lahir }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Tanggal lahir</label>
                                                @error('calon.tgl_lahir')
                                                <div>
                                                    <strong class="text-danger small">Tanggal lahir tidak boleh kosong</strong>
                                                </div>
                                            @enderror
                                                <input @error('calon.tgl_lahir') autofocus @enderror type="date" id="lhr" name="calon[tgl_lahir]" min="1999-01-01" max="2005-12-30" class="form-control" value="{{ $calon!=null?$calon->tgl_lahir : old('calon.tgl_lahir') }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>DIK</label>
                                                <input type="date" id="dik" name="calon[dik]" readonly class="form-control" value="{{ $dik }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm">
                                                <label>Umur</label>
                                                <input type="text" value="{{ $calon!=null?$calon->umr :old('calon.umr') }}" id="umr" name="calon[umr]" readonly class="form-control" >
                                            </div>
                                            <div class="col-1">
                                                <label>Hari</label>
                                                <input type="text" readonly value="{{ $calon!=null?$calon->u_hri :''}}" id="u_hri" name="calon[u_hri]" class="form-control" >
                                            </div>
                                            <div class="col-1">
                                                <label>Bulan</label>
                                                <input type="text" readonly value="{{ $calon!=null?$calon->u_bln :''}}" id="u_bln" name="calon[u_bln]" class="form-control" >
                                            </div>
                                            <div class="col-1">
                                                <label>Tahun</label>
                                                <input type="text" readonly value="{{ $calon!=null?$calon->u_thn :''}}" id="u_thn" name="calon[u_thn]" class="form-control" >
                                            </div>
                                            <div class="col-sm">
                                                <label>Keterangan Umur</label>
                                                <input type="text" value="{{ $calon!=null?$calon->ket_umr :old('calon.ket_umr') }}" id="ket-umr" name="calon[ket_umr]" readonly class="form-control" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm">
                                                <label>Suku</label>
                                                @error('calon.suku')
                                                <div>
                                                    <strong class="text-danger small">Suku tidak boleh kosong</strong>
                                                </div>
                                            @enderror
                                                <input @error('calon.suku') autofocus @enderror type="text" name="calon[suku]" class="form-control" value="{{ $calon!=null?$calon->suku : Auth::guard('calon')->user()->suku }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Agama</label>
                                                @error('calon.agama]')
                                                <div>
                                                    <strong class="text-danger small">Agama tidak boleh kosong</strong>
                                                </div>
                                            @enderror
                                                <input @error('calon.agama') autofocus @enderror type="text" name="calon[agama]" class="form-control" value="{{ $calon!=null?$calon->agama : Auth::guard('calon')->user()->agama }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-8">
                                                <label>Alamat</label>
                                                @error('calon.alamat')
                                                <div>
                                                    <strong class="text-danger small">Alamat tidak boleh kosong</strong>
                                                </div>
                                            @enderror
                                                <input @error('calon.alamat') autofocus @enderror type="text" name="calon[alamat]" class="form-control" value="{{ $calon!=null?$calon->alamat : Auth::guard('calon')->user()->alamat_c }}">
                                            </div>
                                            <div class="col">
                                                <label>RT</label>
                                                <input type="number" onkeypress="return this.value.length < 3;" oninput="if(this.value.length>=3) { this.value = this.value.slice(0,3); }" name="calon[rt]" class="form-control" value="{{ $calon!=null?$calon->rt :old('calon.rt') }}">
                                            </div>
                                            <div class="col">
                                                <label>RW</label>
                                                <input type="number" onkeypress="return this.value.length < 3;" oninput="if(this.value.length>=3) { this.value = this.value.slice(0,3); }" name="calon[rw]" class="form-control" value="{{ $calon!=null?$calon->rw :old('calon.rw') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>No rumah</label>
                                                <input type="text" name="calon[no]" class="form-control" value="{{ $calon!=null?$calon->no :old('calon.no') }}">
                                            </div>
                                            <div class="col">
                                                <label>Dusun</label>
                                                <input type="text" name="calon[dsn]" class="form-control" value="{{ $calon!=null?$calon->dsn :old('calon.dsn') }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Desa</label>
                                                <input type="text" name="calon[ds]" class="form-control" value="{{ $calon!=null?$calon->ds :old('calon.ds') }}">
                                            </div>
                                            <div class="col">
                                                <label>Kecamatan</label>
                                                <input type="text" name="calon[kec]" class="form-control" value="{{ $calon!=null?$calon->kec :old('calon.kec') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Kabupaten/Kota</label>
                                                @if ($calon==null)
                                                <select name="calon[kab]" class="form-select">
                                                    <option {{ old('calon.kab')==''?'selected':'' }} value=""></option>
                                                    <option {{ old('calon.kab')=='Mojokerto'?'selected':'' }} value="Mojokerto">Mojokerto</option>
                                                    <option {{ old('calon.kab')=='Jombang'?'selected':'' }} value="Jombang">Jombang</option>
                                                    <option {{ old('calon.kab')=='Kediri'?'selected':'' }} value="Kediri">Kediri</option>
                                                    <option {{ old('calon.kab')=='Lamongan'?'selected':'' }} value="Lamongan">Lamongan</option>
                                                    <option {{ old('calon.kab')=='Tuban'?'selected':'' }} value="Tuban">Tuban</option>
                                                    <option {{ old('calon.kab')=='Bojonegoro'?'selected':'' }} value="Bojonegoro">Bojonegoro</option>
                                                </select>
                                                @else
                                                <select name="calon[kab]" class="form-select">
                                                    <option value=""></option>
                                                    <option {{ $calon->kab=='Mojokerto'?'selected':'' }} value="Mojokerto">Mojokerto</option>
                                                    <option {{ $calon->kab=='Jombang'?'selected':'' }} value="Jombang">Jombang</option>
                                                    <option {{ $calon->kab=='Kediri'?'selected':'' }} value="Kediri">Kediri</option>
                                                    <option {{ $calon->kab=='Lamongan'?'selected':'' }} value="Lamongan">Lamongan</option>
                                                    <option {{ $calon->kab=='Tuban'?'selected':'' }} value="Tuban">Tuban</option>
                                                    <option {{ $calon->kab=='Bojonegoro'?'selected':'' }} value="Bojonegoro">Bojonegoro</option>
                                                </select>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <label>No telphone</label>
                                                <input type="number" onkeypress="return this.value.length < 15;" oninput="if(this.value.length>=15) { this.value = this.value.slice(0,15); }" name="calon[telp]" class="form-control" value="{{ $calon!=null?$calon->telp :old('calon.telp') }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Daftar ke</label>
                                                <input type="number" name="calon[daftar_ke]" class="form-control" value="{{ $calon!=null?$calon->daftar_ke :old('calon.daftar_ke') }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Aspek tidak lulus</label>
                                                <input type="text" name="calon[aspek_tl]" class="form-control" value="{{ $calon!=null?$calon->aspek_tl :old('calon.aspek_tl') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Prestasi tingkat provinsi</label>
                                                <input type="text" name="calon[prestasi_provinsi]" class="form-control" value="{{ $calon!=null?$calon->prestasi_provinsi :old('calon.prestasi_provinsi') }}">
                                            </div>
                                            <div class="col">
                                                <label>Prestasi tingkat nasional/internasional</label>
                                                <input type="text" name="calon[prestasi_nasional]" class="form-control" value="{{ $calon!=null?$calon->prestasi_nasional :old('calon.prestasi_nasional') }}">
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
                                            <div class="col-lg-4 col-6 col-md-3">
                                                <label>SD</label>
                                                @error('pendidikan.sd')
                                                <div>
                                                    <strong class="text-danger small">SD tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input type="text" @error('pendidikan.sd') autofocus @enderror name="pendidikan[sd]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->sd : old('pendidikan.sd') }}">
                                            </div>
                                            <div class="col-lg-4 col-6 col-md-3">
                                                <label>Tahun lulus SD</label>
                                                @error('pendidikan.l_sd')
                                                <div>
                                                    <strong class="text-danger small">Tahun lulus SD tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input @error('pendidikan.l_sd') autofocus @enderror onkeypress="return this.value.length < 4;" oninput="if(this.value.length>=4) { this.value = this.value.slice(0,4); }" type="number" name="pendidikan[l_sd]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->l_sd : old('pendidikan.l_sd') }}">
                                            </div>
                                            <div class="col-lg-4 col-6 col-md-3">
                                                <label>Kab/Kota Lulus SD</label>
                                                @error('pendidikan.kab_sd')
                                                <div>
                                                    <strong class="text-danger small">Kab/Kota tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input type="text" @error('pendidikan.kab_sd') autofocus @enderror name="pendidikan[kab_sd]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->kab_sd : old('pendidikan.kab_sd') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4 col-6 col-md-3">
                                                <label>SMP</label>
                                                @error('pendidikan.smp')
                                                <div>
                                                    <strong class="text-danger small">SMP tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input type="text" @error('pendidikan.smp') autofocus @enderror name="pendidikan[smp]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->smp : old('pendidikan.smp') }}">
                                            </div>
                                            <div class="col-lg-4 col-6 col-md-3">
                                                <label>Tahun lulus SMP</label>
                                                @error('pendidikan.l_smp')
                                                <div>
                                                    <strong class="text-danger small">Tahun lulus SMP tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input @error('pendidikan.l_smp') autofocus @enderror onkeypress="return this.value.length < 4;" oninput="if(this.value.length>=4) { this.value = this.value.slice(0,4); }" type="number" name="pendidikan[l_smp]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->l_smp : old('pendidikan.l_smp') }}">
                                            </div>
                                            <div class="col-lg-4 col-6 col-md-3">
                                                <label>Kab/Kota Lulus SMP</label>
                                                @error('pendidikan.kab_smp')
                                                <div>
                                                    <strong class="text-danger small">Kab/Kota tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input type="text" @error('pendidikan.kab_smp') autofocus @enderror name="pendidikan[kab_smp]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->kab_smp : old('pendidikan.kab_smp') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm">
                                                <label>SMA</label>
                                                @error('pendidikan.sma')
                                                <div>
                                                    <strong class="text-danger small">SMA tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input type="text" @error('pendidikan.sma') autofocus @enderror name="pendidikan[sma]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->sma : Auth::guard('calon')->user()->nama_sekolah }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Jurusan</label>
                                                @error('pendidikan.jur')
                                                <div>
                                                    <strong class="text-danger small">Jurusan tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input type="text" name="pendidikan[jur]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->jur :  Auth::guard('calon')->user()->jur }}">
                                            </div>
                                            <div class="col-lg-3 col-6 col-md-3">
                                                <label>Kab/Kota Lulus SMA</label>
                                                @error('pendidikan.kab_sma')
                                                <div>
                                                    <strong class="text-danger small">Kab/Kota tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input type="text" @error('pendidikan.kab_sma') autofocus @enderror name="pendidikan[kab_sma]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->kab_sma : old('pendidikan[kab_sma]') }}">
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Tahun lulus SMA</label>
                                                @error('pendidikan.l_sma')
                                                <div>
                                                    <strong class="text-danger small">Tahun lulus tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <select name="pendidikan[l_sma]" class="form-select" id="lulus">
                                                    @if ($pendidikan==null)
                                                    <option {{ old('pendidikan.l_sma')=='0'?'selected':'' }} value="0"></option>
                                                    <option {{ old('pendidikan.l_sma')=='2017'?'selected':'' }} value="2017">2017</option>
                                                    <option {{ old('pendidikan.l_sma')=='2018'?'selected':'' }} value="2018">2018</option>
                                                    <option {{ old('pendidikan.l_sma')=='2019'?'selected':'' }} value="2019">2019</option>
                                                    <option {{ old('pendidikan.l_sma')=='2020'?'selected':'' }} value="2020">2020</option>
                                                    <option {{ old('pendidikan.l_sma')=='2021'?'selected':'' }} value="2021"> 2021</option>
                                                    @else
                                                        @if ($pendidikan->l_sma<=2019)
                                                        <option {{ $pendidikan->l_sma==2017?'selected':'' }} value="2017">2017</option>
                                                        <option {{ $pendidikan->l_sma==2018?'selected':'' }} value="2018">2018</option>
                                                        <option {{ $pendidikan->l_sma==2019?'selected':'' }} value="2019">2019</option>
                                                        @else
                                                        <option {{ $pendidikan->l_sma==2020?'selected':'' }} value="2020">2020</option>
                                                        <option {{ $pendidikan->l_sma==2021?'selected':'' }} value="2021"> 2021</option>
                                                        @endif                                                        
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                            @include('calon.nilai2020')
                                            @include('calon.nilai2019')
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
                                        <h2>Data Orang Tua</h2>
                                        <div class="form-group row">
                                            <div class="col-lg col-6">
                                                <label>Nama ayah</label>
                                                @error('wali.ayah')
                                                <div>
                                                    <strong class="text-danger small">Nama Ayah tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input type="text" name="wali[ayah]" class="form-control" value="{{ $wali!=null?$wali->ayah : Auth::guard('calon')->user()->ortu1 }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Kerja ayah</label>
                                                @error('wali.a_kerja')
                                                <div>
                                                    <strong class="text-danger small">Kerja Ayah tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input type="text" name="wali[a_kerja]" class="form-control" value="{{ $wali!=null?$wali->a_kerja :  Auth::guard('calon')->user()->kerja }}">
                                            </div>
                                            <div class="col-lg col-3">
                                                <label>Ayah seorang TNI AD</label><br>
                                                <label>
                                                    <input type="radio" value="true" name="jab_a"> Iya
                                                </label>
                                                <label class="ml-4">
                                                    <input type="radio" value="false" checked name="jab_a"> Tidak
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="jab_a">
                                            <div class="col-lg col-6">
                                                <label>Pangkat ayah</label>
                                                <input type="text" name="wali[a_pkt]" class="form-control" value="{{ $wali!=null?$wali->a_pkt : old('wali.a_pkt') }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Jabatan ayah</label>
                                                <input type="text" name="wali[a_jab]" class="form-control" value="{{ $wali!=null?$wali->a_jab : old('wali.a_jab') }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Satuan</label>
                                                <input type="text" name="wali[a_sat]" class="form-control" value="{{ $wali!=null?$wali->a_sat : old('wali.a_sat') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg col-6">
                                                <label>Nama ibu</label>
                                                @error('wali.ibu')
                                                <div>
                                                    <strong class="text-danger small">Nama Ibu tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input type="text" name="wali[ibu]" class="form-control" value="{{ $wali!=null?$wali->ibu : old('wali.ibu') }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Kerja ibu</label>
                                                @error('wali.i_kerja')
                                                <div>
                                                    <strong class="text-danger small">Kerja Ibu tidak boleh kosong</strong>
                                                </div>
                                                @enderror
                                                <input type="text" name="wali[i_kerja]" class="form-control" value="{{ $wali!=null?$wali->i_kerja : old('wali.i_kerja') }}">
                                            </div>
                                            <div class="col-lg col-3">
                                                <label>Ibu seorang TNI AD</label><br>
                                                <label>
                                                    <input type="radio" value="true" name="jab_i"> Iya
                                                </label>
                                                <label class="ml-4">
                                                    <input type="radio" value="false" checked name="jab_i"> Tidak
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="jab_i">
                                            <div class="col-lg col-6">
                                                <label>Pangkat ibu</label>
                                                <input type="text" name="wali[i_pkt]" class="form-control" value="{{ $wali!=null?$wali->i_pkt : old('wali.i_pkt') }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Jabatan ibu</label>
                                                <input type="text" name="wali[i_jab]" class="form-control" value="{{ $wali!=null?$wali->i_jab : old('wali.i_jab') }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Satuan</label>
                                                <input type="text" name="wali[i_sat]" class="form-control" value="{{ $wali!=null?$wali->i_sat : old('wali.i_sat') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label>Telphone orang tua</label>
                                                <input type="number" onkeypress="return this.value.length < 15;" oninput="if(this.value.length>=15) { this.value = this.value.slice(0,15); }" name="wali[o_telp]" class="form-control" value="{{ $wali!=null?$wali->o_telp : old('wali.o_telp') }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Alamat orang tua</label>
                                                <input type="text" name="wali[o_alamat]" class="form-control" value="{{ $wali!=null?$wali->o_alamat : Auth::guard('calon')->user()->alamat_o }}">
                                            </div>
                                        </div>
                                        <h2>Tiri/wali/Perwalian/Numpang Alamat</h2>
                                        <div class="form-group row">
                                            <div class="col-lg col-6">
                                                <label>Nama ayah</label>
                                                <input type="text" name="wali[wali_ayah]" class="form-control" value="{{ $wali!=null?$wali->wali_ayah : old('wali.wali_ayah') }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Kerja ayah</label>
                                                <input type="text" name="wali[wa_kerja]" class="form-control" value="{{ $wali!=null?$wali->wa_kerja : old('wali.wa_kerja') }}">
                                            </div>
                                            <div class="col-lg col-3">
                                                <label>Wali ayah seorang TNI AD</label><br>
                                                <label>
                                                    <input type="radio" value="true" name="jab_wa"> Iya
                                                </label>
                                                <label class="ml-4">
                                                    <input type="radio" value="false" checked name="jab_wa"> Tidak
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="jab_wa">
                                            <div class="col-lg col-6">
                                                <label>Pangkat ayah</label>
                                                <input type="text" name="wali[wa_pkt]" class="form-control" value="{{ $wali!=null?$wali->wa_pkt : old('wali.wa_pkt') }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Jabatan ayah</label>
                                                <input type="text" name="wali[wa_jab]" class="form-control" value="{{ $wali!=null?$wali->wa_jab : old('wali.wa_jab') }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Satuan</label>
                                                <input type="text" name="wali[wa_sat]" class="form-control" value="{{ $wali!=null?$wali->wa_sat : old('wali.wa_sat') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg col-6">
                                                <label>Nama ibu</label>
                                                <input type="text" name="wali[wali_ibu]" class="form-control" value="{{ $wali!=null?$wali->wali_ibu : old('wali.wali_ibu') }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Kerja ibu</label>
                                                <input type="text" name="wali[wi_kerja]" class="form-control" value="{{ $wali!=null?$wali->wi_kerja : old('wali.wi_kerja') }}">
                                            </div>
                                            <div class="col-lg col-3">
                                                <label>Wali Ibu seorang TNI AD</label><br>
                                                <label>
                                                    <input type="radio" value="true" name="jab_wi"> Iya
                                                </label>
                                                <label class="ml-4">
                                                    <input type="radio" value="false" checked name="jab_wi"> Tidak
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="jab_wi">
                                            <div class="col-lg col-6">
                                                <label>Pangkat ibu</label>
                                                <input type="text" name="wali[wi_pkt]" class="form-control" value="{{ $wali!=null?$wali->wi_pkt : old('wali.wi_pkt') }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Jabatan ibu</label>
                                                <input type="text" name="wali[wi_jab]" class="form-control" value="{{ $wali!=null?$wali->wi_jab : old('wali.wi_jab') }}">
                                            </div>
                                            <div class="col-lg col-6">
                                                <label>Satuan</label>
                                                <input type="text" name="wali[wi_sat]" class="form-control" value="{{ $wali!=null?$wali->wi_sat : old('wali.wi_sat') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label>Telphone wali</label>
                                                <input type="text" onkeypress="return this.value.length < 15;" oninput="if(this.value.length>=15) { this.value = this.value.slice(0,15); }" name="wali[w_telp]" class="form-control" value="{{ $wali!=null?$wali->w_telp : old('wali.w_telp') }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Alamat wali</label>
                                                <input type="text" name="wali[w_alamat]" class="form-control" value="{{ $wali!=null?$wali->w_alamat : old('wali.w_alamat') }}">
                                            </div>
                                            <div class="col-sm">
                                                <label>Hubungan wali</label>
                                                <select name="wali[status_wali]" class="form-select">
                                                    @if ($wali!=null)
                                                        <option value="0"></option>
                                                        <option {{ $wali->status_wali==1?'selected':'' }} value="1">Wali</option>
                                                        <option {{ $wali->status_wali==2?'selected':'' }} value="2">Tiri</option>
                                                        <option {{ $wali->status_wali==3?'selected':'' }} value="3">Perwalian</option>
                                                        <option {{ $wali->status_wali==4?'selected':'' }} value="4">Numpang alamat</option>
                                                    @else
                                                        <option {{ old('wali.status_wali')=='0'?'selected':'' }} value="0"></option>
                                                        <option {{ old('wali.status_wali')=='1'?'selected':'' }} value="1">Wali</option>
                                                        <option {{ old('wali.status_wali')=='2'?'selected':'' }} value="2">Tiri</option>
                                                        <option {{ old('wali.status_wali')=='3'?'selected':'' }} value="3">Perwalian</option>
                                                        <option {{ old('wali.status_wali')=='4'?'selected':'' }} value="4">Numpang alamat</option>
                                                    @endif
                                                </select>
                                            </div>
                                            {{-- <div class="col-sm">
                                                <label>Hubungan wali</label>
                                                <select name="wali[hub_calon_wali]" class="form-select">
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                </select>
                                                <input type="text" name="wali[hub_calon_wali]" class="form-control" value="{{ $wali!=null?$wali->hub_calon_wali : old('') }}">
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="mx-2 btn btn-success my-3"><i class="fas fa-save"></i> {{ $status==0?'Simpan':'Update' }} data</button>
                            @if ($status==1)
                                <a href="{{ route('calon.pdf') }}" class="mx-2 btn btn-info my-3"><i class="fas fa-save"></i> PDF</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($pendidikan==null)
        <script>
            var val = {!! json_encode(old('pendidikan.l_sma')) !!}
            if (val==null) {
                $('#tg-HMKiy').hide();
                $('#2019').hide();
            }else{
                val = parseInt(val);
                if (val<=2019) {
                    $('#tg-HMKiy').hide();
                    $('#2019').show();
                } else if(val>=2020) {
                    $('#2019').hide();
                    $('#tg-HMKiy').show();
                }else{
                    $('#tg-HMKiy').hide();
                    $('#2019').hide();
                }
            }
        </script>
    @else
        <script>
            var val = {!! json_encode($pendidikan->l_sma) !!}
            val = parseInt(val);
            if (val<=2019) {
                $('#tg-HMKiy').hide();
                $('#2019').show();
            } else if(val>=2020) {
                $('#2019').hide();
                $('#tg-HMKiy').show();
            }else{
                $('#tg-HMKiy').hide();
                $('#2019').hide();
            }
        </script>
    @endif
@endsection

@section('script')
<script src="{{ asset('js/umur.js') }}"></script>
    <script>
        $('#lulus').change(function (e) {
            $('#tg-HMKiy').hide();
            $('#2019').hide();
            var val = $(this).val();
            val = parseInt(val);
            if (val<=2019 && val>0) {
                $('#tg-HMKiy').hide();
                $('#2019').show();
            } else if(val>=2020) {
                $('#2019').hide();
                $('#tg-HMKiy').show();
            }else{
                console.log('nil');
                $('#tg-HMKiy').hide();
                $('#2019').hide();
            }
        });

        $('#lhr').change(function (e) {
            var lhr = $(this).val();
            var dik = $('#dik').val();
            var result = ageCalculator(lhr,dik);
            $('#umr').val(result[0]);
            var date = result[1];
            var a = ageValidation(date);
            $('#ket-umr').val(a);
            console.log(date.years);
            $('#u_thn').val(date.years);
            $('#u_bln').val(date.months);
            $('#u_hri').val(date.days);
        });

        $('#jab_a').hide();
        $('#jab_i').hide();
        $('#jab_wa').hide();
        $('#jab_wi').hide();

        $('input[name=jab_a]').change(function () {
            var val = $(this).val();
            if(val=='true'){
                $('#jab_a').show();
            }else{
                $('#jab_a').hide();
            }
        });
        $('input[name=jab_wa]').change(function () {
            var val = $(this).val();
            if(val=='true'){
                $('#jab_wa').show();
            }else{
                $('#jab_wa').hide();
            }
        });
        $('input[name=jab_i]').change(function () {
            var val = $(this).val();
            if(val=='true'){
                $('#jab_i').show();
            }else{
                $('#jab_i').hide();
            }
        });
        $('input[name=jab_wi]').change(function () {
            var val = $(this).val();
            if(val=='true'){
                $('#jab_wi').show();
            }else{
                $('#jab_wi').hide();
            }
        });
    </script>

@endsection

