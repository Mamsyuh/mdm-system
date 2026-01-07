<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah KK Baru - SISKEP Benangin 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen font-sans text-slate-900">

    {{-- HEADER (Navy Dark sesuai image_aba21d.png) --}}
    <header class="bg-[#0f172a] text-white shadow-xl sticky top-0 z-20 border-b border-white/10">
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button id="menu-toggle" class="md:hidden p-2 rounded-lg hover:bg-slate-800 transition">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/20">
                        <span class="text-xl">🏛️</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold tracking-tight leading-tight uppercase">SISKEP BENANGIN 1</h1>
                        <p class="text-blue-400 text-[10px] hidden md:block font-semibold tracking-widest uppercase">Dashboard Administrasi Desa</p>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-bold bg-blue-600/20 text-blue-300 px-3 py-1 rounded-full border border-blue-500/30 uppercase hidden sm:block">
                    {{ auth()->user()->role->name ?? 'Admin' }}
                </span>
                <div class="w-9 h-9 bg-emerald-500 text-emerald-950 rounded-lg flex items-center justify-center font-bold shadow-lg shadow-emerald-500/20">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <div class="flex">
        {{-- SIDEBAR (Navy Dark) --}}
        <aside id="sidebar" class="w-64 bg-[#0f172a] min-h-screen text-slate-300 p-4 hidden md:block border-r border-white/5">
            <nav class="space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 hover:text-white transition group">
                    <i class="fas fa-home text-slate-500 group-hover:text-blue-400 transition"></i> 
                    <span class="font-medium text-sm">Dashboard</span>
                </a>
                <a href="{{ route('penduduk.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 hover:text-white transition group">
                    <i class="fas fa-users text-slate-500 group-hover:text-blue-400 transition"></i> 
                    <span class="font-medium text-sm">Data Penduduk</span>
                </a>
                {{-- Active State --}}
                <a href="{{ route('kk.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600/10 text-blue-400 border border-blue-500/20 shadow-sm">
                    <i class="fas fa-address-card"></i> 
                    <span class="font-bold text-sm">Manajemen KK</span>
                </a>
            </nav>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 md:p-10">
            <div class="max-w-4xl mx-auto">
                {{-- Breadcrumb/Back --}}
                <div class="mb-8">
                    <a href="{{ route('kk.index') }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-700 transition group">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition"></i> 
                        Kembali ke Manajemen KK
                    </a>
                </div>

                {{-- FORMULIR CARD --}}
                <div class="bg-white rounded-3xl shadow-2xl shadow-slate-200/50 overflow-hidden border border-slate-100">
                    <div class="bg-slate-50 px-8 py-6 border-b border-slate-100 flex items-center gap-4">
                        <div class="w-2 h-8 bg-blue-600 rounded-full"></div>
                        <h2 class="text-2xl font-black text-[#0f172a]">Tambah Kartu Keluarga Baru</h2>
                    </div>
                    
                    <form action="{{ route('kk.store') }}" method="POST" class="p-8 space-y-8">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-8">
                            {{-- NO KK --}}
                            <div class="space-y-2">
                                <label for="no_kk" class="text-sm font-bold text-slate-700 ml-1">Nomor Kartu Keluarga <span class="text-red-500">*</span></label>
                                <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk') }}" required 
                                    class="w-full border-2 border-slate-100 bg-slate-50 rounded-2xl p-3.5 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none transition duration-300 placeholder:text-slate-400 @error('no_kk') border-red-500 @enderror" 
                                    placeholder="16 Digit No. KK">
                                @error('no_kk') <p class="text-red-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- KEPALA KELUARGA --}}
                            <div class="space-y-2">
                                <label for="kepala_keluarga" class="text-sm font-bold text-slate-700 ml-1">Nama Kepala Keluarga <span class="text-red-500">*</span></label>
                                <input type="text" name="kepala_keluarga" id="kepala_keluarga" value="{{ old('kepala_keluarga') }}" required 
                                    class="w-full border-2 border-slate-100 bg-slate-50 rounded-2xl p-3.5 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none transition duration-300 placeholder:text-slate-400 @error('kepala_keluarga') border-red-500 @enderror" 
                                    placeholder="Sesuai KTP">
                                @error('kepala_keluarga') <p class="text-red-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- ALAMAT --}}
                        <div class="space-y-2">
                            <label for="alamat" class="text-sm font-bold text-slate-700 ml-1">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="3" required 
                                class="w-full border-2 border-slate-100 bg-slate-50 rounded-2xl p-3.5 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none transition duration-300 placeholder:text-slate-400 @error('alamat') border-red-500 @enderror" 
                                placeholder="Tuliskan alamat lengkap RT/RW...">{{ old('alamat') }}</textarea>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            {{-- RT --}}
                            <div class="space-y-2">
                                <label for="rt" class="text-sm font-bold text-slate-700 ml-1">RT</label>
                                <input type="text" name="rt" id="rt" value="{{ old('rt') }}" 
                                    class="w-full border-2 border-slate-100 bg-slate-50 rounded-2xl p-3.5 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none transition duration-300 placeholder:text-slate-400" 
                                    placeholder="Contoh: 001">
                            </div>

                            {{-- RW --}}
                            <div class="space-y-2">
                                <label for="rw" class="text-sm font-bold text-slate-700 ml-1">RW</label>
                                <input type="text" name="rw" id="rw" value="{{ old('rw') }}" 
                                    class="w-full border-2 border-slate-100 bg-slate-50 rounded-2xl p-3.5 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none transition duration-300 placeholder:text-slate-400" 
                                    placeholder="Contoh: 002">
                            </div>
                        </div>

                        {{-- TOMBOL SIMPAN (Emerald Green sesuai landing page) --}}
                        <div class="pt-6 flex justify-end">
                            <button type="submit" class="group relative px-10 py-4 bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-black rounded-2xl shadow-xl shadow-emerald-500/30 transition-all duration-300 transform active:scale-95">
                                <span class="flex items-center gap-2 italic">
                                    <i class="fas fa-save group-hover:rotate-12 transition-transform"></i>
                                    SIMPAN DATA KK
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>