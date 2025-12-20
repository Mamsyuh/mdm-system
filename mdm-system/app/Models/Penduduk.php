<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\ValidasiData;
use App\Models\User;         // <--- Import User sudah benar
use App\Models\KartuKeluarga; // Tambahkan ini jika belum ada, untuk fungsi kk()

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kecamatan',
        'desa',
        'no_kk',
        'kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'hubungan_keluarga',
        'agama',
        'nama_ibu',
        'nama_ayah',
        'status_validasi',
        'validated_by',
        'validated_at'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'validated_at' => 'datetime',
    ];

    // Relasi ke User (yang memvalidasi status terakhir)
    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    // Accessor: Hitung Umur (Sudah benar)
    public function getUmurAttribute()
    {
        if (!$this->tanggal_lahir) return 0;
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    // Accessor: Kategori Usia (Sudah benar)
    public function getKategoriUsiaAttribute()
    {
        $umur = $this->umur;
        
        if ($umur < 5) return 'Balita';
        if ($umur < 12) return 'Anak';
        if ($umur < 17) return 'Remaja';
        if ($umur < 60) return 'Dewasa';
        return 'Lansia';
    }

    // Scope: Filter berdasarkan status (Sudah benar)
    public function scopeValid($query)
    {
        return $query->where('status_validasi', 'valid');
    }

    public function scopePending($query)
    {
        return $query->where('status_validasi', 'pending');
    }

    // Relasi ke Kartu Keluarga (Sudah benar)
    public function kk()
    {
        return $this->belongsTo(KartuKeluarga::class, 'kk_id');
    }
    
    /**
     * Relasi BARU: Satu Penduduk memiliki banyak Log Validasi (riwayat)
     */
    public function validasiLogs()
    {
        return $this->hasMany(ValidasiData::class, 'penduduk_id');
    }
}