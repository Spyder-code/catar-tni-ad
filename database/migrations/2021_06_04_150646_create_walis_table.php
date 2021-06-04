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
            $table->string('ibu');
            $table->string('pekerjaan_ayah');
            $table->string('pangkat');
            $table->string('satuan');
            $table->string('pekerjaan_ibu');
            $table->string('alamat');
            $table->string('telephone');
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
