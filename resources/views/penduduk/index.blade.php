<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk - SISKEP Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
<<<<<<< HEAD
        body { font-family: 'Inter', sans-serif; }
        .sidebar-active { background: rgba(37, 99, 235, 0.1); border-right: 4px solid #3b82f6; }
=======
        .bg-batik {
            background-color: #fffbeb;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='%23d97706' fill-opacity='0.03'/%3E%3C/svg%3E");
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
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
    </style>
</head>

<body class="bg-slate-50 min-h-screen">

<<<<<<< HEAD
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
    {{-- HEADER (Logout dan Avatar Admin) --}}
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
<<<<<<< HEAD
        
        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 md:p-10">
            <div class="max-w-6xl mx-auto">
                {{-- Breadcrumb Modern --}}
                <nav class="mb-8 flex items-center gap-3 text-sm font-semibold tracking-wide">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-700 transition">Dashboard</a>
                    <i class="fas fa-chevron-right text-[10px] text-slate-300"></i>
                    <span class="text-slate-400">Data Penduduk</span>
=======

        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 py-6">
                {{-- Breadcrumb --}}
                <nav class="mb-4 text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="text-amber-600 hover:text-amber-800">Dashboard</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-600">Data Penduduk</span>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                </nav>

                {{-- Alert --}}
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 mb-8 rounded-[1.5rem] flex items-center gap-4 animate-bounce">
                        <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                            <i class="fas fa-check-double text-sm"></i>
                        </div>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                @endif
<<<<<<< HEAD
        
                {{-- Statistik Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 group hover:border-blue-500/30 transition-all duration-300">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-4 group-hover:scale-110 transition">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest">Total Penduduk</p>
                        <h2 class="text-3xl font-black text-slate-900 mt-1">{{ $statistik['total'] }}</h2>
                    </div>
        
                    <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 group hover:border-cyan-500/30 transition-all duration-300">
                        <div class="w-12 h-12 bg-cyan-50 rounded-2xl flex items-center justify-center text-cyan-600 mb-4 group-hover:scale-110 transition">
                            <i class="fas fa-mars text-xl"></i>
                        </div>
                        <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest">Laki-laki</p>
                        <h2 class="text-3xl font-black text-slate-900 mt-1">{{ $statistik['laki'] }}</h2>
                    </div>
        
                    <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 group hover:border-rose-500/30 transition-all duration-300">
                        <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600 mb-4 group-hover:scale-110 transition">
                            <i class="fas fa-venus text-xl"></i>
                        </div>
                        <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest">Perempuan</p>
                        <h2 class="text-3xl font-black text-slate-900 mt-1">{{ $statistik['perempuan'] }}</h2>
                    </div>
        
                    <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 border-l-4 border-l-emerald-500 group transition-all duration-300">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-4">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                        <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest">Validasi: Valid</p>
                        <h2 class="text-3xl font-black text-emerald-600 mt-1">{{ $statistik['valid'] }}</h2>
                    </div>
                </div>
        
                {{-- Data Table Container --}}
                <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
                    {{-- Table Action Bar --}}
                    <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row justify-between items-center gap-6">
=======

                {{-- Header & Actions --}}
                {{-- Statistik Penduduk --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-xl shadow border-l-4 border-amber-600">
                        <p class="text-gray-600 text-sm">Total Penduduk</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $statistik['total'] }}</h2>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow border-l-4 border-blue-600">
                        <p class="text-gray-600 text-sm">Laki-laki</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $statistik['laki'] }}</h2>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow border-l-4 border-pink-600">
                        <p class="text-gray-600 text-sm">Perempuan</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $statistik['perempuan'] }}</h2>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                        <div>
                            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Data Penduduk</h1>
                            <p class="text-slate-400 text-sm font-medium mt-1">Kelola arsip digital kependudukan desa.</p>
                        </div>
                        <div class="flex gap-3 w-full md:w-auto">
                            <button onclick="toggleFilter()" class="flex-1 md:flex-none flex items-center justify-center gap-2 px-6 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-2xl transition-all">
                                <i class="fas fa-filter text-xs"></i> FILTER
                            </button>
                            <a href="{{ route('penduduk.create') }}" class="flex-1 md:flex-none flex items-center justify-center gap-2 px-8 py-3.5 bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-black rounded-2xl shadow-lg shadow-emerald-500/20 transition-all uppercase tracking-tighter">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
<<<<<<< HEAD
        
                    {{-- Filter Panel (Hidden by default) --}}
                    <div id="filterPanel" class="hidden bg-slate-50/50 p-8 border-b border-slate-100 animate-fade-in-down">
                        <form method="GET" action="{{ route('penduduk.index') }}" class="grid md:grid-cols-4 gap-6">
=======

                    {{-- Filter Panel --}}
                    <div id="filterPanel" class="hidden mt-4 pt-4 border-t">
                        <form method="GET" action="{{ route('penduduk.index') }}" class="grid md:grid-cols-4 gap-4">
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Pencarian Cepat</label>
                                <input type="text" name="search" value="{{ request('search') }}" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="Nama / NIK / No. KK">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition">
                                    <option value="">Semua</option>
                                    <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Wilayah (RT)</label>
                                <select name="rt" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition">
                                    <option value="">Semua RT</option>
