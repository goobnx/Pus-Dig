<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $judulHalaman = 'Kategori';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => '', 'label' => 'Kategori']
        ];

        $kategori = Kategori::all();

        return view('kategori.index', compact('judulHalaman', 'breadcrumbs', 'kategori'));
    }

    public function create()
    {
        $judulHalaman = 'Kategori';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => route('kategori.index'), 'label' => 'Kategori'],
            ['url' => '', 'label' => 'Tambah']
        ];

        return view('kategori.create', compact('judulHalaman', 'breadcrumbs'));
    }

    public function store(StoreKategoriRequest $request)
    {
        Kategori::create([
            'nama_kategori'       => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Berhasil Menambahkan Kategori');
    }

    public function edit(string $id_kategori)
    {
        $judulHalaman = 'Kategori';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => route('kategori.index'), 'label' => 'Kategori'],
            ['url' => '', 'label' => 'Ubah']
        ];

        $kategori = Kategori::findOrFail($id_kategori);

        return view('kategori.edit', compact('judulHalaman', 'breadcrumbs', 'kategori'));
    }

    public function update(UpdateKategoriRequest $request, string $id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);

        $kategori->fill([
            'nama_kategori' => $request->nama_kategori,
        ]);

        if ($kategori->isDirty()) {
            $kategori->save();
            return redirect()->route('kategori.index')->with('success', 'Berhasil Memperbarui Kategori');
        } else {
            return redirect()->route('kategori.index')->with('info', 'Tidak Ada Perubahan Data');
        }
    }

    public function destroy(string $id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);

        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Berhasil Menghapus Kategori');
    }
}
