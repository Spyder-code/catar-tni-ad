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
            $table->integer('ind')->nullable();
            $table->integer('ing')->nullable();
            $table->integer('mtk')->nullable();
            $table->integer('fis')->nullable();
            $table->integer('kim')->nullable();
            $table->integer('bio')->nullable();
            $table->integer('sos')->nullable();
            $table->integer('geo')->nullable();
            $table->integer('eko')->nullable();
            $table->integer('kom')->nullable();
            $table->integer('lain')->nullable();
            $table->integer('rata')->nullable();
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
