<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operator - SISKEP Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
<<<<<<< HEAD
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
=======
        .bg-batik {
            background-color: #fffbeb;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='%23d97706' fill-opacity='0.03'/%3E%3C/svg%3E");
        }

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

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .avatar-operator {
            background-color: #e3a65fff;
            /* Warna Amber */
            border: 2px solid #fff;
        }
    </style>
</head>

<body class="bg-batik min-h-screen">
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae

    {{-- HEADER --}}
    <header class="bg-[#0f172a] text-white shadow-lg sticky top-0 z-20 border-b border-slate-700">
        <div class="px-6 py-4 flex items-center justify-between">
<<<<<<< HEAD
            <div class="flex items-center gap-4">
                <button id="menu-toggle" class="md:hidden p-2 rounded-md hover:bg-slate-800">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                        <span class="text-xl">🏛️</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold tracking-tight uppercase">SISKEP BENANGIN 1</h1>
                        <p class="text-slate-400 text-xs hidden md:block uppercase tracking-widest">Kecamatan Teweh Timur</p>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-emerald-400 font-medium uppercase tracking-tighter">{{ auth()->user()->role->name ?? 'Operator' }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold shadow-lg border-2 border-slate-600">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2.5 text-white bg-red-500 rounded-lg hover:bg-red-600 transition shadow-md" title="Logout">
                        <i class="fas fa-power-off"></i>
                    </button>
                </form>
            </div>
=======
            @include('layouts.header')
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
        </div>
    </header>

    <div class="flex">
        {{-- SIDEBAR --}}
<<<<<<< HEAD
        <aside id="sidebar" class="sidebar w-64 sidebar-navy min-h-screen text-slate-300 p-4 fixed md:relative z-10 border-r border-slate-800">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4 px-4">Menu Utama</p>
            <nav class="space-y-1">
                <a href="{{ route('operator.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600/10 text-blue-400 font-semibold border border-blue-600/20 shadow-sm">
                    <i class="fas fa-th-large"></i> <span>Dashboard</span>
                </a>

                <a href="{{ route('penduduk.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition">
                    <i class="fas fa-users"></i> <span>Data Penduduk</span>
                </a>

                {{-- Modul Manajemen KK --}}
                <a href="{{ route('kk.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition">
                    <i class="fas fa-address-card"></i> <span>Manajemen KK</span>
                </a>
=======
        <aside id="sidebar"
            class="sidebar w-64 bg-gradient-to-b from-amber-900 to-red-900 min-h-screen text-amber-50 p-4 fixed md:relative z-10">
            <nav class="space-y-2">
                @include('layouts.navigation')
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
            </nav>

            <div class="absolute bottom-10 left-4 right-4 p-5 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 text-center">
                <p class="text-[10px] text-slate-400 italic font-medium">"GOTONG ROYONG MEMBANGUN DESA"</p>
            </div>
        </aside>

