<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * * KODE INI DIKOSONGKAN KARENA SEMUA KOLOM TERKAIT VALIDASI
     * (status_validasi, validated_at, validated_by) 
     * KEMUNGKINAN SUDAH ADA DI TABEL PENDUDUKS BERDASARKAN ERROR SEBELUMNYA.
     */
    public function up(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            // HAPUS SEMUA KODE $table->...
            // Misalnya:
            // $table->enum('status_validasi', ['pending', 'valid', 'rejected'])->default('pending')->after('agama');
            // $table->dateTime('validated_at')->nullable()->after('validation_status');

            // --- Biarkan method ini KOSONG ---
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            // --- Biarkan method ini KOSONG ---
        });
    }
};