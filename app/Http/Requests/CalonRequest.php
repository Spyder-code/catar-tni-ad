<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (env('PONPES')) {
            return [
                'pokok_id' => 'required',
                'calon.nama' => 'required',
                'calon.no_online' => 'nullable',
                'calon.no_kk' => 'required',
                'calon.ktp' => 'required|min:16',
                'calon.tem_lahir' => 'required',
                'calon.tgl_lahir' => 'required',
                'calon.suku' => 'required',
                'calon.agama' => 'required',
                'calon.alamat' => 'required',
                'calon.rt' => 'required',
                'calon.rw' => 'required',
                'calon.no' => 'required',
                'calon.dsn' => 'required',
                'calon.ds' => 'required',
                'calon.kec' => 'required',
                'calon.kab' => 'required',
                'calon.telp' => 'required',
                'calon.daftar_ke' => 'required',
                'calon.aspek_tl' => 'required',
                'calon.keahlian' => 'required',
                'calon.bpjs' => 'nullable',
                'calon.inst' => 'nullable',
                'calon.face' => 'nullable',
                'calon.tiktok' => 'nullable',
                'calon.twiter' => 'nullable',
                'pendidikan.nisnsd' => 'required|min:10',
                'pendidikan.nisnsmp' => 'required|min:10',
                'pendidikan.nisnsma' => 'required|min:10',
                'pendidikan.sd' => 'required',
                'pendidikan.l_sd' => 'required',
                'pendidikan.kab_sd' => 'required',
                'pendidikan.smp' => 'required',
                'pendidikan.l_smp' => 'required',
                'pendidikan.kab_smp' => 'required',
                'pendidikan.sma' => 'required',
                'pendidikan.ponpes' => 'required',
                'pendidikan.l_sma' => 'required',
                'pendidikan.kab_sma' => 'required',
                'pendidikan.jur' => 'required',
                'wali.ayah' => 'required',
                'wali.a_kakek' => 'required',
                'wali.a_kakek_almt_skr' => 'required',
                'wali.a_kakek_almt_sblm' => 'required',
                'wali.a_nenek' => 'required',
                'wali.a_nenek_almt_skr' => 'required',
                'wali.a_nenek_almt_sblm' => 'required',
                'wali.a_kerja' => 'required',
                'wali.ibu' => 'required',
                'wali.i_kerja' => 'required',
                'wali.i_kakek' => 'required',
                'wali.i_kakek_almt_skr' => 'required',
                'wali.i_kakek_almt_sblm' => 'required',
                'wali.i_nenek' => 'required',
                'wali.i_nenek_almt_skr' => 'required',
                'wali.i_nenek_almt_sblm' => 'required',
                'wali.o_telp' => 'required',
                'wali.o_alamat' => 'required',
            ];
        } else {
            return [
                'pokok_id' => 'required',
                'calon.nama' => 'required',
                'calon.no_online' => 'nullable',
                'calon.no_kk' => 'required',
                'calon.ktp' => 'required|min:16',
                'calon.tem_lahir' => 'required',
                'calon.tgl_lahir' => 'required',
                'calon.suku' => 'required',
                'calon.agama' => 'required',
                'calon.alamat' => 'required',
                'calon.rt' => 'required',
                'calon.rw' => 'required',
                'calon.no' => 'required',
                'calon.dsn' => 'required',
                'calon.ds' => 'required',
                'calon.kec' => 'required',
                'calon.kab' => 'required',
                'calon.telp' => 'required',
                'calon.daftar_ke' => 'required',
                'calon.aspek_tl' => 'required',
                'calon.keahlian' => 'required',
                'calon.bpjs' => 'nullable',
                'calon.inst' => 'nullable',
                'calon.face' => 'nullable',
                'calon.tiktok' => 'nullable',
                'calon.twiter' => 'nullable',
                'pendidikan.nisnsd' => 'required',
                'pendidikan.nisnsmp' => 'required',
                'pendidikan.nisnsma' => 'required',
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
                'wali.a_kakek' => 'required',
                'wali.a_kakek_almt_skr' => 'required',
                'wali.a_kakek_almt_sblm' => 'required',
                'wali.a_nenek' => 'required',
                'wali.a_nenek_almt_skr' => 'required',
                'wali.a_nenek_almt_sblm' => 'required',
                'wali.a_kerja' => 'required',
                'wali.ibu' => 'required',
                'wali.i_kerja' => 'required',
                'wali.i_kakek' => 'required',
                'wali.i_kakek_almt_skr' => 'required',
                'wali.i_kakek_almt_sblm' => 'required',
                'wali.i_nenek' => 'required',
                'wali.i_nenek_almt_skr' => 'required',
                'wali.i_nenek_almt_sblm' => 'required',
                'wali.o_telp' => 'required',
                'wali.o_alamat' => 'required',
            ];
        }

    }
}
