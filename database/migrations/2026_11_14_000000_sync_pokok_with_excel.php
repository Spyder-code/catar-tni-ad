<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $newColumns = array_filter(['no_animo', 'nik', 'no_hp_ortu', 'no_telp_wa',
            'email', 'jenis_pendaftaran', 'jalur_pendaftaran', 'kodam', 'kodim',
            'koramil', 'babinsa', 'status', 'tanggal_validasi'],
            fn ($column) => !Schema::hasColumn('pokok', $column));

        Schema::table('pokok', function (Blueprint $table) use ($newColumns) {
            foreach ($newColumns as $column) {
                $table->string($column)->nullable();
            }

            foreach (['no_online', 'nama', 'tem_lahir', 'tgl_lahir', 'kdpanda',
                'tb', 'bb', 'suku', 'agama', 'ortu1', 'wali1', 'jenis_sekolah',
                'nama_sekolah', 'jur', 'th_lulus', 'kerja'] as $column) {
                $table->string($column)->nullable()->change();
            }
            $table->text('alamat_c')->nullable()->change();
            $table->text('alamat_o')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pokok', function (Blueprint $table) {
            $table->dropColumn(['no_animo', 'nik', 'no_hp_ortu', 'no_telp_wa',
                'email', 'jenis_pendaftaran', 'jalur_pendaftaran', 'kodam',
                'kodim', 'koramil', 'babinsa', 'status', 'tanggal_validasi']);
        });
    }
};
