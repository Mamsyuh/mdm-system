<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    /**
     * Menampilkan menu pilihan jenis laporan (PDF atau Excel).
     */
    public function index()
    {
        try {
            // View ini hanya menampilkan menu pilihan
            return view('laporan.pilih');
        } catch (\Exception $e) {
            Log::error('Error di laporan index: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuka halaman laporan: ' . $e->getMessage());
        }
    }

    /**
     * Export PDF - Download langsung
     */
    public function exportPdf()
    {
        try {
            // Ambil semua data penduduk
            $penduduk = Penduduk::all();
            
            // Cek apakah ada data
            if ($penduduk->isEmpty()) {
                return back()->with('warning', 'Tidak ada data penduduk untuk diekspor.');
            }
            
            // Load view dengan data penduduk
            $pdf = Pdf::loadView('laporan.index', compact('penduduk'))
                      ->setPaper('a4', 'landscape');
            
            // Download dengan nama file dinamis
            $filename = 'laporan-penduduk-' . date('Y-m-d-His') . '.pdf';
            
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Error export PDF: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()->with('error', 'Gagal export PDF: ' . $e->getMessage());
        }
    }

    /**
     * Preview PDF di browser (opsional)
     */
    public function previewPdf()
    {
        try {
            // Ambil semua data penduduk
            $penduduk = Penduduk::all();
            
            // Cek apakah ada data
            if ($penduduk->isEmpty()) {
                return back()->with('warning', 'Tidak ada data penduduk untuk di-preview.');
            }
            
            // Load view dengan data penduduk
            $pdf = Pdf::loadView('laporan.index', compact('penduduk'))
                      ->setPaper('a4', 'landscape');
            
            // Stream untuk preview di browser
            return $pdf->stream('preview-laporan-penduduk.pdf');
            
        } catch (\Exception $e) {
            Log::error('Error preview PDF: ' . $e->getMessage());
            return back()->with('error', 'Gagal preview PDF: ' . $e->getMessage());
        }
    }
}