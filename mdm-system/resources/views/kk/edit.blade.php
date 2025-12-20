@php
    // Variabel $kk dikirim dari KartuKeluargaController::edit($kk)
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit KK - {{ $kk->kepala_keluarga }}</title>
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
                
                <a href="{{ route('kk.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-amber-700 shadow-lg">
                    <i class="fas fa-address-card"></i> <span>Manajemen KK</span>
                </a>
                
                <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-envelope-open-text"></i> <span>Layanan Surat</span>
                </a>
            </nav>
            <div class="mt-8 p-4 bg-amber-800/50 rounded-lg border border-amber-600/30">
                <p class="text-xs text-amber-200 text-center italic">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>

        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">
            
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('kk.index') }}" class="text-blue-600 hover:underline font-semibold">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar KK
                </a>
            </div>

            {{-- FORMULIR EDIT KK --}}
            <div class="bg-white rounded-xl shadow-2xl p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Edit Kartu Keluarga: {{ $kk->kepala_keluarga }}</h2>
                
                <form action="{{ route('kk.update', $kk->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid md:grid-cols-2 gap-6">
                        
                        {{-- NO KK --}}
                        <div class="mb-4">
                            <label for="no_kk" class="block text-sm font-medium text-gray-700">Nomor Kartu Keluarga (16 Digit)</label>
                            <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk', $kk->no_kk) }}" required 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 @error('no_kk') border-red-500 @enderror" 
                                placeholder="Contoh: 3302010101000001">
                            @error('no_kk')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- KEPALA KELUARGA --}}
                        <div class="mb-4">
                            <label for="kepala_keluarga" class="block text-sm font-medium text-gray-700">Nama Kepala Keluarga</label>
                            <input type="text" name="kepala_keluarga" id="kepala_keluarga" value="{{ old('kepala_keluarga', $kk->kepala_keluarga) }}" required 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 @error('kepala_keluarga') border-red-500 @enderror" 
                                placeholder="Nama Lengkap Kepala Keluarga">
                            @error('kepala_keluarga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" rows="3" required 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 @error('alamat') border-red-500 @enderror" 
                            placeholder="Contoh: Jalan Pahlawan No. 12 Desa Benangin">{{ old('alamat', $kk->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        
                        {{-- RT --}}
                        <div class="mb-4">
                            <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
                            <input type="text" name="rt" id="rt" value="{{ old('rt', $kk->rt) }}" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 @error('rt') border-red-500 @enderror" 
                                placeholder="Contoh: 001">
                            @error('rt')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- RW --}}
                        <div class="mb-4">
                            <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                            <input type="text" name="rw" id="rw" value="{{ old('rw', $kk->rw) }}" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 @error('rw') border-red-500 @enderror" 
                                placeholder="Contoh: 002">
                            @error('rw')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 border-t pt-4">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                            <i class="fas fa-sync-alt mr-1"></i> Perbarui KK
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