<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiData extends Model
{
    use HasFactory;

    // Nama tabel yang sudah kamu buat (validasi_data)
    protected $table = 'validasi_data';

    // Kolom-kolom yang dapat diisi massal (mass assignable)
    protected $fillable = [
        'penduduk_id',
        'validator_id',
        'status', // valid atau rejected
        'catatan',
    ];
    
    // Log validasi ini dimiliki oleh data Penduduk mana
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }

    // Log ini dibuat oleh validator (User) mana
    public function validator()
    {
        // Asumsi model User ada di App\Models\User
        return $this->belongsTo(User::class, 'validator_id');
    }
}