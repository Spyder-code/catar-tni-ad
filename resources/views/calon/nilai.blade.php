<link rel="stylesheet" href="{{ asset('css.') }}/tabel.css">
<script src="{{ asset('dashboard') }}/js/jquery.min.js"></script>
<div class="tg-wrap">
    <table id="tg-HMKiy" class="tg bg-white" style="table-layout: fixed; width: 100%x">
        <colgroup>
        <col style="width: 50px">
        <col style="width: 138px">
        <col style="width: 60px">
        <col style="width: 60px">
        <col style="width: 60px">
        <col style="width: 60px">
        <col style="width: 60px">
        <col style="width: 60px">
        <col style="width: 60px">
        <col style="width: 60px">
        <col style="width: 60px">
        <col style="width: 60px">
        <col style="width: 60px">
        <col style="width: 60px">
        </colgroup>
    <thead>
    <tr>
        <th class="tg-ih3h" rowspan="3">no</th>
        <th class="tg-ih3h" rowspan="3">Mata pelajaran</th>
        <th class="tg-ih3h" colspan="4">kelas X</th>
        <th class="tg-ih3h" colspan="4">kelas XI</th>
        <th class="tg-ih3h" colspan="4">Kelas XII</th>
    </tr>
    <tr>
        <td class="tg-c3ow" colspan="2">smt 1</td>
        <td class="tg-c3ow" colspan="2">smt 2</td>
        <td class="tg-c3ow" colspan="2">smt 1</td>
        <td class="tg-c3ow" colspan="2">smt 2</td>
        <td class="tg-c3ow" colspan="2">smt 1</td>
        <td class="tg-c3ow" colspan="2">smt 2</td>
    </tr>
    <tr>
        <td class="tg-c3ow" colspan="1">Peng</td>
        <td class="tg-c3ow" colspan="1">Ketr</td>
        <td class="tg-c3ow" colspan="1">Peng</td>
        <td class="tg-c3ow" colspan="1">Ketr</td>
        <td class="tg-c3ow" colspan="1">Peng</td>
        <td class="tg-c3ow" colspan="1">Ketr</td>
        <td class="tg-c3ow" colspan="1">Peng</td>
        <td class="tg-c3ow" colspan="1">Ketr</td>
        <td class="tg-c3ow" colspan="1">Peng</td>
        <td class="tg-c3ow" colspan="1">Ketr</td>
        <td class="tg-c3ow" colspan="1">Peng</td>
        <td class="tg-c3ow" colspan="1">Ketr</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="tg-c3ow">1</td>
        <td class="tg-c3ow">B. Indonesia</td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bipeng1 :'' }}" step="any" name="nilai[bipeng1]" id="ind1"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->biket1 :'' }}" step="any" name="nilai[biket1]" id="ind2"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bipeng2 :'' }}" step="any" name="nilai[bipeng2]" id="ind3"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->biket2 :'' }}" step="any" name="nilai[biket2]" id="ind4"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bipeng3 :'' }}" step="any" name="nilai[bipeng3]" id="ind5"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->biket3 :'' }}" step="any" name="nilai[biket3]" id="ind6" ></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bipeng4 :'' }}" step="any" name="nilai[bipeng4]" id="ind7"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->biket4 :'' }}" step="any" name="nilai[biket4]" id="ind8"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bipeng5 :'' }}" step="any" name="nilai[bipeng5]" id="ind9"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->biket5 :'' }}" step="any" name="nilai[biket5]" id="ind10"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bipeng6 :'' }}" step="any" name="nilai[bipeng6]" id="ind11"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->biket6 :'' }}" step="any" name="nilai[biket6]" id="ind12"></td>
    </tr>
    <tr>
        <td class="tg-c3ow">2</td>
        <td class="tg-c3ow">matematika</td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkpeng1 :'' }}" step="any" name="nilai[mtkpeng1]" id="mtk1"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkket1 :'' }}" step="any" name="nilai[mtkket1]" id="mtk2"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkpeng2 :'' }}" step="any" name="nilai[mtkpeng2]" id="mtk3"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkket2 :'' }}" step="any" name="nilai[mtkket2]" id="mtk4"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkpeng3 :'' }}" step="any" name="nilai[mtkpeng3]" id="mtk5"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkket3 :'' }}" step="any" name="nilai[mtkket3]" id="mtk6"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkpeng4 :'' }}" step="any" name="nilai[mtkpeng4]" id="mtk7"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkket4 :'' }}" step="any" name="nilai[mtkket4]" id="mtk8"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkpeng5 :'' }}" step="any" name="nilai[mtkpeng5]" id="mtk9"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkket5 :'' }}" step="any" name="nilai[mtkket5]" id="mtk10"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkpeng6 :'' }}" step="any" name="nilai[mtkpeng6]" id="mtk11"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->mtkket6 :'' }}" step="any" name="nilai[mtkket6]" id="mtk12"></td>
    </tr>
    <tr>
        <td class="tg-c3ow">3</td>
        <td class="tg-c3ow">B. Inggris</td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigpeng1 :'' }}" step="any" name="nilai[bigpeng1]" id="ing1"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigket1 :'' }}" step="any" name="nilai[bigket1]" id="ing2"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigpeng2 :'' }}" step="any" name="nilai[bigpeng2]" id="ing3"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigket2 :'' }}" step="any" name="nilai[bigket2]" id="ing4"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigpeng3 :'' }}" step="any" name="nilai[bigpeng3]" id="ing5"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigket3 :'' }}" step="any" name="nilai[bigket3]" id="ing6"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigpeng4 :'' }}" step="any" name="nilai[bigpeng4]" id="ing7"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigket4 :'' }}" step="any" name="nilai[bigket4]" id="ing8"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigpeng5 :'' }}" step="any" name="nilai[bigpeng5]" id="ing9"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigket5 :'' }}" step="any" name="nilai[bigket5]" id="ing10"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigpeng6 :'' }}" step="any" name="nilai[bigpeng6]" id="ing11"></td>
        <td class="tg-c3ow"><input class="input" min="0" max="100" type="number" value="{{ $nilai!=null?$nilai->bigket6 :'' }}" step="any" name="nilai[bigket6]" id="ing12"></td>
    </tr>
        <td class="tg-c3ow"></td>
        <td class="tg-c3ow">jumlah</td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah1 :'' }}" step="any" name="nilai[jumlah1]" id="jmlh1" readonly="" min="0" max="600"></td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah_ket1 :'' }}" step="any" name="nilai[jumlah_ket1]" id="jmlh2" readonly="" min="0" max="600"></td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah2 :'' }}" step="any" name="nilai[jumlah2]" id="jmlh3" readonly="" min="0" max="600"></td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah_ket2 :'' }}" step="any" name="nilai[jumlah_ket2]" id="jmlh4" readonly="" min="0" max="600"></td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah3 :'' }}" step="any" name="nilai[jumlah3]" id="jmlh5" readonly="" min="0" max="600"></td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah_ket3 :'' }}" step="any" name="nilai[jumlah_ket3]" id="jmlh6" readonly="" min="0" max="600"></td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah4 :'' }}" step="any" name="nilai[jumlah4]" id="jmlh7" readonly="" min="0" max="600"></td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah_ket4 :'' }}" step="any" name="nilai[jumlah_ket4]" id="jmlh8" readonly="" min="0" max="600"></td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah5 :'' }}" step="any" name="nilai[jumlah5]" id="jmlh9" readonly="" min="0" max="600"></td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah_ket5 :'' }}" step="any" name="nilai[jumlah_ket5]" id="jmlh10" readonly="" min="0" max="600"></td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah6 :'' }}" step="any" name="nilai[jumlah6]" id="jmlh11" readonly="" min="0" max="600"></td>
        <td class="tg-c3ow"><input class="input" type="number" value="{{ $nilai!=null?$nilai->jumlah_ket6:'' }}" step="any" name="nilai[jumlah_ket6]" id="jmlh12" readonly="" min="0" max="600"></td>
    </tr>
        <tr>
        <td class="tg-c3ow"></td>
        <td class="tg-c3ow">rta2 peng/ketr</td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata1 :'' }}" step="any" name="nilai[rata1]" id="ra1" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata_ket1 :'' }}" step="any" name="nilai[rata_ket1]" id="ra2" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata2 :'' }}" step="any" name="nilai[rata2]" id="ra3" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata_ket2 :'' }}" step="any" name="nilai[rata_ket2]" id="ra4" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata3 :'' }}" step="any" name="nilai[rata3]" id="ra5" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata_ket3 :'' }}" step="any" name="nilai[rata_ket3]" id="ra6" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata4 :'' }}" step="any" name="nilai[rata4]" id="ra7" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata_ket4 :'' }}" step="any" name="nilai[rata_ket4]" id="ra8" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata5 :'' }}" step="any" name="nilai[rata5]" id="ra9" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata_ket5 :'' }}" step="any" name="nilai[rata_ket5]" id="ra10" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata6 :'' }}" step="any" name="nilai[rata6]" id="ra11" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata_ket6 :'' }}" step="any" name="nilai[rata_ket6]" id="ra12" readonly="" min="0" max="100"></td>
    </tr>
    <tr>
        <td class="tg-c3ow"></td>
        <td class="tg-c3ow">rata2 smt</td>
        <td class="tg-c3ow" colspan="2"><input style="width: 100%" class="input" type="number" value="{{ $nilai!=null?$nilai->rata_smt1 :'' }}" step="any" name="nilai[rata_smt1]" id="rb1" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow" colspan="2"><input style="width: 100%" class="input" type="number" value="{{ $nilai!=null?$nilai->rata_smt2 :'' }}" step="any" name="nilai[rata_smt2]" id="rb2" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow" colspan="2"><input style="width: 100%" class="input" type="number" value="{{ $nilai!=null?$nilai->rata_smt3 :'' }}" step="any" name="nilai[rata_smt3]" id="rb3" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow" colspan="2"><input style="width: 100%" class="input" type="number" value="{{ $nilai!=null?$nilai->rata_smt4 :'' }}" step="any" name="nilai[rata_smt4]" id="rb4" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow" colspan="2"><input style="width: 100%" class="input" type="number" value="{{ $nilai!=null?$nilai->rata_smt5 :'' }}" step="any" name="nilai[rata_smt5]" id="rb5" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow" colspan="2"><input style="width: 100%" class="input" type="number" value="{{ $nilai!=null?$nilai->rata_smt6 :'' }}" step="any" name="nilai[rata_smt6]" id="rb6" readonly="" min="0" max="100"></td>
    </tr>
    <tr>
        <td class="tg-c3ow"></td>
        <td class="tg-c3ow">rata2 kls</td>
        <td class="tg-c3ow" colspan="4"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata_kls1 :'' }}" step="any" name="nilai[rata_kls1]" id="rc1" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow" colspan="4"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata_kls2 :'' }}" step="any" name="nilai[rata_kls2]" id="rc2" readonly="" min="0" max="100"></td>
        <td class="tg-c3ow" colspan="4"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata_kls3 :'' }}" step="any" name="nilai[rata_kls3]" id="rc3" readonly="" min="0" max="100"></td>
    </tr>
    <tr>
        <td class="tg-c3ow"></td>
        <td class="tg-c3ow">rata2 akhir</td>
        <td class="tg-c3ow" colspan="12"><input class="input" style="width: 100%" type="number" value="{{ $nilai!=null?$nilai->rata_akhir :'' }}" step="any" name="nilai[rata_akhir]" id="rd" readonly="" min="0" max="100"></td>
    </tr>
    </tbody>
    </table>
