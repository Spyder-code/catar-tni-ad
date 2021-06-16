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
            $table->foreignId('calon_id')->constrained('calon');
            $table->string('ind',10)->nullable();
            $table->string('ing',10)->nullable();
            $table->string('mtk',10)->nullable();
            $table->string('fis',10)->nullable();
            $table->string('kim',10)->nullable();
            $table->string('bio',10)->nullable();
            $table->string('sos',10)->nullable();
            $table->string('geo',10)->nullable();
            $table->string('eko',10)->nullable();
            $table->string('kom',10)->nullable();
            $table->string('lain',10)->nullable();
            $table->string('rata',10)->nullable();
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
