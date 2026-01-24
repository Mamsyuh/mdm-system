<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'alamat',
        'rt',
        'rw',
    ];

    // Relasi untuk menghitung anggota berdasarkan no_kk yang sama
    public function anggota()
    {
        return $this->hasMany(Penduduk::class, 'kk_id', 'id');
    }
}
