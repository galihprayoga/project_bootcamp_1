<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class Produk_pembeli_controller extends Controller
{
    public function daftar_produk()
    {
        try {
            $data_produk = DB::table('daftar_produk')
                    ->select(
                        'daftar_produk.id',
                        'daftar_produk.nama_produk',
                        'daftar_produk.gambar_produk',
                        'daftar_produk.gambar_produk_2',
                        'daftar_produk.gambar_produk_3',
                        'daftar_produk.stok',
                        'daftar_produk.deskripsi_produk',
                        'daftar_produk.harga'
                    )
                    ->get();


            $data = [
                'data_produk' => $data_produk
            ];


            return view('daftar_produk', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function detail_produk($id) // Parameter $id untuk mengambil data yang ingin di edit
    {
        // mengambil data dari database tabel produk sesuai id pada parameter
        try {
            $data_produk = DB::table('daftar_produk')
                    ->select(
                        'daftar_produk.id',
                        'daftar_produk.nama_produk',
                        'daftar_produk.gambar_produk',
                        'daftar_produk.gambar_produk_2',
                        'daftar_produk.gambar_produk_3',
                        'daftar_produk.stok',
                        'daftar_produk.deskripsi_produk',
                        'daftar_produk.harga'
                    )
                    ->where('daftar_produk.id', $id)
                    ->get();


            // membuat object untuk menyimpan data produk dan id
            $data = [
                'data_produk' => $data_produk,
                'id' => $id
            ];

            // menampilkan halaman view edit_produk.blade.php dengan data dari object $data
            return view('detail_produk', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
}