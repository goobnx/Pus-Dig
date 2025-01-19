<?php

use App\Http\Controllers\AkunController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfilUserController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\PeminjamanUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('register', [RegisterController::class, 'processRegister'])->name('process.register');
    Route::get('login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('login', [LoginController::class, 'processLogin'])->name('process.login');
});

Route::get('/', [PeminjamanUserController::class, 'indexBook'])->name('index.book');
Route::get('/buku/{slug_judul_buku}', [PeminjamanUserController::class, 'showBook'])->name('show.book');

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'processLogout'])->name('process.logout');

    Route::middleware('role:peminjam')->group(function () {
        Route::post('/pinjam/{slug_judul_buku}', [PeminjamanUserController::class, 'processPeminjaman'])->name('process.peminjaman');
        Route::post('/kembalikan/{slug_judul_buku}', [PeminjamanUserController::class, 'processPengembalian'])->name('process.pengembalian');
        Route::get('/peminjaman-saya', [PeminjamanUserController::class, 'indexPeminjaman'])->name('indexPeminjaman');
        Route::get('/riwayat-peminjaman', [PeminjamanUserController::class, 'riwayatPeminjaman'])->name('riwayatPeminjaman');
        Route::post('/buku/{slug_judul_buku}/ulasan', [UlasanController::class, 'storeUlasan'])->name('store.ulasan');
        Route::put('/buku/ulasan/{id_ulasan}', [UlasanController::class, 'updateUlasan'])->name('update.ulasan');
        Route::get('/profil-user', [ProfilUserController::class, 'index'])->name('profilUser.index');
        Route::put('/profil-user/{id_user}', [ProfilUserController::class, 'update'])->name('profilUser.update');
        Route::get('/profil-user/ubah-password', [ProfilUserController::class, 'indexUbahPassword'])->name('index.ubahPasswordUser');
        Route::put('/profil-user/ubah-password/{id_user}', [ProfilUserController::class, 'processUbahPassword'])->name('process.ubahPasswordUser');
        Route::get('/koleksi', [KoleksiController::class, 'index'])->name('index.koleksi');
        Route::post('/koleksi/{slug_judul_buku}', [KoleksiController::class, 'store'])->name('store.koleksi');
        Route::delete('/koleksi/{id_koleksi}', [KoleksiController::class, 'destroy'])->name('destroy.koleksi');
    });

    Route::middleware('role:admin|petugas')->prefix('perpustakaan')->group(function () {
        Route::resource('home', HomeController::class);
        Route::resource('buku', BukuController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('kategori-buku', KategoriBukuController::class);
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('index.peminjaman');
        Route::post('/peminjaman/{id_peminjaman}/verifikasi', [PeminjamanController::class, 'verifikasiPeminjaman'])->name('verifikasi.peminjaman');
        Route::post('/pengembalian/{id_peminjaman}/verifikasi', [PeminjamanController::class, 'verifikasiPengembalian'])->name('verifikasi.pengembalian');
        Route::get('/peminjaman/cetak', [PeminjamanController::class, 'cetakPeminjaman'])->name('cetak.peminjaman');
        Route::get('/profil', [ProfilController::class, 'index'])->name('index.profil');
        Route::put('/profil/{id_user}', [ProfilController::class, 'update'])->name('update.profil');
        Route::get('/profil/ubah-password', [ProfilController::class, 'indexUbahPassword'])->name('index.ubahPassword');
        Route::put('/profil/ubah-password/{id_user}', [ProfilController::class, 'processUbahPassword'])->name('process.ubahPassword');
        Route::resource('akun', AkunController::class);
        Route::get('/akun/reset-password/{id_user}/reset', [AkunController::class, 'indexResetPassword'])->name('index.resetPassword');
        Route::put('/akun/reset-password/{id_user}', [AkunController::class, 'processResetPassword'])->name('process.resetPassword');
    });
});
