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
            $table->string('sd')->nullable();
            $table->string('smp')->nullable();
            $table->string('sma')->nullable();
            $table->string('l_sd')->nullable();
            $table->string('l_smp')->nullable();
            $table->string('l_sma')->nullable();
            $table->string('kab_sd')->nullable();
            $table->string('kab_smp')->nullable();
            $table->string('kab_sma')->nullable();
            $table->string('nama_sma')->nullable();
            $table->string('jur')->nullable();
            $table->string('jumlah_nuan')->nullable();
            $table->string('rata')->nullable();
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
