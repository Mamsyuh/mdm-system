<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Keluarga - SISKEP Benangin 1</title>
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