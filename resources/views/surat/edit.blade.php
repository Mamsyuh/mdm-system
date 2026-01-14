@php
    // Variabel $surat dan $penduduks dikirim dari SuratController::edit($surat)
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengajuan Surat - {{ $surat->jenis_surat }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-active { background: rgba(37, 99, 235, 0.1); border-right: 4px solid #3b82f6; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

    {{-- HEADER --}}
    <header class="bg-[#0f172a] text-white shadow-xl sticky top-0 z-30">
        <div class="px-6 py-4 flex items-center justify-between max-w-[1600px] mx-auto">
            @include('layouts.header')
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
                <i class="fas fa-quote-left text-blue-500/30 text-2xl mb-2"></i>
                <p class="text-[11px] text-slate-300 font-medium leading-relaxed uppercase tracking-widest">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main id="main-content" class="flex-1 p-6 md:p-10">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('surat.index') }}" class="text-blue-600 hover:underline font-semibold">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Pengajuan
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-2xl p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Edit Pengajuan Surat</h2>
                
                <form action="{{ route('surat.update', $surat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- Form Group 1: Pemohon dan Jenis Surat --}}
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        
                        {{-- Field: Pemohon (Penduduk) --}}
                        <div>
                            <label for="penduduk_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Pemohon (Penduduk)</label>
                            <select id="penduduk_id" name="penduduk_id" required 
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                                <option value="" disabled>-- Pilih Penduduk --</option>
                                @foreach($penduduks as $penduduk)
                                    <option value="{{ $penduduk->id }}" 
                                        {{ (old('penduduk_id', $surat->penduduk_id) == $penduduk->id) ? 'selected' : '' }}>
                                        {{ $penduduk->nama }} (NIK: {{ $penduduk->nik }})
                                    </option>
                                @endforeach
                            </select>
                            @error('penduduk_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Field: Jenis Surat --}}
                        <div>
                            <label for="jenis_surat" class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat Pengantar</label>
                            <select id="jenis_surat" name="jenis_surat" required 
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                                <option value="" disabled>-- Pilih Jenis Surat --</option>
                                @php $selectedType = old('jenis_surat', $surat->jenis_surat); @endphp
                                <option value="Surat Keterangan Domisili" {{ $selectedType == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
                                <option value="Surat Pengantar Nikah" {{ $selectedType == 'Surat Pengantar Nikah' ? 'selected' : '' }}>Surat Pengantar Nikah (N1-N4)</option>
                                <option value="Surat Keterangan Usaha" {{ $selectedType == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha (SKU)</option>
                                <option value="Surat Keterangan Tidak Mampu" {{ $selectedType == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu (SKTM)</option>
                                <option value="Lainnya" {{ $selectedType == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_surat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Field: Keperluan --}}
                    <div class="mb-6">
                        <label for="keperluan" class="block text-sm font-medium text-gray-700 mb-1">Keperluan Pengajuan Surat</label>
                        <textarea id="keperluan" name="keperluan" rows="3" required 
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 sm:text-sm"
                            placeholder="Contoh: Digunakan untuk persyaratan pendaftaran CPNS di kantor pemerintahan">{{ old('keperluan', $surat->keperluan) }}</textarea>
                        @error('keperluan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition">
                            <i class="fas fa-sync-alt mr-2"></i> Perbarui Pengajuan
                        </button>
                    </div>
                </form>

            </div>
        </main>
    </div>

    <script>
        // Toggle Sidebar Script
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>

</body>
</html>