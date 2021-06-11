<?php

namespace App\Http\Controllers;

use App\Exports\CalonExport;
use App\Imports\PokokImport;
use App\Models\Calon;
use App\Models\Pendidikan;
use App\Models\Pokok;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function pokok()
    {
        $data = Pokok::all()->sortByDesc('no_online');
        return view('admin.pokok',compact('data'));
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

    public function export(Request $request)
    {
        return Excel::download(new CalonExport($request->calon), 'calon.xlsx');
    }

}
