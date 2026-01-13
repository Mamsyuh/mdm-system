<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Keluarga - SISKEP Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<<<<<<< HEAD
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-active { background: rgba(37, 99, 235, 0.1); border-right: 4px solid #3b82f6; }
    </style>
</head>

<body class="bg-slate-50 min-h-screen">

    {{-- HEADER: Navy Deep Blue --}}
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
                    <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider">{{ auth()->user()->role->name ?? 'Admin' }}</span>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                    @csrf
                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-rose-500/10 hover:bg-rose-500 text-rose-500 hover:text-white rounded-xl transition-all duration-300 border border-rose-500/20 shadow-lg shadow-rose-500/10">
                        <i class="fas fa-power-off"></i>
                    </button>
                </form>
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

    {{-- HEADER --}}
    <header class="bg-gradient-to-r from-amber-900 via-red-900 to-amber-900 text-amber-50 shadow-lg sticky top-0 z-20">
        <div class="h-2 bg-gradient-to-r from-amber-500 via-red-500 to-amber-500"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            @include('layouts.header')
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
        </div>
    </header>

<<<<<<< HEAD
    <div class="flex max-w-[1600px] mx-auto">
        {{-- SIDEBAR: Dark Navy --}}
        <aside id="sidebar" class="w-72 bg-[#0f172a] min-h-screen text-slate-400 p-6 hidden md:block border-r border-white/5">
            <div class="mb-10 px-2">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Menu Utama</p>
            </div>
            <nav class="space-y-3">
=======
    <div class="flex">
        {{-- SIDEBAR --}}
        <aside id="sidebar"
            class="sidebar w-64 bg-gradient-to-b from-amber-900 to-red-900 min-h-screen text-amber-50 p-4 fixed md:relative z-10">
            <nav class="space-y-2">
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                @include('layouts.navigation')
            </nav>
            <div class="mt-20 p-6 rounded-[2rem] bg-gradient-to-br from-blue-600/10 to-emerald-600/10 border border-white/5 text-center">
                <i class="fas fa-quote-left text-blue-500/30 text-2xl mb-2"></i>
                <p class="text-[11px] text-slate-300 font-medium leading-relaxed uppercase tracking-widest">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>
        
        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 md:p-10">
            <div class="max-w-6xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="mb-8 flex items-center gap-3 text-sm font-semibold tracking-wide">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-700 transition">Dashboard</a>
                    <i class="fas fa-chevron-right text-[10px] text-slate-300"></i>
                    <span class="text-slate-400">Kartu Keluarga</span>
                </nav>
        
                {{-- Alerts --}}
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 mb-8 rounded-[1.5rem] flex items-center gap-4 animate-bounce">
                        <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                            <i class="fas fa-check-double text-sm"></i>
                        </div>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                @endif

<<<<<<< HEAD
                {{-- Table Container --}}
                <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
                    {{-- Action Bar --}}
                    <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div>
                            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Manajemen KK</h1>
                            <p class="text-slate-400 text-sm font-medium mt-1">Daftar registrasi Kartu Keluarga desa.</p>
                        </div>
                        <div class="flex gap-3 w-full md:w-auto">
                            <a href="{{ route('kk.create') }}" class="flex-1 md:flex-none flex items-center justify-center gap-2 px-8 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-black rounded-2xl shadow-lg shadow-blue-500/20 transition-all uppercase tracking-tighter text-sm">
                                <i class="fas fa-plus"></i> Tambah KK
                            </a>
                        </div>
                    </div>
        
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">No. KK</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Kepala Keluarga</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Wilayah</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Anggota</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($kk as $kartuKeluarga)
                                <tr class="hover:bg-blue-50/40 transition-all duration-200 group">
                                    <td class="px-8 py-6 text-sm font-black text-blue-600 tracking-tighter">
                                        {{ $kartuKeluarga->no_kk }}
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $kartuKeluarga->kepala_keluarga }}</span>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase mt-0.5 tracking-widest italic">Kepala Keluarga</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2">
                                            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black tracking-tighter">RT {{ $kartuKeluarga->rt }}</span>
                                            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black tracking-tighter">RW {{ $kartuKeluarga->rw }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[11px] font-black">
                                            {{ $kartuKeluarga->anggota_count }} JIWA
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-2 opacity-30 group-hover:opacity-100 transition-opacity">
                                            {{-- Detail --}}
                                            <a href="{{ route('kk.show', $kartuKeluarga->id) }}" class="w-9 h-9 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-eye text-xs"></i>
                                            </a>
                                            {{-- Edit --}}
                                            <a href="{{ route('kk.edit', $kartuKeluarga->id) }}" class="w-9 h-9 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-edit text-xs"></i>
                                            </a>
                                            {{-- PDF --}}
                                            <a href="{{ route('kk.exportPdf', $kartuKeluarga->id) }}" target="_blank" class="w-9 h-9 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-file-pdf text-xs"></i>
                                            </a>
                                            {{-- Hapus --}}
                                            <form action="{{ route('kk.destroy', $kartuKeluarga->id) }}" method="POST" onsubmit="return confirm('Hapus KK? Anggota akan kehilangan relasi.')" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-9 h-9 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                                                    <i class="fas fa-trash text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center opacity-20">
                                            <i class="fas fa-folder-open text-6xl mb-4 text-slate-400"></i>
                                            <p class="font-black uppercase tracking-[0.2em] text-slate-500">Belum Ada Data KK</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
        
                    {{-- Pagination --}}
                    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
                        {{ $kk->links() }}
                    </div>
