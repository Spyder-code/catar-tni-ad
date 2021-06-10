<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Pendidikan;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $status = 1;
            return view('calon.formulir',compact('calon','pendidikan','wali','status'));
        }else{
            $pendidikan = null;
            $wali = null;
            $status = 0;
            return view('calon.formulir',compact('calon','pendidikan','wali','status'));
        }
    }

    public function store(Request $request)
    {
        if ($request->status==0) {
            $calon = Calon::create([
                'no_online'=>$request->no_online,
                'nama'=>$request->nama,
                'agama'=>$request->agama,
                'tem_lahir'=>$request->tem_lahir,
                'tgl_lahir'=>$request->tgl_lahir,
                'suku'=>$request->suku,
                'alamat'=>$request->alamat,
                'rt'=>$request->rt, 
                'rw'=>$request->rw,
                'no'=>$request->no,
                'dsn'=>$request->dusun,
                'ds'=>$request->desa,
                'kec'=>$request->kecamatan,
                'kab'=>$request->kab, 
                'telp'=>$request->telp, 
                'daftar_ke'=>$request->daftar_ke, 
                'aspek_tl'=>$request->aspek_tl, 
            ]);

            Pendidikan::create([
                'calon_id'=>$calon->id,
                'sd'=>$request->sd,
                'l_sd'=>$request->l_sd,
                'smp'=>$request->smp,
                'l_smp'=>$request->l_smp,
                'sma'=>$request->sma,
                'nama_sma'=>$request->sma,
                'jur'=>$request->jurusan, 
                'l_sma'=>$request->l_sma,
                'jumlah_nuan'=>0,
                'rata'=>0,
            ]);

            Wali::create([
                'calon_id'=>$calon->id,
                'ayah'=> $request->ayah,
                'a_kerja'=> $request->kerja_ayah, 
                'a_pkt'=> $request->pangkat_ayah, 
                'a_jab'=> $request->jabatan_ayah, 
                'a_sat'=> $request->satuan_ayah, 
                'ibu'=> $request->ibu,
                'i_kerja'=> $request->kerja_ibu, 
                'i_pkt'=> $request->pangkat_ibu, 
                'i_jab'=> $request->jabatan_ibu, 
                'i_sat'=> $request->satuan_ibu, 
                'o_telp'=> $request->phone, 
                'o_alamat'=> $request->alamat_ortu,
                'status_wali'=> $request->status_wali,
                'hub_calon_wali'=> $request->hub_wali,
            ]);
        }else{
            $calon = Calon::find($request->calon_id)->update([
                'no_online'=>$request->no_online,
                'nama'=>$request->nama,
                'agama'=>$request->agama,
                'tem_lahir'=>$request->tem_lahir,
                'tgl_lahir'=>$request->tgl_lahir,
                'suku'=>$request->suku,
                'alamat'=>$request->alamat,
                'rt'=>$request->rt, 
                'rw'=>$request->rw,
                'no'=>$request->no,
                'dsn'=>$request->dusun,
                'ds'=>$request->desa,
                'kec'=>$request->kecamatan,
                'kab'=>$request->kab, 
                'telp'=>$request->telp, 
                'daftar_ke'=>$request->daftar_ke, 
                'aspek_tl'=>$request->aspek_tl, 
            ]);

            Pendidikan::where('calon_id',$request->calon_id)->update([
                'sd'=>$request->sd,
                'l_sd'=>$request->l_sd,
                'smp'=>$request->smp,
                'l_smp'=>$request->l_smp,
                'sma'=>$request->sma,
                'nama_sma'=>$request->sma,
                'jur'=>$request->jurusan, 
                'l_sma'=>$request->l_sma,
                'jumlah_nuan'=>0,
                'rata'=>0,
            ]);

            Wali::where('calon_id',$request->calon_id)->update([
                'ayah'=> $request->ayah,
                'a_kerja'=> $request->kerja_ayah, 
                'a_pkt'=> $request->pangkat_ayah, 
                'a_jab'=> $request->jabatan_ayah, 
                'a_sat'=> $request->satuan_ayah, 
                'ibu'=> $request->ibu,
                'i_kerja'=> $request->kerja_ibu, 
                'i_pkt'=> $request->pangkat_ibu, 
                'i_jab'=> $request->jabatan_ibu, 
                'i_sat'=> $request->satuan_ibu, 
                'o_telp'=> $request->phone, 
                'o_alamat'=> $request->alamat_ortu,
                'status_wali'=> $request->status_wali,
                'hub_calon_wali'=> $request->hub_wali,
            ]);
        }

        return back()->with('success','Data berhasil disimpan!');
    }

    public function logout()
    {
        Auth::guard('calon')->logout();
        return redirect()->route('login');
    }
}
