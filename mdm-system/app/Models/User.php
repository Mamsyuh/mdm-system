<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\ValidasiData; // <--- BARU: Impor model log
use App\Models\Penduduk;     // <--- BARU: Impor model penduduk

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that can be mass assigned.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * Hidden attributes.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attributes.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke tabel roles
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    /**
     * Relasi BARU: Semua Log Validasi (di tabel validasi_data) yang dibuat oleh User ini.
     */
    public function validasiDataLogs()
    {
        return $this->hasMany(ValidasiData::class, 'validator_id');
    }

    /**
     * Relasi BARU: Data Penduduk mana saja yang terakhir divalidasi oleh User ini.
     */
    public function validatedPenduduks()
    {
        return $this->hasMany(Penduduk::class, 'validated_by');
    }
}