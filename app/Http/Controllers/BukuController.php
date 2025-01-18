<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBukuRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBukuRequest;

class BukuController extends Controller
{
    public function index()
    {
        $judulHalaman = 'Buku';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => '', 'label' => 'Buku']
        ];

        $buku = Buku::all();

        return view('buku.index', compact('judulHalaman', 'breadcrumbs', 'buku'));
    }

    public function create()
    {
        $judulHalaman = 'Buku';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => route('buku.index'), 'label' => 'Buku'],
            ['url' => '', 'label' => 'Tambah']
        ];

        return view('buku.create', compact('judulHalaman', 'breadcrumbs'));
    }

    public function store(StoreBukuRequest $request)
    {
        $slug = Str::slug($request->judul_buku, '-');

        $originalSlug = $slug;
        $counter = 1;
        while (Buku::where('slug_judul_buku', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $path = $request->file('sampul_buku')->store('buku/sampul_buku', 'public');

        Buku::create([
            'judul_buku'       => $request->judul_buku,
            'slug_judul_buku'  => $slug,
            'penulis_buku'     => $request->penulis_buku,
            'penerbit_buku'    => $request->penerbit_buku,
            'tahunterbit_buku' => $request->tahunterbit_buku,
            'sinopsis_buku'    => $request->sinopsis_buku,
            'sampul_buku'      => $path,
        ]);

        return redirect()->route('buku.index')->with('success', 'Berhasil Menambahkan Buku');
    }

    public function edit(string $id_buku)
    {
        $judulHalaman = 'Buku';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => route('buku.index'), 'label' => 'Buku'],
            ['url' => '', 'label' => 'Ubah']
        ];

        $buku = Buku::findOrFail($id_buku);

        return view('buku.edit', compact('judulHalaman', 'breadcrumbs', 'buku'));
    }

    public function update(UpdateBukuRequest $request, string $id_buku)
    {
        $buku = Buku::findOrFail($id_buku);

        $buku->fill([
            'judul_buku'       => $request->judul_buku,
            'penulis_buku'     => $request->penulis_buku,
            'penerbit_buku'    => $request->penerbit_buku,
            'tahunterbit_buku' => $request->tahunterbit_buku,
            'sinopsis_buku'    => $request->sinopsis_buku,
        ]);

        if ($buku->isDirty('judul_buku')) {
            $slug = Str::slug($request->judul_buku, '-');
    
            $originalSlug = $slug;
            $counter = 1;
            while (Buku::where('slug_judul_buku', $slug)->where('id_buku', '!=', $buku->id_buku)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
    
            $buku->slug_judul_buku = $slug;
        }

        if ($request->hasFile('sampul_buku')) {
            if ($buku->sampul_buku && Storage::disk('public')->exists($buku->sampul_buku)) {
                Storage::disk('public')->delete($buku->sampul_buku);
            }

            $path = $request->file('sampul_buku')->store('buku/sampul_buku', 'public');
            $buku->sampul_buku = $path;
        }

        if ($buku->isDirty()) {
            $buku->save();
            return redirect()->route('buku.index')->with('success', 'Berhasil Memperbarui Data Buku');
        } else {
            return redirect()->route('buku.index')->with('info', 'Tidak Ada Perubahan Data');
        }
    }

    public function destroy(string $id_buku)
    {
        $buku = Buku::findOrFail($id_buku);

        if ($buku->sampul_buku) {
            Storage::disk('public')->delete($buku->sampul_buku);
        }

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Berhasil Menghapus Buku');
    }
}