<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Surat - SISKEP Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-active { background: rgba(37, 99, 235, 0.1); border-right: 4px solid #3b82f6; }
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
        {{-- SIDEBAR --}}
        <aside id="sidebar" class="w-72 bg-[#0f172a] min-h-screen text-slate-400 p-6 hidden md:block border-r border-white/5">
            <div class="mb-10 px-2">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Menu Utama</p>
            </div>
            <nav class="space-y-3">
                @include('layouts.navigation')
            </nav>
            <div class="mt-20 p-6 rounded-[2rem] bg-gradient-to-br from-blue-600/10 to-emerald-600/10 border border-white/5 text-center">
                <p class="text-[11px] text-slate-300 font-medium leading-relaxed uppercase tracking-widest">"Pelayanan Cepat, Desa Maju"</p>
            </div>
        </aside>
        
        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 md:p-10">
            <div class="max-w-6xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="mb-8 flex items-center gap-3 text-sm font-semibold tracking-wide">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-700 transition">Dashboard</a>
                    <i class="fas fa-chevron-right text-[10px] text-slate-300"></i>
                    <span class="text-slate-400">Administrasi Surat</span>
                </nav>
        
                {{-- Alerts --}}
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 mb-8 rounded-[1.5rem] flex items-center gap-4 animate-pulse">
                        <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                            <i class="fas fa-check text-sm"></i>
                        </div>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Table Container --}}
                <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
                    {{-- Action Bar --}}
                    <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div>
                            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Daftar Pengajuan Surat</h1>
                            <p class="text-slate-400 text-sm font-medium mt-1">Kelola permohonan surat keterangan penduduk.</p>
                        </div>
                        <a href="{{ route('surat.create') }}" class="flex items-center justify-center gap-2 px-8 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-black rounded-2xl shadow-lg shadow-blue-500/20 transition-all uppercase tracking-tighter text-sm">
                            <i class="fas fa-plus"></i> Buat Pengajuan
                        </a>
                    </div>
        
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">No. Surat / Tanggal</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Pemohon</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Jenis & Keperluan</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($surats as $surat)
                                <tr class="hover:bg-blue-50/40 transition-all duration-200 group">
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-blue-600 tracking-tighter">{{ $surat->nomor_surat ?? 'DRAFT' }}</span>
                                            <span class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-wider italic">{{ $surat->created_at->format('d M Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $surat->penduduk->nama ?? 'N/A' }}</span>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase mt-0.5 tracking-widest">{{ $surat->penduduk->nik ?? '' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col max-w-[200px]">
                                            <span class="text-xs font-black text-slate-700 uppercase">{{ $surat->jenis_surat }}</span>
                                            <span class="text-[10px] text-slate-400 truncate mt-1">{{ $surat->keperluan }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        @if($surat->status == 'approved')
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">Approved</span>
                                        @elseif($surat->status == 'rejected')
                                            <span class="px-3 py-1 bg-rose-50 text-rose-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-rose-100">Rejected</span>
                                        @else
                                            <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-amber-100">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-2 opacity-30 group-hover:opacity-100 transition-opacity">
                                            {{-- Detail --}}
                                            <a href="{{ route('surat.show', $surat->id) }}" class="w-9 h-9 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-search text-xs"></i>
                                            </a>
                                            
                                            {{-- Edit (Pending Only) --}}
                                            @if($surat->status == 'pending')
                                            <a href="{{ route('surat.edit', $surat->id) }}" class="w-9 h-9 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-edit text-xs"></i>
                                            </a>
                                            @endif

                                            {{-- Cetak (Approved Only) --}}
                                            @if($surat->status == 'approved')
                                            <a href="#" target="_blank" class="w-9 h-9 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-print text-xs"></i>
                                            </a>
                                            @endif

                                            {{-- Hapus (Admin Only) --}}
                                            @if(auth()->user()->role->name === 'admin')
                                            <form action="{{ route('surat.destroy', $surat->id) }}" method="POST" onsubmit="return confirm('Hapus pengajuan?')" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-9 h-9 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                                                    <i class="fas fa-trash text-xs"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center opacity-20">
                                            <i class="fas fa-envelope-open-text text-6xl mb-4 text-slate-400"></i>
                                            <p class="font-black uppercase tracking-[0.2em] text-slate-500 text-xs">Belum Ada Pengajuan Surat</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
        
                    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
                        {{ $surats->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>
</html>