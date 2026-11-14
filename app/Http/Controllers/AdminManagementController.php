<?php

namespace App\Http\Controllers;

use App\Models\Pokok;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->orderBy('kodim')->orderBy('name')->get();
        $kodims = Pokok::query()->whereNotNull('kodim')->where('kodim', '!=', '')
            ->distinct()->orderBy('kodim')->pluck('kodim');

        return view('admin.management', compact('admins', 'kodims'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        DB::transaction(function () use ($data) {
            if ($data['penanggung_jawab'] === '1') {
                User::where('penanggung_jawab_kodim', $data['kodim'])
                    ->update(['penanggung_jawab_kodim' => null]);
            }

            User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'avatar' => '/storage/user/default.png',
                'role' => 'admin',
                'kodim' => $data['kodim'],
                'nrp' => $data['nrp'] ?? null,
                'penanggung_jawab_kodim' => $data['penanggung_jawab'] === '1' ? $data['kodim'] : null,
            ]);
        });

        return redirect()->route('admin-management.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function update(Request $request, User $admin)
    {
        abort_unless($admin->role === 'admin', 404);
        $data = $this->validated($request, $admin);

        DB::transaction(function () use ($admin, $data) {
            // Release the old unique key before assigning the new signer.
            $admin->update(['penanggung_jawab_kodim' => null]);
            if ($data['penanggung_jawab'] === '1') {
                User::where('penanggung_jawab_kodim', $data['kodim'])
                    ->update(['penanggung_jawab_kodim' => null]);
            }

            $changes = [
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'kodim' => $data['kodim'],
                'nrp' => $data['nrp'] ?? null,
                'penanggung_jawab_kodim' => $data['penanggung_jawab'] === '1' ? $data['kodim'] : null,
            ];
            if (!empty($data['password'])) {
                $changes['password'] = Hash::make($data['password']);
            }
            $admin->update($changes);
        });

        return redirect()->route('admin-management.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy(User $admin)
    {
        abort_unless($admin->role === 'admin', 404);
        $admin->delete();

        return redirect()->route('admin-management.index')->with('success', 'Admin berhasil dihapus.');
    }

    private function validated(Request $request, ?User $admin = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($admin?->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($admin?->id)],
            'password' => [$admin ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'kodim' => ['required', 'string', 'max:255'],
            'penanggung_jawab' => ['required', Rule::in(['0', '1'])],
            'nrp' => [Rule::requiredIf($request->input('penanggung_jawab') === '1'), 'nullable', 'string', 'max:50'],
        ]);

        if (!Pokok::where('kodim', $data['kodim'])->exists()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'kodim' => 'Kodim belum tersedia. Upload Data Pokok terlebih dahulu.',
            ]);
        }

        return $data;
    }
}
