<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Data - SISKEP Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
        </div>
    </header>

    <div class="flex max-w-[1600px] mx-auto">
        {{-- SIDEBAR --}}
        <aside id="sidebar" class="w-72 bg-[#0f172a] min-h-screen text-slate-400 p-6 hidden md:block border-r border-white/5">
            <nav class="space-y-3">
                @include('layouts.navigation')
            </nav>
            <div class="mt-20 p-6 rounded-[2rem] bg-gradient-to-br from-blue-600/10 to-emerald-600/10 border border-white/5 text-center">
                <p class="text-[11px] text-slate-300 font-medium leading-relaxed uppercase tracking-widest italic">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>
        
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
                </div>
        
                {{-- ALERTS --}}
                @if (session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 mb-8 rounded-[1.5rem] flex items-center gap-4 animate-in fade-in duration-500">
                        <i class="fas fa-check-circle text-emerald-500"></i>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                @endif

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