<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendudukExport;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman pilihan laporan dengan filter
     */
    public function index()
    {
        try {
            // Ambil tahun dari 2020 sampai tahun sekarang
            $tahunSekarang = date('Y');
            $tahunList = range($tahunSekarang, 2020);
            
            // Ambil statistik data
            $totalPenduduk = Penduduk::count();
            $lakiLaki = Penduduk::where('jenis_kelamin', 'L')->count();
            $perempuan = Penduduk::where('jenis_kelamin', 'P')->count();
            
            return view('laporan.pilih', compact('tahunList', 'totalPenduduk', 'lakiLaki', 'perempuan'));
            
        } catch (\Exception $e) {
            Log::error('Error di laporan index: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuka halaman laporan: ' . $e->getMessage());
        }
    }

    /**
     * Export PDF dengan filter
     */
    public function exportPdf(Request $request)
    {
        try {
            // Set memory limit dan timeout
            ini_set('memory_limit', '512M');
            ini_set('max_execution_time', '300');
            
            // Query dengan filter
            $query = Penduduk::query();
            $filterInfo = 'Semua Data';
            
            // Filter berdasarkan tipe
            if ($request->filter_type === 'tahun' && $request->tahun) {
                // Filter berdasarkan created_at jika ada, jika tidak ada gunakan semua data tahun tersebut
                if (Schema::hasColumn('penduduks', 'created_at')) {
                    $query->whereYear('created_at', $request->tahun);
                }
                $filterInfo = 'Tahun ' . $request->tahun;
            } elseif ($request->filter_type === 'bulan' && $request->tahun && $request->bulan) {
                if (Schema::hasColumn('penduduks', 'created_at')) {
                    $query->whereYear('created_at', $request->tahun)
                          ->whereMonth('created_at', $request->bulan);
                }
                $bulanNama = $this->getNamaBulan($request->bulan);
                $filterInfo = $bulanNama . ' ' . $request->tahun;
            }
            
            // Ambil data
            $penduduk = $query->orderBy('nama')->get();
            
            // Cek apakah ada data
            if ($penduduk->isEmpty()) {
                return back()->with('warning', 'Tidak ada data penduduk untuk filter yang dipilih.');
            }
            
            // Load view untuk PDF
            $pdf = Pdf::loadView('laporan.pdf', compact('penduduk', 'filterInfo'))
                      ->setPaper('a4', 'landscape')
                      ->setOption('isHtml5ParserEnabled', true)
                      ->setOption('isRemoteEnabled', true);
            
            // Nama file dinamis
            $filename = 'laporan-penduduk-' . strtolower(str_replace(' ', '-', $filterInfo)) . '-' . date('Ymd') . '.pdf';
            
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            Log::error('Error export PDF: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()->with('error', 'Gagal export PDF: ' . $e->getMessage());
        }
    }

    /**
     * Preview PDF di browser
     */
    public function previewPdf(Request $request)
    {
        try {
            $query = Penduduk::query();
            $filterInfo = 'Semua Data';
            
            if ($request->filter_type === 'tahun' && $request->tahun) {
                if (Schema::hasColumn('penduduks', 'created_at')) {
                    $query->whereYear('created_at', $request->tahun);
                }
                $filterInfo = 'Tahun ' . $request->tahun;
            } elseif ($request->filter_type === 'bulan' && $request->tahun && $request->bulan) {
                if (Schema::hasColumn('penduduks', 'created_at')) {
                    $query->whereYear('created_at', $request->tahun)
                          ->whereMonth('created_at', $request->bulan);
                }
                $bulanNama = $this->getNamaBulan($request->bulan);
                $filterInfo = $bulanNama . ' ' . $request->tahun;
            }
            
            $penduduk = $query->orderBy('nama')->get();
            
            if ($penduduk->isEmpty()) {
                return back()->with('warning', 'Tidak ada data penduduk untuk di-preview.');
            }
            
            $pdf = Pdf::loadView('laporan.pdf', compact('penduduk', 'filterInfo'))
                      ->setPaper('a4', 'landscape');
            
            return $pdf->stream('preview-laporan-penduduk.pdf');
            
        } catch (\Exception $e) {
            Log::error('Error preview PDF: ' . $e->getMessage());
            return back()->with('error', 'Gagal preview PDF: ' . $e->getMessage());
        }
    }

    /**
     * Export Excel dengan filter
     */
    public function exportExcel(Request $request)
    {
        try {
            $query = Penduduk::query();
            $filterInfo = 'semua-data';
            
            if ($request->filter_type === 'tahun' && $request->tahun) {
                if (Schema::hasColumn('penduduks', 'created_at')) {
                    $query->whereYear('created_at', $request->tahun);
                }
                $filterInfo = 'tahun-' . $request->tahun;
            } elseif ($request->filter_type === 'bulan' && $request->tahun && $request->bulan) {
                if (Schema::hasColumn('penduduks', 'created_at')) {
                    $query->whereYear('created_at', $request->tahun)
                          ->whereMonth('created_at', $request->bulan);
                }
                $filterInfo = 'bulan-' . $request->bulan . '-tahun-' . $request->tahun;
            }
            
            $penduduk = $query->get();
            
            if ($penduduk->isEmpty()) {
                return back()->with('warning', 'Tidak ada data untuk diekspor.');
            }
            
            $filename = 'laporan-penduduk-' . $filterInfo . '-' . date('Ymd') . '.xlsx';
            
            return Excel::download(new PendudukExport($penduduk), $filename);
            
        } catch (\Exception $e) {
            Log::error('Error export Excel: ' . $e->getMessage());
            return back()->with('error', 'Gagal export Excel: ' . $e->getMessage());
        }
    }

    /**
     * Helper: Konversi nomor bulan ke nama bulan
     */
    private function getNamaBulan($bulan)
    {
        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        return $namaBulan[(int)$bulan] ?? '';
    }
}