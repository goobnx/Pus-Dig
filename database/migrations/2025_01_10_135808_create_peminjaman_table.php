<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_buku');
            $table->foreign('id_buku')->references('id_buku')->on('bukus')->onDelete('cascade');
            $table->date('tgl_peminjaman');
            $table->date('tgl_pengembalian')->nullable();
            $table->enum('status_peminjaman', ['belum_pinjam', 'verifikasi_peminjaman', 'sedang_pinjam', 'verifikasi_pengembalian', 'selesai_pinjam'])->default('belum_pinjam');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
