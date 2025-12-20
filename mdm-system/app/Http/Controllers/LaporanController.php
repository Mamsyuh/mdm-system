<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;

class LaporanController extends Controller
{
    /**
     * Menampilkan menu pilihan jenis laporan (PDF atau Excel).
     */
    public function index()
    {
        // View ini hanya menampilkan menu pilihan
        return view('laporan.index');
    }
}