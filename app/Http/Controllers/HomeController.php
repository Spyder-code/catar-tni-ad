<?php

namespace App\Http\Controllers;

use App\Exports\CalonExport;
use App\Exports\DataExport;
use App\Exports\PokokExport;
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
        if (Auth::user() && !Auth::user()->isSuperadmin()) {
            return redirect()->route('pokok');
        }
        $visitor = Visitor::all();
        $user = User::all();
        return view('admin.main', compact('visitor', 'user'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function calon(Request $request)
    {
        $perPage = (int) $request->input('per_page', 50);
        if (!in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 50;
        }

        $allowedSortColumns = ['id', 'no_animo', 'no_online', 'nama', 'tgl_lahir', 'tem_lahir', 'updated_at'];
        $sort = $request->input('sort');
        $direction = strtolower($request->input('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

        $query = $this->calonQuery($request);
        $search = trim((string) $request->query('q', ''));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('calon.nama', 'like', '%' . $search . '%')
                    ->orWhere('calon.no_online', 'like', '%' . $search . '%')
                    ->orWhere('calon.ktp', 'like', '%' . $search . '%')
                    ->orWhereHas('pokok', function ($pokok) use ($search) {
                        $pokok->where('no_animo', 'like', '%' . $search . '%');
                    });
            });
        }
        if (in_array($request->query('jenis'), ['CABA', 'CATA'], true)) {
            $prefix = $request->query('jenis') === 'CABA' ? 'BA' : 'TA';
            $query->whereHas('pokok', function ($pokok) use ($prefix) {
                $pokok->where('no_animo', 'like', $prefix . '%');
            });
        }
        if ($request->query('validasi') === 'sudah') {
            $query->where(function ($q) {
                $q->where('calon.no_online', 'like', '082.%/BA')->orWhere('calon.no_online', 'like', '082.%/TA');
            });
        } elseif ($request->query('validasi') === 'belum') {
            $query->where(function ($q) {
                $q->whereNull('calon.no_online')->orWhere(function ($notValidated) {
                    $notValidated->where('calon.no_online', 'not like', '082.%/BA')
                        ->where('calon.no_online', 'not like', '082.%/TA');
                });
            });
        }
        if ($request->filled('kodim')) {
            $query->whereHas('pokok', function ($pokok) use ($request) {
                $pokok->where('kodim', $request->query('kodim'));
            });
        }

        if (in_array($sort, $allowedSortColumns, true)) {
            if ($sort === 'no_animo') {
                $query->orderBy(
                    Pokok::select('no_animo')->whereColumn('pokok.id', 'calon.id')->limit(1),
                    $direction
                );
                $query->orderByDesc('calon.id');
            } else {
                $query->orderBy('calon.' . $sort, $direction);
                if ($sort !== 'id') {
                    $query->orderByDesc('calon.id');
                }
            }
        } else {
            $sort = 'updated_at';
            $direction = 'desc';
            $query->orderByDesc('calon.updated_at')->orderByDesc('calon.id');
        }

        $data = $query->paginate($perPage)->withQueryString();

        $kodims = $request->user()->isSuperadmin() ? Pokok::whereNotNull('kodim')->where('kodim', '!=', '')->distinct()->orderBy('kodim')->pluck('kodim') : collect();
        return view('admin.calon', compact('data', 'sort', 'direction', 'perPage', 'kodims'));
    }

    public function printCalon(Request $request, $id)
    {
        $user = $request->user();
        $calon = Calon::with(['pendidikan', 'wali', 't2020', 'pokok'])->findOrFail($id);

        if ($user && !$user->isSuperadmin()) {
            $isOwnKodim = $this->calonQuery($request)->where('calon.id', $id)->exists();
            if (!$isOwnKodim) {
                abort(403);
            }
        }

        $pokok = $calon->pokok ?? Pokok::find($calon->id);
        $pendidikan = $calon->pendidikan ?? Pendidikan::where('calon_id', $calon->id)->first();
        $wali = $calon->wali ?? Wali::where('calon_id', $calon->id)->first();
        $nilai = $calon->t2020 ?? T2020::where('calon_id', $calon->id)->first();
        $setting = Setting::find(1);

        $kodim = $pokok?->kodim;
        $petugas = User::where('penanggung_jawab_kodim', $kodim)->first()
            ?? User::where('kodim', $kodim)->whereNotNull('nrp')->first()
            ?? User::whereNotNull('nrp')->first();

        return view('calon.pdf', compact('pendidikan', 'setting', 'wali', 'nilai', 'calon', 'pokok', 'petugas'));
    }

    public function calonDestroy(Request $request)
    {
        $user = $request->user();
        $calon = Calon::find($request->id);
        if (!$calon) {
            return back()->with('danger', 'Calon tidak ditemukan');
        }

        if ($user && !$user->isSuperadmin()) {
            $isOwnKodim = $this->calonQuery($request)->where('calon.id', $request->id)->exists();
            if (!$isOwnKodim) {
                abort(403);
            }
        }

        Calon::destroy($request->id);
        return back()->with('success', 'Calon dengan ID ' . $request->id . ' berhasil dihapus!');
    }

    public function calonDestroyAll(Request $request)
    {
        if (!$request->user()->isSuperadmin()) {
            abort(403);
        }

        Schema::disableForeignKeyConstraints();
        Calon::truncate();
        Wali::truncate();
        Pendidikan::truncate();
        T2019::truncate();
        T2020::truncate();
        Schema::enableForeignKeyConstraints();
        return back()->with('success', 'Data berhasil dihapus!');
    }

    private function calonQuery(Request $request)
    {
        $user = $request->user();
        $kodim = ($user && $user->isSuperadmin()) ? null : $user?->kodim;
        $query = Calon::query()->with('pokok');

        if ($kodim !== null) {
            $query->where(function ($q) use ($kodim) {
                $q->whereHas('pokok', function ($sub) use ($kodim) {
                    $sub->where('kodim', $kodim);
                })->orWhereIn('no_online', function ($sub) use ($kodim) {
                    $sub->select('no_online')->from('pokok')->where('kodim', $kodim)->whereNotNull('no_online')->where('no_online', '!=', '');
                })->orWhereIn('ktp', function ($sub) use ($kodim) {
                    $sub->select('nik')->from('pokok')->where('kodim', $kodim)->whereNotNull('nik')->where('nik', '!=', '');
                });
            });
        } elseif ($user && !$user->isSuperadmin()) {
            $query->whereRaw('1 = 0');
        }

        return $query;
    }

    public function pokok(Request $request)
    {
        $filters = $this->pokokFilters($request);
        $kodim = $request->user()->isSuperadmin() ? null : $request->user()->kodim;
        $query = Pokok::query();
        if ($kodim !== null) {
            $query->where('kodim', $kodim);
        } elseif (!$request->user()->isSuperadmin()) {
            $query->whereRaw('1 = 0');
        }
        $perPage = (int) $request->input('per_page', 50);
        if (!in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 50;
        }

        $allowedSortColumns = array_merge(['id'], array_keys(Pokok::EXCEL_COLUMNS));
        $sort = $request->input('sort');
        $direction = strtolower($request->input('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

        if (in_array($sort, $allowedSortColumns, true)) {
            $query->orderBy($sort, $direction);
            if ($sort !== 'id') {
                $query->orderByDesc('id');
            }
        } else {
            $sort = 'id';
            $direction = 'desc';
            $query->orderByDesc('id');
        }

        $data = $query->filtered($filters)->paginate($perPage)->withQueryString();
        $options = [];
        foreach (['jalur_pendaftaran', 'kdpanda', 'kodim'] as $column) {
            $optionQuery = Pokok::query()->whereNotNull($column)->where($column, '!=', '');
            if ($kodim !== null) {
                $optionQuery->where('kodim', $kodim);
            } elseif (!$request->user()->isSuperadmin()) {
                $optionQuery->whereRaw('1 = 0');
            }
            $options[$column] = $optionQuery->distinct()->orderBy($column)->pluck($column);
        }

        return view('admin.pokok', compact('data', 'filters', 'options', 'sort', 'direction', 'perPage'));
    }

    public function exportPokok(Request $request)
    {
        $filters = $this->pokokFilters($request);

        return Excel::download(new PokokExport($filters), 'data-pokok.xlsx');
    }

    private function pokokFilters(Request $request): array
    {
        return $request->validate([
            'q' => 'nullable|string|max:100',
            'jenis' => 'nullable|in:CABA,CATA',
            'jalur_pendaftaran' => 'nullable|string|max:255',
            'kdpanda' => 'nullable|string|max:255',
            'kodim' => 'nullable|string|max:255',
        ]);
    }

    public function createPokok()
    {
        return view('admin.createDataPokok');
    }

    public function storePokok(Request $request)
    {
        $data = $request->all();
        // $data['suku'] = 'J';
        // $data['agama'] = 'I';
        Pokok::create($data);
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

        if ($request->file('file')) {
            Excel::import(new PokokImport, $request->file);
            return back()->with('success', 'Import berhasil');
        } else {
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
        return $this->exportDataSelect($request);
    }

    public function exportAll(Request $request)
    {
        return $this->exportDataAll($request);
    }

    public function exportDataAll(Request $request)
    {
        $calon = $this->calonQuery($request)->pluck('id')->all();

        $name = env('PONPES') ? 'santri.xlsx' : 'calon.xlsx';
        return Excel::download(new DataExport($calon), $name);
    }

    public function exportDataSelect(Request $request)
    {
        if (empty($request->calon)) {
            return back()->with('danger', 'Harap pilih data terlebih dahulu');
        }

        $calon = $this->calonQuery($request)
            ->whereIn('id', (array) $request->calon)
            ->pluck('id')
            ->all();

        if (empty($calon)) {
            return back()->with('danger', 'Harap pilih data terlebih dahulu');
        }

        $name = env('PONPES') ? 'santri.xlsx' : 'calon.xlsx';
        return Excel::download(new DataExport($calon), $name);
    }

    public function setting()
    {
        $data =  Setting::find(1);
        return view('admin.setting', compact('data'));
    }

    public function settingUpdate(Request $request, Setting $setting)
    {
        $setting->update($request->all());
        return back()->with('success', 'Data berhasil diupdate!');
    }
}
