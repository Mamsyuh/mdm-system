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
        .bg-batik {
            background-color: #fffbeb;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='%23d97706' fill-opacity='0.03'/%3E%3C/svg%3E");
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s ease-in-out; }
            .sidebar.active { transform: translateX(0); box-shadow: 6px 0 10px rgba(0,0,0,0.3); }
        }
    </style>
</head>
<body class="bg-batik min-h-screen">

    {{-- HEADER --}}
    <header class="bg-gradient-to-r from-amber-900 via-red-900 to-amber-900 text-amber-50 shadow-lg sticky top-0 z-20">
        {{-- ... Kode Header sama dengan create.blade.php ... --}}
        <div class="h-2 bg-gradient-to-r from-amber-500 via-red-500 to-amber-500"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button id="menu-toggle" class="md:hidden p-2 rounded-md hover:bg-amber-800">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                        <span class="text-2xl">🏛️</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-wide">DESA Benangin 1</h1>
                        <p class="text-amber-200 text-sm hidden md:block">📍 Kecamatan Teweh Timur</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm bg-amber-800 px-3 py-1 rounded-full hidden sm:block">{{ auth()->user()->role->name ?? 'Admin' }}</span>
                <div class="w-10 h-10 bg-amber-700 rounded-full flex items-center justify-center font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                {{-- Logout Button --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2 text-sm text-red-100 bg-red-700 rounded-full hover:bg-red-800 transition shadow-md hidden sm:block" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent"></div>
    </header>

    <div class="flex">
        {{-- SIDEBAR --}}
        <aside id="sidebar" class="sidebar w-64 bg-gradient-to-b from-amber-900 to-red-900 min-h-screen text-amber-50 p-4 fixed md:relative z-10">
            <nav class="space-y-2">
                @if (auth()->user()->role->name === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                @else
                    <a href="{{ route('operator.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                @endif
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>

                <a href="{{ route('validasi.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-check-double"></i> <span>Validasi Data</span>
                </a>

                <a href="{{ route('penduduk.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-users"></i> <span>Data Penduduk</span>
                </a>
                
                <a href="{{ route('kk.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-address-card"></i> <span>Manajemen KK</span>
                </a>

                <a href="{{ route('surat.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-amber-700 shadow-lg">
                    <i class="fas fa-envelope-open-text"></i> <span>Layanan Surat</span>
                </a>
            </nav>
            <div class="mt-8 p-4 bg-amber-800/50 rounded-lg border border-amber-600/30">
                <p class="text-xs text-amber-200 text-center italic">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>

        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">
            
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