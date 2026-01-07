<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendudukExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Penduduk::all([
            'kecamatan',
            'desa',
            'no_kk',
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
            'nama_ayah'
        ]);
    }

    public function headings(): array
    {
        return [
            'Nama Kecamatan',
            'Nama Kelurahan',
            'No KK',
            'Alamat',
            'RT',
            'RW',
            'Nama Lengkap Anggota Keluarga',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Status Hubungan dalam Keluarga',
            'Agama',
            'Nama Ibu',
            'Nama Ayah'
        ];
    }
}
