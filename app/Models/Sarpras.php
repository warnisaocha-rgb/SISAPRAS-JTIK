<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarpras extends Model
{
    use HasFactory;

    protected $table = 'sarpras';

    protected $fillable = [
        'kode_sarpras',
        'nama_sarpras',
        'jenis_perabot',
        'jenis_sarpras',
        'ruangan_id',
        'jumlah_total',
        'jumlah_tersedia',
        'maks_pinjam',
        'kondisi',
        'status',
        'spesifikasi',
        'foto',
    ];

    // Relasi: Sarpras tersimpan di satu ruangan/lab
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    // Relasi: Sarpras bisa dipinjam berkali-kali
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'sarpras_id');
    }
}
