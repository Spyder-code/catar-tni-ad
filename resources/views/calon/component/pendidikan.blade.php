<div class="form-group row">
    <div class="col-lg-4 col-6 col-md-3">
        <label>SD</label>
        @error('pendidikan.sd')
        <div>
            <strong class="text-danger small">SD tidak boleh kosong</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" @error('pendidikan.sd') autofocus @enderror name="pendidikan[sd]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->sd : old('pendidikan.sd') }}">
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
        <input type="text" style="text-transform: uppercase" @error('pendidikan.kab_sd') autofocus @enderror name="pendidikan[kab_sd]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->kab_sd : old('pendidikan.kab_sd') }}">
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
        <input type="text" style="text-transform: uppercase" @error('pendidikan.smp') autofocus @enderror name="pendidikan[smp]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->smp : old('pendidikan.smp') }}">
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
        <input type="text" style="text-transform: uppercase" @error('pendidikan.kab_smp') autofocus @enderror name="pendidikan[kab_smp]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->kab_smp : old('pendidikan.kab_smp') }}">
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
        <input type="text" style="text-transform: uppercase" @error('pendidikan.sma') autofocus @enderror name="pendidikan[sma]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->sma : Auth::guard('calon')->user()->nama_sekolah }}">
    </div>
    <div class="col-sm">
        <label>Jurusan</label>
        @error('pendidikan.jur')
        <div>
            <strong class="text-danger small">Jurusan tidak boleh kosong</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" name="pendidikan[jur]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->jur :  Auth::guard('calon')->user()->jur }}">
    </div>
    <div class="col-lg-3 col-6 col-md-3">
        <label>Kab/Kota Lulus SMA</label>
        @error('pendidikan.kab_sma')
        <div>
            <strong class="text-danger small">Kab/Kota tidak boleh kosong</strong>
        </div>
        @enderror
        <input type="text" style="text-transform: uppercase" @error('pendidikan.kab_sma') autofocus @enderror name="pendidikan[kab_sma]" class="form-control" value="{{ $pendidikan!=null?$pendidikan->kab_sma : old('pendidikan.kab_sma') }}">
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
            <option {{ old('pendidikan.l_sma')=='2022'?'selected':'' }} value="2022"> 2022</option>
            @else
                <option {{ $pendidikan->l_sma==2017?'selected':'' }} value="2017">2017</option>
                <option {{ $pendidikan->l_sma==2018?'selected':'' }} value="2018">2018</option>
                <option {{ $pendidikan->l_sma==2019?'selected':'' }} value="2019">2019</option>
                <option {{ $pendidikan->l_sma==2020?'selected':'' }} value="2020">2020</option>
                <option {{ $pendidikan->l_sma==2021?'selected':'' }} value="2021"> 2021</option>
                <option {{ $pendidikan->l_sma==2022?'selected':'' }} value="2022"> 2022</option>
            @endif
        </select>
    </div>
</div>
    @include('calon.nilai2019')
    @include('calon.nilai2020')
