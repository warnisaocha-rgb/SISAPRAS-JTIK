<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sarpras', function (Blueprint $table) {
            $table->string('lokasi_rak')->nullable()->after('ruangan_id');
            $table->integer('maks_pinjam')->default(2)->after('jumlah_tersedia');
        });
    }

    public function down(): void
    {
        Schema::table('sarpras', function (Blueprint $table) {
            $table->dropColumn(['lokasi_rak', 'maks_pinjam']);
        });
    }
};
