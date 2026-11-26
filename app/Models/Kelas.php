<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'program_studi_id',
        'angkatan',
        'nama_kelas',
    ];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'kelas_id');
    }

    /**
     * Daftar master kelas resmi JTIK FT UNM (PTIK & TEKOM)
     */
    public static function defaultMasterList(): array
    {
        return [
            'PTIK' => [
                'nama_prodi' => 'Pendidikan Teknik Informatika dan Komputer',
                'angkatan' => [
                    2020 => [
                        'PTIK ULANG 20',
                    ],
                    2023 => [
                        'PTIK A 23',
                        'PTIK B 23',
                        'PTIK ULANG 23',
                    ],
                    2024 => [
                        'PTIK A 24',
                        'PTIK B 24',
                        'PTIK C 24',
                        'PTIK D 24',
                        'PTIK E 24',
                        'PTIK F 24',
                        'PTIK G 24',
                        'PTIK H 24',
                        'PTIK I 24',
                        'PTIK Pilihan A 24',
                        'PTIK Pilihan B 24',
                        'PTIK Pilihan C 24',
                        'PTIK Pilihan D 24',
                        'PTIK ULANG 24',
                    ],
                    2025 => [
                        'PTIK A 25',
                        'PTIK B 25',
                        'PTIK C 25',
                        'PTIK D 25',
                        'PTIK E 25',
                        'PTIK F 25',
                        'PTIK ULANG 25',
                    ],
                    2026 => [
                        'PTIK A 26',
                        'PTIK B 26',
                        'PTIK C 26',
                        'PTIK D 26',
                        'PTIK E 26',
                        'PTIK F 26',
                    ],
                ],
            ],
            'TEKOM' => [
                'nama_prodi' => 'Teknik Komputer',
                'angkatan' => [
                    2020 => [
                        'TEKOM ULANG 20',
                    ],
                    2023 => [
                        'TEKOM ULANG 23',
                    ],
                    2024 => [
                        'TEKOM ES-A 24',
                        'TEKOM JDF-A 24',
                        'TEKOM JDF-B 24',
                        'TEKOM SC-A 24',
                        'TEKOM SC-B 24',
                        'TEKOM SC-C 24',
                        'TEKOM Pilihan A 24',
                        'TEKOM Pilihan B 24',
                        'TEKOM Pilihan C 24',
                    ],
                    2025 => [
                        'TEKOM A 25',
                        'TEKOM B 25',
                        'TEKOM C 25',
                        'TEKOM D 25',
                        'TEKOM E 25',
                    ],
                    2026 => [
                        'TEKOM A 26',
                        'TEKOM B 26',
                        'TEKOM C 26',
                        'TEKOM D 26',
                        'TEKOM E 26',
                    ],
                ],
            ],
        ];
    }

    /**
     * Pastikan data master Program Studi & Kelas tersedia di database
     */
    public static function ensureSeeded(): void
    {
        if (!Schema::hasTable('program_studis') || !Schema::hasTable('kelas')) {
            return;
        }

        if (static::count() > 0) {
            return;
        }

        foreach (static::defaultMasterList() as $kodeProdi => $prodiData) {
            $prodi = ProgramStudi::firstOrCreate(
                ['kode_prodi' => $kodeProdi],
                ['nama_prodi' => $prodiData['nama_prodi']]
            );

            foreach ($prodiData['angkatan'] as $tahun => $daftarNamaKelas) {
                foreach ($daftarNamaKelas as $namaKelas) {
                    static::firstOrCreate(
                        ['nama_kelas' => $namaKelas],
                        [
                            'program_studi_id' => $prodi->id,
                            'angkatan' => $tahun,
                        ]
                    );
                }
            }
        }
    }

    /**
     * Cari record Kelas dari ID, nama_kelas, atau nama program studi
     */
    public static function resolveFromInput($input): ?self
    {
        if (empty($input)) {
            return null;
        }

        static::ensureSeeded();

        if (is_numeric($input)) {
            $byId = static::with('programStudi')->find((int) $input);
            if ($byId) {
                return $byId;
            }
        }

        $clean = trim((string) $input);

        // 1. Exact match nama_kelas (case-insensitive)
        $exact = static::with('programStudi')
            ->whereRaw('LOWER(nama_kelas) = ?', [strtolower($clean)])
            ->first();
        if ($exact) {
            return $exact;
        }

        // 2. Jika input format tahun 4 digit (mis. "PTIK A 2024" -> "PTIK A 24", "PTIK A 22" -> "PTIK A 24")
        $normalized = preg_replace('/\b20(\d{2})\b/', '$1', $clean);
        if ($normalized !== $clean) {
            $byNorm = static::with('programStudi')
                ->whereRaw('LOWER(nama_kelas) = ?', [strtolower($normalized)])
                ->first();
            if ($byNorm) {
                return $byNorm;
            }
        }

        // 3. Jika input mengandung TEKOM atau Teknik Komputer
        if (stripos($clean, 'TEKOM') !== false || stripos($clean, 'Teknik Komputer') !== false) {
            return static::with('programStudi')
                ->where('nama_kelas', 'TEKOM A 25')
                ->first() ?? static::with('programStudi')->where('nama_kelas', 'like', 'TEKOM%')->first();
        }

        // 4. Default ke PTIK A 24
        return static::with('programStudi')
            ->where('nama_kelas', 'PTIK A 24')
            ->first() ?? static::with('programStudi')->first();
    }

    /**
     * Format array siap pakai untuk dropdown JS di Blade
     */
    public static function getForDropdownJs(): array
    {
        static::ensureSeeded();

        return static::with('programStudi')
            ->orderBy('id')
            ->get()
            ->map(function (self $k) {
                return [
                    'id' => $k->id,
                    'nama_kelas' => $k->nama_kelas,
                    'angkatan' => $k->angkatan,
                    'kode_prodi' => $k->programStudi?->kode_prodi ?? (str_starts_with($k->nama_kelas, 'TEKOM') ? 'TEKOM' : 'PTIK'),
                    'program_studi' => $k->programStudi?->nama_prodi ?? (str_starts_with($k->nama_kelas, 'TEKOM') ? 'Teknik Komputer' : 'Pendidikan Teknik Informatika dan Komputer'),
                ];
            })
            ->values()
            ->all();
    }
}
