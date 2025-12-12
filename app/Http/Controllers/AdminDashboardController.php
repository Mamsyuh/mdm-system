<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\KartuKeluarga; // <--- PASTIKAN INI ADA
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan semua data penduduk yang sudah divalidasi
        // Asumsi scope valid() sudah ada di model Penduduk
        $pendudukValid = Penduduk::where('status_validasi', 'Valid')->get();

        // Format waktu Indonesia pada dashboard admin
        $indonesian_date = Carbon::now()->locale('id')->translatedFormat('l, d F Y');

        // 1. Total Penduduk (Semua data yang divalidasi)
        $totalPenduduk = Penduduk::all()->count();

        // Data Valid (Sesuai permintaan)
        $dataValid = $pendudukValid->count();

        // 2. Jumlah Kepala Keluarga
        // FIX: Mengambil hitungan langsung dari tabel KartuKeluarga
        $totalKK = KartuKeluarga::count();

        // 3. Statistik Gender (Data untuk Chart)
        $dataGender = Penduduk::valid()
            ->select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->get();

        $genderLabels = ['Laki-laki', 'Perempuan'];
        $genderCounts = [
            $dataGender->where('jenis_kelamin', 'L')->pluck('total')->first() ?? 0,
            $dataGender->where('jenis_kelamin', 'P')->pluck('total')->first() ?? 0,
        ];

        // 4. Statistik Usia (Data untuk Chart)
        $usiaData = [
            $pendudukValid->filter(fn($p) => $p->umur < 5)->count(),
            $pendudukValid->filter(fn($p) => $p->umur >= 5 && $p->umur < 12)->count(),
            $pendudukValid->filter(fn($p) => $p->umur >= 12 && $p->umur < 17)->count(),
            $pendudukValid->filter(fn($p) => $p->umur >= 17 && $p->umur < 60)->count(),
            $pendudukValid->filter(fn($p) => $p->umur >= 60)->count(),
        ];
        $usiaLabels = ['Balita (<5)', 'Anak (5-11)', 'Remaja (12-16)', 'Dewasa (17-59)', 'Lansia (60+)'];


        // 5. Statistik RT/RW (Data untuk Chart)
        $dataRT = Penduduk::valid()
            ->select('rt', DB::raw('count(*) as total'))
            ->groupBy('rt')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        $rtLabels = $dataRT->pluck('rt')->map(fn($rt) => "RT $rt")->toArray();
        $rtData = $dataRT->pluck('total')->toArray();

        // Data Simulasi (dipertahankan agar view tidak error)
        $suratPending = 0;

        return view('admin.dashboard', compact(
            'totalPenduduk',
            'indonesian_date',
            'dataValid',
            'totalKK',
            'suratPending',

            // Data untuk chart
            'genderLabels',
            'genderCounts',
            'usiaLabels',
            'usiaData',
            'rtLabels',
            'rtData'
        ));
    }
}