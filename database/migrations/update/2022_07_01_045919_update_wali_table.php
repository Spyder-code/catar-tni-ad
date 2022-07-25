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
            $table->string('a_kakek_almt_skr')->nullable()->after('a_kakek');
            $table->string('a_kakek_almt_sblm')->nullable()->after('a_kakek_almt_skr');
            $table->string('a_nenek_almt_skr')->nullable()->after('a_nenek');
            $table->string('a_nenek_almt_sblm')->nullable()->after('a_nenek_almt_skr');
            $table->string('i_kakek_almt_skr')->nullable()->after('i_kakek');
            $table->string('i_kakek_almt_sblm')->nullable()->after('i_kakek_almt_skr');
            $table->string('i_nenek_almt_skr')->nullable()->after('i_nenek');
            $table->string('i_nenek_almt_sblm')->nullable()->after('i_nenek_almt_skr');
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
