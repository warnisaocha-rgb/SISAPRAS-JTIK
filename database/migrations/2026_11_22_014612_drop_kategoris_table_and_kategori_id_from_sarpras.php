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
        if (Schema::hasColumn('sarpras', 'kategori_id')) {
            Schema::table('sarpras', function (Blueprint $table) {
                $table->dropConstrainedForeignId('kategori_id');
            });
        }

        Schema::dropIfExists('kategoris');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('kategoris')) {
            Schema::create('kategoris', function (Blueprint $table) {
                $table->id();
                $table->string('nama_kategori');
                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('sarpras', 'kategori_id')) {
            Schema::table('sarpras', function (Blueprint $table) {
                $table->foreignId('kategori_id')->nullable()->after('jenis_sarpras')->constrained('kategoris')->nullOnDelete();
            });
        }
    }
};
