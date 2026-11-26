<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ruangans', function (Blueprint $table) {
            if (!Schema::hasColumn('ruangans', 'lokasi_gedung')) {
                $table->string('lokasi_gedung')->nullable()->after('nama_ruangan');
            }
            if (!Schema::hasColumn('ruangans', 'nip_pj')) {
                $table->string('nip_pj')->nullable()->after('pj_ruangan');
            }
            if (!Schema::hasColumn('ruangans', 'role_pj')) {
                $table->string('role_pj')->nullable()->after('nip_pj');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruangans', function (Blueprint $table) {
            foreach (['role_pj', 'nip_pj', 'lokasi_gedung'] as $col) {
                if (Schema::hasColumn('ruangans', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
