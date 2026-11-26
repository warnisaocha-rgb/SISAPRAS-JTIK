<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'kode_peminjaman',
        'user_id',
        'sarpras_id',
        'jumlah',
        'tgl_pinjam',
        'tgl_kembali_rencana',
        'tgl_kembali_aktual',
        'waktu_keterangan',
        'keperluan',
        'dosen_penanggung_jawab',
        'status',
        'catatan_pengelola',
        'foto_sebelum',
        'foto_sesudah',
        'catatan_kondisi_awal',
        'catatan_kondisi_kembali',
        'status_pengembalian',
    ];

    protected $appends = [
        'waktu_formatted',
        'jadwal_lengkap',
    ];

    // Relasi: Peminjaman diajukan oleh satu User (Mahasiswa)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: Peminjaman meminjam satu Sarpras
    public function sarpras()
    {
        return $this->belongsTo(Sarpras::class, 'sarpras_id');
    }

    public function getWaktuFormattedAttribute(): string
    {
        $w = trim($this->waktu_keterangan ?? '');
        if (!empty($w)) {
            if (preg_match('/\((.*?)\)/', $w, $matches)) {
                $w = trim($matches[1]);
            } else {
                $w = trim(preg_replace('/^\d{1,4}[\/\-\.]\d{1,2}[\/\-\.]\d{1,4}\s*/', '', $w));
            }
        }

        if (empty($w)) {
            $w = $this->tgl_pinjam ? \Carbon\Carbon::parse($this->tgl_pinjam)->format('H:i') . ' WITA' : '08:00 - 15:00 WITA';
        }

        if (!preg_match('/WITA|WIB|WIT/i', $w)) {
            $w .= ' WITA';
        }

        return $w;
    }

    public function getJadwalLengkapAttribute(): string
    {
        $tgl = $this->tgl_pinjam ? \Carbon\Carbon::parse($this->tgl_pinjam)->translatedFormat('d M Y') : '-';
        return $tgl . ', ' . $this->waktu_formatted;
    }
}
