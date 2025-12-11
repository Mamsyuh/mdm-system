<?php

use App\Http\Controllers\Controller; // Pastikan Controller umum ini di-import jika dipakai untuk redirect
use App\Http\Controllers\OperatorDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\SuratController; 
use App\Http\Controllers\LaporanController; // <--- IMPOR BARU: LaporanController

// --------------------------------------------------
// PUBLIC HOMEPAGE
// --------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

// --------------------------------------------------
// DASHBOARD REDIRECT BASED ON ROLE
// --------------------------------------------------
Route::get('/dashboard', function () {

    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login');
    }

    // role menggunakan relasi → role->name
    if ($user->role && $user->role->name === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role && $user->role->name === 'operator') {
        return redirect()->route('operator.dashboard');
    }

    // jika user tidak punya role
    return abort(403, 'Role tidak dikenali');

})->middleware(['auth', 'verified'])->name('dashboard');


// --------------------------------------------------
// ADMIN AREA
// --------------------------------------------------
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // --------------------------
    // ADMIN ONLY: PERSETUJUAN SURAT
    // --------------------------
    Route::post('/surat/{surat}/approve', [SuratController::class, 'approve'])->name('surat.approve');
    Route::post('/surat/{surat}/reject', [SuratController::class, 'reject'])->name('surat.reject');
    Route::delete('/surat/{surat}', [SuratController::class, 'destroy'])->name('surat.destroy');
    
});

// --------------------------------------------------
// OPERATOR AREA
// --------------------------------------------------
Route::middleware(['auth', 'role:operator'])->group(function () {

    Route::get('/operator/dashboard', [OperatorDashboardController::class, 'index'])
        ->name('operator.dashboard');

});


// --------------------------------------------------
// OPERATOR + ADMIN AREA (PENDUDUK & KK, VALIDASI, SURAT)
// --------------------------------------------------
Route::middleware(['auth', 'role:admin,operator'])->group(function () {

    // =========================================================
    // ⚠️ CRITICAL FIX: ROUTE KUSTOM HARUS DI ATAS ROUTE RESOURCE
    // =========================================================

    // --------------------------
    // MODUL LAYANAN SURAT
    // --------------------------
    Route::resource('surat', SuratController::class)->except(['destroy']); 
    
    // ROUTE BARU: Cetak PDF Surat Resmi
    Route::get('/surat/{surat}/print', [SuratController::class, 'printPdf'])
        ->name('surat.print');


    // --------------------------
    // MODUL VALIDASI DATA
    // --------------------------
    Route::get('/validasi', [ValidasiController::class, 'index'])
        ->name('validasi.index');

    Route::get('/validasi/{penduduk}', [ValidasiController::class, 'show'])
        ->name('validasi.show');

    Route::post('/validasi/{penduduk}/approve', [ValidasiController::class, 'approve'])
        ->name('validasi.approve');

    Route::post('/validasi/{penduduk}/reject', [ValidasiController::class, 'reject'])
        ->name('validasi.reject');


    // --------------------------
    // PENDUDUK KUSTOM ROUTES
    // --------------------------
    
    // ROUTE BARU: MENU PILIHAN CETAK LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index'); 

    Route::post('/penduduk/import-csv', [PendudukController::class, 'importCsv'])
        ->name('penduduk.importCsv');

    Route::get('/penduduk/export-excel', [PendudukController::class, 'exportExcel'])
        ->name('penduduk.exportExcel');

    Route::get('/penduduk/export-pdf', [PendudukController::class, 'exportPdf'])
        ->name('penduduk.exportPdf');

    Route::get('/penduduk/statistik', [PendudukController::class, 'statistik'])
        ->name('penduduk.statistik');

    // --------------------------
    // CRUD PENDUDUK (RESOURCE DITARUH DI BAWAH KUSTOM)
    // --------------------------
    Route::resource('penduduk', PendudukController::class);


    // --------------------------
    // KK KUSTOM ROUTES
    // --------------------------
    Route::get('/kk/{kk}/export-pdf', [KartuKeluargaController::class, 'exportPdf'])
        ->name('kk.exportPdf');

    // --------------------------
    // CRUD KK (RESOURCE DITARUH DI BAWAH KUSTOM)
    // --------------------------
    Route::resource('kk', KartuKeluargaController::class);

});


// --------------------------------------------------
// USER PROFILE
// --------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --------------------------------------------------
require __DIR__.'/auth.php';