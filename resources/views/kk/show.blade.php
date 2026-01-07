<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail KK: {{ $kk->no_kk }} - SISKEP Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .table-header { @apply px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] bg-slate-50/50; }
        .row-hover:hover { background-color: rgba(59, 130, 246, 0.04); }
    </style>
</head>
<body class="bg-slate-50 min-h-screen text-slate-900">

    {{-- HEADER --}}
    <header class="bg-[#0f172a] text-white shadow-xl sticky top-0 z-30">
        <div class="h-1.5 bg-gradient-to-r from-blue-600 via-emerald-500 to-blue-600"></div>
        <div class="px-6 py-4 flex items-center justify-between max-w-[1600px] mx-auto">
            <div class="flex items-center gap-4">
                <a href="{{ route('kk.index') }}" class="p-2 rounded-xl bg-white/10 hover:bg-white/20 transition group">
                    <i class="fas fa-arrow-left text-blue-400 group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h1 class="text-sm font-black tracking-tight leading-none uppercase">Manajemen Kartu Keluarga</h1>
                    <p class="text-blue-400 text-[10px] font-bold tracking-widest uppercase mt-1">Siskep Digital Desa</p>
                </div>
            </div>
            
            <div class="flex gap-2">
                <a href="{{ route('kk.exportPdf', $kk->id) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-rose-600 hover:bg-rose-500 text-[10px] font-black uppercase tracking-widest rounded-xl transition shadow-lg shadow-rose-600/20">
                    <i class="fas fa-file-pdf"></i> <span class="hidden sm:inline">Export PDF</span>
                </a>
                <a href="{{ route('kk.edit', $kk->id) }}" class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-[10px] font-black uppercase tracking-widest rounded-xl transition shadow-lg shadow-blue-600/20">
                    <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit Data</span>
                </a>
            </div>
        </div>
    </header>

    <div class="max-w-6xl mx-auto p-6 md:p-10">
        
        {{-- KK INFO CARD --}}
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden mb-10">
            <div class="p-8 md:p-10 bg-gradient-to-br from-[#0f172a] to-[#1e293b] text-white relative">
                <div class="absolute top-0 right-0 p-10 opacity-10">
                    <i class="fas fa-id-card text-8xl"></i>
                </div>
                <div class="relative z-10">
                    <span class="px-4 py-1.5 bg-blue-500/20 text-blue-400 rounded-full text-[10px] font-black tracking-[0.2em] border border-blue-500/30 uppercase">Nomor KK: {{ $kk->no_kk }}</span>
                    <h2 class="text-4xl font-black mt-4 tracking-tight uppercase">{{ $kk->kepala_keluarga }}</h2>
                    <div class="flex flex-wrap gap-6 mt-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center border border-white/10 text-emerald-400">
                                <i class="fas fa-map-marker-alt text-xs"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-300">{{ $kk->alamat }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center border border-white/10 text-blue-400">
                                <i class="fas fa-users text-xs"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-300">{{ $kk->anggota->count() }} Anggota Keluarga</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center border border-white/10 text-amber-400">
                                <i class="fas fa-th-large text-xs"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-300 uppercase tracking-widest">RT {{ $kk->rt }} / RW {{ $kk->rw }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MEMBER TABLE --}}
            <div class="p-6 md:p-8">
                <h3 class="flex items-center gap-3 text-lg font-black text-slate-900 uppercase tracking-tight mb-6">
                    <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                    Daftar Anggota Keluarga
                </h3>

                <div class="overflow-x-auto rounded-3xl border border-slate-100 shadow-sm">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="table-header text-center">No.</th>
                                <th class="table-header">Nama & NIK</th>
                                <th class="table-header">Hubungan</th>
                                <th class="table-header">Tgl Lahir & Usia</th>
                                <th class="table-header text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse ($kk->anggota as $anggota)
                            <tr class="row-hover transition-colors group">
                                <td class="px-6 py-5 text-center text-xs font-black text-slate-400 group-hover:text-blue-600">{{ $loop->iteration }}</td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $anggota->nama }}</span>
                                        <span class="text-[10px] font-bold text-blue-600 tracking-widest mt-0.5">NIK: {{ $anggota->nik }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-[11px] font-black text-slate-500 uppercase tracking-wider bg-slate-100 px-3 py-1 rounded-lg">
                                        {{ $anggota->hubungan_keluarga }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold text-slate-700">{{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d/m/Y') }}</span>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">{{ $anggota->umur ?? '?' }} Tahun</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    @if($anggota->status_validasi == 'Valid')
                                        <span class="px-3 py-1 bg-emerald-100 text-emerald-600 text-[9px] font-black uppercase rounded-full border border-emerald-200">Valid</span>
                                    @elseif($anggota->status_validasi == 'Perlu Verifikasi')
                                        <span class="px-3 py-1 bg-amber-100 text-amber-600 text-[9px] font-black uppercase rounded-full border border-amber-200">Pending</span>
                                    @else
                                        <span class="px-3 py-1 bg-rose-100 text-rose-600 text-[9px] font-black uppercase rounded-full border border-rose-200">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center opacity-30">
                                        <i class="fas fa-users-slash text-5xl mb-4"></i>
                                        <p class="text-[10px] font-black uppercase tracking-[0.2em]">Belum Ada Anggota Keluarga</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- FOOTER NOTE --}}
        <div class="flex items-center justify-between px-8 py-4 bg-slate-200/50 rounded-2xl border border-slate-200">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                <i class="fas fa-clock mr-2"></i> Terakhir diperbarui: {{ now()->translatedFormat('d F Y, H:i') }}
            </p>
            <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest italic">
                Siskep Digital Desa Benangin 1
            </p>
        </div>
    </div>

</body>
</html>