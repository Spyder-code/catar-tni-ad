<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WaliAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wali', function (Blueprint $table) {
            $table->string('a_kakek_almt_skr')->after('a_kakek')->nullable();
            $table->string('a_kakek_almt_sblm')->after('a_kakek_almt_skr')->nullable();
            $table->string('a_nenek_almt_skr')->after('a_nenek')->nullable();
            $table->string('a_nenek_almt_sblm')->after('a_nenek_almt_skr')->nullable();
            $table->string('i_kakek_almt_skr')->after('i_kakek')->nullable();
            $table->string('i_kakek_almt_sblm')->after('i_kakek_almt_skr')->nullable();
            $table->string('i_nenek_almt_skr')->after('i_nenek')->nullable();
            $table->string('i_nenek_almt_sblm')->after('i_nenek_almt_skr')->nullable();
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
