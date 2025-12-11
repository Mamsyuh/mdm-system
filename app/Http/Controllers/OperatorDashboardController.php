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

        return view('operator.dashboard', [
            'totalPending' => $totalPending,
            'totalValid' => $totalValid,
            'totalRejected' => $totalRejected,
            'recentPending' => $recentPending,
        ]);
    }
}