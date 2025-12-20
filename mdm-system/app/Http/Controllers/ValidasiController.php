<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\ValidasiData; // Model log validasi yang baru kamu buat
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ValidasiController extends Controller
{
    /**
     * Menampilkan daftar data penduduk yang statusnya 'pending'
     * (Khusus untuk Operator/Admin).
     */
    public function index()
    {
        $penduduksPending = Penduduk::where('status_validasi', 'Perlu Verifikasi')
                                    ->orderBy('id', 'asc')
                                    ->paginate(15);
        
        return view('validasi.index', compact('penduduksPending'));
    }

    /**
     * Menampilkan detail data penduduk yang akan divalidasi.
     * (Opsional: Kamu bisa menggunakan resource PendudukController::show jika sudah ada).
     */
    public function show(Penduduk $penduduk)
    {
        // Pastikan hanya data pending yang bisa dilihat
        if ($penduduk->status_validasi !== 'Perlu Verifikasi') {
            return redirect()->route('validasi.index')->with('error', 'Data ini sudah divalidasi.');
        }

        return view('validasi.show', compact('penduduk'));
    }

    /**
     * Aksi: Menyetujui (Approve) Data Penduduk.
     */
    public function approve(Penduduk $penduduk)
    {
        // 1. Update status di tabel penduduks
        $penduduk->update(attributes: [
            'status_validasi' => 'Valid',
            'validated_by' => Auth::id(), // ID User yang login (validator)
            'validated_at' => Carbon::now(),
        ]);

        // 2. Catat log di tabel validasi_data
        ValidasiData::create([
            'penduduk_id' => $penduduk->id,
            'validator_id' => Auth::id(),
            'status' => 'valid',
            'catatan' => 'Data disetujui dan diverifikasi oleh ' . Auth::user()->name,
        ]);

        return redirect()->route('validasi.index')
                         ->with('success', 'Data Penduduk ' . $penduduk->nama . ' berhasil disetujui!');
    }

    /**
     * Aksi: Menolak (Reject) Data Penduduk.
     */
    public function reject(Request $request, Penduduk $penduduk)
    {
        $request->validate(['catatan' => 'required|string|min:10']);

        // 1. Update status di tabel penduduks
        $penduduk->update(attributes: [
            'status_validasi' => 'Tidak Valid',
            'validated_by' => Auth::id(), // ID User yang login (validator)
            'validated_at' => Carbon::now(),
        ]);

        // 2. Catat log di tabel validasi_data
        ValidasiData::create([
            'penduduk_id' => $penduduk->id,
            'validator_id' => Auth::id(),
            'status' => 'rejected',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('validasi.index')
                         ->with('error', 'Data Penduduk ' . $penduduk->nama . ' berhasil ditolak dengan catatan.');
    }
}