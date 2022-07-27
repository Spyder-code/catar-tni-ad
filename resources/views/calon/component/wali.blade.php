<h2>Data Orang Tua</h2>
<div class="form-group row">
    <div class="col-lg-6 col-md-6 col-12">
        <label>Nama ayah</label>
        @error('wali.ayah')
        <div>
            <strong class="text-danger small">Nama Ayah tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[ayah]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->ayah) : Auth::guard('calon')->user()->ortu1 }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Nama Kakek dari Ayah</label>
        @error('wali.a_kakek')
        <div>
            <strong class="text-danger small">Nama Kakek dari Ayah tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[a_kakek]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->a_kakek) :  old('wali.a_kakek') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Alamat Kakek dari Ayah Sekarang</label>
        @error('wali.a_kakek_almt_skr')
        <div>
            <strong class="text-danger small">Alamat Kakek dari Ayah Sekarang tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[a_kakek_almt_skr]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->a_kakek_almt_skr) :  old('wali.a_kakek_almt_skr') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Alamat Kakek dari Ayah Sebelumnya</label>
        @error('wali.a_kakek_almt_sblm')
        <div>
            <strong class="text-danger small">Alamat Kakek dari Ayah Sebelumnya tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[a_kakek_almt_sblm]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->a_kakek_almt_sblm) :  old('wali.a_kakek_almt_sblm') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Nama Nenek dari Ayah</label>
        @error('wali.a_nenek')
        <div>
            <strong class="text-danger small">Nama Kakek dari Ayah tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[a_nenek]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->a_nenek) :  old('wali.a_nenek') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Alamat Nenek dari Ayah Sekarang</label>
        @error('wali.a_nenek_almt_skr')
        <div>
            <strong class="text-danger small">Alamat Nenek dari Ayah Sekarang tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[a_nenek_almt_skr]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->a_nenek_almt_skr) :  old('wali.a_nenek_almt_skr') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Alamat Nenek dari Ayah Sebelumnya</label>
        @error('wali.a_nenek_almt_sblm')
        <div>
            <strong class="text-danger small">Alamat Nenek dari Ayah Sebelumnya tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[a_nenek_almt_sblm]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->a_nenek_almt_sblm) :  old('wali.a_nenek_almt_sblm') }}">
    </div>
</div>
<div class="form-group row">
    <div class="col-lg-6 col-md-6 col-12">
        <label>Kerja ayah</label>
        @error('wali.a_kerja')
        <div>
            <strong class="text-danger small">Kerja Ayah tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[a_kerja]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->a_kerja) :  Auth::guard('calon')->user()->kerja }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
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
    <div class="col-lg-6 col-md-6 col-12">
        <label>Pangkat ayah</label>
        <input type="text" style="text-transform: uppercase" name="wali[a_pkt]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->a_pkt) : old('wali.a_pkt') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Jabatan ayah</label>
        <input type="text" style="text-transform: uppercase" name="wali[a_jab]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->a_jab) : old('wali.a_jab') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Satuan</label>
        <input type="text" style="text-transform: uppercase" name="wali[a_sat]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->a_sat) : old('wali.a_sat') }}">
    </div>
</div>
<div class="form-group row">
    <div class="col-lg-6 col-md-6 col-12">
        <label>Nama ibu</label>
        @error('wali.ibu')
        <div>
            <strong class="text-danger small">Nama Ibu tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[ibu]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->ibu) : old('wali.ibu') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Nama Kakek dari Ibu</label>
        @error('wali.i_kakek')
        <div>
            <strong class="text-danger small">Nama Kakek dari Ibu tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[i_kakek]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->i_kakek) : old('wali.i_kakek') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Alamat Kakek dari Ibu Sekarang</label>
        @error('wali.i_kakek_almt_skr')
        <div>
            <strong class="text-danger small">Alamat Kakek dari Ibu Sekarang tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[i_kakek_almt_skr]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->i_kakek_almt_skr) :  old('wali.i_kakek_almt_skr') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Alamat Kakek dari Ibu Sebelumnya</label>
        @error('wali.i_kakek_almt_sblm')
        <div>
            <strong class="text-danger small">Alamat Kakek dari Ibu Sebelumnya tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[i_kakek_almt_sblm]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->i_kakek_almt_sblm) :  old('wali.i_kakek_almt_sblm') }}">
    </div>
    <div class="col-lg-6 col-md-3 col-12">
        <label>Nama Nenek dari Ibu</label>
        @error('wali.i_nenek')
        <div>
            <strong class="text-danger small">Nama Kakek dari Ibu tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[i_nenek]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->i_nenek) : old('wali.i_nenek') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Alamat Nenek dari Ibu Sekarang</label>
        @error('wali.i_nenek_almt_skr')
        <div>
            <strong class="text-danger small">Alamat Nenek dari Ibu Sekarang tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[i_nenek_almt_skr]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->i_nenek_almt_skr) :  old('wali.i_nenek_almt_skr') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Alamat Nenek dari Ibu Sebelumnya</label>
        @error('wali.i_nenek_almt_sblm')
        <div>
            <strong class="text-danger small">Alamat Nenek dari Ibu Sebelumnya tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[i_nenek_almt_sblm]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->i_nenek_almt_sblm) :  old('wali.i_nenek_almt_sblm') }}">
    </div>
