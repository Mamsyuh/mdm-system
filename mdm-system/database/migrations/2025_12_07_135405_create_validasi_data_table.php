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
        Schema::create('validasi_data', function (Blueprint $table) {
            $table->id();

            // Kolom Foreign Key ke Data Penduduk yang divalidasi/direject
            $table->foreignId('penduduk_id')->constrained('penduduks')->onDelete('cascade');
            
            // Kolom Foreign Key ke User (Operator/Admin) yang melakukan validasi
            $table->foreignId('validator_id')->nullable()->constrained('users')->onDelete('set null');

            // Status Aksi: 'valid', 'rejected'
            $table->enum('status', ['valid', 'rejected']);

            // Catatan (penting jika statusnya rejected)
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_data');
    }
};