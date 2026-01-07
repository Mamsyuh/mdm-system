<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Jenis Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        /* Gaya Layout */
        .bg-batik {
            background-color: #fffbeb;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='%23d97706' fill-opacity='0.03'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-batik min-h-screen">
    
    <div class="flex flex-col items-center justify-center min-h-screen p-4">
        
        <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-lg text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Cetak Laporan Penduduk</h2>
            <p class="text-gray-500 mb-8">Pilih format dokumen yang Anda inginkan.</p>

            <div class="flex flex-col md:flex-row justify-center gap-6">
                
                {{-- 1. Export PDF --}}
                <a href="{{ route('penduduk.exportPdf') }}" target="_blank" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-6 rounded-lg shadow-xl transition transform hover:scale-105">
                    <i class="fas fa-file-pdf text-2xl mb-2"></i>
                    <p class="text-lg">Export PDF</p>
                    <p class="text-xs font-normal">Cetak data untuk arsip (Portrait)</p>
                </a>

                {{-- 2. Export Excel --}}
                <a href="{{ route('penduduk.exportExcel') }}" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg shadow-xl transition transform hover:scale-105">
                    <i class="fas fa-file-excel text-2xl mb-2"></i>
                    <p class="text-lg">Export Excel</p>
                    <p class="text-xs font-normal">Unduh data untuk diolah</p>
                </a>
            </div>
            
            <div class="mt-8">
                <a href="{{ route(auth()->user()->role->name === 'admin' ? 'admin.dashboard' : 'operator.dashboard') }}" class="text-blue-600 hover:underline text-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

</body>
</html>