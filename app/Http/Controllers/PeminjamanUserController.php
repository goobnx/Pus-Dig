<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Ulasan;
use App\Models\Koleksi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanUserController extends Controller
{
    public function indexBook()
    {
        $buku = Buku::all();
        
        foreach ($buku as $book) {
            // Mengambil rata-rata rating untuk buku ini
            $book->rataRataRating = Ulasan::where('id_buku', $book->id_buku)->avg('rating');
            
            // Mengambil jumlah ulasan yang memiliki isi (tidak kosong)
            $book->jumlahUlasan = Ulasan::where('id_buku', $book->id_buku)
            ->whereNotNull('isi_ulasan') // Memastikan isi ulasan tidak null
            ->where('isi_ulasan', '!=', '') // Memastikan isi ulasan tidak kosong
            ->count(); // Jumlah ulasan dengan isi
        }
        
        return view('user.index', compact('buku'));
    }
    
    public function showBook($slug_judul_buku)
    {
        $buku = Buku::with('kategori')->where('slug_judul_buku', $slug_judul_buku)->first();

        if (!$buku) {
            abort(404, 'Buku tidak ditemukan');
        }

        $user = auth()->user();

        $statusPeminjaman = 'belum_pinjam';

        if ($user) {
            $statusPeminjaman = Peminjaman::where('id_user', $user->id_user)
                ->where('id_buku', $buku->id_buku)
                ->latest()
                ->value('status_peminjaman') ?? 'belum_pinjam';
        }

        $rataRataRating = Ulasan::where('id_buku', $buku->id_buku)->avg('rating');

        $jumlahRating = Ulasan::where('id_buku', $buku->id_buku)->count('rating');

        $ulasan = null;

        if (Auth::check()) {
            $ulasan = Ulasan::where('id_user', Auth::id())
                            ->where('id_buku', $buku->id_buku)
                            ->first();
        }

        $jumlahUlasan = Ulasan::where('id_buku', $buku->id_buku)
            ->whereNotNull('isi_ulasan')
            ->where('isi_ulasan', '!=', '')
            ->count();

        $semuaUlasan = Ulasan::where('id_buku', $buku->id_buku)->latest()->get();

        $hitungRating = Ulasan::where('id_buku', $buku->id_buku)
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        $jumlahMasingRating = array_sum($hitungRating);

        $ratingPersentase = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingPersentase[$i] = isset($hitungRating[$i])
                ? ($hitungRating[$i] / $jumlahRating) * 100
                : 0;
        }

        $adaDiKoleksi = false;

        if ($user) {
            $adaDiKoleksi = Koleksi::where('id_user', $user->id_user)
                ->where('id_buku', $buku->id_buku)
                ->exists();
        }

        return view('user.show', compact('buku', 'statusPeminjaman', 'rataRataRating', 'jumlahRating', 'ulasan', 'jumlahUlasan', 'semuaUlasan', 'ratingPersentase', 'hitungRating', 'adaDiKoleksi'));
    }

    public function processPeminjaman($slug_judul_buku)
    {
        $user = auth()->user();

        $buku = Buku::where('slug_judul_buku', $slug_judul_buku)->first();

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        $peminjaman = new Peminjaman();
        $peminjaman->id_user = $user->id_user;
        $peminjaman->id_buku = $buku->id_buku;
        $peminjaman->tgl_peminjaman = now();
        $peminjaman->status_peminjaman = 'verifikasi_peminjaman';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Buku berhasil dipinjam dan menunggu verifikasi.');
    }

    public function processPengembalian($slug_judul_buku)
    {
        $user = auth()->user();

        $buku = Buku::where('slug_judul_buku', $slug_judul_buku)->first();

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        $peminjaman = Peminjaman::where('id_user', $user->id_user)
            ->where('id_buku', $buku->id_buku)
            ->where('status_peminjaman', 'sedang_pinjam')
            ->first();

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Tidak ada peminjaman aktif untuk buku ini.');
        }

        $peminjaman->status_peminjaman = 'verifikasi_pengembalian';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan dan menunggu verifikasi.');
    }

    public function indexPeminjaman()
    {
        $user = auth()->user();

        $peminjaman = Peminjaman::where('id_user', $user->id_user)
            ->whereIn('status_peminjaman', ['sedang_pinjam', 'verifikasi_peminjaman', 'verifikasi_pengembalian'])
            ->get();

        return view('user.peminjaman', compact('peminjaman'));
    }
}