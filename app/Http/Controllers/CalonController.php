<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Pendidikan;
use App\Models\Setting;
use App\Models\T2020;
use App\Models\T2019;
use App\Models\Wali;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CalonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:calon');
    }

    public function index()
    {
        $no = Auth::guard('calon')->user()->no_online;
        $calon = Calon::where('no_online',$no)->first();
        $dik = Setting::find(1)->dik;
        if($calon!=null){
            $pendidikan = Pendidikan::where('calon_id',$calon->id)->first();
            $wali = Wali::where('calon_id',$calon->id)->first();
            $nilai = T2020::where('calon_id',$calon->id)->first();
            $nilai2019 = T2019::where('calon_id',$calon->id)->first();
            $status = 1;
            return view('calon.formulir',compact('calon','dik','pendidikan','wali','status','nilai','nilai2019'));
        }else{
            $pendidikan = null;
            $wali = null;
            $nilai = null;
            $nilai2019 = null;
            $status = 0;
            return view('calon.formulir',compact('calon','dik','pendidikan','wali','status','nilai','nilai2019'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'calon.nama' => 'required',
            'calon.no_online' => 'required',
            'calon.no_kk' => 'required',
            'calon.ktp' => 'required|min:16',
            'calon.tem_lahir' => 'required',
            'calon.tgl_lahir' => 'required',
            'calon.suku' => 'required',
            'calon.agama' => 'required',
            'calon.alamat' => 'required',
            'pendidikan.sd' => 'required',
            'pendidikan.l_sd' => 'required',
            'pendidikan.kab_sd' => 'required',
            'pendidikan.smp' => 'required',
            'pendidikan.l_smp' => 'required',
            'pendidikan.kab_smp' => 'required',
            'pendidikan.sma' => 'required',
            'pendidikan.l_sma' => 'required',
            'pendidikan.kab_sma' => 'required',
            'pendidikan.jur' => 'required',
            'wali.ayah' => 'required',
            'wali.a_kakek' => 'required',
            'wali.a_nenek' => 'required',
            'wali.a_kerja' => 'required',
            'wali.ibu' => 'required',
            'wali.i_kerja' => 'required',
            'wali.i_kakek' => 'required',
            'wali.i_nenek' => 'required',
        ]);

        $check = Calon::where('no_online',$request->calon['no_online'])->first();
        // if($check!=null){
        //     return redirect()->back()->with('error','Silahkan refresh halaman ini');
        // }

            $day = date('d', strtotime($request->calon['tgl_lahir']));
            $month = date('m', strtotime($request->calon['tgl_lahir']));
            $year = date('Y', strtotime($request->calon['tgl_lahir']));
            $c = array_merge($request->calon,[
                'l_hri'=>$day,
                'l_bln'=>$month,
                'l_thn'=>$year,
            ]);
            if($check==null){
                $calon = Calon::create($c);
            }else{
                $check->update($c);
                $calon = $check;
            }
            $pendidikan = array_merge($request->pendidikan,['calon_id'=>$calon->id]);
            $wali = array_merge($request->wali,['calon_id'=>$calon->id]);
            $nilai = array_merge($request->nilai,['calon_id'=>$calon->id]);
            $nilai2019 = array_merge($request->nilai2019,['calon_id'=>$calon->id]);
            if($check==null){
                $pen = Pendidikan::create($pendidikan);
                $a = Wali::create($wali);
            }else{
                $pen = Pendidikan::where('calon_id',$calon->id)->first();
                $pen->update($pendidikan);
                $a = Wali::where('calon_id',$calon->id)->first();
                $a->update($wali);
            }

            $thnLulus = (int)$pen->l_sma;
            if ($thnLulus<=2019) {
                if($check==null){
                    T2019::create($nilai2019);
                    T2020::create($nilai);
                }else{
                    $data_nilai19 = T2019::where('calon_id',$calon->id)->first();
                    $data_nilai19->update($nilai2019);
                    $data_nilai20 = T2020::where('calon_id',$calon->id)->first();
                    $data_nilai20->update($nilai);
                }
            } else {
                if($check==null){
                    T2020::create($nilai);
                }else{
                    $data_nilai20 = T2020::where('calon_id',$calon->id)->first();
                    $data_nilai20->update($nilai);
                }
            }

            if ($a->status_wali==1) {
                $status = 'Wali';
            } else if($a->status_wali==2) {
                $status = 'Tiri';
            } else if($a->status_wali==3) {
                $status = 'Perwalian';
            } else if($a->status_wali==4) {
                $status = 'Numpang alamat';
            }else{
                $status = '';
            }
            $namaCalon = addslashes($calon->nama);
            $namaAyah = addslashes($a->ayah);
            $namaIbu = addslashes($a->ibu);
            $waliAyah = addslashes($a->wali_ayah);
            $waliIbu = addslashes($a->wali_ibu);
            Wali::find($a->id)->update([
                'hub_calon_wali'=>$status,
                'ayah' => $namaAyah,
                'ibu' => $namaIbu,
                'wali_ayah' => $waliAyah,
                'wali_ibu' => $waliIbu
            ]);
            Calon::find($calon->id)->update(['nama'=>$namaCalon]);

        return back()->with('success','Data berhasil disimpan');
    }

    public function pdf()
    {
        $no = Auth::guard('calon')->user()->no_online;
        $calon = Calon::where('no_online',$no)->first();
        if ($calon==null) {
            return redirect()->route('calon.form')->with('danger','Harap Lengkapi data terlebih dahulu!');
        } else {
            $pendidikan = Pendidikan::where('calon_id',$calon->id)->first();
            $wali = Wali::where('calon_id',$calon->id)->first();
            $nilai = T2020::where('calon_id',$calon->id)->first();
            $data = ['Wali','Tiri','Perwalian','Numpang alamat'];
            $setting = Setting::find(1);
            return view('calon.pdf',compact('pendidikan','setting','wali','nilai','calon','data'));
        }

    }

    public function nilai()
    {
        $no = Auth::guard('calon')->user()->no_online;
        $calon = Calon::where('no_online',$no)->first();
        if ($calon==null) {
            return redirect()->route('calon.form')->with('danger','Harap Lengkapi data terlebih dahulu!');
        } else {
            $pendidikan = Pendidikan::where('calon_id',$calon->id)->first();
            $nilai = T2020::where('calon_id',$calon->id)->first();
            // if ($nilai==null) {
            //     return redirect()->route('calon.form')->with('danger','Menu nilai PDF khusus untuk!');
            // }
            return view('calon.nilaipdf',compact('nilai','calon','pendidikan'));
        }
    }

    public function logout()
    {
        Auth::guard('calon')->logout();
        return redirect()->route('login');
    }
}
