<?php

use App\Models\Kelas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('program_studis')) {
            Schema::create('program_studis', function (Blueprint $table) {
                $table->id();
                $table->string('kode_prodi', 20)->unique();
                $table->string('nama_prodi');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('kelas')) {
            Schema::create('kelas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('program_studi_id')->constrained('program_studis')->cascadeOnDelete();
                $table->unsignedSmallInteger('angkatan');
                $table->string('nama_kelas')->unique();
                $table->timestamps();
            });
        }

        // Seed 2 Program Studi (PTIK & TEKOM) dan 52 Kelas resmi
        Kelas::ensureSeeded();

        // Tambahkan kelas_id pada tabel users
        if (!Schema::hasColumn('users', 'kelas_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('kelas_id')
                    ->nullable()
                    ->after('ruangan_id')
                    ->constrained('kelas')
                    ->nullOnDelete();
            });
        }

        // Konversi data jurusan lama milik mahasiswa ke kelas_id, lalu hapus kolom jurusan
        if (Schema::hasColumn('users', 'jurusan')) {
            $mahasiswaUsers = DB::table('users')->where('role', 'mahasiswa')->get();
            foreach ($mahasiswaUsers as $mhs) {
                $resolvedKelas = Kelas::resolveFromInput($mhs->jurusan ?? 'PTIK A 24');
                if ($resolvedKelas) {
                    DB::table('users')->where('id', $mhs->id)->update([
                        'kelas_id' => $resolvedKelas->id,
                    ]);
                }
            }

            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('jurusan');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('users', 'jurusan')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('jurusan')->nullable()->after('status_akun');
            });
        }

        if (Schema::hasColumn('users', 'kelas_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropConstrainedForeignId('kelas_id');
            });
        }

        Schema::dropIfExists('kelas');
        Schema::dropIfExists('program_studis');
    }
};
