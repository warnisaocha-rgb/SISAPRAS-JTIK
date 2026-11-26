<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'nomor_induk',
        'name',
        'email',
        'password',
        'role',
        'ruangan_id',
        'kelas_id',
        'status_akun',
        'approved_at',
        'approved_by',
        'jurusan',
        'jabatan',
    ];

    protected $with = [
        'kelas.programStudi',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'approved_at' => 'datetime',
        ];
    }

    // Relasi: Pengelola / Admin terikat pada ruangan tanggung jawabnya
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    // Relasi: Mahasiswa terikat pada Kelas (yang terhubung ke Program Studi)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi: User (Mahasiswa) bisa memiliki banyak pengajuan peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // Relasi: Riwayat login pengguna
    public function loginHistories()
    {
        return $this->hasMany(LoginHistory::class);
    }

    // Relasi: Aktivitas login terakhir pengguna
    public function latestLoginHistory()
    {
        return $this->hasOne(LoginHistory::class)->latestOfMany('logged_in_at');
    }

    // Relasi: Admin yang menyetujui pendaftaran pengelola
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Mutator backward-compatible: jika ada kode yang mengisi 'jurusan',
     * otomatis konversi ke kelas_id pada tabel kelas.
     */
    public function setJurusanAttribute($value): void
    {
        if (empty($value)) {
            return;
        }

        $resolved = Kelas::resolveFromInput($value);
        if ($resolved) {
            $this->attributes['kelas_id'] = $resolved->id;
            $this->unsetRelation('kelas');
        }
    }

    public function getJurusanAttribute(): ?string
    {
        if (array_key_exists('jurusan', $this->attributes)) {
            return $this->attributes['jurusan'];
        }

        return $this->kelas?->nama_kelas;
    }

    public function getNamaKelasAttribute(): string
    {
        return $this->kelas?->nama_kelas ?? 'PTIK A 24';
    }

    public function getProgramStudiAttribute(): string
    {
        return $this->kelas?->programStudi?->nama_prodi ?? 'Pendidikan Teknik Informatika dan Komputer';
    }

    public function getKodeProdiAttribute(): string
    {
        return $this->kelas?->programStudi?->kode_prodi ?? 'PTIK';
    }
}
