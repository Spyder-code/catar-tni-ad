<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wali', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_id')->constrained('calon');
            $table->string('ayah');
            $table->string('a_kerja');
            $table->string('a_pkt');
            $table->string('a_jab');
            $table->string('a_sat');
            $table->string('ibu');
            $table->string('i_kerja');
            $table->string('i_pkt');
            $table->string('i_jab');
            $table->string('i_sat');
            $table->string('o_telp');
            $table->string('o_alamat');
            $table->string('status_wali');
            $table->string('hub_calon_wali')->nullable();
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
        Schema::dropIfExists('walis');
    }
}
