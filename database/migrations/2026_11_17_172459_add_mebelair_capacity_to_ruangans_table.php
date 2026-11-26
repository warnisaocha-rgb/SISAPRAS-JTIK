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
            $table->unsignedInteger('kapasitas_kursi')->default(40)->after('kondisi');
            $table->unsignedInteger('kapasitas_meja')->default(20)->after('kapasitas_kursi');
            $table->unsignedInteger('kuota_maks_kursi')->default(10)->after('kapasitas_meja');
            $table->unsignedInteger('kuota_maks_meja')->default(10)->after('kuota_maks_kursi');
            $table->text('catatan_mebelair')->nullable()->after('kuota_maks_meja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruangans', function (Blueprint $table) {
            $table->dropColumn([
                'kapasitas_kursi',
                'kapasitas_meja',
                'kuota_maks_kursi',
                'kuota_maks_meja',
                'catatan_mebelair',
            ]);
        });
    }
};
