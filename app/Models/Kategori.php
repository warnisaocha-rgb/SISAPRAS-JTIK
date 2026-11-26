<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori',
    ];

    // Relasi: Satu kategori bisa memiliki banyak sarpras
    public function sarpras()
    {
        return $this->hasMany(Sarpras::class, 'kategori_id');
    }
}
