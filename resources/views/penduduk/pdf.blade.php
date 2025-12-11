<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Penduduk</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        table, th, td { border: 1px solid black; padding: 5px; }
        th { background: #ddd; }
    </style>
</head>
<body>

<h3 style="text-align:center">DATA PENDUDUK</h3>

<table>
    <thead>
        <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>JK</th>
            <th>Alamat</th>
            <th>RT</th>
            <th>RW</th>
        </tr>
    </thead>

    <tbody>
        @foreach($penduduk as $p)
        <tr>
            <td>{{ $p->nik }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->jenis_kelamin }}</td>
            <td>{{ $p->alamat }}</td>
            <td>{{ $p->rt }}</td>
            <td>{{ $p->rw }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
