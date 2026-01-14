<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operator - SISKEP Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* Menggunakan warna dasar dari screenshot aplikasi Anda */
        .bg-main { background-color: #f8fafc; }
        .sidebar-navy { background-color: #0f172a; }
        .card-shadow { box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05); }
        
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s ease-in-out; }
            .sidebar.active { transform: translateX(0); }
        }
        .stat-card:hover { transform: translateY(-4px); transition: all 0.3s ease; }
    </style>
</head>
<body class="bg-main min-h-screen">

    {{-- HEADER --}}
    <header class="bg-[#0f172a] text-white shadow-lg sticky top-0 z-20 border-b border-slate-700">
        <div class="px-6 py-4 flex items-center justify-between">
            @include('layouts.header')
        </div>
    </header>

    <div class="flex">
        {{-- SIDEBAR --}}
        <aside id="sidebar" class="sidebar w-64 sidebar-navy min-h-screen text-slate-300 p-4 fixed md:relative z-10 border-r border-slate-800">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4 px-4">Menu Utama</p>
            <nav class="space-y-1">
                @include('layouts.navigation')
            </nav>

            <div class="mt-20 p-6 rounded-[2rem] bg-gradient-to-br from-blue-600/10 to-emerald-600/10 border border-white/5 text-center">
                <i class="fas fa-quote-left text-blue-500/30 text-2xl mb-2"></i>
                <p class="text-[11px] text-slate-300 font-medium leading-relaxed uppercase tracking-widest">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>

        <main id="main-content" class="flex-1 p-6 md:p-8">
            
            {{-- BLOCK 1: UCAPAN SELAMAT DATANG --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Halo, {{ auth()->user()->name }}! 👋</h2>
                    <p class="text-slate-500 mt-1 font-medium">Sistem Informasi Manajemen Data Desa Benangin 1</p>
                </div>
                <div class="bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm flex items-center gap-2">
                    <i class="far fa-calendar-alt text-blue-500"></i>
                    <span class="text-sm font-bold text-slate-700 uppercase">{{ now()->translatedFormat('d F Y') }}</span>
                </div>
            </div>

            {{-- BLOCK AKSI CEPAT --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <a href="{{ route('penduduk.create') }}" class="group flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-200 hover:border-blue-400 transition card-shadow">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">
                            <i class="fas fa-user-plus text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800">Input Penduduk Baru</p>
                            <p class="text-xs text-slate-500">Tambah data warga ke sistem</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-slate-300 group-hover:text-blue-500"></i>
                </a>

                <a href="{{ route('laporan.index') }}" class="group flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-200 hover:border-emerald-400 transition card-shadow">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition">
                            <i class="fas fa-print text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800">Cetak Laporan</p>
                            <p class="text-xs text-slate-500">Ekspor data ke PDF/Excel</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-slate-300 group-hover:text-emerald-500"></i>
                </a>
            </div>
            
            {{-- Kartu Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="stat-card bg-white rounded-2xl p-6 border-b-4 border-amber-400 card-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-xl font-bold">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <span class="text-[10px] font-bold text-amber-600 uppercase bg-amber-100 px-2 py-1 rounded">Pending</span>
                    </div>
                    <p class="text-4xl font-black text-slate-800">{{ number_format($totalPending ?? 0, 0, ',', '.') }}</p>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mt-1">Data Perlu Validasi</p>
                </div>
                
                <div class="stat-card bg-white rounded-2xl p-6 border-b-4 border-emerald-500 card-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl font-bold">
                            <i class="fas fa-check-double text-xl"></i>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 uppercase bg-emerald-100 px-2 py-1 rounded">Selesai</span>
                    </div>
                    <p class="text-4xl font-black text-slate-800">{{ number_format($totalValid ?? 0, 0, ',', '.') }}</p>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mt-1">Total Data Valid</p>
                </div>

                <div class="stat-card bg-white rounded-2xl p-6 border-b-4 border-slate-800 card-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-slate-100 text-slate-800 rounded-xl font-bold">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                    </div>
                    <p class="text-4xl font-black text-slate-800">{{ number_format(($totalValid ?? 0) + ($totalPending ?? 0), 0, ',', '.') }}</p>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mt-1">Total Registrasi</p>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>

</body>

</html>