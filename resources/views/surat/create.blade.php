<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengajuan Surat - SISKEP Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        select, textarea, input { transition: all 0.2s ease-in-out; }
        select:focus, textarea:focus, input:focus { 
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.1);
        }
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
            <nav class="space-y-3">
                @include('layouts.navigation')
            </nav>
        </aside>
        
        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 md:p-10">
            <div class="max-w-4xl mx-auto">
                {{-- Breadcrumb & Back Button --}}
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                    <nav class="flex items-center gap-3 text-sm font-semibold tracking-wide">
                        <a href="{{ route('surat.index') }}" class="text-blue-600 hover:text-blue-700 transition flex items-center gap-2">
                            <i class="fas fa-arrow-left text-xs"></i> Kembali
                        </a>
                        <i class="fas fa-chevron-right text-[10px] text-slate-300"></i>
                        <span class="text-slate-400">Buat Pengajuan</span>
                    </nav>
                </div>

                {{-- Form Card --}}
                <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
                    <div class="p-8 md:p-12 border-b border-slate-50 bg-gradient-to-r from-slate-50 to-transparent">
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Formulir Pengajuan Surat</h2>
                        <p class="text-slate-400 text-sm font-medium mt-2">Silahkan lengkapi data pemohon dan detail keperluan surat di bawah ini.</p>
                    </div>

                    <form action="{{ route('surat.store') }}" method="POST" class="p-8 md:p-12 space-y-10">
                        @csrf
                        
                        <div class="grid md:grid-cols-2 gap-8">
                            {{-- Field: Pemohon --}}
                            <div class="space-y-2">
                                <label for="penduduk_id" class="block text-[11px] font-black text-slate-500 uppercase tracking-[0.2em] ml-1">Nama Pemohon (NIK)</label>
                                <div class="relative">
                                    <select id="penduduk_id" name="penduduk_id" required 
                                        class="block w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white outline-none appearance-none cursor-pointer">
                                        <option value="" disabled selected>-- Pilih Data Penduduk --</option>
                                        @foreach($penduduks as $penduduk)
                                            <option value="{{ $penduduk->id }}" {{ old('penduduk_id') == $penduduk->id ? 'selected' : '' }}>
                                                {{ $penduduk->nama }} — {{ $penduduk->nik }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                                    </div>
                                </div>
                                @error('penduduk_id')
                                    <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase tracking-wider">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Field: Jenis Surat --}}
                            <div class="space-y-2">
                                <label for="jenis_surat" class="block text-[11px] font-black text-slate-500 uppercase tracking-[0.2em] ml-1">Jenis Layanan Surat</label>
                                <div class="relative">
                                    <select id="jenis_surat" name="jenis_surat" required 
                                        class="block w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white outline-none appearance-none cursor-pointer">
                                        <option value="" disabled selected>-- Pilih Jenis Surat --</option>
                                        <option value="Surat Keterangan Domisili" {{ old('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Domisili (SKD)</option>
                                        <option value="Surat Pengantar Nikah" {{ old('jenis_surat') == 'Surat Pengantar Nikah' ? 'selected' : '' }}>Pengantar Nikah (N1-N4)</option>
                                        <option value="Surat Keterangan Usaha" {{ old('jenis_surat') == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Keterangan Usaha (SKU)</option>
                                        <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Tidak Mampu (SKTM)</option>
                                        <option value="Lainnya" {{ old('jenis_surat') == 'Lainnya' ? 'selected' : '' }}>Lainnya / Umum</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                                    </div>
                                </div>
                                @error('jenis_surat')
                                    <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase tracking-wider">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Field: Keperluan --}}
                        <div class="space-y-2">
                            <label for="keperluan" class="block text-[11px] font-black text-slate-500 uppercase tracking-[0.2em] ml-1">Maksud / Keperluan Pengajuan</label>
                            <textarea id="keperluan" name="keperluan" rows="4" required 
                                class="block w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-[2rem] text-sm font-medium text-slate-700 focus:border-blue-500 focus:bg-white outline-none resize-none"
                                placeholder="Jelaskan secara mendetail untuk apa surat ini digunakan... (Contoh: Melengkapi berkas pendaftaran kerja di PT. Maju Jaya)">{{ old('keperluan') }}</textarea>
                            @error('keperluan')
                                <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest hidden md:block">Pastikan data sudah sesuai</p>
                            <div class="flex gap-4 w-full md:w-auto">
                                <button type="reset" class="flex-1 md:flex-none px-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black rounded-2xl transition-all uppercase tracking-tighter text-xs">
                                    Reset
                                </button>
                                <button type="submit" class="flex-1 md:flex-none px-10 py-4 bg-blue-600 hover:bg-blue-500 text-white font-black rounded-2xl shadow-xl shadow-blue-500/20 transition-all uppercase tracking-tighter text-xs flex items-center justify-center gap-2">
                                    <i class="fas fa-paper-plane text-[10px]"></i> Ajukan Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Information Card --}}
                <div class="mt-8 p-6 bg-blue-600 rounded-[2rem] flex items-center gap-6 shadow-xl shadow-blue-500/10 border border-blue-400/20">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center text-white shrink-0">
                        <i class="fas fa-info-circle text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-white uppercase tracking-tight">Informasi Penting</h4>
                        <p class="text-blue-100 text-xs leading-relaxed mt-0.5">Setelah diajukan, surat akan masuk ke antrian status <strong>Pending</strong>. Harap tunggu validasi dari Kepala Desa atau Sekretaris Desa untuk penerbitan nomor surat resmi.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('hidden');
        });
    </script>
</body>
</html>