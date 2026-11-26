<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangans';

    protected $fillable = [
        'kode_ruangan',
        'nama_ruangan',
        'jenis_ruangan',
        'lokasi_gedung',
        'pj_ruangan',
        'nip_pj',
        'role_pj',
        'kondisi',
        'kapasitas_kursi',
        'kapasitas_meja',
        'kuota_maks_kursi',
        'kuota_maks_meja',
        'catatan_mebelair',
    ];

    // Relasi: Satu ruangan bisa menyimpan banyak sarpras / inventaris
    public function sarpras()
    {
        return $this->hasMany(Sarpras::class, 'ruangan_id');
    }
}
