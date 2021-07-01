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
            $table->string('bipeng1',11)->nullable();
            $table->string('biket1',11)->nullable();
            $table->string('bigpeng1',11)->nullable();
            $table->string('bigket1',11)->nullable();
            $table->string('mtkpeng1',11)->nullable();
            $table->string('mtkket1',11)->nullable();
            $table->string('fispeng1',11)->nullable();
            $table->string('fisket1',11)->nullable();
            $table->string('kimpeng1',11)->nullable();
            $table->string('kimket1',11)->nullable();
            $table->string('biopeng1',11)->nullable();
            $table->string('bioket1',11)->nullable();
            $table->string('bipeng2',11)->nullable();
            $table->string('biket2',11)->nullable();
            $table->string('bigpeng2',11)->nullable();
            $table->string('bigket2',11)->nullable();
            $table->string('mtkpeng2',11)->nullable();
            $table->string('mtkket2',11)->nullable();
            $table->string('fispeng2',11)->nullable();
            $table->string('fisket2',11)->nullable();
            $table->string('kimpeng2',11)->nullable();
            $table->string('kimket2',11)->nullable();
            $table->string('biopeng2',11)->nullable();
            $table->string('bioket2',11)->nullable();
            $table->string('bipeng3',11)->nullable();
            $table->string('biket3',11)->nullable();
            $table->string('bigpeng3',11)->nullable();
            $table->string('bigket3',11)->nullable();
            $table->string('mtkpeng3',11)->nullable();
            $table->string('mtkket3',11)->nullable();
            $table->string('fispeng3',11)->nullable();
            $table->string('fisket3',11)->nullable();
            $table->string('kimpeng3',11)->nullable();
            $table->string('kimket3',11)->nullable();
            $table->string('biopeng3',11)->nullable();
            $table->string('bioket3',11)->nullable();
            $table->string('bipeng4',11)->nullable();
            $table->string('biket4',11)->nullable();
            $table->string('bigpeng4',11)->nullable();
            $table->string('bigket4',11)->nullable();
            $table->string('mtkpeng4',11)->nullable();
            $table->string('mtkket4',11)->nullable();
            $table->string('fispeng4',11)->nullable();
            $table->string('fisket4',11)->nullable();
            $table->string('kimpeng4',11)->nullable();
            $table->string('kimket4',11)->nullable();
            $table->string('biopeng4',11)->nullable();
            $table->string('bioket4',11)->nullable();
            $table->string('bipeng5',11)->nullable();
            $table->string('biket5',11)->nullable();
            $table->string('bigpeng5',11)->nullable();
            $table->string('bigket5',11)->nullable();
            $table->string('mtkpeng5',11)->nullable();
            $table->string('mtkket5',11)->nullable();
            $table->string('fispeng5',11)->nullable();
            $table->string('fisket5',11)->nullable();
            $table->string('kimpeng5',11)->nullable();
            $table->string('kimket5',11)->nullable();
            $table->string('biopeng5',11)->nullable();
            $table->string('bioket5',11)->nullable();
            $table->string('bipeng6',11)->nullable();
            $table->string('biket6',11)->nullable();
            $table->string('bigpeng6',11)->nullable();
            $table->string('bigket6',11)->nullable();
            $table->string('mtkpeng6',11)->nullable();
            $table->string('mtkket6',11)->nullable();
            $table->string('fispeng6',11)->nullable();
            $table->string('fisket6',11)->nullable();
            $table->string('kimpeng6',11)->nullable();
            $table->string('kimket6',11)->nullable();
            $table->string('biopeng6',11)->nullable();
            $table->string('bioket6',11)->nullable();
            $table->string('jumlah1',11)->nullable();
            $table->string('jumlah_ket1',11)->nullable();
            $table->string('jumlah2',11)->nullable();
            $table->string('jumlah_ket2',11)->nullable();
            $table->string('jumlah3',11)->nullable();
            $table->string('jumlah_ket3',11)->nullable();
            $table->string('jumlah4',11)->nullable();
            $table->string('jumlah_ket4',11)->nullable();
            $table->string('jumlah5',11)->nullable();
            $table->string('jumlah_ket5',11)->nullable();
            $table->string('jumlah6',11)->nullable();
            $table->string('jumlah_ket6',11)->nullable();
            $table->string('rata1',11)->nullable();
            $table->string('rata_ket1',11)->nullable();
            $table->string('rata2',11)->nullable();
            $table->string('rata_ket2',11)->nullable();
            $table->string('rata3',11)->nullable();
            $table->string('rata_ket3',11)->nullable();
            $table->string('rata4',11)->nullable();
            $table->string('rata_ket4',11)->nullable();
            $table->string('rata5',11)->nullable();
            $table->string('rata_ket5',11)->nullable();
            $table->string('rata6',11)->nullable();
            $table->string('rata_ket6',11)->nullable();
            $table->string('rata_smt1',11)->nullable();
            $table->string('rata_smt2',11)->nullable();
            $table->string('rata_smt3',11)->nullable();
            $table->string('rata_smt4',11)->nullable();
            $table->string('rata_smt5',11)->nullable();
            $table->string('rata_smt6',11)->nullable();
            $table->string('rata_kls1',11)->nullable();
            $table->string('rata_kls2',11)->nullable();
            $table->string('rata_kls3',11)->nullable();
            $table->string('rata_akhir',11)->nullable();
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