<<<<<<< HEAD
                                    @foreach($rtList as $rt)
                                        <option value="{{ $rt->rt }}">RT {{ $rt->rt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-end gap-2">
                                <button type="submit" class="flex-1 py-3 bg-blue-600 text-white font-black rounded-xl hover:bg-blue-700 transition">CARI</button>
                                <a href="{{ route('penduduk.index') }}" class="flex-1 py-3 bg-slate-200 text-slate-600 text-center font-black rounded-xl hover:bg-slate-300 transition text-sm">RESET</a>
                            </div>
                        </form>
                    </div>

                    {{-- Table Area --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">No</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Identitas Warga</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Gender</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Umur</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Wilayah</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
=======
                                    @forelse($rtList as $rt)
                                        <option value="{{ $rt->rt }}">RT {{ $rt->rt }}</option>
                                    @empty
                                        <option value="">Tidak ada data</option>
                                    @endforelse
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Validasi</label>
                                <select name="status_validasi"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                                    <option value="">Semua</option>
                                    <option value="valid" {{ request('status_validasi') == 'valid' ? 'selected' : '' }}>
                                        Valid
                                    </option>
                                    <option value="pending" {{ request('status_validasi') == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="reject" {{ request('status_validasi') == 'reject' ? 'selected' : '' }}>
                                        Reject
                                    </option>
                                </select>
                            </div>
                            <div class="md:col-span-4 flex gap-2">
                                <button type="submit"
                                    class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg transition">
                                    <i class="fas fa-search mr-2"></i> Cari
                                </button>
                                <button type="reset"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg transition">
                                    <i class="fas fa-redo mr-2"></i> Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Table --}}
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-amber-600 to-amber-700 text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">NIK
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">L/P
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Umur
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">RT/RW
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Status
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Aksi
                                    </th>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($penduduks as $index => $penduduk)
<<<<<<< HEAD
                                <tr class="hover:bg-blue-50/40 transition-all duration-200 group">
                                    <td class="px-8 py-6 text-sm font-bold text-slate-400 italic">
                                        {{ $penduduks->firstItem() + $index }}
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-slate-900 group-hover:text-blue-600 transition tracking-tight uppercase">
                                                {{ $penduduk->nama }}
                                            </span>
                                            <span class="text-[11px] font-bold text-slate-400 mt-0.5 tracking-tighter">
                                                NIK: {{ $penduduk->nik }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        @if($penduduk->jenis_kelamin == 'L')
                                            <span class="w-9 h-9 bg-blue-50 text-blue-600 rounded-xl inline-flex items-center justify-center text-xs shadow-sm shadow-blue-500/10">
                                                <i class="fas fa-mars"></i>
                                            </span>
                                        @else
                                            <span class="w-9 h-9 bg-rose-50 text-rose-600 rounded-xl inline-flex items-center justify-center text-xs shadow-sm shadow-rose-500/10">
                                                <i class="fas fa-venus"></i>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 text-sm font-black text-slate-600">
                                        {{ $penduduk->umur }} <span class="text-[10px] text-slate-400">TH</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2">
                                            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black tracking-tighter">RT {{ $penduduk->rt }}</span>
                                            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black tracking-tighter">RW {{ $penduduk->rw }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        @php
                                            $statusClasses = [
                                                'Valid' => 'bg-emerald-100 text-emerald-700',
                                                'Perlu Verifikasi' => 'bg-amber-100 text-amber-700',
                                                'Ditolak' => 'bg-rose-100 text-rose-700'
                                            ];
                                            $currentClass = $statusClasses[$penduduk->status_validasi] ?? 'bg-slate-100 text-slate-700';
                                        @endphp
                                        <span class="px-4 py-1.5 {{ $currentClass }} rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm">
                                            {{ $penduduk->status_validasi }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-2 opacity-30 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('penduduk.edit', $penduduk) }}" class="w-10 h-10 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-edit text-xs"></i>
                                            </a>
                                            <form action="{{ route('penduduk.destroy', $penduduk) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-10 h-10 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                                    <i class="fas fa-trash-alt text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
=======
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 text-sm">{{ $penduduks->firstItem() + $index }}</td>
                                        <td class="px-4 py-3 text-sm font-mono">{{ $penduduk->nik }}</td>
                                        <td class="px-4 py-3 text-sm font-medium">{{ $penduduk->nama }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            @if($penduduk->jenis_kelamin == 'L')
                                                <span class="text-blue-600"><i class="fas fa-mars"></i></span>
                                            @else
                                                <span class="text-pink-600"><i class="fas fa-venus"></i></span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm">{{ $penduduk->umur }} th</td>
                                        <td class="px-4 py-3 text-sm">{{ $penduduk->rt }}/{{ $penduduk->rw }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            @if($penduduk->status_validasi == 'Valid')
                                                <span
                                                    class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Valid</span>
                                            @elseif($penduduk->status_validasi == 'Perlu Verifikasi')
                                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">Perlu
                                                    Verifikasi</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded-full">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm text-center">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('penduduk.edit', $penduduk) }}"
                                                    class="text-amber-600 hover:text-amber-800" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('penduduk.destroy', $penduduk) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                                @empty
                                <tr>
                                    <td colspan="7" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center opacity-20">
                                            <i class="fas fa-database text-6xl mb-4"></i>
                                            <p class="font-black uppercase tracking-[0.2em]">Data Tidak Ditemukan</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
<<<<<<< HEAD
        
                    {{-- Pagination Modern --}}
                    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
=======

                    {{-- Pagination --}}
                    <div class="px-4 py-3 bg-gray-50">
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
                        {{ $penduduks->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleFilter() {
            const panel = document.getElementById('filterPanel');
            panel.classList.toggle('hidden');
        }
    </script>

</body>
</html>