<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'id_user',
        'id_buku',
        'tgl_peminjaman',
        'tgl_pengembalian',
        'status_peminjaman',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
