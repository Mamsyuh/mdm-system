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
        return view('kk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|digits:16|unique:kartu_keluargas,no_kk',
            'kepala_keluarga' => 'required',
        ]);

        KartuKeluarga::create($request->all());
        return redirect()->route('kk.index')->with('success','KK berhasil dibuat.');
    }

    public function show(KartuKeluarga $kk)
    {
        // Cari anggota yang memiliki no_kk yang sama dengan KK ini
        $anggota = Penduduk::where('no_kk', $kk->no_kk)->get();
        return view('kk.show', compact('kk','anggota'));
    }

    public function edit(KartuKeluarga $kk)
    {
        return view('kk.edit', compact('kk'));
    }

    public function update(Request $request, KartuKeluarga $kk)
    {
        $request->validate([
            'no_kk' => 'required|digits:16|unique:kartu_keluargas,no_kk,'.$kk->id,
            'kepala_keluarga' => 'required',
        ]);

        $kk->update($request->all());
        return redirect()->route('kk.index')->with('success','KK berhasil diperbarui.');
    }

    public function destroy(KartuKeluarga $kk)
    {
        $kk->delete();
        return redirect()->route('kk.index')->with('success','KK berhasil dihapus.');
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