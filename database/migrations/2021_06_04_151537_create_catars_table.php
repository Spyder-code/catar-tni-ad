<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catar', function (Blueprint $table) {
            $table->id();
            $table->string('nodaf');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('suku');
            $table->string('agama');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('no');
            $table->string('dusun');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kab_kota');
            $table->string('telephone');
            $table->string('daftar_ke');
            $table->string('aspek_tl');
            $table->string('sd');
            $table->string('smp');
            $table->string('sma');
            $table->string('thn_lulus_sd');
            $table->string('thn_lulus_smp');
            $table->string('thn_lulus_sma');
            $table->string('jurusan');
            $table->string('jumlah_nuan');
            $table->string('rata_rata_nuan');
            $table->string('ayah');
            $table->string('ibu');
            $table->string('pekerjaan_ayah');
            $table->string('pangkat');
            $table->string('satuan');
            $table->string('pekerjaan_ibu');
            $table->string('alamat_ortu');
            $table->string('telephone_ortu');
            $table->string('status_wali');
            $table->string('hub_calon_wali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catars');
    }
}
