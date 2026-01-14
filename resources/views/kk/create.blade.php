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
                @include('layouts.navigation')
            </nav>
            <div class="mt-20 p-6 rounded-[2rem] bg-gradient-to-br from-blue-600/10 to-emerald-600/10 border border-white/5 text-center">
                <i class="fas fa-quote-left text-blue-500/30 text-2xl mb-2"></i>
                <p class="text-[11px] text-slate-300 font-medium leading-relaxed uppercase tracking-widest">"Gotong Royong Membangun Desa"</p>
            </div>
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

                        {{-- Pilih Kepala Keluarga --}}
                        <div class="space-y-2">
                            <label for="penduduk_id" class="text-sm font-bold text-slate-700 ml-1">Kepala Keluarga berdasarkan NIK <span class="text-red-500">*</span></label>
                            <select id="select_penduduk" name="penduduk_id"
                                class="select-2 w-full border-2 border-slate-100 bg-slate-50 rounded-2xl p-3.5">
                                <option value="">-- Pilih --</option>
                                @foreach ($kepalaKeluarga as $p)
                                    <option value="{{ $p->id }}">
                                        ({{ $p->nik }}) {{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#select_penduduk').select2({
            placeholder: "Cari berdasarkan nama atau NIK...",
            allowClear: true
        });
    </script>

</body>
</html>