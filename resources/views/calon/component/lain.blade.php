<div class="form-group row">
    <div class="col-lg-4 col-12 mt-2 col-md-6">
        <label>Nomor BPJS</label>
        <input type="text" style="text-transform: uppercase" @error('calon.bpjs') autofocus @enderror name="calon[bpjs]"
            class="form-control validate-symbol" value="{{ $calon != null ? stripcslashes($calon->bpjs) : old('calon.bpjs') }}">
    </div>
    <div class="col-lg-4 col-12 mt-2 col-md-6">
        <label>Instagram <small>(Nama Akun)</small></label>
        <input type="text" style="text-transform: uppercase" @error('calon.inst') autofocus @enderror name="calon[inst]"
            class="form-control validate-symbol"
            value="{{ $calon != null ? stripcslashes($calon->inst) : old('calon.inst') }}">
    </div>
    <div class="col-lg-4 col-12 mt-2 col-md-6">
        <label>Facebook <small>(Nama Akun)</small></label>
        <input type="text" style="text-transform: uppercase" @error('calon.face') autofocus @enderror
            name="calon[face]" class="form-control validate-symbol"
            value="{{ $calon != null ? stripcslashes($calon->face) : old('calon.face') }}">
    </div>
    <div class="col-lg-4 col-12 mt-2 col-md-6">
        <label>Tiktok <small>(Nama Akun)</small></label>
        <input type="text" style="text-transform: uppercase" @error('calon.tiktok') autofocus @enderror
            name="calon[tiktok]" class="form-control validate-symbol"
            value="{{ $calon != null ? stripcslashes($calon->tiktok) : old('calon.tiktok') }}">
    </div>
    <div class="col-lg-4 col-12 mt-2 col-md-6">
        <label>Twiter <small>(Nama Akun)</small></label>
        <input type="text" style="text-transform: uppercase" @error('calon.twiter') autofocus @enderror
            name="calon[twiter]" class="form-control validate-symbol"
            value="{{ $calon != null ? stripcslashes($calon->twiter) : old('calon.twiter') }}">
    </div>
</div>
