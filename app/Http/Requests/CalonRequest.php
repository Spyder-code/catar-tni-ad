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
        return [
            'calon.nama' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'calon.no_online' => 'required',
            'calon.no_kk' => 'required',
            'calon.ktp' => 'required|min:16',
            'calon.tem_lahir' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'calon.tgl_lahir' => 'required',
            'calon.suku' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'calon.agama' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'calon.alamat' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'calon.rt' => 'required',
            'calon.rw' => 'required',
            'calon.no' => 'required',
            'calon.dsn' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'calon.ds' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'calon.kec' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'calon.kab' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'calon.telp' => 'required',
            'calon.daftar_ke' => 'required',
            'calon.aspek_tl' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'calon.keahlian' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'pendidikan.sd' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'pendidikan.l_sd' => 'required',
            'pendidikan.kab_sd' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'pendidikan.smp' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'pendidikan.l_smp' => 'required',
            'pendidikan.kab_smp' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'pendidikan.sma' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'pendidikan.l_sma' => 'required',
            'pendidikan.kab_sma' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'pendidikan.jur' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'wali.ayah' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'wali.a_kakek' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'wali.a_nenek' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'wali.a_kerja' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'wali.ibu' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'wali.i_kerja' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'wali.i_kakek' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'wali.i_nenek' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'wali.o_telp' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
            'wali.o_alamat' => 'required|regex:/^[a-zA-Z0-9 .,-]+$/',
        ];
    }
}
