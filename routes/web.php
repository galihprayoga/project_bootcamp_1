<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Produk_pembeli_controller;
use App\Http\Controllers\Produk_penjual_controller;
use App\Http\Controllers\Pesanan_penjual_controller;
use App\Http\Controllers\Pemesanan_pembeli_controller;
use App\Http\Controllers\Users_controller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::get('/', [Produk_pembeli_controller::class, 'daftar_produk'])->name('daftar_produk');
Route::get('/detail_produk/{id}', [Produk_pembeli_controller::class, 'detail_produk'])->name('detail_produk');


Route::group(['middleware' => 'auth'], function(){
    Route::get('/input_produk', [Produk_penjual_controller::class, 'input_produk'])->name('input_produk');
    Route::post('/simpan_input_produk', [Produk_penjual_controller::class, 'simpan_input_produk'])->name('simpan_input_produk');


    Route::get('/report_produk', [Produk_penjual_controller::class, 'report_produk'])->name('report_produk');
    
    Route::get('/edit_produk/{id}', [Produk_penjual_controller::class, 'edit_produk'])->name('edit_produk');
    Route::post('/simpan_edit_produk/{id}', [Produk_penjual_controller::class, 'simpan_edit_produk'])->name('simpan_edit_produk');
    
    Route::get('/hapus_produk/{id}', [Produk_penjual_controller::class, 'hapus_produk'])->name('hapus_produk');
    
    Route::get('/pesanan', [Pesanan_penjual_controller::class, 'pesanan'])->name('pesanan');
    
    Route::get('/detail_pesanan/{id}', [Pesanan_penjual_controller::class, 'detail_pesanan'])->name('detail_pesanan');
    
    Route::get('/pemesanan/{id}', [Pesanan_penjual_controller::class, 'pemesanan'])->name('pemesanan');
    
    Route::post('/pesan_produk/{id}', [Pemesanan_pembeli_controller::class, 'pesan_produk'])->name('pesan_produk');
    
    Route::get('/pembayaran', [Pemesanan_pembeli_controller::class, 'pembayaran'])->name('pembayaran');
    Route::post('/simpan_pembayaran', [Pemesanan_pembeli_controller::class, 'simpan_pembayaran'])->name('simpan_pembayaran');
    
    Route::post('/do_tambah_keranjang/{id}', [Pemesanan_pembeli_controller::class, 'do_tambah_keranjang'])->name('do_tambah_keranjang');
    
    Route::get('/keranjang', [Pemesanan_pembeli_controller::class, 'keranjang'])->name('keranjang');
    Route::get('/hapus_produk_keranjang/{id}', [Pemesanan_pembeli_controller::class, 'hapus_produk_keranjang'])->name('hapus_produk_keranjang');

    Route::get('/cetak_pdf/{id}', [Pesanan_penjual_controller::class, 'cetak_pdf'])->name('cetak_pdf');

    Route::get('/edit_profil', [Users_controller::class, 'edit_profil'])->name('edit_profil');
    Route::post('/simpan_edit_profil', [Users_controller::class, 'simpan_edit_profil'])->name('simpan_edit_profil');

});