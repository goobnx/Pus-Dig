<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasans';

    protected $primaryKey = 'id_ulasan';

    protected $fillable = [
        'id_user',
        'id_buku',
        'isi_ulasan',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }
}
