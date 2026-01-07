<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Data Penduduk - Desa Benangin 1</title>
    <style>
        /* Konfigurasi Halaman PDF: Landscape agar muat banyak kolom */
        @page { 
            margin: 1cm; 
            size: a4 landscape; 
        }
        
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            line-height: 1.2;
            color: #1a1a1a;
        }

        /* Styling Kop Surat */
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
            text-align: center;
        }
        .kop-surat h2 { margin: 0; font-size: 16px; text-transform: uppercase; }
        .kop-surat h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        .kop-surat p { margin: 5px 0 0 0; font-size: 10px; font-style: italic; }

        .title {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 15px;
            font-size: 13px;
            text-transform: uppercase;
        }

        /* Styling Tabel */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            font-size: 9px; /* Ukuran font dioptimalkan */
        }
        table, th, td { 
            border: 1px solid #000; 
        }
        th { 
            background-color: #f2f2f2; 
            padding: 6px 3px;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
        }
        td { 
            padding: 5px 3px; 
            vertical-align: middle;
        }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        
        /* Baris Selang-Seling */
        tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        /* Footer Tanda Tangan */
        .footer-container {
            margin-top: 30px;
            width: 100%;
        }
        .footer-ttd {
            float: right;
            width: 200px;
            text-align: center;
            font-size: 11px;
        }
        .spacer { height: 50px; }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h2>Pemerintah Kabupaten Barito Utara</h2>
        <h2>Kecamatan Teweh Timur</h2>
        <h1>Pemerintah Desa Benangin 1</h1>
        <p>Alamat: Jalan Negara Benangin - Lampeong, Kode Pos 73881</p>
    </div>

    <div class="title">LAPORAN DATA PENDUDUK DESA</div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="11%">No. KK</th>
                <th width="11%">NIK</th>
                <th width="15%">Nama Lengkap</th>
                <th width="3%">JK</th>
                <th width="14%">Tempat, Tgl Lahir</th>
                <th width="7%">Agama</th>
                <th width="12%">Hubungan</th>
                <th width="15%">Alamat</th>
                <th width="4%">RT/RW</th>
                <th width="5%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penduduk as $p)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $p->no_kk }}</td>
                <td class="text-center font-bold">{{ $p->nik }}</td>
                <td>{{ strtoupper($p->nama) }}</td>
                <td class="text-center">{{ $p->jenis_kelamin == 'Laki-laki' ? 'L' : 'P' }}</td>
                <td>{{ $p->tempat_lahir }}, {{ $p->tanggal_lahir ? $p->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                <td class="text-center">{{ $p->agama }}</td>
                <td class="text-center">{{ $p->hubungan_keluarga }}</td>
                <td>{{ $p->alamat }}</td>
                <td class="text-center">{{ $p->rt }}/{{ $p->rw }}</td>
                <td class="text-center" style="color: {{ $p->status_validasi == 'valid' ? 'green' : 'red' }}">
                    {{ strtoupper($p->status_validasi) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-container">
        <div class="footer-ttd">
            <p>Benangin, {{ date('d F Y') }}</p>
            <p>Kepala Desa Benangin 1,</p>
            <div class="spacer"></div>
            <p><strong>( __________________________ )</strong></p>
            <p>NIP. ........................................</p>
        </div>
    </div>

</body>
</html>