=======
        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">

            {{-- HEADER HALAMAN --}}
            <div class="bg-white rounded-2xl p-6 mb-6 shadow-xl border-t-4 border-amber-600">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Kartu Keluarga</h2>
                    <a href="{{ route('kk.create') }}"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                        <i class="fas fa-plus mr-1"></i> Tambah KK Baru
                    </a>
                </div>
                <p class="text-gray-500 mt-1">Daftar semua Kartu Keluarga yang tercatat di Desa Benangin.</p>
            </div>

            {{-- ALERT SUKSES/ERROR --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Gagal!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            {{-- TABEL DATA KK --}}
            <div class="bg-white rounded-xl shadow-2xl p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No. KK</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kepala Keluarga</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alamat (RT/RW)</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Anggota</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($kk as $kartuKeluarga)
                                <tr class="hover:bg-amber-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ $kartuKeluarga->no_kk }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $kartuKeluarga->kepala_keluarga }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $kartuKeluarga->alamat }} ({{ $kartuKeluarga->rt }}/{{ $kartuKeluarga->rw }})
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">{{ $kartuKeluarga->anggota_count }}
                                            Jiwa</span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium flex justify-center space-x-2">
                                        {{-- Tombol Detail --}}
                                        <a href="{{ route('kk.show', $kartuKeluarga->id) }}"
                                            class="text-blue-600 hover:text-blue-900" title="Detail"><i
                                                class="fas fa-eye"></i></a>

                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('kk.edit', $kartuKeluarga->id) }}"
                                            class="text-amber-600 hover:text-amber-900" title="Edit"><i
                                                class="fas fa-edit"></i></a>

                                        {{-- Tombol PDF --}}
                                        <a href="{{ route('kk.exportPdf', $kartuKeluarga->id) }}" target="_blank"
                                            class="text-red-600 hover:text-red-900" title="Export PDF"><i
                                                class="fas fa-file-pdf"></i></a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('kk.destroy', $kartuKeluarga->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus KK ini? Semua anggota akan kehilangan relasi KK.');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        <i class="fas fa-info-circle mr-2"></i> Belum ada Kartu Keluarga yang tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $kk->links() }}
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                </div>
            </div>
        </main>
    </div>

    <script>
<<<<<<< HEAD
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
=======
        // Toggle Sidebar Script
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
        });
    </script>

</body>

</html>