</div>
<div class="form-group row">
    <div class="col-lg-6 col-md-6 col-12">
        <label>Kerja ibu</label>
        @error('wali.i_kerja')
        <div>
            <strong class="text-danger small">Kerja Ibu tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[i_kerja]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->i_kerja) : old('wali.i_kerja') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
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
    <div class="col-lg-6 col-md-6 col-12">
        <label>Pangkat ibu</label>
        <input type="text" style="text-transform: uppercase" name="wali[i_pkt]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->i_pkt) : old('wali.i_pkt') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Jabatan ibu</label>
        <input type="text" style="text-transform: uppercase" name="wali[i_jab]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->i_jab) : old('wali.i_jab') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Satuan</label>
        <input type="text" style="text-transform: uppercase" name="wali[i_sat]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->i_sat) : old('wali.i_sat') }}">
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <label>Telphone orang tua</label>
        @error('wali.o_telp')
        <div>
            <strong class="text-danger small">Telphone tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="number" onkeypress="return this.value.length < 15;" oninput="if(this.value.length>=15) { this.value = this.value.slice(0,15); }" name="wali[o_telp]" class="form-control" value="{{ $wali!=null?$wali->o_telp : old('wali.o_telp') }}">
    </div>
    <div class="col-sm">
        <label>Alamat orang tua</label>
        @error('wali.o_alamat')
        <div>
            <strong class="text-danger small">Alamat tidak boleh kosong dan mengandung tanda petik(')</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="wali[o_alamat]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->o_alamat) : Auth::guard('calon')->user()->alamat_o }}">
    </div>
</div>
<h2>Tiri/wali/Perwalian/Numpang Alamat</h2>
<div class="form-group row">
    <div class="col-lg-6 col-md-6 col-12">
        <label>Nama ayah</label>
        <input type="text" style="text-transform: uppercase" name="wali[wali_ayah]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->wali_ayah) : old('wali.wali_ayah') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Kerja ayah</label>
        <input type="text" style="text-transform: uppercase" name="wali[wa_kerja]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->wa_kerja) : old('wali.wa_kerja') }}">
    </div>
    <div class="col-lg-6 col-md-3 col-12">
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
    <div class="col-lg-6 col-md-6 col-12">
        <label>Pangkat ayah</label>
        <input type="text" style="text-transform: uppercase" name="wali[wa_pkt]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->wa_pkt) : old('wali.wa_pkt') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Jabatan ayah</label>
        <input type="text" style="text-transform: uppercase" name="wali[wa_jab]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->wa_jab) : old('wali.wa_jab') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Satuan</label>
        <input type="text" style="text-transform: uppercase" name="wali[wa_sat]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->wa_sat) : old('wali.wa_sat') }}">
    </div>
</div>
<div class="form-group row">
    <div class="col-lg-6 col-md-6 col-12">
        <label>Nama ibu</label>
        <input type="text" style="text-transform: uppercase" name="wali[wali_ibu]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->wali_ibu) : old('wali.wali_ibu') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Kerja ibu</label>
        <input type="text" style="text-transform: uppercase" name="wali[wi_kerja]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->wi_kerja) : old('wali.wi_kerja') }}">
    </div>
    <div class="col-lg-6 col-md-3 col-12">
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
    <div class="col-lg-6 col-md-6 col-12">
        <label>Pangkat ibu</label>
        <input type="text" style="text-transform: uppercase" name="wali[wi_pkt]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->wi_pkt) : old('wali.wi_pkt') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Jabatan ibu</label>
        <input type="text" style="text-transform: uppercase" name="wali[wi_jab]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->wi_jab) : old('wali.wi_jab') }}">
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <label>Satuan</label>
        <input type="text" style="text-transform: uppercase" name="wali[wi_sat]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->wi_sat) : old('wali.wi_sat') }}">
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <label>Telphone wali</label>
        <input type="text" style="text-transform: uppercase" onkeypress="return this.value.length < 15;" oninput="if(this.value.length>=15) { this.value = this.value.slice(0,15); }" name="wali[w_telp]" class="form-control" value="{{ $wali!=null?$wali->w_telp : old('wali.w_telp') }}">
    </div>
    <div class="col-sm">
        <label>Alamat wali</label>
        <input type="text" style="text-transform: uppercase" name="wali[w_alamat]" class="form-control validate-symbol" value="{{ $wali!=null?stripcslashes($wali->w_alamat) : old('wali.w_alamat') }}">
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
                <option {{ old('wali.status_wali')==0?'selected':'' }} value="0"></option>
                <option {{ old('wali.status_wali')==1?'selected':'' }} value="1">Wali</option>
                <option {{ old('wali.status_wali')==2?'selected':'' }} value="2">Tiri</option>
                <option {{ old('wali.status_wali')==3?'selected':'' }} value="3">Perwalian</option>
                <option {{ old('wali.status_wali')==4?'selected':'' }} value="4">Numpang alamat</option>
            @endif
        </select>
    </div>
    {{-- <div class="col-sm">
        <label>Hubungan wali</label>
        <select name="wali[hub_calon_wali]" class="form-select">
            <option value=""></option>
            <option value=""></option>
        </select>
        <input type="text" style="text-transform: uppercase" name="wali[hub_calon_wali]" class="form-control" value="{{ $wali!=null?$wali->hub_calon_wali : old('') }}">
    </div> --}}
</div>
