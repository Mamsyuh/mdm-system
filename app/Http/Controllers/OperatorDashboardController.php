<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OperatorDashboardController extends Controller
{
    /**
     * Menampilkan dashboard khusus untuk peran Operator.
     */
    public function index()
    {
        // Statistik yang relevan untuk Operator: Fokus pada Validasi

        // Format waktu Indonesia pada dashboard admin
        $indonesian_date = Carbon::now()->locale('id')->translatedFormat('l, d F Y');

        // 1. Total Data Pending (Tugas Utama Operator)
        $totalPending = Penduduk::where('status_validasi', 'pending')->count();

        // 2. Total Data Valid
        $totalValid = Penduduk::where('status_validasi', 'valid')->count();

        // 3. Total Data Reject
        $totalRejected = Penduduk::where('status_validasi', 'rejected')->count();

        // 4. Data Pending Terbaru (untuk daftar cepat)
        $recentPending = Penduduk::where('status_validasi', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $pendudukValid = Penduduk::where('status_validasi', 'Valid')->get();

        $dataGender = Penduduk::valid()
            ->select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->get();

        $dataPemilih = Penduduk::selectRaw('desa, COUNT(*) as total')
            ->whereDate('tanggal_lahir', '<=', now()->subYears(17))
            ->groupBy('desa')
            ->get();

        $pemilihLabels = $dataPemilih->pluck('desa');
        $pemilihValues = $dataPemilih->pluck('total');

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

        return view('operator.dashboard', [
            'totalPending' => $totalPending,
            'totalValid' => $totalValid,
            'totalRejected' => $totalRejected,
            'recentPending' => $recentPending,
            'indonesian_date' => $indonesian_date,
            // Data untuk chart
            'genderLabels' => $genderLabels,
            'genderCounts' => $genderCounts,
            'usiaLabels' => $usiaLabels,
            'usiaData' => $usiaData,
            'pemilihLabels' => $pemilihLabels,
            'pemilihValues' => $pemilihValues
        ]);
    }
}
