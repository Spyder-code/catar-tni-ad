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
        $pendidikan = Pendidikan::where('calon_id',$calon->id)->first();
        $wali = Wali::where('calon_id',$calon->id)->first();
        $nilai = T2020::where('calon_id',$calon->id)->first();
        $data = ['Wali','Tiri','Perwalian','Numpang alamat'];
        if ($calon==null) {
            return redirect()->route('calon.form')->with('danger','Harap Lengkapi data terlebih dahulu!');
        } else {
            return view('calon.pdf',compact('pendidikan','wali','nilai','calon','data'));
        }

    }

    public function nilai()
    {
        $no = Auth::guard('calon')->user()->no_online;
        $calon = Calon::where('no_online',$no)->first();
        $pendidikan = Pendidikan::where('calon_id',$calon->id)->first();
        $nilai = T2020::where('calon_id',$calon->id)->first();
        if ($calon==null) {
            return redirect()->route('calon.form')->with('danger','Harap Lengkapi data terlebih dahulu!');
        } else {
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
