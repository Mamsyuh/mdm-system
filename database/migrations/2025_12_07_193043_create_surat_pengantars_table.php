<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_pengantars', function (Blueprint $table) {
            $table->id();
            
            // Siapa yang mengajukan surat (biasanya dari data Penduduk)
            $table->foreignId('penduduk_id')->constrained('penduduks')->onDelete('cascade'); 

            // Jenis Surat: Keterangan Domisili, Pengantar Nikah, dll.
            $table->string('jenis_surat'); 
            
            // Keperluan Surat
            $table->string('keperluan');
            
            // Nomor Surat (akan diisi saat disetujui Admin)
            $table->string('nomor_surat')->nullable()->unique();
            
            // Status Pengajuan: pending (operator), approved (admin), rejected (admin)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            // Kolom Audit (Siapa yang menyetujui)
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('catatan')->nullable(); // Alasan penolakan
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengantars');
    }
};