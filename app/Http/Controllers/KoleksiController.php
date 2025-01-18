<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoleksiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $koleksi = Koleksi::where('id_user', $user->id_user)
            ->with('buku')
            ->get();

        return view('user.koleksi', compact('koleksi'));
    }

    public function store($slug_judul_buku)
    {
        $user = auth()->user();

        $buku = Buku::where('slug_judul_buku', $slug_judul_buku)->first();

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        $koleksi = new Koleksi();
        $koleksi->id_user = $user->id_user;
        $koleksi->id_buku = $buku->id_buku;
        $koleksi->save();

        return redirect()->back()->with('success', 'Koleksi berhasil ditambahkan.');
    }

    public function destroy(string $id_koleksi)
    {
        $koleksi = Koleksi::findOrFail($id_koleksi);

        $koleksi->delete();

        return redirect()->route('index.koleksi')->with('success', 'Berhasil Menghapus Kategori');
    }
}
