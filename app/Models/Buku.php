<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'judul_buku',
        'slug_judul_buku',
        'penulis_buku',
        'penerbit_buku',
        'tahunterbit_buku',
        'sinopsis_buku',
        'sampul_buku',
    ];

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_bukus', 'id_buku', 'id_kategori');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku');
    }
}