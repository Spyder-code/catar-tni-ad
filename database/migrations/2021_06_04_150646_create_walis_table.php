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
            $table->foreignId('calon_id')->constrained('calon')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('ayah')->nullable();
            $table->string('a_kerja')->nullable();
            $table->string('a_pkt')->nullable();
            $table->string('a_jab')->nullable();
            $table->string('a_sat')->nullable();
            $table->string('ibu')->nullable();
            $table->string('i_kerja')->nullable();
            $table->string('i_pkt')->nullable();
            $table->string('i_jab')->nullable();
            $table->string('i_sat')->nullable();
            $table->string('o_telp')->nullable();
            $table->string('o_alamat')->nullable();
            $table->string('wali_ayah')->nullable();
            $table->string('wa_kerja')->nullable();
            $table->string('wa_pkt')->nullable();
            $table->string('wa_jab')->nullable();
            $table->string('wa_sat')->nullable();
            $table->string('wali_ibu')->nullable();
            $table->string('wi_kerja')->nullable();
            $table->string('wi_pkt')->nullable();
            $table->string('wi_jab')->nullable();
            $table->string('wi_sat')->nullable();
            $table->string('w_telp')->nullable();
            $table->string('w_alamat')->nullable();
            $table->integer('status_wali')->nullable();
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
