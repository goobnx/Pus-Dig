<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $judulHalaman = 'Home';
        $breadcrumbs = [
            ['url' => '', 'label' => 'Home']
        ];

        $totalBuku       = Buku::count();
        $totalKategori   = Kategori::count();
        $totalUser       = User::count();
        $totalPeminjaman = Peminjaman::count();

        return view('home.index', compact('judulHalaman', 'breadcrumbs', 'totalBuku', 'totalKategori', 'totalUser', 'totalPeminjaman'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
