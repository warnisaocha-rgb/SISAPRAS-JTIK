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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sarpras_id')->constrained('sarpras')->onDelete('cascade');
            $table->integer('jumlah')->default(1);
            $table->dateTime('tgl_pinjam');
            $table->dateTime('tgl_kembali_rencana');
            $table->dateTime('tgl_kembali_aktual')->nullable();
            $table->string('waktu_keterangan')->nullable(); // e.g. 08:00 - 12:00 WITA
            $table->text('keperluan')->nullable();
            $table->string('dosen_penanggung_jawab')->nullable();
            $table->enum('status', ['menunggu_verifikasi', 'disetujui', 'sedang_dipinjam', 'selesai', 'ditolak'])->default('menunggu_verifikasi');
            $table->text('catatan_pengelola')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
