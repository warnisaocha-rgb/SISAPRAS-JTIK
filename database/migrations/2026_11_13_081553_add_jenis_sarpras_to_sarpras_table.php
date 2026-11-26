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
        Schema::table('sarpras', function (Blueprint $table) {
            $table->enum('jenis_sarpras', ['alat_bahan', 'sarana_ruangan'])->default('alat_bahan')->after('nama_sarpras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sarpras', function (Blueprint $table) {
            $table->dropColumn('jenis_sarpras');
        });
    }
};
