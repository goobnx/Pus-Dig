<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $judulHalaman = 'Peminjaman';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => '', 'label' => 'Peminjaman']
        ];

        $tanggalAwal      = $request->input('tanggal_awal');
        $tanggalAkhir     = $request->input('tanggal_akhir');
        $statusPeminjaman = $request->input('status_peminjaman');

        $peminjamanQuery = Peminjaman::with('user', 'buku');

        if ($tanggalAwal && $tanggalAkhir) {
            $peminjamanQuery->whereBetween('tgl_peminjaman', [$tanggalAwal, $tanggalAkhir]);
        }

        if ($statusPeminjaman) {
            $peminjamanQuery->where('status_peminjaman', $statusPeminjaman);
        }

        $peminjaman = $peminjamanQuery->get();

        return view('peminjaman.index', compact('judulHalaman', 'breadcrumbs', 'peminjaman', 'tanggalAwal', 'tanggalAkhir', 'statusPeminjaman'));
    }

    public function verifikasiPeminjaman($id_peminjaman)
    {
        $peminjaman = Peminjaman::find($id_peminjaman);

        if (!$peminjaman) {
            return redirect()->route('index.peminjaman')->withErrors('Peminjaman tidak ditemukan.');
        }

        if ($peminjaman->status_peminjaman === 'verifikasi_peminjaman') {
            $peminjaman->status_peminjaman = 'sedang_pinjam';
            $peminjaman->save();

            return redirect()->route('index.peminjaman')->with('success', 'Peminjaman berhasil diverifikasi dan sekarang sedang dipinjam.');
        }

        return redirect()->route('index.peminjaman')->withErrors('Status peminjaman tidak sesuai untuk diverifikasi.');
    }

    public function verifikasiPengembalian($id_peminjaman)
    {
        $peminjaman = Peminjaman::find($id_peminjaman);

        if (!$peminjaman) {
            return redirect()->route('index.peminjaman')->withErrors('Peminjaman tidak ditemukan.');
        }

        if ($peminjaman->status_peminjaman === 'verifikasi_pengembalian') {
            $peminjaman->tgl_pengembalian = now();
            $peminjaman->status_peminjaman = 'selesai_pinjam';
            $peminjaman->save();

            return redirect()->route('index.peminjaman')->with('success', 'Pengembalian berhasil diverifikasi.');
        }

        return redirect()->route('index.peminjaman')->withErrors('Status peminjaman tidak sesuai untuk diverifikasi.');
    }

    public function cetakPeminjaman(Request $request)
    {
        $tanggalAwal      = $request->input('tanggal_awal');
        $tanggalAkhir     = $request->input('tanggal_akhir');
        $statusPeminjaman = $request->input('status_peminjaman');

    	$peminjamanQuery = Peminjaman::with('user', 'buku');

        if ($tanggalAwal && $tanggalAkhir) {
            $peminjamanQuery->whereBetween('tgl_peminjaman', [$tanggalAwal, $tanggalAkhir]);
        }

        if ($statusPeminjaman) {
            $peminjamanQuery->where('status_peminjaman', $statusPeminjaman);
        }

        $peminjaman = $peminjamanQuery->get();
 
    	$pdf = PDF::loadview('peminjaman.pdf',compact('peminjaman', 'tanggalAwal', 'tanggalAkhir', 'statusPeminjaman'));

    	return $pdf->stream();
    }
}