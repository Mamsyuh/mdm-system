<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operator - Desa Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        .bg-batik {
            background-color: #fffbeb;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='%23d97706' fill-opacity='0.03'/%3E%3C/svg%3E");
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s ease-in-out; }
            .sidebar.active { transform: translateX(0); box-shadow: 6px 0 10px rgba(0,0,0,0.3); }
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="bg-batik min-h-screen">

    {{-- HEADER (LOGOUT DIPINDAHKAN KE SINI) --}}
    <header class="bg-gradient-to-r from-amber-900 via-red-900 to-amber-900 text-amber-50 shadow-lg sticky top-0 z-20">
        <div class="h-2 bg-gradient-to-r from-amber-500 via-red-500 to-amber-500"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button id="menu-toggle" class="md:hidden p-2 rounded-md hover:bg-amber-800">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                        <span class="text-2xl">🏛️</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-wide">DESA Benangin 1</h1>
                        <p class="text-amber-200 text-sm hidden md:block">📍 Kecamatan Teweh Timur</p>
                    </div>
                </div>
            </div>
            
            {{-- PROFILE & LOGOUT BARU --}}
            <div class="flex items-center gap-4">
                <span class="text-sm bg-amber-800 px-3 py-1 rounded-full hidden sm:block">{{ auth()->user()->role->name ?? 'Operator' }}</span>
                <div class="w-10 h-10 bg-amber-700 rounded-full flex items-center justify-center font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                
                {{-- TOMBOL LOGOUT BARU DI SEBELAH PROFILE --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2 text-sm text-red-100 bg-red-700 rounded-full hover:bg-red-800 transition shadow-md hidden sm:block" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
            {{-- AKHIR PROFILE & LOGOUT BARU --}}
        </div>
        <div class="h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent"></div>
    </header>

    <div class="flex">
        {{-- SIDEBAR --}}
        <aside id="sidebar" class="sidebar w-64 bg-gradient-to-b from-amber-900 to-red-900 min-h-screen text-amber-50 p-4 fixed md:relative z-10">
            <nav class="space-y-2">
                <a href="{{ route('operator.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-amber-700 shadow-lg">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
                
                {{-- Modul Validasi --}}
                <a href="{{ route('validasi.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-check-double"></i> <span>Validasi Data</span>
                </a>

                {{-- Modul Data Penduduk --}}
                <a href="{{ route('penduduk.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-users"></i> <span>Data Penduduk</span>
                </a>

                {{-- Modul Manajemen KK --}}
                <a href="{{ route('kk.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-address-card"></i> <span>Manajemen KK</span>
                </a>
                
                {{-- Modul Layanan Surat --}}
                <a href="{{ route('surat.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-envelope-open-text"></i> <span>Layanan Surat</span>
                </a>
            </nav>
            <div class="mt-8 p-4 bg-amber-800/50 rounded-lg border border-amber-600/30">
                <p class="text-xs text-amber-200 text-center italic">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>

        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">
            
            {{-- BLOCK 1: UCAPAN SELAMAT DATANG --}}
            <div class="bg-gradient-to-r from-amber-800 to-red-800 rounded-2xl p-6 text-white mb-6 shadow-xl">
                <h2 class="text-2xl font-bold">Halo, Operator {{ auth()->user()->name }}!</h2>
                <p class="text-amber-200 mt-1">Siap memverifikasi data penduduk desa? 📅 {{ now()->translatedFormat('l, d F Y') }}</p>
            </div>

            {{-- BLOCK AKSI CEPAT (1 BARIS) --}}
            <div class="bg-white rounded-xl shadow-2xl p-4 mb-6">
                <h3 class="text-lg font-bold text-amber-900 mb-3"><i class="fas fa-bolt mr-2 text-yellow-500"></i> Aksi Cepat</h3>
                <div class="flex flex-wrap gap-4 items-center justify-start">
                    
                    {{-- Validasi Data --}}
                    <a href="{{ route('validasi.index') }}" class="flex items-center p-3 bg-yellow-100 rounded-lg hover:bg-yellow-200 transition duration-300 shadow-md text-sm font-semibold text-yellow-800">
                        <i class="fas fa-check-double text-lg mr-2"></i> Proses Validasi ({{ $totalPending ?? 0 }})
                    </a>

                    {{-- Tambah Penduduk (Input data baru) --}}
                    <a href="{{ route('penduduk.create') }}" class="flex items-center p-3 bg-indigo-100 rounded-lg hover:bg-indigo-200 transition duration-300 shadow-md text-sm font-semibold text-indigo-800">
                        <i class="fas fa-user-plus text-lg mr-2"></i> Input Penduduk Baru
                    </a>

                    {{-- Cetak Laporan (Perbaikan: ke menu pilihan) --}}
                    <a href="{{ route('laporan.index') }}" class="flex items-center p-3 bg-teal-100 rounded-lg hover:bg-teal-200 transition duration-300 shadow-md text-sm font-semibold text-teal-800">
                        <i class="fas fa-print text-lg mr-2"></i> Cetak Laporan
                    </a>
                </div>
            </div>
            
            <h3 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Tugas Validasi</h3>
            
            {{-- Kartu Tugas Validasi --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                
                {{-- Data Pending (Fokus Utama) --}}
                <div class="stat-card bg-white rounded-xl p-5 shadow-lg border-l-4 border-yellow-500 cursor-pointer" onclick="window.location.href='{{ route('validasi.index') }}'">
                    <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center mb-3 text-2xl text-white">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalPending ?? 0, 0, ',', '.') }}</p>
                    <p class="text-gray-500 text-sm font-semibold">Data Menunggu Validasi</p>
                    <p class="text-xs text-yellow-700 mt-1">Klik untuk segera proses.</p>
                </div>
                
                {{-- Data Valid --}}
                <div class="stat-card bg-white rounded-xl p-5 shadow-lg border-l-4 border-green-600">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mb-3 text-2xl text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalValid ?? 0, 0, ',', '.') }}</p>
                    <p class="text-gray-500 text-sm">Total Data Valid</p>
                </div>

                {{-- Data Reject --}}
                <div class="stat-card bg-white rounded-xl p-5 shadow-lg border-l-4 border-red-600">
                    <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center mb-3 text-2xl text-white">
                        <i class="fas fa-times"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalRejected ?? 0, 0, ',', '.') }}</p>
                    <p class="text-gray-500 text-sm">Total Data Ditolak</p>
                </div>
            </div>
            
            {{-- DATA PENDING TERBARU --}}
            <div class="bg-white rounded-xl shadow-2xl p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">5 Data Pending Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat Pada</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($recentPending as $penduduk)
                            <tr class="hover:bg-amber-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">{{ $penduduk->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $penduduk->nik }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $penduduk->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="{{ route('validasi.show', $penduduk->id) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-xs transition">
                                        <i class="fas fa-search"></i> Verifikasi
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    <i class="fas fa-check-circle mr-2 text-green-500"></i> Tidak ada data penduduk yang menunggu validasi! Tugas selesai.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if ($totalPending > 5)
                <div class="mt-4 text-center">
                    <a href="{{ route('validasi.index') }}" class="text-blue-600 hover:underline font-semibold text-sm">
                        Lihat Semua {{ $totalPending }} Data Pending <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                </div>
                @endif
            </div>

        </main>
    </div>

    {{-- Script Toggle Sidebar --}}
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>

</body>
</html>