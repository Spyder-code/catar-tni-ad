<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWaliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wali', function(Blueprint $table){
            $table->string('a_kakek')->nullable()->after('ayah');
            $table->string('a_nenek')->nullable()->after('a_kakek');
            $table->string('i_kakek')->nullable()->after('ibu');
            $table->string('i_nenek')->nullable()->after('i_kakek');
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
