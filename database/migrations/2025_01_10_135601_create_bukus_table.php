<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('judul_buku');
            $table->string('slug_judul_buku');
            $table->string('penulis_buku');
            $table->string('penerbit_buku');
            $table->string('tahunterbit_buku');
            $table->text('sinopsis_buku');
            $table->string('sampul_buku');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
