<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifCalonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon', function(Blueprint $table){
            $table->foreignId('pokok_id')->nullable()->after('id')->constrained('pokok')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->string('keahlian')->nullable()->after('aspek_tl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
