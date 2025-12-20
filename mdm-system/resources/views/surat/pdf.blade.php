@php
    // Variabel $surat dikirim dari SuratController::printPdf (atau method yang kamu buat)
    $penduduk = $surat->penduduk;
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Surat Keterangan Domisili - {{ $surat->nomor_surat }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 0;
            padding: 50px; /* Margin kertas */
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .header h3, .header p {
            margin: 0;
            line-height: 1.2;
        }
        .content {
            line-height: 1.6;
        }
        .content .indent {
            text-indent: 40px; /* Paragraf menjorok */
            margin-bottom: 15px;
        }
        .data-table {
            width: 80%;
            margin: 20px auto;
        }
        .data-table td {
            padding: 5px 0;
            vertical-align: top;
        }
        .label {
            width: 150px;
        }
        .ttd {
            width: 40%;
            float: right;
            margin-top: 50px;
        }
        .ttd-kiri {
            width: 40%;
            float: left;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    {{-- KOP SURAT --}}
    <div class="header">
        <h3 style="font-size: 14pt;">PEMERINTAH KABUPATEN BARITO UTARA</h3>
        <h3 style="font-size: 16pt;">DESA BENANGIN 1</h3>
        <p>Jalan Utama Desa Benangin (Kode Pos: 73881)</p>
    </div>

    {{-- JUDUL SURAT --}}
    <div style="text-align: center; margin-bottom: 30px;">
        <h3 style="text-decoration: underline; margin: 5px 0;">SURAT KETERANGAN DOMISILI</h3>
        <p>Nomor: {{ $surat->nomor_surat ?? 'BELUM TERBIT' }}</p>
    </div>

    {{-- ISI SURAT --}}
    <div class="content">
        <div class="indent">
            Yang bertanda tangan di bawah ini, Kepala Desa Benangin 1, Kecamatan Teweh Timur, Kabupaten Barito Utara, dengan ini menerangkan bahwa:
        </div>

        {{-- DETAIL PEMOHON --}}
        <table class="data-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td>:</td>
                <td>{{ $penduduk->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Nomor Induk Kependudukan (NIK)</td>
                <td>:</td>
                <td>{{ $penduduk->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tempat/Tgl. Lahir</td>
                <td>:</td>
                <td>{{ $penduduk->tempat_lahir ?? '-' }}, {{ $penduduk->tanggal_lahir ? \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $penduduk->jenis_kelamin ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Agama</td>
                <td>:</td>
                <td>{{ $penduduk->agama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pekerjaan</td>
                <td>:</td>
                <td>{{ $penduduk->pekerjaan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Sesuai KTP</td>
                <td>:</td>
                <td>{{ $penduduk->alamat ?? '-' }} RT {{ $penduduk->rt ?? '-' }}/RW {{ $penduduk->rw ?? '-' }}</td>
            </tr>
        </table>
        
        <div class="indent">
            Bahwa nama yang bersangkutan di atas adalah benar-benar penduduk Desa Benangin 1 dan berdomisili di alamat tersebut di atas. Surat keterangan ini dibuat untuk keperluan:
        </div>

        <div style="margin: 0 40px; border: 1px dashed #000; padding: 15px; text-align: center; font-weight: bold;">
            {{ $surat->keperluan }}
        </div>

        <div class="indent" style="margin-top: 15px;">
            Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
        </div>
    </div>

    {{-- TANDA TANGAN --}}
    <div style="clear: both;"></div>
    <div class="ttd">
        <p style="text-align: center; margin-bottom: 80px;">
            Dikeluarkan di Benangin,
            <br>
            Pada Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            <br>
            Kepala Desa Benangin 1
        </p>
        <p style="text-align: center; font-weight: bold;">
            ({{ $surat->approver->name ?? 'NAMA KEPALA DESA' }})
        </p>
    </div>
</div>

</body>
</html>