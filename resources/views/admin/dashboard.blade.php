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
        /* Mengikuti gradien landing page */
        .bg-main-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #1d4ed8 100%);
        }
        
        body {
            background-color: #f8fafc;
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
        
        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        /* Warna Hijau khas Tombol Landing Page */
        .btn-primary-green {
            background-color: #4ade80; /* Emerald/Lime Green */
            color: #064e3b;
            transition: all 0.2s;
        }
        .btn-primary-green:hover {
            background-color: #22c55e;
            transform: scale(1.02);
        }
    </style>
</head>
<body class="min-h-screen">

    {{-- HEADER (Blue Theme) --}}
    <header class="bg-blue-950 text-white shadow-lg sticky top-0 z-20">
        <div class="h-1 bg-emerald-400"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button id="menu-toggle" class="md:hidden p-2 rounded-md hover:bg-blue-800">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center backdrop-blur-md">
                        <span class="text-xl">🏛️</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold tracking-tight">SISKEP BENANGIN 1</h1>
                        <p class="text-blue-300 text-xs hidden md:block">Dashboard Administrasi Desa</p>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="text-xs font-semibold bg-blue-800 px-3 py-1 rounded-full hidden sm:block">
                    {{ auth()->user()->role->name ?? 'Administrator' }}
                </span>
                <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center shadow-inner border-2 border-white/20">
                    <i class="fas fa-user-shield text-emerald-950 text-lg"></i>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2 text-red-200 hover:text-white transition" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="flex">
        {{-- SIDEBAR (Dark Blue) --}}
        <aside id="sidebar" class="sidebar w-64 bg-slate-900 min-h-screen text-slate-300 p-4 fixed md:relative z-10 border-r border-slate-800">
            <nav class="space-y-1">
                @include('layouts.navigation')
            </nav>
            
            <div class="mt-10 p-4 bg-blue-900/20 rounded-xl border border-blue-500/20">
                <p class="text-[10px] uppercase tracking-widest text-blue-400 font-bold mb-2">Status Sistem</p>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    <span class="text-xs text-slate-400">Server Terhubung</span>
                </div>
            </div>
        </aside>

        <main id="main-content" class="flex-1 p-4 md:p-8 transition-all duration-300">
            
            {{-- BLOCK 1: WELCOME (Gradient Blue) --}}
            <div class="bg-main-gradient rounded-3xl p-8 text-white mb-8 shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-3xl font-extrabold">Selamat Datang, {{ auth()->user()->name }}!</h2>
                    <p class="text-blue-100 mt-2 opacity-90">Pantau dan kelola data kependudukan hari ini: <span class="font-semibold">{{ now()->translatedFormat('l, d F Y') }}</span></p>
                </div>
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            {{-- QUICK ACTIONS --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <a href="{{ route('validasi.index') }}" class="btn-primary-green p-4 rounded-2xl flex items-center justify-center gap-3 font-bold shadow-lg shadow-emerald-500/20">
                    <i class="fas fa-shield-check text-xl"></i> Cek Validasi ({{ $dataValid }})
                </a>
                <a href="{{ route('penduduk.create') }}" class="bg-white border border-slate-200 p-4 rounded-2xl flex items-center justify-center gap-3 font-bold text-slate-700 hover:bg-slate-50 transition shadow-sm">
                    <i class="fas fa-plus-circle text-blue-600 text-xl"></i> Input Data Baru
                </a>
                <a href="{{ route('laporan.index') }}" class="bg-white border border-slate-200 p-4 rounded-2xl flex items-center justify-center gap-3 font-bold text-slate-700 hover:bg-slate-50 transition shadow-sm">
                    <i class="fas fa-file-pdf text-red-500 text-xl"></i> Export Laporan
                </a>
            </div>
            
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Statistik Utama</h3>
            
            {{-- STAT CARDS (Blue & Emerald Accents) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex justify-between items-center">
                    <div>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Penduduk</p>
                        <p class="text-3xl font-black text-slate-800 mt-1">{{ number_format($totalPenduduk ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                
                <div class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex justify-between items-center">
                    <div>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Data Terverifikasi</p>
                        <p class="text-3xl font-black text-emerald-600 mt-1">{{ $dataValid ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-check-double"></i>
                    </div>
                </div>

                <div class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex justify-between items-center">
                    <div>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Kepala Keluarga</p>
                        <p class="text-3xl font-black text-slate-800 mt-1">{{ $totalKK ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-slate-50 text-slate-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-home-user"></i>
                    </div>
                </div>
            </div>

            {{-- CHARTS --}}
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-blue-600 rounded-full"></span> Komposisi Gender
                    </h3>
                    <div class="aspect-square max-h-[300px] mx-auto">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-blue-600 rounded-full"></span> Kelompok Usia
                    </h3>
                    <canvas id="usiaChart"></canvas>
                </div>
            </div>

            {{-- SECONDARY ACTION --}}
           {{--  <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col md:flex-row justify-between items-center gap-4 border-l-8 border-l-blue-600">
                <div class="text-center md:text-left">
                    <h4 class="text-lg font-bold text-slate-800">Menunggu Persetujuan Surat</h4>
                    <p class="text-slate-500 text-sm italic">Terdapat {{ $suratPending ?? 0 }} permohonan yang harus ditinjau.</p>
                </div>
                <a href="{{ route('surat.index') }}" class="w-full md:w-auto px-6 py-3 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-xl transition flex items-center justify-center gap-2">
                    <i class="fas fa-file-signature"></i> Buka Antrean
                </a>
            </div>

        </main>
    </div>
 --}} 
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Warna Palette Biru & Hijau untuk Chart
        const colorPalette = {
            blue: '#2563eb',
            lightBlue: '#60a5fa',
            emerald: '#10b981',
            slate: '#64748b'
        };

        const genderLabels = @json($genderLabels ?? ['Pria', 'Wanita']);
        const genderCounts = @json($genderCounts ?? [50, 50]);

        // Chart Gender
        new Chart(document.getElementById('genderChart'), {
            type: 'doughnut',
            data: {
                labels: genderLabels,
                datasets: [{
                    data: genderCounts,
                    backgroundColor: [colorPalette.blue, colorPalette.emerald],
                    hoverOffset: 10,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Chart Usia
        new Chart(document.getElementById('usiaChart'), {
            type: 'bar',
            data: {
                labels: @json($usiaLabels ?? []),
                datasets: [{
                    label: 'Jiwa',
                    data: @json($usiaData ?? []),
                    backgroundColor: colorPalette.blue + 'cc',
                    borderRadius: 8
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>

</html>