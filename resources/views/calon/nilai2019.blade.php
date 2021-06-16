<div id="2019" class="container">
    <div class="form-group row">
        <div class="col-sm">
            <label>Bhs. Indonesi</label>
            <input type="number" name="nilai2019[ind]" step="any" value="{{ $nilai2019!=null?$nilai2019->ind :'' }}" class="form-control input-nilai" id="p1" >
        </div>
        <div class="col-sm">
            <label>Bhs. Inggris</label>
            <input type="number" name="nilai2019[ing]" step="any" value="{{ $nilai2019!=null?$nilai2019->ing :'' }}" class="form-control input-nilai" id="p2" >
        </div>
        <div class="col-sm">
            <label>Matematika</label>
            <input type="number" name="nilai2019[mtk]" step="any" value="{{ $nilai2019!=null?$nilai2019->mtk :'' }}" class="form-control input-nilai" id="p3" >
        </div>
        <div class="col-sm">
            <label>Fisika</label>
            <input type="number" name="nilai2019[fis]" step="any" value="{{ $nilai2019!=null?$nilai2019->fis :'' }}" class="form-control input-nilai" id="p4" >
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm">
            <label>Kimia</label>
            <input type="number" name="nilai2019[kim]" step="any" value="{{ $nilai2019!=null?$nilai2019->kim :'' }}" class="form-control input-nilai" id="p5" >
        </div>
        <div class="col-sm">
            <label>Biologi</label>
            <input type="number" name="nilai2019[bio]" step="any" value="{{ $nilai2019!=null?$nilai2019->bio :'' }}" class="form-control input-nilai" id="p6" >
        </div>
        <div class="col-sm">
            <label>Sosiologi</label>
            <input type="number" name="nilai2019[sos]" step="any" value="{{ $nilai2019!=null?$nilai2019->sos :'' }}" class="form-control input-nilai" id="p7" >
        </div>
        <div class="col-sm">
            <label>Geografi</label>
            <input type="number" name="nilai2019[geo]" step="any" value="{{ $nilai2019!=null?$nilai2019->geo :'' }}" class="form-control input-nilai" id="p8" >
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm">
            <label>Ekonomi</label>
            <input type="number" name="nilai2019[eko]" step="any" value="{{ $nilai2019!=null?$nilai2019->eko :'' }}" class="form-control input-nilai" id="p9" >
        </div>
        <div class="col-sm">
            <label>Kompetensi</label>
            <input type="number" name="nilai2019[kom]" step="any" value="{{ $nilai2019!=null?$nilai2019->kom :'' }}" class="form-control input-nilai" id="p10" >
        </div>
        <div class="col-sm">
            <label>Lain</label>
            <input type="number" name="nilai2019[lain]" step="any" value="{{ $nilai2019!=null?$nilai2019->lain :'' }}" class="form-control input-nilai" id="p11" >
        </div>
        <div class="col-sm">
            <label>Rata-rata</label>
            <input readonly type="number" name="nilai2019[rata]" step="any" value="{{ $nilai2019!=null?$nilai2019->rata :'' }}" class="form-control input-nilai" id="rata" >
        </div>
    </div>
</div>

<script>
    $('.input-nilai').change(function (e) {
        var nilai = [];
        var total = 0;
        for (let i = 1; i <= 11; i++) {
            var a = $('#p'+i).val();
            if(a!=''){
                var nil= parseFloat(a);
                nilai.push(nil);
            }
        }
        for(var i = 0; i<nilai.length; i++){
            total +=nilai[i]
        }
        var bnykNilai = nilai.length;
        var rata = (total/bnykNilai);
        $('#rata').val(rata.toFixed(2));
    });
</script>
