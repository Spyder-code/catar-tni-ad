<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('validation_counters', function (Blueprint $table) {
            $table->string('type', 2)->primary();
            $table->unsignedInteger('last_number')->default(0);
        });
        DB::table('validation_counters')->insert([
            ['type' => 'BA', 'last_number' => 0],
            ['type' => 'TA', 'last_number' => 0],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('validation_counters');
    }
};
