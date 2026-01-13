<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Data - SISKEP Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<<<<<<< HEAD
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .row-hover:hover { background-color: rgba(59, 130, 246, 0.04); }
    </style>
</head>

<body class="bg-slate-50 min-h-screen">

    {{-- HEADER --}}
    <header class="bg-[#0f172a] text-white shadow-xl sticky top-0 z-30">
        <div class="h-1.5 bg-gradient-to-r from-blue-600 via-emerald-500 to-blue-600"></div>
        <div class="px-6 py-4 flex items-center justify-between max-w-[1600px] mx-auto">
            <div class="flex items-center gap-4">
                <button id="menu-toggle" class="md:hidden p-2 rounded-xl bg-white/10 hover:bg-white/20 transition">
                    <i class="fas fa-bars text-xl text-blue-400"></i>
                </button>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/20">
                        <span class="text-xl">🏛️</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-black tracking-tight leading-none uppercase">SISKEP BENANGIN 1</h1>
                        <p class="text-blue-400 text-[10px] font-bold tracking-[0.2em] uppercase mt-1 opacity-90">Kecamatan Teweh Timur</p>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="hidden md:flex flex-col items-end mr-2">
                    <span class="text-xs font-bold text-white">{{ auth()->user()->name ?? 'Administrator' }}</span>
                    <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider">{{ auth()->user()->role->name ?? 'Operator' }}</span>
                </div>
                <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center border border-blue-500/30">
                    <i class="fas fa-user-shield text-blue-400"></i>
                </div>
            </div>
=======

    <style>
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

        .avatar-admin {
            background-color: #d97706;
            /* Warna Amber */
            border: 2px solid #fff;
        }

        .avatar-operator {
            background-color: #e3a65fff;
            /* Warna Amber */
            border: 2px solid #fff;
        }
    </style>
</head>

<body class="bg-batik min-h-screen">

    {{-- HEADER (Gunakan header dari dashboard admin/operator) --}}
    <header class="bg-gradient-to-r from-amber-900 via-red-900 to-amber-900 text-amber-50 shadow-lg sticky top-0 z-20">
        <div class="h-2 bg-gradient-to-r from-amber-500 via-red-500 to-amber-500"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            @include('layouts.header')
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
        </div>
    </header>

    <div class="flex max-w-[1600px] mx-auto">
        {{-- SIDEBAR --}}
<<<<<<< HEAD
        <aside id="sidebar" class="w-72 bg-[#0f172a] min-h-screen text-slate-400 p-6 hidden md:block border-r border-white/5">
            <nav class="space-y-3">
=======
        <aside id="sidebar"
            class="sidebar w-64 bg-gradient-to-b from-amber-900 to-red-900 min-h-screen text-amber-50 p-4 fixed md:relative z-10">
            <nav class="space-y-2">
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                @include('layouts.navigation')
            </nav>
            <div class="mt-20 p-6 rounded-[2rem] bg-gradient-to-br from-blue-600/10 to-emerald-600/10 border border-white/5 text-center">
                <p class="text-[11px] text-slate-300 font-medium leading-relaxed uppercase tracking-widest italic">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>
<<<<<<< HEAD
        
        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 md:p-10">
            <div class="max-w-6xl mx-auto">
                
                {{-- PAGE HEADER --}}
                <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <nav class="mb-4 flex items-center gap-3 text-sm font-semibold tracking-wide text-slate-400">
                            <span class="text-blue-600">Verifikasi</span>
                            <i class="fas fa-chevron-right text-[10px] text-slate-300"></i>
                            <span>Data Pending</span>
                        </nav>
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight flex items-center gap-4">
                            Validasi Data Penduduk
                            <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-full text-xs font-black tracking-widest border border-amber-200">
                                {{ $penduduksPending->total() }} PENDING
                            </span>
                        </h2>
                        <p class="text-slate-400 text-sm font-medium mt-2 italic">Pastikan keabsahan dokumen fisik sebelum melakukan persetujuan data.</p>
                    </div>
