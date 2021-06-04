<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_id')->constrained('calon');
            $table->string('sd');
            $table->string('smp');
            $table->string('sma');
            $table->string('thn_lulus_sd');
            $table->string('thn_lulus_smp');
            $table->string('thn_lulus_sma');
            $table->string('jurusan');
            $table->string('jumlah_nuan');
            $table->string('rata_rata_nuan');
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
        Schema::dropIfExists('pendidikans');
    }
}
