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
            $table->foreignId('calon_id')->constrained('calon');
            $table->string('bipeng1',10)->nullable();
            $table->string('biket1',10)->nullable();
            $table->string('bigpeng1',10)->nullable();
            $table->string('bigket1',10)->nullable();
            $table->string('mtkpeng1',10)->nullable();
            $table->string('mtkket1',10)->nullable();
            $table->string('fispeng1',10)->nullable();
            $table->string('fisket1',10)->nullable();
            $table->string('kimpeng1',10)->nullable();
            $table->string('kimket1',10)->nullable();
            $table->string('biopeng1',10)->nullable();
            $table->string('bioket1',10)->nullable();
            $table->string('bipeng2',10)->nullable();
            $table->string('biket2',10)->nullable();
            $table->string('bigpeng2',10)->nullable();
            $table->string('bigket2',10)->nullable();
            $table->string('mtkpeng2',10)->nullable();
            $table->string('mtkket2',10)->nullable();
            $table->string('fispeng2',10)->nullable();
            $table->string('fisket2',10)->nullable();
            $table->string('kimpeng2',10)->nullable();
            $table->string('kimket2',10)->nullable();
            $table->string('biopeng2',10)->nullable();
            $table->string('bioket2',10)->nullable();
            $table->string('bipeng3',10)->nullable();
            $table->string('biket3',10)->nullable();
            $table->string('bigpeng3',10)->nullable();
            $table->string('bigket3',10)->nullable();
            $table->string('mtkpeng3',10)->nullable();
            $table->string('mtkket3',10)->nullable();
            $table->string('fispeng3',10)->nullable();
            $table->string('fisket3',10)->nullable();
            $table->string('kimpeng3',10)->nullable();
            $table->string('kimket3',10)->nullable();
            $table->string('biopeng3',10)->nullable();
            $table->string('bioket3',10)->nullable();
            $table->string('bipeng4',10)->nullable();
            $table->string('biket4',10)->nullable();
            $table->string('bigpeng4',10)->nullable();
            $table->string('bigket4',10)->nullable();
            $table->string('mtkpeng4',10)->nullable();
            $table->string('mtkket4',10)->nullable();
            $table->string('fispeng4',10)->nullable();
            $table->string('fisket4',10)->nullable();
            $table->string('kimpeng4',10)->nullable();
            $table->string('kimket4',10)->nullable();
            $table->string('biopeng4',10)->nullable();
            $table->string('bioket4',10)->nullable();
            $table->string('bipeng5',10)->nullable();
            $table->string('biket5',10)->nullable();
            $table->string('bigpeng5',10)->nullable();
            $table->string('bigket5',10)->nullable();
            $table->string('mtkpeng5',10)->nullable();
            $table->string('mtkket5',10)->nullable();
            $table->string('fispeng5',10)->nullable();
            $table->string('fisket5',10)->nullable();
            $table->string('kimpeng5',10)->nullable();
            $table->string('kimket5',10)->nullable();
            $table->string('biopeng5',10)->nullable();
            $table->string('bioket5',10)->nullable();
            $table->string('bipeng6',10)->nullable();
            $table->string('biket6',10)->nullable();
            $table->string('bigpeng6',10)->nullable();
            $table->string('bigket6',10)->nullable();
            $table->string('mtkpeng6',10)->nullable();
            $table->string('mtkket6',10)->nullable();
            $table->string('fispeng6',10)->nullable();
            $table->string('fisket6',10)->nullable();
            $table->string('kimpeng6',10)->nullable();
            $table->string('kimket6',10)->nullable();
            $table->string('biopeng6',10)->nullable();
            $table->string('bioket6',10)->nullable();
            $table->string('jumlah1',10)->nullable();
            $table->string('jumlah_ket1',10)->nullable();
            $table->string('jumlah2',10)->nullable();
            $table->string('jumlah_ket2',10)->nullable();
            $table->string('jumlah3',10)->nullable();
            $table->string('jumlah_ket3',10)->nullable();
            $table->string('jumlah4',10)->nullable();
            $table->string('jumlah_ket4',10)->nullable();
            $table->string('jumlah5',10)->nullable();
            $table->string('jumlah_ket5',10)->nullable();
            $table->string('jumlah6',10)->nullable();
            $table->string('jumlah_ket6',10)->nullable();
            $table->string('rata1',10)->nullable();
            $table->string('rata_ket1',10)->nullable();
            $table->string('rata2',10)->nullable();
            $table->string('rata_ket2',10)->nullable();
            $table->string('rata3',10)->nullable();
            $table->string('rata_ket3',10)->nullable();
            $table->string('rata4',10)->nullable();
            $table->string('rata_ket4',10)->nullable();
            $table->string('rata5',10)->nullable();
            $table->string('rata_ket5',10)->nullable();
            $table->string('rata6',10)->nullable();
            $table->string('rata_ket6',10)->nullable();
            $table->string('rata_smt1',10)->nullable();
            $table->string('rata_smt2',10)->nullable();
            $table->string('rata_smt3',10)->nullable();
            $table->string('rata_smt4',10)->nullable();
            $table->string('rata_smt5',10)->nullable();
            $table->string('rata_smt6',10)->nullable();
            $table->string('rata_kls1',10)->nullable();
            $table->string('rata_kls2',10)->nullable();
            $table->string('rata_kls3',10)->nullable();
            $table->string('rata_akhir',10)->nullable();
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
