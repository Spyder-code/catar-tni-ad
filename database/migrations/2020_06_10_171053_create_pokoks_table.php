<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokok', function (Blueprint $table) {
            $table->id();
            $table->string('no_online');
            $table->string('nama');
            $table->string('tem_lahir');
            $table->string('tgl_lahir');
            $table->string('kdpanda');
            $table->string('tb');
            $table->string('bb');
            $table->string('suku');
            $table->string('agama');
            $table->string('ortu1');
            $table->string('wali1');
            $table->text('alamat_c');
            $table->text('alamat_o');
            $table->string('jenis sekolah');
            $table->string('nama_sekolah');
            $table->string('jur');
            $table->string('th_lulus');
            $table->string('kerja');
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
        Schema::dropIfExists('pokoks');
    }
}
