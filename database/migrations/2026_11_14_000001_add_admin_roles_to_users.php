<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Existing accounts retain their current access after deployment.
            $table->string('role')->default('superadmin');
            $table->string('kodim')->nullable();
            // NULL permits other admins; UNIQUE guarantees one signer per kodim.
            $table->string('penanggung_jawab_kodim')->nullable()->unique();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['penanggung_jawab_kodim']);
            $table->dropColumn(['role', 'kodim', 'penanggung_jawab_kodim']);
        });
    }
};
