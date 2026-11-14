<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokoksTable extends Migration
{
    public function up()
    {
        Schema::create('pokok', function (Blueprint $table) {
            $table->id();
            $table->string('no_animo')->nullable();
            $table->string('no_online')->nullable(); // NO VALIDASI
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->string('tem_lahir')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('suku')->nullable();
            $table->text('alamat_c')->nullable(); // ALAMAT
            $table->string('tb')->nullable();
            $table->string('bb')->nullable();
            $table->string('ortu1')->nullable();
            $table->string('kerja')->nullable();
            $table->string('no_hp_ortu')->nullable();
            $table->string('jenis_sekolah')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->string('jur')->nullable();
            $table->string('th_lulus')->nullable();
            $table->string('no_telp_wa')->nullable();
            $table->string('email')->nullable();
            $table->string('jenis_pendaftaran')->nullable();
            $table->string('jalur_pendaftaran')->nullable();
            $table->string('kdpanda')->nullable(); // PANDA
            $table->string('kodam')->nullable();
            $table->string('kodim')->nullable();
            $table->string('koramil')->nullable();
            $table->string('babinsa')->nullable();
            $table->string('status')->nullable();
            $table->string('tanggal_validasi')->nullable();
            // Kolom lama masih dipakai pada formulir calon.
            $table->string('wali1')->nullable();
            $table->text('alamat_o')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pokok');
    }
}
