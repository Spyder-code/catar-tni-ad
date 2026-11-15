<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalonRequest;
use App\Models\Calon;
use App\Models\Pokok;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CalonVerificationController extends Controller
{
    public function show(Request $request, Calon $calon)
    {
        $this->authorizeCalon($request, $calon);
        $calon->load(['pokok', 'pendidikan', 'wali', 't2020', 't2019']);
        $pokok = $calon->pokok;
        abort_unless($pokok, 404);
        return view('calon.formulir', [
            'calon' => $calon, 'pokok' => $pokok, 'setting' => Setting::find(1),
            'pendidikan' => $calon->pendidikan, 'wali' => $calon->wali,
            'nilai' => $calon->t2020, 'nilai2019' => $calon->t2019,
            'status' => 1, 'adminReview' => true,
        ]);
    }

    public function update(CalonRequest $request, Calon $calon)
    {
        $this->authorizeCalon($request, $calon);
        $this->save($request, $calon);
        return redirect()->route('calon.verify.show', $calon)->with('success', 'Data calon berhasil diperbarui.');
    }

    public function submit(CalonRequest $request, Calon $calon)
    {
        $this->authorizeCalon($request, $calon);
        DB::transaction(function () use ($request, $calon) {
            $calon = Calon::whereKey($calon->id)->lockForUpdate()->firstOrFail();
            $pokok = Pokok::whereKey($calon->id)->lockForUpdate()->firstOrFail();
            $this->save($request, $calon);
            if ($calon->no_online && preg_match('~^082\.\d{5}/(?:BA|TA)$~', $calon->no_online)) {
                $pokok->update(['no_online' => $calon->no_online, 'tanggal_validasi' => $pokok->tanggal_validasi ?: now()->format('d-m-Y')]);
                return;
            }
            $type = strtoupper((string) $pokok->jenis_pendaftaran) === 'CATA' || str_starts_with(strtoupper((string) $pokok->no_animo), 'TA') ? 'TA' : 'BA';
            $counter = DB::table('validation_counters')->where('type', $type)->lockForUpdate()->first();
            if (!$counter) {
                throw ValidationException::withMessages(['calon.no_online' => 'Counter validasi belum tersedia. Jalankan migrasi database.']);
            }
            $existing = DB::table('pokok')->where('no_online', 'like', '082.%/' . $type)->pluck('no_online')
                ->merge(DB::table('calon')->where('no_online', 'like', '082.%/' . $type)->pluck('no_online'));
            $used = $existing->filter(fn ($number) => preg_match('~^082\.(\d{5})/' . $type . '$~', $number))
                ->mapWithKeys(fn ($number) => [(int) substr($number, 4, 5) => true]);
            $next = 1;
            while ($used->has($next) && $next <= 99999) {
                $next++;
            }
            if ($next > 99999) {
                throw ValidationException::withMessages(['calon.no_online' => 'Nomor validasi ' . $type . ' sudah habis.']);
            }
            $number = sprintf('082.%05d/%s', $next, $type);
            DB::table('validation_counters')->where('type', $type)->update(['last_number' => max($counter->last_number, $next)]);
            $calon->update(['no_online' => $number]);
            $pokok->update(['no_online' => $number, 'tanggal_validasi' => now()->format('d-m-Y')]);
        }, 5);

        return redirect()->route('calon.print', $calon->id)->with('auto_print', true);
    }

    public function cancel(Request $request, Calon $calon)
    {
        $this->authorizeCalon($request, $calon);
        $request->validate(['persetujuan' => 'accepted']);

        DB::transaction(function () use ($calon) {
            $calon = Calon::whereKey($calon->id)->lockForUpdate()->firstOrFail();
            $pokok = Pokok::whereKey($calon->id)->lockForUpdate()->firstOrFail();
            if (!preg_match('~^082\.\d{5}/(BA|TA)$~', (string) $calon->no_online, $matches)) {
                throw ValidationException::withMessages(['persetujuan' => 'Calon ini belum memiliki nomor validasi.']);
            }
            DB::table('validation_counters')->where('type', $matches[1])->lockForUpdate()->first();
            $calon->update(['no_online' => null]);
            $pokok->update(['no_online' => null, 'tanggal_validasi' => null]);
        }, 5);

        return redirect()->route('calon')->with('success', 'Validasi dibatalkan. Calon perlu diverifikasi kembali.');
    }

    private function save(CalonRequest $request, Calon $calon): void
    {
        $data = $request->validated();
        $personal = array_intersect_key($request->input('calon', []), array_flip($calon->getFillable()));
        unset($personal['no_online']);
        $date = strtotime($personal['tgl_lahir']);
        $personal += ['l_hri' => date('d', $date), 'l_bln' => date('m', $date), 'l_thn' => date('Y', $date)];
        $calon->update($personal);
        foreach (['pendidikan' => 'pendidikan', 'wali' => 'wali', 'nilai' => 't2020', 'nilai2019' => 't2019'] as $input => $relation) {
            if ($request->has($input)) {
                $model = $calon->{$relation}()->getRelated();
                $values = array_intersect_key($request->input($input, []), array_flip($model->getFillable()));
                unset($values['calon_id']);
                $calon->{$relation}()->updateOrCreate(['calon_id' => $calon->id], $values);
            }
        }
    }

    private function authorizeCalon(Request $request, Calon $calon): void
    {
        $user = $request->user();
        abort_unless($user && ($user->isSuperadmin() || ($user->kodim && $calon->pokok?->kodim === $user->kodim)), 403);
    }
}
