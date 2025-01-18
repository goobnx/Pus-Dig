<?php

namespace App\Providers;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layout.sidebar', function ($view) {
            $jumlahVerifikasiPeminjaman = Peminjaman::where('status_peminjaman', 'verifikasi_peminjaman')->count();
            $jumlahVerifikasiPengembalian = Peminjaman::where('status_peminjaman', 'verifikasi_pengembalian')->count();
            $totalVerifikasi = $jumlahVerifikasiPeminjaman + $jumlahVerifikasiPengembalian;
            $view->with('totalVerifikasi', $totalVerifikasi);
        });
    }
}
