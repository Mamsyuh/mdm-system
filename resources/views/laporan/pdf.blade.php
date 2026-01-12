<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Data Penduduk</title>
    <style>
        @page { 
            margin: 1cm; 
            size: a4 landscape; 
        }
        
        body { 
            font-family: Arial, sans-serif; 
            font-size: 8px;
            line-height: 1.3;
        }
        
        .header { 
            text-align: center; 
            border-bottom: 3px solid #000; 
            margin-bottom: 10px; 
            padding-bottom: 8px; 
        }
        
        .header h2 {
            margin: 0 0 3px 0;
            font-size: 14px;
            font-weight: bold;
        }
        
        .header p {
            margin: 0;
            font-size: 10px;
        }
        
        .filter-info {
            text-align: center;
            margin: 10px 0;
            padding: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            font-size: 9px;
            font-weight: bold;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 5px;
        }
        
        th, td { 
            border: 1px solid #000; 
            padding: 3px 4px;
            text-align: left;
        }
        
        th { 
            background-color: #e0e0e0; 
            font-weight: bold;
            text-transform: uppercase;
            font-size: 7px;
        }
        
        td {
            font-size: 7px;
        }
        
        .text-center { 
            text-align: center; 
        }
        
        .no-col {
            width: 25px;
            text-align: center;
        }
        
        .footer {
            margin-top: 20px;
            font-size: 8px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>PEMERINTAH DESA BENANGIN 1</h2>
        <p>Laporan Data Penduduk Lengkap</p>
    </div>
    
    <div class="filter-info">
        Filter: {{ $filterInfo }} | Total: {{ $penduduk->count() }} Penduduk
    </div>
    
    <table>
        <thead>
            <tr>
                <th class="no-col">NO</th>
                <th>NO. KK</th>
                <th>NIK</th>
                <th>NAMA LENGKAP</th>
                <th class="text-center">JK</th>
                <th>TEMPAT, TGL LAHIR</th>
                <th>AGAMA</th>
                <th>HUBUNGAN</th>
                <th>ALAMAT</th>
                <th class="text-center">RT/RW</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penduduk as $p)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $p->no_kk ?? '-' }}</td>
                <td>{{ $p->nik ?? '-' }}</td>
                <td>{{ strtoupper($p->nama ?? '-') }}</td>
                <td class="text-center">{{ $p->jenis_kelamin == 'Laki-laki' || $p->jenis_kelamin == 'L' ? 'L' : 'P' }}</td>
                <td>{{ ($p->tempat_lahir ?? '-') }}, {{ $p->tanggal_lahir ? $p->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                <td>{{ $p->agama ?? '-' }}</td>
                <td>{{ $p->hubungan_keluarga ?? '-' }}</td>
                <td>{{ $p->alamat ?? '-' }}</td>
                <td class="text-center">{{ ($p->rt ?? '0') }}/{{ ($p->rw ?? '0') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>