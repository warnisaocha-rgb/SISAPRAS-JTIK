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
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->string('foto_sebelum')->nullable()->after('catatan_pengelola');
            $table->string('foto_sesudah')->nullable()->after('foto_sebelum');
            $table->text('catatan_kondisi_awal')->nullable()->after('foto_sesudah');
            $table->text('catatan_kondisi_kembali')->nullable()->after('catatan_kondisi_awal');
            $table->string('status_pengembalian')->nullable()->default('menunggu_cek_fisik')->after('catatan_kondisi_kembali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn([
                'foto_sebelum',
                'foto_sesudah',
                'catatan_kondisi_awal',
                'catatan_kondisi_kembali',
                'status_pengembalian'
            ]);
        });
    }
};