<<<<<<< HEAD
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
=======
        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">

            {{-- BLOCK 1: UCAPAN SELAMAT DATANG --}}
            <div class="bg-gradient-to-r from-amber-800 to-red-800 rounded-2xl p-6 text-white mb-6 shadow-xl">
                <h2 class="text-2xl font-bold">Halo, {{ auth()->user()->name }}!</h2>
                <p class="text-amber-200 mt-1">Siap memverifikasi data penduduk desa? 📅
                    {{ $indonesian_date }}
                </p>
            </div>

            {{-- BLOCK AKSI CEPAT (1 BARIS) --}}
            <div class="bg-white rounded-xl shadow-2xl p-4 mb-6">
                <h3 class="text-lg font-bold text-amber-900 mb-3"><i class="fas fa-bolt mr-2 text-yellow-500"></i> Aksi
                    Cepat</h3>
                <div class="flex flex-wrap gap-4 items-center justify-start">

                    {{-- Validasi Data --}}
                    <a href="{{ route('validasi.index') }}"
                        class="flex items-center p-3 bg-yellow-100 rounded-lg hover:bg-yellow-200 transition duration-300 shadow-md text-sm font-semibold text-yellow-800">
                        <i class="fas fa-check-double text-lg mr-2"></i> Proses Validasi ({{ $totalPending ?? 0 }})
                    </a>

                    {{-- Cetak Laporan (Perbaikan: ke menu pilihan) --}}
                    <a href="{{ route('laporan.index') }}"
                        class="flex items-center p-3 bg-teal-100 rounded-lg hover:bg-teal-200 transition duration-300 shadow-md text-sm font-semibold text-teal-800">
                        <i class="fas fa-print text-lg mr-2"></i> Cetak Laporan
                    </a>
                </div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Tugas Validasi</h3>

            {{-- Kartu Tugas Validasi --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                {{-- Data Pending (Fokus Utama) --}}
                <div class="stat-card bg-white rounded-xl p-5 shadow-lg border-l-4 border-yellow-500 cursor-pointer"
                    onclick="window.location.href='{{ route('validasi.index') }}'">
                    <div
                        class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center mb-3 text-2xl text-white">
                        <i class="fas fa-exclamation-triangle"></i>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
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
<<<<<<< HEAD
                
                <div class="stat-card bg-white rounded-2xl p-6 border-b-4 border-emerald-500 card-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl font-bold">
                            <i class="fas fa-check-double text-xl"></i>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 uppercase bg-emerald-100 px-2 py-1 rounded">Selesai</span>
=======

                {{-- Data Valid --}}
                <div class="stat-card bg-white rounded-xl p-5 shadow-lg border-l-4 border-green-600">
                    <div
                        class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mb-3 text-2xl text-white">
                        <i class="fas fa-check-circle"></i>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                    </div>
                    <p class="text-4xl font-black text-slate-800">{{ number_format($totalValid ?? 0, 0, ',', '.') }}</p>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mt-1">Total Data Valid</p>
                </div>

<<<<<<< HEAD
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
            
            {{-- TABEL DATA TERBARU --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-800 uppercase tracking-tight">Antrian Validasi Terbaru</h3>
                    <span class="bg-slate-100 text-slate-600 text-xs font-bold px-3 py-1 rounded-full uppercase">{{ $recentPending->count() }} Data</span>
                </div>
=======
                {{-- Data Reject --}}
                <div class="stat-card bg-white rounded-xl p-5 shadow-lg border-l-4 border-red-600">
                    <div
                        class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center mb-3 text-2xl text-white">
                        <i class="fas fa-times"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalRejected ?? 0, 0, ',', '.') }}
                    </p>
                    <p class="text-gray-500 text-sm">Total Data Ditolak</p>
                </div>
            </div>

            {{-- DATA PENDING TERBARU --}}
            <div class="bg-white rounded-xl shadow-2xl p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">5 Data Pending Terbaru</h3>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/50">
                            <tr>
<<<<<<< HEAD
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Warga</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIK</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Input</th>
                                <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest">Opsi</th>
=======
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIK</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dibuat Pada</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($recentPending as $penduduk)
<<<<<<< HEAD
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-slate-700 uppercase text-sm">{{ $penduduk->nama }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-mono italic">{{ $penduduk->nik }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    {{ $penduduk->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('validasi.show', $penduduk->id) }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-1.5 px-4 rounded-lg text-xs transition uppercase tracking-tighter">
                                        Periksa <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-emerald-50 text-emerald-400 rounded-full flex items-center justify-center mb-4 text-2xl">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Semua data sudah divalidasi</p>
                                    </div>
                                </td>
                            </tr>
=======
                                <tr class="hover:bg-amber-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">{{ $penduduk->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $penduduk->nik }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $penduduk->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="{{ route('validasi.show', $penduduk->id) }}"
                                            class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-xs transition">
                                            <i class="fas fa-search"></i> Verifikasi
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        <i class="fas fa-check-circle mr-2 text-green-500"></i> Tidak ada data penduduk yang
                                        menunggu validasi! Tugas selesai.
                                    </td>
                                </tr>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                            @endforelse
                        </tbody>
                    </table>
                </div>
<<<<<<< HEAD
=======

                @if ($totalPending > 5)
                    <div class="mt-4 text-center">
                        <a href="{{ route('validasi.index') }}" class="text-blue-600 hover:underline font-semibold text-sm">
                            Lihat Semua {{ $totalPending }} Data Pending <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                    </div>
                @endif
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
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