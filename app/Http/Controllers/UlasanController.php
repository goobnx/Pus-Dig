<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function storeUlasan(Request $request, $slug_judul_buku)
    {
        $request->validate([
            'rating'      => 'required|integer|between:1,5',
            'isi_ulasan'  => 'nullable|string|max:500',
        ]);

        $user = auth()->user();

        $buku = Buku::where('slug_judul_buku', $slug_judul_buku)->first();

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        $ulasan = new Ulasan();
        $ulasan->id_user = $user->id_user;
        $ulasan->id_buku = $buku->id_buku;
        $ulasan->rating = $request->rating;
        $ulasan->isi_ulasan = $request->isi_ulasan;
        $ulasan->save();

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim.');
    }

    public function updateUlasan(Request $request, $id_ulasan)
    {
        $ulasan = Ulasan::findOrFail($id_ulasan);

        $request->validate([
            'rating'      => 'required|integer|between:1,5',
            'isi_ulasan'  => 'nullable|string|max:500',
        ]);

        $ulasan->fill([
            'rating'     => $request->rating,
            'isi_ulasan' => $request->isi_ulasan,
        ]);

        if ($ulasan->isDirty()) {
            $ulasan->save();
            return redirect()->back()->with('success', 'Berhasil Memperbarui Ulasan');
        } else {
            return redirect()->back()->with('info', 'Tidak Ada Perubahan Ulasan');
        }
    }
}