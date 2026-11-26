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
        if (Schema::hasColumn('sarpras', 'lokasi_rak')) {
            Schema::table('sarpras', function (Blueprint $table) {
                $table->dropColumn('lokasi_rak');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('sarpras', 'lokasi_rak')) {
            Schema::table('sarpras', function (Blueprint $table) {
                $table->string('lokasi_rak')->nullable()->after('ruangan_id');
            });
        }
    }
};