=======

        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">

            {{-- HEADER HALAMAN --}}
            <div class="bg-white rounded-2xl p-6 mb-6 shadow-xl border-t-4 border-blue-600">
                <h2 class="text-2xl font-bold text-gray-800">📋 Data Penduduk Menunggu Validasi</h2>
                <p class="text-gray-500 mt-1">Halaman ini digunakan Operator untuk memverifikasi data penduduk baru.</p>
            </div>

            {{-- ALERT SUKSES/ERROR --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                </div>
        
                {{-- ALERTS --}}
                @if (session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 mb-8 rounded-[1.5rem] flex items-center gap-4 animate-in fade-in duration-500">
                        <i class="fas fa-check-circle text-emerald-500"></i>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                @endif

<<<<<<< HEAD
                {{-- DATA TABLE --}}
                <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center w-16">No.</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Identitas Penduduk</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Kelahiran & Gender</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Domisili (RT/RW)</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($penduduksPending as $penduduk)
                                <tr class="row-hover transition-all duration-200 group">
                                    <td class="px-8 py-6 text-center text-sm font-black text-slate-400 group-hover:text-blue-600 transition-colors">
                                        {{ $loop->iteration + $penduduksPending->firstItem() - 1 }}
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $penduduk->nama }}</span>
                                            <span class="text-[10px] font-bold text-blue-600 mt-1 tracking-widest">NIK: {{ $penduduk->nik }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-bold text-slate-700">{{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d/m/Y') }}</span>
                                            <span class="text-[10px] text-slate-400 font-bold uppercase mt-1 tracking-wider">{{ $penduduk->jenis_kelamin }} ({{ $penduduk->umur ?? '?' }} Thn)</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-medium text-slate-600">{{ $penduduk->alamat }}</span>
                                            <span class="text-[10px] font-black text-slate-400 uppercase mt-1">RT {{ $penduduk->rt }} / RW {{ $penduduk->rw }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <a href="{{ route('validasi.show', $penduduk->id) }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-lg shadow-blue-500/20 transition-all active:scale-95">
                                            <i class="fas fa-search"></i> Periksa Data
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center opacity-20">
                                            <i class="fas fa-check-double text-6xl mb-4 text-slate-400"></i>
                                            <p class="font-black uppercase tracking-[0.2em] text-slate-500 text-xs">Semua Data Sudah Tervalidasi</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
        
                    {{-- PAGINATION --}}
                    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
                        {{ $penduduksPending->links() }}
                    </div>
=======
            {{-- TABEL DATA PENDING --}}
            <div class="bg-white rounded-xl shadow-2xl p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No.</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama & NIK</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    TTL & Gender</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alamat (RT/RW)</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($penduduksPending as $penduduk)
                                <tr class="hover:bg-amber-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $loop->iteration + $penduduksPending->firstItem() - 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">{{ $penduduk->nama }}</div>
                                        <div class="text-xs text-gray-500">NIK: {{ $penduduk->nik }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $penduduk->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d/m/Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $penduduk->jenis_kelamin }}
                                            ({{ $penduduk->umur ?? '?' }} thn)</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $penduduk->alamat }} ({{ $penduduk->rt }}/{{ $penduduk->rw }})
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        {{-- Tombol Aksi --}}
                                        <a href="{{ route('validasi.show', $penduduk->id) }}"
                                            class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-3 rounded text-xs transition">
                                            <i class="fas fa-search"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        <i class="fas fa-check-circle mr-2 text-green-500"></i> Tidak ada data penduduk yang
                                        menunggu validasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                </div>

                {{-- WARNING CARD --}}
                <div class="mt-10 p-8 rounded-[2rem] bg-[#0f172a] text-white flex flex-col md:flex-row items-center gap-8 border border-white/5 relative overflow-hidden shadow-2xl">
                    <div class="absolute top-0 right-0 p-4 opacity-5">
                        <i class="fas fa-shield-halved text-9xl"></i>
                    </div>
                    <div class="w-16 h-16 bg-rose-500 rounded-2xl flex items-center justify-center text-white shrink-0 shadow-xl shadow-rose-500/20">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-black uppercase tracking-tight leading-none text-rose-500">Peringatan Keamanan Operator</h4>
                        <p class="text-slate-400 text-xs font-medium mt-2 leading-relaxed max-w-2xl uppercase tracking-wider">
                            Setiap persetujuan data akan dicatat oleh sistem ke dalam log aktivitas. Mohon pastikan data yang anda verifikasi telah sesuai dengan 
                            <span class="text-white font-black underline decoration-blue-500 underline-offset-4">Dokumen Fisik (KTP/KK Asli)</span> 
                            guna menghindari kesalahan data kependudukan.
                        </p>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
=======

            {{-- Catatan untuk Operator --}}
            <div class="mt-6 p-4 bg-red-50 border-l-4 border-red-400 text-red-700">
                <p class="font-bold"><i class="fas fa-exclamation-triangle mr-2"></i> PERINGATAN OPERATOR</p>
                <p class="text-sm">Pastikan Anda membandingkan data dengan dokumen asli (KTP/KK) sebelum melakukan
                    verifikasi.</p>
            </div>

>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
        </main>
    </div>

    <script>
<<<<<<< HEAD
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
=======
        // Toggle Sidebar Script (Ambil dari dashboard admin/operator)
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
        });
    </script>
</body>

</html>