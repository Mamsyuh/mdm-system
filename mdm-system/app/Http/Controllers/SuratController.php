<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratPengantar;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan ini terimport jika kamu menggunakan DomPDF

class SuratController extends Controller
{
    /**
     * Menampilkan daftar semua pengajuan surat
     */
    public function index()
    {
        $surats = SuratPengantar::with('penduduk', 'approver')
                                ->orderBy('status', 'asc') // Pending tampil duluan
                                ->orderBy('created_at', 'desc')
                                ->paginate(15);
        
        return view('surat.index', compact('surats'));
    }

    /**
     * Menampilkan form untuk membuat pengajuan baru
     */
    public function create()
    {
        // Hanya tampilkan penduduk yang statusnya sudah 'valid' untuk pengajuan surat
        $penduduks = Penduduk::where('status_validasi', 'valid')->orderBy('nama')->get(); 
        
        return view('surat.create', compact('penduduks'));
    }

    /**
     * Menyimpan pengajuan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_surat' => 'required|string|max:100',
            'keperluan' => 'required|string|max:255',
        ]);
        
        // Data Penduduk yang dipilih sudah harus valid
        $penduduk = Penduduk::findOrFail($request->penduduk_id);
        if ($penduduk->status_validasi !== 'valid') {
             return redirect()->back()->withInput()->with('error', 'Data penduduk yang dipilih belum divalidasi oleh Operator/Admin.');
        }

        SuratPengantar::create($request->all());

        return redirect()->route('surat.index')->with('success', 'Pengajuan surat berhasil dibuat.');
    }

    /**
     * Menampilkan detail pengajuan surat
     */
    public function show(SuratPengantar $surat)
    {
        $surat->load('penduduk', 'approver');
        return view('surat.show', compact('surat'));
    }

    /**
     * Menampilkan form edit pengajuan (hanya jika pending)
     */
    public function edit(SuratPengantar $surat)
    {
        if ($surat->status !== 'pending') {
            return redirect()->route('surat.index')->with('error', 'Surat yang sudah diproses tidak bisa diedit.');
        }
        $penduduks = Penduduk::where('status_validasi', 'valid')->orderBy('nama')->get();
        return view('surat.edit', compact('surat', 'penduduks'));
    }

    /**
     * Memperbarui pengajuan surat
     */
    public function update(Request $request, SuratPengantar $surat)
    {
        if ($surat->status !== 'pending') {
            return redirect()->route('surat.index')->with('error', 'Surat yang sudah diproses tidak bisa diupdate.');
        }
        
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_surat' => 'required|string|max:100',
            'keperluan' => 'required|string|max:255',
        ]);
        
        $surat->update($request->all());
        
        return redirect()->route('surat.index')->with('success', 'Pengajuan surat berhasil diperbarui.');
    }

    /**
     * Aksi: Menyetujui dan Menerbitkan Nomor Surat (Admin Only)
     */
    public function approve(SuratPengantar $surat)
    {
        if ($surat->status !== 'pending') {
            return redirect()->back()->with('error', 'Surat sudah diproses.');
        }
        
        // 1. Generate Nomor Surat Otomatis
        // Misal: 474/001/DB/XII/2025 (KodeSurat/NoUrut/Desa/BulanRomawi/Tahun)
        $bulanRomawi = Carbon::now()->isoFormat('MMMM');
        $tahun = Carbon::now()->year;

        // Ambil nomor urut terakhir
        $latestSurat = SuratPengantar::whereNotNull('nomor_surat')->orderBy('id', 'desc')->first();
        // Asumsi nomor urut 3 digit (e.g., 001). Ambil 3 digit di posisi ke-4 (indeks 4) dari string nomor_surat
        $nomorUrut = $latestSurat ? (int)substr($latestSurat->nomor_surat, 4, 3) + 1 : 1; 
        $nomorUrutFormatted = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

        // Format Bulan Romawi
        $bulanRomawi = Carbon::now()->format('MM'); // Gunakan format 2 digit (01-12) atau implementasikan konversi Romawi jika diperlukan
        
        // Sesuaikan format nomor surat agar lebih mudah dihitung
        // Contoh format baru: 474/001/SKD/XII/2025 (KodeSurat/NoUrut/JenisSurat/BulanRomawi/Tahun)
        $jenisSuratKode = match($surat->jenis_surat) {
            'Surat Keterangan Domisili' => 'SKD',
            'Surat Pengantar Nikah' => 'SPN',
            'Surat Keterangan Usaha' => 'SKU',
            'Surat Keterangan Tidak Mampu' => 'SKTM',
            default => 'LNN',
        };

        $nomorSurat = "474/{$nomorUrutFormatted}/{$jenisSuratKode}/{$bulanRomawi}/{$tahun}";
        
        // 2. Update Status
        $surat->update([
            'status' => 'approved',
            'nomor_surat' => $nomorSurat,
            'approved_by' => Auth::id(),
            'catatan' => null, // Bersihkan catatan jika ada
        ]);
        
        return redirect()->route('surat.index')->with('success', 'Surat berhasil disetujui dan diterbitkan: ' . $nomorSurat);
    }

    /**
     * Aksi: Menolak Pengajuan Surat (Admin Only)
     */
    public function reject(Request $request, SuratPengantar $surat)
    {
        if ($surat->status !== 'pending') {
            return redirect()->back()->with('error', 'Surat sudah diproses.');
        }
        
        $request->validate(['catatan' => 'required|string|min:10']);

        $surat->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'catatan' => $request->catatan,
            'nomor_surat' => null, // Pastikan nomor surat dikosongkan/null
        ]);
        
        return redirect()->route('surat.index')->with('error', 'Pengajuan surat ditolak. Alasan: ' . $request->catatan);
    }
    
    /**
     * Menghapus Surat (Admin Only)
     */
    public function destroy(SuratPengantar $surat)
    {
        $surat->delete();
        return redirect()->route('surat.index')->with('success', 'Pengajuan surat berhasil dihapus permanen.');
    }

    /**
     * Mencetak Surat Resmi yang Sudah Disetujui
     */
    public function printPdf(SuratPengantar $surat)
    {
        if ($surat->status !== 'approved') {
            return redirect()->back()->with('error', 'Surat belum disetujui, tidak bisa dicetak.');
        }

        // Pastikan relasi penduduk dan approver dimuat
        $surat->load('penduduk', 'approver');
        
        // Menggunakan view umum 'surat.pdf'
        $pdf = Pdf::loadView('surat.pdf', compact('surat'))->setPaper('a4', 'portrait');

        return $pdf->stream("RESMI_{$surat->nomor_surat}.pdf");
    }
}