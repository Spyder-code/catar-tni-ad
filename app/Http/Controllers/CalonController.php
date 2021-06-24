<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Pendidikan;
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
        if($calon!=null){
            $pendidikan = Pendidikan::where('calon_id',$calon->id)->first();
            $wali = Wali::where('calon_id',$calon->id)->first();
            $nilai = T2020::where('calon_id',$calon->id)->first();
            $nilai2019 = T2019::where('calon_id',$calon->id)->first();
            $status = 1;
            return view('calon.formulir',compact('calon','pendidikan','wali','status','nilai','nilai2019'));
        }else{
            $pendidikan = null;
            $wali = null;
            $nilai = null;
            $nilai2019 = null;
            $status = 0;
            return view('calon.formulir',compact('calon','pendidikan','wali','status','nilai','nilai2019'));
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'calon.nama' => 'required',
            'calon.no_online' => 'required',
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
            'wali.a_kerja' => 'required',
            'wali.ibu' => 'required',
            'wali.i_kerja' => 'required',
        ]);

        if ($request->status==0) {
            $calon = Calon::create($request->calon);
            $pendidikan = array_merge($request->pendidikan,['calon_id'=>$calon->id]);
            $wali = array_merge($request->wali,['calon_id'=>$calon->id]);
            $nilai = array_merge($request->nilai,['calon_id'=>$calon->id]);
            $nilai2019 = array_merge($request->nilai2019,['calon_id'=>$calon->id]);
            Pendidikan::create($pendidikan);
            $a = Wali::create($wali);
            T2020::create($nilai);
            T2019::create($nilai2019);
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

            Wali::find($a->id)->update(['hub_calon_wali'=>$status]);

        }else{
            $calon = Calon::find($request->calon_id)->update($request->calon);
            $pendidikan = array_merge($request->pendidikan,['calon_id'=>$request->calon_id]);
            $wali = array_merge($request->wali,['calon_id'=>$request->calon_id]);
            $nilai = array_merge($request->nilai,['calon_id'=>$request->calon_id]);
            $nilai2019 = array_merge($request->nilai2019,['calon_id'=>$request->calon_id]);
            Pendidikan::where('calon_id',$request->calon_id)->update($pendidikan);
            Wali::where('calon_id',$request->calon_id)->update($wali);
            T2020::where('calon_id',$request->calon_id)->update($nilai);
            T2019::where('calon_id',$request->calon_id)->update($nilai2019);
            Calon::find($request->calon_id)->update(['updated_at'=> Carbon::now()]);
            if ($request->wali['status_wali']==1) {
                $status = 'Wali';
            } else if($request->wali['status_wali']==2) {
                $status = 'Tiri';
            } else if($request->wali['status_wali']==3) {
                $status = 'Perwalian';
            } else if($request->wali['status_wali']==4) {
                $status = 'Numpang alamat';
            }else{
                $status = '';
            }

            Wali::where('calon_id',$request->calon_id)->update(['hub_calon_wali'=>$status]);
        }

        return redirect()->route('calon.pdf');
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
            return view('calon.pdf',compact('pendidikan','wali','nilai','calon','data'));
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
            if ($pendidikan->l_sma<=2019) {
                return redirect()->route('calon.form')->with('danger','Menu nilai PDF disabled!');
            }
            return view('calon.nilaipdf',compact('nilai','calon','pendidikan'));
        }
    }

    public function logout()
    {
        Auth::guard('calon')->logout();
        return redirect()->route('login');
    }
}
