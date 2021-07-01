<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateT2019STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlulus2019', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_id')->constrained('calon')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('ind',11)->nullable();
            $table->string('ing',11)->nullable();
            $table->string('mtk',11)->nullable();
            $table->string('fis',11)->nullable();
            $table->string('kim',11)->nullable();
            $table->string('bio',11)->nullable();
            $table->string('sos',11)->nullable();
            $table->string('geo',11)->nullable();
            $table->string('eko',11)->nullable();
            $table->string('kom',11)->nullable();
            $table->string('lain',11)->nullable();
            $table->string('rata',11)->nullable();
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
        Schema::dropIfExists('t2019_s');
    }
}
