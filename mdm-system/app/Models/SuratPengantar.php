<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengantar extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'penduduk_id',
        'jenis_surat',
        'keperluan',
        'nomor_surat',
        'status',
        'approved_by',
        'catatan',
    ];

    /**
     * Surat ini diajukan oleh Penduduk mana.
     */
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }
    
    /**
     * Admin/User mana yang menyetujui surat ini.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}