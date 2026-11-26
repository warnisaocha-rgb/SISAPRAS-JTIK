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
        Schema::create('bebas_pinjams', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('keperluan')->default('Pemberkasan Yudisium & Wisuda Sarjana FT UNM');
            $table->dateTime('tgl_pengajuan');
            
            // 1. Lab Komputer 1 (Lt. 2)
            $table->enum('status_lab_komputer', ['bebas', 'tertahan', 'belum_cek'])->default('belum_cek');
            $table->string('petugas_lab_komputer')->nullable();
            $table->dateTime('tgl_lab_komputer')->nullable();
            $table->text('catatan_lab_komputer')->nullable();

            // 2. Lab Jaringan & IoT (Lt. 3)
            $table->enum('status_lab_jaringan', ['bebas', 'tertahan', 'belum_cek'])->default('belum_cek');
            $table->string('petugas_lab_jaringan')->nullable();
            $table->dateTime('tgl_lab_jaringan')->nullable();
            $table->text('catatan_lab_jaringan')->nullable();

            // 3. Bengkel / Ruang Inventaris (Lt. 1)
            $table->enum('status_ruang_inventaris', ['bebas', 'tertahan', 'belum_cek'])->default('belum_cek');
            $table->string('petugas_ruang_inventaris')->nullable();
            $table->dateTime('tgl_ruang_inventaris')->nullable();
            $table->text('catatan_ruang_inventaris')->nullable();

            // Final Overall Status
            $table->enum('status_final', ['bebas', 'tertahan', 'belum_cek'])->default('belum_cek');
            $table->dateTime('tgl_disahkan_final')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bebas_pinjams');
    }
};
