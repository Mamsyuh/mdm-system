@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">📊 Statistik Data Penduduk</h2>

    {{-- ==== KARTU ANGKA ==== --}}
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card p-3 text-center bg-primary text-white rounded shadow">
                <h4>Total Penduduk</h4>
                <h2>{{ $total }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-center bg-info text-white rounded shadow">
                <h4>Laki-Laki</h4>
                <h2>{{ $laki }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-center bg-danger text-white rounded shadow">
                <h4>Perempuan</h4>
                <h2>{{ $perempuan }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-center bg-warning text-white rounded shadow">
                <h4>Kepala Keluarga (KK)</h4>
                <h2>{{ $jumlah_kk ?? '-' }}</h2>
            </div>
        </div>

    </div>

    {{-- ==== GRAFIK JENIS KELAMIN ==== --}}
    <div class="card p-4 shadow mb-4">
        <h4 class="mb-3">Grafik Berdasarkan Jenis Kelamin</h4>

        <canvas id="chartGender"></canvas>
    </div>

    {{-- ==== GRAFIK STATUS VALIDASI ==== --}}
    <div class="card p-4 shadow mb-4">
        <h4 class="mb-3">Grafik Berdasarkan Status Validasi</h4>

        <canvas id="chartValidasi"></canvas>
    </div>

</div>


{{-- ==== CHART.JS ==== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // === Grafik Jenis Kelamin ===
    new Chart(document.getElementById('chartGender'), {
        type: 'pie',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $laki }}, {{ $perempuan }}],
                backgroundColor: ['#0d6efd', '#dc3545']
            }]
        }
    });

    // === Grafik Status Validasi ===
    new Chart(document.getElementById('chartValidasi'), {
        type: 'bar',
        data: {
            labels: ['Valid', 'Perlu Verifikasi', 'Invalid'],
            datasets: [{
                label: 'Jumlah Penduduk',
                data: [
                    {{ $jumlah_valid }},
                    {{ $jumlah_verifikasi }},
                    {{ $jumlah_invalid }}
                ],
                backgroundColor: ['#198754', '#ffc107', '#dc3545']
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

@endsection
