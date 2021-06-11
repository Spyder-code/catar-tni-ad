<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Pendidikan;
use App\Models\T2020;
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
            $status = 1;
            return view('calon.formulir',compact('calon','pendidikan','wali','status','nilai'));
        }else{
            $pendidikan = null;
            $wali = null;
            $nilai = null;
            $status = 0;
            return view('calon.formulir',compact('calon','pendidikan','wali','status','nilai'));
        }
    }

    public function store(Request $request)
    {
        if ($request->status==0) {
            $calon = Calon::create($request->calon);
            $pendidikan = array_merge($request->pendidikan,['calon_id'=>$calon->id]);
            $wali = array_merge($request->wali,['calon_id'=>$calon->id]);
            $nilai = array_merge($request->nilai,['calon_id'=>$calon->id]);
            Pendidikan::create($pendidikan);
            Wali::create($wali);
            T2020::create($nilai);
        }else{
            $calon = Calon::find($request->calon_id)->update($request->calon);
            $pendidikan = array_merge($request->pendidikan,['calon_id'=>$request->calon_id]);
            $wali = array_merge($request->wali,['calon_id'=>$request->calon_id]);
            $nilai = array_merge($request->nilai,['calon_id'=>$request->calon_id]);
            Pendidikan::where('calon_id',$request->calon_id)->update($pendidikan);
            Wali::where('calon_id',$request->calon_id)->update($wali);
            T2020::where('calon_id',$request->calon_id)->update($nilai);
            Calon::find($request->calon_id)->update(['updated_at'=> Carbon::now()]);
        }

        return back()->with('success','Data berhasil disimpan!');
    }

    public function pdf()
    {
        $no = Auth::guard('calon')->user()->no_online;
        $calon = Calon::where('no_online',$no)->first();
        $pendidikan = Pendidikan::where('calon_id',$calon->id)->first();
        $wali = Wali::where('calon_id',$calon->id)->first();
        $nilai = T2020::where('calon_id',$calon->id)->first();
        return view('calon.pdf',compact('pendidikan','wali','nilai','calon'));
    }

    public function nilai()
    {
        $no = Auth::guard('calon')->user()->no_online;
        $calon = Calon::where('no_online',$no)->first();
        $pendidikan = Pendidikan::where('calon_id',$calon->id)->first();
        $nilai = T2020::where('calon_id',$calon->id)->first();
        return view('calon.nilaipdf',compact('nilai','calon','pendidikan'));
    }

    public function logout()
    {
        Auth::guard('calon')->logout();
        return redirect()->route('login');
    }
}
