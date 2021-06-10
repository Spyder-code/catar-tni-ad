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
            $table->string('nama')->nullable();
            $table->string('agama')->nullable();
            $table->string('tem_lahir')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('suku')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('no')->nullable();
            $table->string('dsn')->nullable();
            $table->string('ds')->nullable();
            $table->string('kec')->nullable();
            $table->string('kab')->nullable();
            $table->string('telp')->nullable();
            $table->string('daftar_ke')->nullable();
            $table->string('aspek_tl')->nullable();
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
