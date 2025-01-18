<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
    ];

    public function buku()
    {
        return $this->belongsToMany(Buku::class, 'kategori_bukus', 'id_kategori', 'id_buku');
    }
}