<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon', function (Blueprint $table) {
            $table->id();
            $table->string('no_online');
            $table->string('nama');
            $table->string('tem_lahir');
            $table->string('tgl_lahir');
            $table->string('suku');
            $table->string('agama');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('no');
            $table->string('dsn');
            $table->string('ds');
            $table->string('kec');
            $table->string('kab');
            $table->string('telp');
            $table->string('daftar_ke');
            $table->string('aspek_tl');
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
        Schema::dropIfExists('calons');
    }
}
