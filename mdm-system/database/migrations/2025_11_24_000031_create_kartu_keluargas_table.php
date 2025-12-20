<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartu_keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk', 16)->unique();
            $table->string('kepala_keluarga'); 
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->timestamps();
        });

        Schema::table('penduduks', function (Blueprint $table) {
            $table->unsignedBigInteger('kk_id')->nullable()->after('id');

            $table->foreign('kk_id')
                ->references('id')
                ->on('kartu_keluargas')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropForeign(['kk_id']);
            $table->dropColumn('kk_id');
        });

        Schema::dropIfExists('kartu_keluargas');
    }
};
