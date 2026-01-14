@php
    // Variabel $surat dikirim dari SuratController::show($surat)
    $isAdmin = auth()->user()->role->name === 'admin';
    $isPending = $surat->status === 'pending';
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan Surat - {{ $surat->jenis_surat }}</title>
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
            
            <a href="{{ route('surat.index') }}" class="text-blue-600 hover:underline mb-4 block font-semibold">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Pengajuan
            </a>

            {{-- ALERT STATUS --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-2xl p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Pengajuan Surat: {{ $surat->jenis_surat }}</h2>
                
                <div class="grid md:grid-cols-3 gap-6 mb-8 text-sm">
                    
                    {{-- Blok Status Surat --}}
                    <div>
                        <h4 class="font-bold text-lg text-amber-700 mb-2 border-b">Status Pengajuan</h4>
                        <p><span class="font-semibold">Tanggal Pengajuan:</span> {{ $surat->created_at->format('d F Y H:i') }}</p>
                        <p><span class="font-semibold">Nomor Surat:</span> 
                            <span class="font-mono text-gray-900">{{ $surat->nomor_surat ?? 'BELUM TERBIT' }}</span>
                        </p>
                        <p class="mt-2"><span class="font-semibold">Status:</span> 
                            @if($surat->status == 'approved')
                                <span class="px-2 py-0.5 text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">DISETUJUI</span>
                            @elseif($surat->status == 'rejected')
                                <span class="px-2 py-0.5 text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">DITOLAK</span>
                            @else
                                <span class="px-2 py-0.5 text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">PENDING</span>
                            @endif
                        </p>
                    </div>

                    {{-- Blok Pemohon --}}
                    <div>
                        <h4 class="font-bold text-lg text-amber-700 mb-2 border-b">Detail Pemohon</h4>
                        <p><span class="font-semibold">Nama:</span> {{ $surat->penduduk->nama ?? '-' }}</p>
                        <p><span class="font-semibold">NIK:</span> {{ $surat->penduduk->nik ?? '-' }}</p>
                        <p><span class="font-semibold">Alamat:</span> {{ $surat->penduduk->alamat ?? '-' }} (RT/RW: {{ $surat->penduduk->rt ?? '-' }}/{{ $surat->penduduk->rw ?? '-' }})</p>
                    </div>

                    {{-- Blok Keperluan --}}
                    <div>
                        <h4 class="font-bold text-lg text-amber-700 mb-2 border-b">Keperluan Surat</h4>
                        <p class="text-gray-700 italic">{{ $surat->keperluan }}</p>
                        
                        @if ($surat->status === 'rejected')
                        <div class="mt-4 p-3 bg-red-50 border border-red-300 rounded">
                            <p class="font-semibold text-red-700">Catatan Penolakan:</p>
                            <p class="text-red-600 text-sm">{{ $surat->catatan }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- AKSI ADMIN (HANYA MUNCUL JIKA ADMIN & PENDING) --}}
                @if ($isAdmin && $isPending)
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-t pt-4">Aksi Persetujuan Admin</h3>
                    <div class="flex space-x-4">
                        
                        {{-- 1. FORM APPROVE --}}
                        <form method="POST" action="{{ route('surat.approve', $surat->id) }}" onsubmit="return confirm('YAKIN INGIN MENYETUJUI SURAT INI? Nomor surat akan diterbitkan otomatis.');">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                                <i class="fas fa-check-circle mr-2"></i> SETUJUI & TERBITKAN
                            </button>
                        </form>

                        {{-- 2. FORM REJECT --}}
                        <button onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                            <i class="fas fa-times-circle mr-2"></i> TOLAK PENGAJUAN
                        </button>
                    </div>
                @endif
            </div>

            {{-- MODAL REJECT (Untuk menolak pengajuan) --}}
            <div id="rejectModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-70 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-2xl">
                    <h3 class="text-xl font-bold mb-4 text-red-700">Tolak Pengajuan Surat</h3>
                    <form method="POST" action="{{ route('surat.reject', $surat->id) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan Wajib Diisi:</label>
                            <textarea id="catatan" name="catatan" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 p-2" placeholder="Contoh: NIK pemohon belum divalidasi atau data keperluan tidak jelas."></textarea>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Tolak Pengajuan</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    {{-- Script Toggle Sidebar --}}
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>

</body>
</html>