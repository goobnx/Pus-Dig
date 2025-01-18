<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriBukuRequest;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $judulHalaman = 'Kategori Buku';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => '', 'label' => 'Kategori Buku']
        ];

        $kategoriBuku = KategoriBuku::all();

        return view('kategori_buku.index', compact('judulHalaman', 'breadcrumbs', 'kategoriBuku'));
    }

    public function create()
    {
        $judulHalaman = 'Kategori Buku';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => route('kategori-buku.index'), 'label' => 'Kategori Buku'],
            ['url' => '', 'label' => 'Tambah']
        ];

        $buku = Buku::all();
        $kategori = Kategori::all();

        return view('kategori_buku.create', compact('judulHalaman', 'breadcrumbs', 'buku', 'kategori'));
    }

    public function store(StoreKategoriBukuRequest $request)
    {
        $buku = Buku::findOrFail($request->id_buku);

        $buku->kategori()->sync($request->id_kategori);

        return redirect()->route('kategori-buku.index')->with('success', 'Berhasil Menambahkan Kategori ke Buku');
    }

    public function edit(string $id_kategori_buku)
    {
        $judulHalaman = 'Kategori Buku';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => '', 'label' => 'Kategori Buku'],
            ['url' => '', 'label' => 'Ubah']
        ];

        $kategoriBuku = KategoriBuku::findOrFail($id_kategori_buku);

        return view('kategori_buku.edit', compact('judulHalaman', 'breadcrumbs', 'kategoriBuku'));
    }

    public function destroy(string $id_kategori_buku)
    {
        $kategoriBuku = KategoriBuku::findOrFail($id_kategori_buku);

        $kategoriBuku->delete();

        return redirect()->route('kategori-buku.index')->with('success', 'Berhasil Menghapus Kategori Buku');
    }
}
