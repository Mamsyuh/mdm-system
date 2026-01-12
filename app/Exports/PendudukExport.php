<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendudukExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $penduduk;

    public function __construct($penduduk)
    {
        $this->penduduk = $penduduk;
    }

    public function collection()
    {
        return $this->penduduk;
    }

    public function headings(): array
    {
        return [
            'NO',
            'NO. KK',
            'NIK',
            'NAMA LENGKAP',
            'JENIS KELAMIN',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'AGAMA',
            'STATUS PERKAWINAN',
            'HUBUNGAN KELUARGA',
            'ALAMAT',
            'RT',
            'RW',
            'NAMA AYAH',
            'NAMA IBU',
        ];
    }

    public function map($penduduk): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $penduduk->no_kk ?? '-',
            $penduduk->nik ?? '-',
            strtoupper($penduduk->nama ?? '-'),
            $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $penduduk->tempat_lahir ?? '-',
            $penduduk->tanggal_lahir ? $penduduk->tanggal_lahir->format('d/m/Y') : '-',
            $penduduk->agama ?? '-',
            $penduduk->status_perkawinan ?? '-',
            $penduduk->hubungan_keluarga ?? '-',
            $penduduk->alamat ?? '-',
            $penduduk->rt ?? '-',
            $penduduk->rw ?? '-',
            $penduduk->nama_ayah ?? '-',
            $penduduk->nama_ibu ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => 'CCCCCC']]],
        ];
    }
}