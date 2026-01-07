<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi: {{ $penduduk->nama }} - SISKEP Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .data-label { @apply text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1; }
        .data-value { @apply text-sm font-bold text-slate-800 tracking-tight; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

    {{-- HEADER --}}
    <header class="bg-[#0f172a] text-white shadow-xl sticky top-0 z-30">
        <div class="h-1.5 bg-gradient-to-r from-blue-600 via-emerald-500 to-blue-600"></div>
        <div class="px-6 py-4 flex items-center justify-between max-w-[1600px] mx-auto">
            <div class="flex items-center gap-4">
                <a href="{{ route('validasi.index') }}" class="p-2 rounded-xl bg-white/10 hover:bg-white/20 transition">
                    <i class="fas fa-arrow-left text-blue-400"></i>
                </a>
                <div>
                    <h1 class="text-sm font-black tracking-tight leading-none uppercase">Verifikasi Data</h1>
                    <p class="text-blue-400 text-[10px] font-bold tracking-widest uppercase mt-1">ID Penduduk: #{{ $penduduk->id }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-[10px] bg-amber-500/20 text-amber-500 border border-amber-500/30 px-3 py-1 rounded-full font-black uppercase tracking-tighter">Status: Pending</span>
            </div>
        </div>
    </header>

    <div class="max-w-5xl mx-auto p-6 md:p-10">
        
        {{-- SUCCESS/ERROR MESSAGES --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3 shadow-sm">
                <i class="fas fa-check-circle"></i>
                <p class="text-xs font-bold">{{ session('success') }}</p>
            </div>
        @endif

        {{-- IDENTITY CARD --}}
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden mb-8">
            <div class="p-8 md:p-12 border-b border-slate-50 bg-gradient-to-br from-slate-50 to-white">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 bg-blue-600 rounded-[2rem] flex items-center justify-center text-white shadow-xl shadow-blue-500/30">
                            <i class="fas fa-user-check text-3xl"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight">{{ $penduduk->nama }}</h2>
                            <p class="text-blue-600 font-black tracking-widest text-xs mt-1">NIK. {{ $penduduk->nik }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <div class="grid md:grid-cols-3 gap-12">
                    {{-- Section 1 --}}
                    <div class="space-y-6">
                        <div class="flex flex-col">
                            <span class="data-label">Jenis Kelamin</span>
                            <span class="data-value">{{ $penduduk->jenis_kelamin }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="data-label">Hubungan Keluarga</span>
                            <span class="data-value">{{ $penduduk->hubungan_keluarga }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="data-label">Agama</span>
                            <span class="data-value">{{ $penduduk->agama }}</span>
                        </div>
                    </div>

                    {{-- Section 2 --}}
                    <div class="space-y-6">
                        <div class="flex flex-col">
                            <span class="data-label">Tempat, Tanggal Lahir</span>
                            <span class="data-value">{{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="data-label">Usia Saat Ini</span>
                            <span class="data-value">{{ $penduduk->umur ?? '?' }} Tahun</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="data-label">No. Kartu Keluarga</span>
                            <span class="data-value tracking-widest">{{ $penduduk->no_kk }}</span>
                        </div>
                    </div>

                    {{-- Section 3 --}}
                    <div class="space-y-6">
                        <div class="flex flex-col">
                            <span class="data-label">Kepala Keluarga</span>
                            <span class="data-value">{{ $penduduk->kepala_keluarga }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="data-label">Alamat Lengkap</span>
                            <span class="data-value leading-relaxed">{{ $penduduk->alamat }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="data-label">RT / RW</span>
                            <span class="data-value">Wilayah {{ $penduduk->rt }} / {{ $penduduk->rw }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ACTION AREA --}}
            <div class="p-8 md:p-12 bg-slate-50/50 border-t border-slate-100">
                <div class="flex flex-col md:flex-row gap-4">
                    <form method="POST" action="{{ route('validasi.approve', $penduduk->id) }}" class="flex-1" onsubmit="return confirm('Apakah Anda yakin data ini sudah VALID?');">
                        @csrf
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-black py-5 rounded-2xl shadow-xl shadow-emerald-500/20 transition-all uppercase tracking-widest text-xs flex items-center justify-center gap-3 active:scale-95">
                            <i class="fas fa-check-double text-sm"></i> Setujui & Validasi Data
                        </button>
                    </form>
                    
                    <button onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="flex-1 bg-white hover:bg-rose-50 text-rose-600 border-2 border-rose-100 font-black py-5 rounded-2xl transition-all uppercase tracking-widest text-xs flex items-center justify-center gap-3 active:scale-95">
                        <i class="fas fa-ban text-sm"></i> Tolak Pendaftaran
                    </button>
                </div>
                
                <div class="mt-8 flex items-center gap-3 text-amber-600 bg-amber-50 p-4 rounded-xl border border-amber-100">
                    <i class="fas fa-info-circle text-sm"></i>
                    <p class="text-[10px] font-bold uppercase tracking-wider">PENTING: Data yang sudah divalidasi akan langsung masuk ke database penduduk aktif.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL REJECT --}}
    <div id="rejectModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-[#0f172a]/80 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="document.getElementById('rejectModal').classList.add('hidden')"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-[2.5rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-100">
                <div class="bg-rose-600 px-8 py-6">
                    <h3 class="text-lg font-black text-white uppercase tracking-tight flex items-center gap-3">
                        <i class="fas fa-exclamation-circle"></i> Konfirmasi Penolakan
                    </h3>
                </div>
                <form method="POST" action="{{ route('validasi.reject', $penduduk->id) }}" class="p-8">
                    @csrf
                    <div class="space-y-4">
                        <label for="catatan" class="block text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">Alasan Penolakan</label>
                        <textarea id="catatan" name="catatan" rows="4" required 
                            class="block w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm font-bold text-slate-700 focus:border-rose-500 focus:bg-white outline-none resize-none transition-all"
                            placeholder="Sebutkan alasan (Contoh: NIK tidak terdaftar di database pusat atau foto dokumen buram)"></textarea>
                    </div>
                    <div class="mt-8 flex flex-col md:flex-row gap-3">
                        <button type="submit" class="flex-1 bg-rose-600 hover:bg-rose-500 text-white font-black py-4 rounded-xl shadow-lg shadow-rose-500/20 transition-all uppercase tracking-widest text-[10px]">
                            Ya, Tolak Data
                        </button>
                        <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black py-4 rounded-xl transition-all uppercase tracking-widest text-[10px]">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>