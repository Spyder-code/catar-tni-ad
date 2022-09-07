<?php

namespace App\Http\Controllers;

use App\Exports\CalonExport;
use App\Imports\PokokImport;
use App\Models\Calon;
use App\Models\Pendidikan;
use App\Models\Pokok;
use App\Models\Setting;
use App\Models\T2019;
use App\Models\T2020;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $visitor = Visitor::all();
        $user = User::all();
        return view('admin.main',compact('visitor','user'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function calon()
    {
        $data = Calon::all()->sortByDesc('updated_at');
        return view('admin.calon', compact('data'));
    }

    public function calonDestroy(Request $request)
    {
        Calon::destroy($request->id);
        return back()->with('success', 'Calon dengan ID '.$request->id).' berhasil dihapus!';
    }

    public function calonDestroyAll()
    {
        Schema::disableForeignKeyConstraints();
        Calon::truncate();
        Wali::truncate();
        Pendidikan::truncate();
        T2019::truncate();
        T2020::truncate();
        Schema::enableForeignKeyConstraints();
        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function pokok()
    {
        $data = Pokok::all()->sortByDesc('no_online');
        return view('admin.pokok',compact('data'));
    }

    public function createPokok()
    {
        return view('admin.createDataPokok');
    }

    public function storePokok(Request $request)
    {
        Pokok::create($request->all());
        return redirect('pokok')->with('success', 'Data berhasil ditambahkan!');
    }

    public function deletePokok(Pokok $pokok)
    {
        $pokok->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function editPokok(Pokok $pokok)
    {
        return view('admin.editDataPokok', compact('pokok'));
    }

    public function updatePokok(Request $request, Pokok $pokok)
    {
        $pokok->update($request->all());
        return redirect('pokok')->with('success', 'Data berhasil diubah!');
    }

    public function importExcelPokok(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        if($request->file('file')){
            Excel::import(new PokokImport, $request->file);
            return back()->with('success', 'Import berhasil');
        }else{
            return back()->with('danger', 'Import gagal');
        }
    }

    public function pokokDestroy()
    {
        Pokok::truncate();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function export(Request $request)
    {
        if ($request->calon==null) {
            return back()->with('danger','Harap pilih data terlebih dahulu');
        }else{
            if(env('PONPES')){
                $name = 'santri.csv';
            }else{
                $name = 'calon.csv';
            }

            return Excel::download(new CalonExport($request->calon), $name);
        }
    }

    public function exportAll()
    {
        $data = Calon::all();
        $calon = array();
        foreach ($data as $item ) {
            array_push($calon,$item->id);
        };

        if(env('PONPES')){
            $name = 'santri.csv';
        }else{
            $name = 'calon.csv';
        }
        return Excel::download(new CalonExport($calon), $name);
    }

    public function exportDataAll()
    {
        $data = Calon::all();
        $calon = array();
        foreach ($data as $item ) {
            array_push($calon,$item->id);
        };

        if(env('PONPES')){
            $name = 'santri.csv';
        }else{
            $name = 'calon.csv';
        }
        return Excel::download(new CalonExport($calon), $name);
    }

    public function exportDataSelect(Request $request)
    {
        if ($request->calon==null) {
            return back()->with('danger','Harap pilih data terlebih dahulu');
        }else{
            if(env('PONPES')){
                $name = 'santri.csv';
            }else{
                $name = 'calon.csv';
            }
            return Excel::download(new CalonExport($request->calon), $name);
        }
    }

    public function setting()
    {
        $data =  Setting::find(1);
        return view('admin.setting',compact('data'));
    }

    public function settingUpdate(Request $request, Setting $setting)
    {
        $setting->update($request->all());
        return back()->with('success','Data berhasil diupdate!');
    }

}
