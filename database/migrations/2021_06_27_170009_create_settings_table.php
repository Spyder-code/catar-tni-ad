<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('pendaftaran')->nullable();
            $table->string('heading_1')->nullable();
            $table->string('heading_2')->nullable();
            $table->text('content')->nullable();
            $table->date('dik')->nullable();
            $table->date('tertua')->nullable();
            $table->date('termuda')->nullable();
            $table->string('lp_heading')->nullable();
            $table->string('lp_title_santri')->nullable();
            $table->string('lp_title_reguler')->nullable();
            $table->integer('lihat_umur')->nullable();
            $table->string('label_ponpes')->nullable();
            $table->string('label_alamat_ponpes')->nullable();
            $table->string('label_kabupaten_ponpes')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
