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
        $anggota = Penduduk::where('kk_id',$kk->id)->get();
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
        Penduduk::where('kk_id',$kk->id)->update(['kk_id'=>null]);
        $kk->delete();
        return redirect()->route('kk.index')->with('success','KK berhasil dihapus.');
    }

    public function exportPdf($id)
    {
        $kk = KartuKeluarga::with('anggota')->findOrFail($id);
        $pdf = Pdf::loadView('kk.export_pdf', compact('kk'))->setPaper('a4','portrait');
        return $pdf->download("KK-{$kk->no_kk}.pdf");
    }

    public function statistik()
    {
        $per_rt = KartuKeluarga::select('rt', DB::raw('count(*) as total'))->groupBy('rt')->get();
        $per_rw = KartuKeluarga::select('rw', DB::raw('count(*) as total'))->groupBy('rw')->get();
        return view('kk.statistik', compact('per_rt','per_rw'));
    }
}