</div>

<script>
    $(':input[type="number"]').keyup(function (e) {
        var ind = []; var ing = [];  var mtk = [];  var jmlh = [];
        var total = 0;
        var j = 0;
        var k = 0;
        var h = 0;
        for (let i = 0; i < 12; i++) {
            var j = j +1;
            var a = $('#ind'+j).val();
            var b = $('#ing'+j).val();
            var c = $('#mtk'+j).val();
            if(a!=''){
                var nil= parseFloat(a);
                ind.push(nil);
            }
            if(b!=''){
                var nil= parseFloat(b);
                ing.push(nil);
            }
            if(c!=''){
                var nil= parseFloat(c);
                mtk.push(nil);
            }
            var jum = ind[i]+ing[i]+mtk[i];
            var ra = jum/3;
            $('#jmlh'+j).val(jum);
            $('#ra'+j).val(ra.toFixed(2));
            jmlh.push(jum);
            total +=jmlh[i]
        }

        for (let i = 1; i <= 6; i++) {
            var rb = jmlh[k]+jmlh[k+1];
            var totalRb = rb/6;
            $('#rb'+i).val(totalRb.toFixed(2));
            k = k + 2;
        }
        for (let i = 1; i <= 3; i++) {
            var rc = jmlh[h]+jmlh[h+1]+jmlh[h+2]+jmlh[h+3];
            var totalRc = rc/12;
            $('#rc'+i).val(totalRc.toFixed(2));
            h = h + 4;
        }

        var akhir = total/36;
        $('#rd').val(akhir.toFixed(2));

    });
</script>
