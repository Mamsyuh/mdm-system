<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kecamatan', 'desa', 'no_kk', 'kepala_keluarga', 'alamat', 'rt', 'rw',
        'nama', 'nik', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'hubungan_keluarga', 'agama', 'nama_ibu', 'nama_ayah',
        'status_validasi', 'validated_by', 'validated_at'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'validated_at' => 'datetime',
    ];

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function getUmurAttribute()
    {
        if (!$this->tanggal_lahir) return 0;
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    public function getKategoriUsiaAttribute()
    {
        $umur = $this->umur;
        if ($umur < 5) return 'Balita';
        if ($umur < 12) return 'Anak';
        if ($umur < 17) return 'Remaja';
        if ($umur < 60) return 'Dewasa';
        return 'Lansia';
    }

    public function scopeValid($query)
    {
        return $query->where('status_validasi', 'valid');
    }

    // Relasi ke KK menggunakan no_kk sebagai penghubung
    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class, 'no_kk', 'no_kk');
    }

    public function validasiLogs()
    {
        return $this->hasMany(ValidasiData::class, 'penduduk_id');
    }
}