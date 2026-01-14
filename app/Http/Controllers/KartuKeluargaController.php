<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class KartuKeluargaController extends Controller
{
    public function index()
    {
        // withCount akan membuat field otomatis 'anggota_count'
        $kk = KartuKeluarga::withCount('anggota')->paginate(20);
        return view('kk.index', compact('kk'));
    }

    public function create()
    {
        $kepalaKeluarga = Penduduk::where('kepala_keluarga', 'Iya')
            ->whereNull('kk_id')
            ->get();
        return view('kk.create', compact('kepalaKeluarga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required'
        ]);
        
        // Ambil data penduduk
        $penduduk = Penduduk::findOrFail($request->penduduk_id);

        // Buat KK baru
        $kk = KartuKeluarga::create([
            'no_kk' => $penduduk->no_kk,
            'kepala_keluarga' => $penduduk->nama,
            'alamat' => $penduduk->alamat,
            'rt' => $penduduk->rt,
            'rw' => $penduduk->rw,
        ]);

        // Update penduduk agar terhubung ke KK (supaya hilang dari dropdown)
        $penduduk->update([
            'kk_id' => $kk->id
        ]);

        return redirect()->route('kk.index')->with('success', 'KK berhasil dibuat.');
    }

    public function show(KartuKeluarga $kk)
    {
        // Cari anggota yang memiliki no_kk yang sama dengan KK ini
        $anggota = Penduduk::where('no_kk', $kk->no_kk)->get();
        return view('kk.show', compact('kk', 'anggota'));
    }

    public function edit(KartuKeluarga $kk)
    {
        $kepalaKeluarga = Penduduk::where(function($q) use ($kk) {
            $q->whereNull('kk_id')  
            ->orWhere('kk_id', $kk->id); // kepala keluarga sekarang tetap muncul
        })
        ->where('kepala_keluarga', 'Iya')
        ->get();
        return view('kk.edit', compact('kepala_keluarga'));
    }

    public function update(Request $request, KartuKeluarga $kk)
    {
        $request->validate([
            'penduduk_id' => 'required'
        ]);

        $pendudukBaru = Penduduk::findOrFail($request->penduduk_id);

        // ➤ 1. Jika kepala keluarga diganti → reset penduduk lama
        if ($kk->penduduk_id !== $pendudukBaru->id) {

            // hapus relasi lama
            Penduduk::where('id', $kk->penduduk_id)->update([
                'kk_id' => null
            ]);

            // set relasi penduduk baru
            $pendudukBaru->update([
                'kk_id' => $kk->id
            ]);
        }

        // ➤ 2. Update data KK
        $kk->update([
            'no_kk' => $request->no_kk,
            'kepala_keluarga' => $pendudukBaru->nama,
            'alamat' => $pendudukBaru->alamat,
            'rt' => $pendudukBaru->rt,
            'rw' => $pendudukBaru->rw
        ]);
        
        return redirect()->route('kk.index')->with('success', 'KK berhasil diperbarui.');
    }

    public function destroy(KartuKeluarga $kk)
    {
        $kk->delete();

        if($kk->anggota()->count() > 0) {
            // Lepaskan relasi kk_id dari anggota
            DB::table('penduduks')
                ->where('no_kk', $kk->no_kk)
                ->update(['kk_id' => null]);
        }

        return redirect()->route('kk.index')->with('success', 'KK berhasil dihapus.');
    }

    public function exportPdf()
    {
        // Mengambil data lengkap penduduk
        $penduduk = \App\Models\Penduduk::all();

        // Pastikan nama view sesuai dengan letak file blade Anda
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.pdf', compact('penduduk'));

        // Setting kertas ke Landscape
        return $pdf->setPaper('a4', 'landscape')->download('Laporan-Data-Penduduk.pdf');
    }
}