<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studis';

    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'program_studi_id');
    }
}
