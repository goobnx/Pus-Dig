<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_bukus', function (Blueprint $table) {
            $table->id('id_kategori_buku');
            $table->unsignedBigInteger('id_buku');
            $table->foreign('id_buku')->references('id_buku')->on('bukus')->onDelete('cascade');
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_bukus');
    }
};