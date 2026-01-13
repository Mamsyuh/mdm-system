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
        </div>
    </header>

    <div class="flex max-w-[1600px] mx-auto">
        {{-- SIDEBAR: Dark Navy --}}
        <aside id="sidebar" class="w-72 bg-[#0f172a] min-h-screen text-slate-400 p-6 hidden md:block border-r border-white/5">
            <div class="mb-10 px-2">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Menu Utama</p>
            </div>
            <nav class="space-y-3">
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
                {{-- Breadcrumb Modern --}}
                <nav class="mb-8 flex items-center gap-3 text-sm font-semibold tracking-wide">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-700 transition">Dashboard</a>
                    <i class="fas fa-chevron-right text-[10px] text-slate-300"></i>
                    <span class="text-slate-400">Data Penduduk</span>
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
        
                    {{-- Filter Panel (Hidden by default) --}}
                    <div id="filterPanel" class="hidden bg-slate-50/50 p-8 border-b border-slate-100 animate-fade-in-down">
                        <form method="GET" action="{{ route('penduduk.index') }}" class="grid md:grid-cols-4 gap-6">
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
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($penduduks as $index => $penduduk)
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
        
                    {{-- Pagination Modern --}}
                    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
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