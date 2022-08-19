<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalonRequest;
use App\Models\Calon;
use App\Models\LandingPage;
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
        $dik = LandingPage::find(1)->dik;
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

    public function store(CalonRequest $request)
    {

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
            $c['id'] = Auth::guard('calon')->user()->id;
            // dd($c);
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
            $a_kakek = addslashes($a->a_kakek);
            $i_kakek = addslashes($a->i_kakek);
            $a_nenek = addslashes($a->a_nenek);
            $i_nenek = addslashes($a->i_nenek);
            Wali::find($a->id)->update([
                'hub_calon_wali'=>$status,
                'ayah' => $namaAyah,
                'ibu' => $namaIbu,
                'wali_ayah' => $waliAyah,
                'wali_ibu' => $waliIbu,
                'a_kakek' => $a_kakek,
                'i_kakek' => $i_kakek,
                'a_nenek' => $a_nenek,
                'i_nenek' => $i_nenek,
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
            $setting = LandingPage::find(1);
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
