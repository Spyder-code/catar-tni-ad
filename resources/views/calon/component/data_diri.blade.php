<div class="form-group row">
    <div class="col-12 col-md-6">
        <label>No online</label>
        @error('calon.no_online')
            <div>
                <strong class="text-danger small">Nomor Online tidak boleh kosong dan mengandung tanda petik(')</strong>
            </div>
        @enderror
        <input @error('calon.no_online') autofocus @enderror type="text" style="text-transform: uppercase" name="calon[no_online]" class="form-control" readonly value="{{ Auth::guard('calon')->user()->no_online }}">
    </div>
</div>
<div class="form-group row">
    <div class="col-sm">
        <label>Nama</label>
        @error('calon.nama')
            <div>
                <strong class="text-danger small">Nama tidak boleh kosong dan mengandung tanda petik(')</strong>
            </div>
        @enderror
        <input @error('calon.nama') autofocus @enderror type="text" style="text-transform: uppercase" name="calon[nama]" class="form-control validate-symbol" readonly value="{{ Auth::guard('calon')->user()->nama }}">
    </div>
    <div class="col-sm">
        <label>No. Kartu Keluarga</label>
        @error('calon.no_kk')
            <div>
                <strong class="text-danger small">No.Kartu Keluarga tidak boleh kosong dan mengandung tanda petik(')</strong>
            </div>
        @enderror
        <input @error('calon.no_kk') autofocus @enderror type="text" style="text-transform: uppercase" name="calon[no_kk]" class="form-control" onkeypress="return this.value.length < 18;" oninput="if(this.value.length>=18) { this.value = this.value.slice(0,18); }" value="{{ $calon!=null?$calon->no_kk : old('calon.no_kk') }}">
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
                <strong class="text-danger small">Tempat lahir tidak boleh kosong dan mengandung tanda petik(')</strong>
            </div>
        @enderror
        <input @error('calon.tem_lahir') autofocus @enderror type="text" style="text-transform: uppercase" name="calon[tem_lahir]" class="form-control validate-symbol" readonly value="{{ Auth::guard('calon')->user()->tem_lahir }}">
    </div>
    <div class="col-sm">
        <label>Tanggal lahir <small>(YYYY-MM-DD)</small></label>
        @error('calon.tgl_lahir')
        <div>
            <strong class="text-danger small">Tanggal lahir tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
    @enderror
        <input @error('calon.tgl_lahir') autofocus @enderror type="date" id="lhr" name="calon[tgl_lahir]" min="1999-01-01" max="2005-12-30" class="form-control" value="{{ $calon!=null?$calon->tgl_lahir : old('calon.tgl_lahir') }}">
    </div>
    <div class="col-sm">
        <label>DIK</label>
        <input type="date" id="dik" name="calon[dik]" readonly class="form-control" value="{{ $dik }}">
    </div>
</div>
@if ($setting->lihat_umur==1)
<div class="form-group row">
    <div class="col-sm">
        <label>Umur</label>
        <input type="text" style="text-transform: uppercase" value="{{ $calon!=null?$calon->umr :old('calon.umr') }}" id="umr" name="calon[umr]" readonly class="form-control" >
    </div>
    <div class="col-4">
        <label>Hari</label>
        <input type="text" style="text-transform: uppercase" readonly value="{{ $calon!=null?$calon->u_hri :old('calon.u_hri')}}" id="u_hri" name="calon[u_hri]" class="form-control" >
    </div>
    <div class="col-4">
        <label>Bulan</label>
        <input type="text" style="text-transform: uppercase" readonly value="{{ $calon!=null?$calon->u_bln :old('calon.u_bln')}}" id="u_bln" name="calon[u_bln]" class="form-control" >
    </div>
    <div class="col-4">
        <label>Tahun</label>
        <input type="text" style="text-transform: uppercase" readonly value="{{ $calon!=null?$calon->u_thn :old('calon.u_thn')}}" id="u_thn" name="calon[u_thn]" class="form-control" >
    </div>
    <div class="col-sm">
        <label>Keterangan Umur</label>
        <input type="text" style="text-transform: uppercase" value="{{ $calon!=null?$calon->ket_umr :old('calon.ket_umr') }}" id="ket-umr" name="calon[ket_umr]" readonly class="form-control" >
    </div>
</div>
@else
<div class="form-group row">
    <input type="hidden" style="text-transform: uppercase" value="{{ $calon!=null?$calon->umr :old('calon.umr') }}" id="umr" name="calon[umr]" readonly class="form-control" >
    <input type="hidden" style="text-transform: uppercase" readonly value="{{ $calon!=null?$calon->u_hri :old('calon.u_hri')}}" id="u_hri" name="calon[u_hri]" class="form-control" >
    <input type="hidden" style="text-transform: uppercase" readonly value="{{ $calon!=null?$calon->u_thn :old('calon.u_thn')}}" id="u_thn" name="calon[u_thn]" class="form-control" >
    <input type="hidden" style="text-transform: uppercase" value="{{ $calon!=null?$calon->ket_umr :old('calon.ket_umr') }}" id="ket-umr" name="calon[ket_umr]" readonly class="form-control" >
    <input type="hidden" style="text-transform: uppercase" readonly value="{{ $calon!=null?$calon->u_bln :old('calon.u_bln')}}" id="u_bln" name="calon[u_bln]" class="form-control" >
</div>
@endif
<div class="form-group row">
    <div class="col-sm">
        <label>Suku</label>
        @error('calon.suku')
        <div>
            <strong class="text-danger small">Suku tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
    @enderror
        <input @error('calon.suku') autofocus @enderror type="text" style="text-transform: uppercase" name="calon[suku]" class="form-control validate-symbol" readonly value="{{ Auth::guard('calon')->user()->suku }}">
    </div>
    <div class="col-sm">
        <label>Agama</label>
        @error('calon.agama')
        <div>
            <strong class="text-danger small">Agama tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input @error('calon.agama') autofocus @enderror type="text" style="text-transform: uppercase" name="calon[agama]" class="form-control validate-symbol" readonly value="{{ Auth::guard('calon')->user()->agama }}">
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-8">
        <label>Jalan</label>
        @error('calon.alamat')
        <div>
            <strong class="text-danger small">Jalan tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input @error('calon.alamat') autofocus @enderror type="text" style="text-transform: uppercase" name="calon[alamat]" class="form-control validate-symbol" value="{{ $calon!=null?stripcslashes($calon->alamat) : old('calon.alamat')}}">
    </div>
    <div class="col">
        <label>RT</label>
        @error('calon.rt')
        <div>
            <strong class="text-danger small">RT tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="number" onkeypress="return this.value.length < 3;" oninput="if(this.value.length>=3) { this.value = this.value.slice(0,3); }" name="calon[rt]" class="form-control" value="{{ $calon!=null?$calon->rt :old('calon.rt') }}">
    </div>
    <div class="col">
        <label>RW</label>
        @error('calon.rw')
        <div>
            <strong class="text-danger small">RW tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="number" onkeypress="return this.value.length < 3;" oninput="if(this.value.length>=3) { this.value = this.value.slice(0,3); }" name="calon[rw]" class="form-control" value="{{ $calon!=null?$calon->rw :old('calon.rw') }}">
    </div>
    <div class="col">
        <label>No rumah</label>
        @error('calon.no')
        <div>
            <strong class="text-danger small">No rumah tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="calon[no]" class="form-control" value="{{ $calon!=null?$calon->no :old('calon.no') }}">
    </div>
</div>
<div class="form-group row">
    <div class="col">
        <label>Dusun</label>
        @error('calon.dsn')
        <div>
            <strong class="text-danger small">Dusun tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="calon[dsn]" class="form-control validate-symbol" value="{{ $calon!=null?stripcslashes($calon->dsn) :old('calon.dsn') }}">
    </div>
    <div class="col-sm">
        <label>Desa</label>
        @error('calon.ds')
        <div>
            <strong class="text-danger small">Desa tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="calon[ds]" class="form-control validate-symbol" value="{{ $calon!=null?stripcslashes($calon->ds) :old('calon.ds') }}">
    </div>
    <div class="col">
        <label>Kecamatan</label>
        @error('calon.kec')
        <div>
            <strong class="text-danger small">Kecamatan tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="calon[kec]" class="form-control validate-symbol" value="{{ $calon!=null?stripcslashes($calon->kec) :old('calon.kec') }}">
    </div>
    <div class="col">
        <label>Kabupaten/Kota</label>
        @error('calon.kab')
        <div>
            <strong class="text-danger small">Kabupaten/Kota tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
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
</div>
<div class="form-group row">
    <div class="col">
        <label>No telphone</label>
        @error('calon.telp')
        <div>
            <strong class="text-danger small">No telephone tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="number" onkeypress="return this.value.length < 15;" oninput="if(this.value.length>=15) { this.value = this.value.slice(0,15); }" name="calon[telp]" class="form-control" value="{{ $calon!=null?$calon->telp :old('calon.telp') }}">
    </div>
    <div class="col-sm">
        <label>Daftar ke</label>
        @error('calon.daftar_ke')
        <div>
            <strong class="text-danger small">Daftar Ke- tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="number" name="calon[daftar_ke]" class="form-control" value="{{ $calon!=null?$calon->daftar_ke :old('calon.daftar_ke') }}">
    </div>
    <div class="col-sm">
        <label>Aspek tidak lulus</label>
        @error('calon.aspek_tl')
        <div>
            <strong class="text-danger small">Aspek tidak lulus tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="calon[aspek_tl]" class="form-control validate-symbol" value="{{ $calon!=null?stripcslashes($calon->aspek_tl) :old('calon.aspek_tl') }}">
    </div>
    <div class="col-sm">
        <label>Keahlian</label>
        @error('calon.keahlian')
        <div>
            <strong class="text-danger small">Keahlian tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="calon[keahlian]" class="form-control validate-symbol" value="{{ $calon!=null?stripcslashes($calon->keahlian) :old('calon.keahlian') }}">
    </div>
</div>
<div class="form-group row">
    <div class="col">
        <label>Prestasi tingkat provinsi/nasional/internasional</label>
        <input type="text" style="text-transform: uppercase" name="calon[prestasi_provinsi]" class="form-control validate-symbol" value="{{ $calon!=null?$calon->prestasi_provinsi :old('calon.prestasi_provinsi') }}">
    </div>
    <div class="col">
        <label>Email</label>
        <input type="text" style="text-transform: uppercase" name="calon[prestasi_nasional]" class="form-control validate-symbol" value="{{ $calon!=null?$calon->prestasi_nasional :old('calon.prestasi_nasional') }}">
    </div>
</div>
