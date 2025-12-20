<!DOCTYPE html>
<html>
<head>
    <title>Kartu Keluarga - {{ $kk->no_kk }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 16pt;
            margin: 0;
        }
        .info-kk {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-kk td {
            padding: 5px 0;
        }
        .label {
            width: 150px;
            font-weight: bold;
        }
        .separator {
            width: 10px;
            text-align: center;
        }
        .table-anggota {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table-anggota th, .table-anggota td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        .table-anggota th {
            background-color: #f2f2f2;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>KARTU KELUARGA</h1>
        <p>DESA BENANGIN 1</p>
    </div>

    {{-- INFORMASI KK UTAMA --}}
    <table class="info-kk">
        <tr>
            <td class="label">Nomor KK</td>
            <td class="separator">:</td>
            <td>{{ $kk->no_kk }}</td>
            <td class="label">RT / RW</td>
            <td class="separator">:</td>
            <td>{{ $kk->rt }} / {{ $kk->rw }}</td>
        </tr>
        <tr>
            <td class="label">Nama Kepala Keluarga</td>
            <td class="separator">:</td>
            <td>{{ $kk->kepala_keluarga }}</td>
            <td class="label">Desa / Kecamatan</td>
            <td class="separator">:</td>
            <td>BENANGIN 1 / TEWEH TIMUR</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="separator">:</td>
            <td colspan="4">{{ $kk->alamat }}</td>
        </tr>
    </table>

    {{-- DAFTAR ANGGOTA KELUARGA --}}
    <h3>DAFTAR ANGGOTA KELUARGA</h3>
    <table class="table-anggota">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA LENGKAP</th>
                <th>NIK</th>
                <th>HUBUNGAN</th>
                <th>JENIS KELAMIN</th>
                <th>TGL LAHIR</th>
                <th>AGAMA</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kk->anggota as $anggota)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $anggota->nama }}</td>
                <td>{{ $anggota->nik }}</td>
                <td>{{ $anggota->hubungan_keluarga }}</td>
                <td>{{ $anggota->jenis_kelamin }}</td>
                <td>{{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d-m-Y') }}</td>
                <td>{{ $anggota->agama }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada anggota keluarga terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TANDA TANGAN --}}
    <div style="width: 300px; float: right; margin-top: 50px;">
        <p style="text-align: center; margin-bottom: 50px;">
            Benangin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            <br>
            Kepala Desa Benangin 1
        </p>
        <p style="text-align: center; font-weight: bold; margin-top: 50px;">
            (...........................................)
        </p>
    </div>
</div>

</body>
</html>