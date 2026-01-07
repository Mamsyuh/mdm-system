<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Desa Benangin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Gaya Batik */
        .bg-batik {
            background-color: #fffbeb;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='%23d97706' fill-opacity='0.03'/%3E%3C/svg%3E");
        }

        /* Sidebar Toggle Mobile */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: 6px 0 10px rgba(0, 0, 0, 0.3);
            }
        }

        /* Efek Hover Card Statistik */
        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .avatar-admin {
            background-color: #d97706;
            /* Warna Amber */
            border: 2px solid #fff;
        }

        /* Custom Shadow for Chart Blocks */
        .chart-block {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>

<body class="bg-batik min-h-screen">

    {{-- HEADER (Logout dan Avatar Admin) --}}
    <header class="bg-gradient-to-r from-amber-900 via-red-900 to-amber-900 text-amber-50 shadow-lg sticky top-0 z-20">
        <div class="h-2 bg-gradient-to-r from-amber-500 via-red-500 to-amber-500"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            @include('layouts.header')
        </div>
        <div class="h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent"></div>
    </header>

    <div class="flex">
        {{-- SIDEBAR --}}
        <aside id="sidebar"
            class="sidebar w-64 bg-gradient-to-b from-amber-900 to-red-900 min-h-screen text-amber-50 p-4 fixed md:relative z-10">
            <nav class="space-y-2">
                @include('layouts.navigation')
            </nav>

            <div class="mt-8 p-4 bg-amber-800/50 rounded-lg border border-amber-600/30">
                <p class="text-xs text-amber-200 text-center italic">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>

        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">

            {{-- BLOCK 1: UCAPAN SELAMAT DATANG --}}
            <div class="bg-gradient-to-r from-amber-800 to-red-800 rounded-2xl p-6 text-white mb-6 shadow-2xl">
                <h2 class="text-2xl font-bold">Halo, {{ auth()->user()->name }}!</h2>
                <p class="text-amber-200 mt-1">Dashboard Utama Pengelolaan Data. 📅
                    {{ $indonesian_date }}
                </p>
            </div>

            {{-- BLOCK AKSI CEPAT (Prioritas di atas) --}}
            <div class="bg-white rounded-xl shadow-2xl p-4 mb-6">
                <h3 class="text-lg font-bold text-amber-900 mb-3"><i class="fas fa-bolt mr-2 text-yellow-500"></i> Aksi
                    Cepat</h3>
                <div class="flex flex-wrap gap-4 items-center justify-start">

                    {{-- Tambah Penduduk --}}
                    <a href="{{ route('penduduk.create') }}"
                        class="flex items-center p-3 bg-indigo-100 rounded-lg hover:bg-indigo-200 transition duration-300 shadow-md text-sm font-semibold text-indigo-800">
                        <i class="fas fa-user-plus text-lg mr-2"></i> Input Penduduk Baru
                    </a>

                    {{-- Cetak Laporan (ke menu pilihan) --}}
                    <a href="{{ route('laporan.index') }}"
                        class="flex items-center p-3 bg-teal-100 rounded-lg hover:bg-teal-200 transition duration-300 shadow-md text-sm font-semibold text-teal-800">
                        <i class="fas fa-print text-lg mr-2"></i> Cetak Laporan
                    </a>
                </div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Data Kunci</h3>

            {{-- Kartu Data Kunci (3 KARTU - COMPACT LAYOUT) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

                {{-- 1. Total Penduduk --}}
                <div
                    class="stat-card bg-white rounded-xl p-5 shadow-lg border-l-4 border-amber-600 flex justify-between items-center">
                    <div>
                        <p class="text-3xl font-bold text-gray-800">
                            {{ number_format($totalPenduduk ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="text-gray-500 text-sm mt-1">Total Penduduk (Jiwa)</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-amber-600 rounded-full flex items-center justify-center text-xl text-white shadow-md">
                        <i class="fas fa-users"></i>
                    </div>
                </div>

                {{-- 2. Kepala Keluarga --}}
                <div
                    class="stat-card bg-white rounded-xl p-5 shadow-lg border-l-4 border-blue-600 flex justify-between items-center">
                    <div>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalKK ?? 0 }}</p>
                        <p class="text-gray-500 text-sm mt-1">Total Kepala Keluarga</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-xl text-white shadow-md">
                        <i class="fas fa-house-user"></i>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-4">Distribusi Demografi</h3>

            {{-- Chart Section --}}
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                {{-- Chart Gender --}}
                <div class="bg-white rounded-xl p-6 shadow-2xl chart-block">
                    <h3 class="text-lg font-bold text-amber-900 mb-4">📊 Distribusi Gender</h3>
                    <canvas id="genderChart"></canvas>
                </div>

                {{-- Chart Usia --}}
                <div class="bg-white rounded-xl p-6 shadow-2xl chart-block">
                    <h3 class="text-lg font-bold text-amber-900 mb-4">👥 Distribusi Usia</h3>
                    <canvas id="usiaChart"></canvas>
                </div>
            </div>

            {{-- Chart RT --}}
            <div class="bg-white rounded-xl p-6 shadow-2xl chart-block mb-6">
                <h3 class="text-lg font-bold text-amber-900 mb-4">🏘️ 5 RT dengan Penduduk Terbanyak</h3>
                <canvas id="rtChart"></canvas>
            </div>

            {{-- Cek Pengajuan Surat (Sebagai Aksi sekunder Admin) --}}
            <div class="bg-white rounded-xl shadow-2xl p-6 flex justify-between items-center border-l-4 border-red-700">
                <div>
                    <h4 class="text-xl font-bold text-red-700">Pengajuan Surat Perlu Persetujuan</h4>
                    <p class="text-gray-600 text-sm mt-1">Ada **{{ $suratPending ?? 0 }}** surat yang menunggu aksi
                        Anda.</p>
                </div>
                <a href="{{ route('surat.index') }}"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                    <i class="fas fa-file-signature mr-2"></i> Proses Surat
                </a>
            </div>

        </main>
    </div>

    <script>
        // Toggle Sidebar
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Data dari Controller (Script Chart.js tetap sama)
        const genderLabels = @json($genderLabels ?? []);
        const genderCounts = @json($genderCounts ?? []);
        const usiaLabels = @json($usiaLabels ?? []);
        const usiaData = @json($usiaData ?? []);
        const rtLabels = @json($rtLabels ?? []);
        const rtData = @json($rtData ?? []);

        // Chart Gender
        if (document.getElementById('genderChart') && genderLabels.length > 0) {
            new Chart(document.getElementById('genderChart'), {
                type: 'pie',
                data: {
                    labels: genderLabels,
                    datasets: [{
                        data: genderCounts,
                        backgroundColor: ['rgba(54, 162, 235, 0.8)', 'rgba(255, 99, 132, 0.8)'],
                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' }
                    }
                }
            });
        }

        // Chart Usia
        if (document.getElementById('usiaChart') && usiaLabels.length > 0) {
            new Chart(document.getElementById('usiaChart'), {
                type: 'bar',
                data: {
                    labels: usiaLabels,
                    datasets: [{
                        label: 'Jumlah Penduduk',
                        data: usiaData,
                        backgroundColor: 'rgba(217, 119, 6, 0.7)',
                        borderColor: 'rgba(217, 119, 6, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        // Chart RT
        if (document.getElementById('rtChart') && rtLabels.length > 0) {
            new Chart(document.getElementById('rtChart'), {
                type: 'bar',
                data: {
                    labels: rtLabels,
                    datasets: [{
                        label: 'Jumlah Penduduk',
                        data: rtData,
                        backgroundColor: 'rgba(16, 185, 129, 0.7)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'y',
                    scales: {
                        x: { beginAtZero: true }
                    }
                }
            });
        }
    </script>

</body>

</html>