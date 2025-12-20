<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();

            // Data dari CSV
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('no_kk')->nullable();
            $table->string('kepala_keluarga')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('hubungan_keluarga');
            $table->string('agama')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nama_ayah')->nullable();

            // ✅ TAMBAHKAN KOLOM BARU INI
            $table->string('status_validasi')->nullable();
            $table->foreignId('validated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('validated_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};