<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateT2020STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlulus2020', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_id')->constrained('calon')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('bipeng1')->nullable();
            $table->integer('biket1')->nullable();
            $table->integer('bigpeng1')->nullable();
            $table->integer('bigket1')->nullable();
            $table->integer('mtkpeng1')->nullable();
            $table->integer('mtkket1')->nullable();
            $table->integer('fispeng1')->nullable();
            $table->integer('fisket1')->nullable();
            $table->integer('kimpeng1')->nullable();
            $table->integer('kimket1')->nullable();
            $table->integer('biopeng1')->nullable();
            $table->integer('bioket1')->nullable();
            $table->integer('bipeng2')->nullable();
            $table->integer('biket2')->nullable();
            $table->integer('bigpeng2')->nullable();
            $table->integer('bigket2')->nullable();
            $table->integer('mtkpeng2')->nullable();
            $table->integer('mtkket2')->nullable();
            $table->integer('fispeng2')->nullable();
            $table->integer('fisket2')->nullable();
            $table->integer('kimpeng2')->nullable();
            $table->integer('kimket2')->nullable();
            $table->integer('biopeng2')->nullable();
            $table->integer('bioket2')->nullable();
            $table->integer('bipeng3')->nullable();
            $table->integer('biket3')->nullable();
            $table->integer('bigpeng3')->nullable();
            $table->integer('bigket3')->nullable();
            $table->integer('mtkpeng3')->nullable();
            $table->integer('mtkket3')->nullable();
            $table->integer('fispeng3')->nullable();
            $table->integer('fisket3')->nullable();
            $table->integer('kimpeng3')->nullable();
            $table->integer('kimket3')->nullable();
            $table->integer('biopeng3')->nullable();
            $table->integer('bioket3')->nullable();
            $table->integer('bipeng4')->nullable();
            $table->integer('biket4')->nullable();
            $table->integer('bigpeng4')->nullable();
            $table->integer('bigket4')->nullable();
            $table->integer('mtkpeng4')->nullable();
            $table->integer('mtkket4')->nullable();
            $table->integer('fispeng4')->nullable();
            $table->integer('fisket4')->nullable();
            $table->integer('kimpeng4')->nullable();
            $table->integer('kimket4')->nullable();
            $table->integer('biopeng4')->nullable();
            $table->integer('bioket4')->nullable();
            $table->integer('bipeng5')->nullable();
            $table->integer('biket5')->nullable();
            $table->integer('bigpeng5')->nullable();
            $table->integer('bigket5')->nullable();
            $table->integer('mtkpeng5')->nullable();
            $table->integer('mtkket5')->nullable();
            $table->integer('fispeng5')->nullable();
            $table->integer('fisket5')->nullable();
            $table->integer('kimpeng5')->nullable();
            $table->integer('kimket5')->nullable();
            $table->integer('biopeng5')->nullable();
            $table->integer('bioket5')->nullable();
            $table->integer('bipeng6')->nullable();
            $table->integer('biket6')->nullable();
            $table->integer('bigpeng6')->nullable();
            $table->integer('bigket6')->nullable();
            $table->integer('mtkpeng6')->nullable();
            $table->integer('mtkket6')->nullable();
            $table->integer('fispeng6')->nullable();
            $table->integer('fisket6')->nullable();
            $table->integer('kimpeng6')->nullable();
            $table->integer('kimket6')->nullable();
            $table->integer('biopeng6')->nullable();
            $table->integer('bioket6')->nullable();
            $table->integer('jumlah1')->nullable();
            $table->integer('jumlah_ket1')->nullable();
            $table->integer('jumlah2')->nullable();
            $table->integer('jumlah_ket2')->nullable();
            $table->integer('jumlah3')->nullable();
            $table->integer('jumlah_ket3')->nullable();
            $table->integer('jumlah4')->nullable();
            $table->integer('jumlah_ket4')->nullable();
            $table->integer('jumlah5')->nullable();
            $table->integer('jumlah_ket5')->nullable();
            $table->integer('jumlah6')->nullable();
            $table->integer('jumlah_ket6')->nullable();
            $table->integer('rata1')->nullable();
            $table->integer('rata_ket1')->nullable();
            $table->integer('rata2')->nullable();
            $table->integer('rata_ket2')->nullable();
            $table->integer('rata3')->nullable();
            $table->integer('rata_ket3')->nullable();
            $table->integer('rata4')->nullable();
            $table->integer('rata_ket4')->nullable();
            $table->integer('rata5')->nullable();
            $table->integer('rata_ket5')->nullable();
            $table->integer('rata6')->nullable();
            $table->integer('rata_ket6')->nullable();
            $table->integer('rata_smt1')->nullable();
            $table->integer('rata_smt2')->nullable();
            $table->integer('rata_smt3')->nullable();
            $table->integer('rata_smt4')->nullable();
            $table->integer('rata_smt5')->nullable();
            $table->integer('rata_smt6')->nullable();
            $table->integer('rata_kls1')->nullable();
            $table->integer('rata_kls2')->nullable();
            $table->integer('rata_kls3')->nullable();
            $table->integer('rata_akhir')->nullable();
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
        Schema::dropIfExists('t2020_s');
    }
}
