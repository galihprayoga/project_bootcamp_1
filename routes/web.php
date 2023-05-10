<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InputProdukController;


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


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/input_produk', [InputProdukController::class, 'input_produk'])->name('input_produk');
Route::post('/simpan_input_produk', [InputProdukController::class, 'simpan_input_produk'])->name('simpan_input_produk');

Route::get('/report_produk', [InputProdukController::class, 'report_produk'])->name('report_produk');

Route::get('/daftar_produk', [InputProdukController::class, 'daftar_produk'])->name('daftar_produk');

Route::get('/home_pembeli', [App\Http\Controllers\Pembeli::class, 'index'])->name('home_pembeli');