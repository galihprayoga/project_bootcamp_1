<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class Pesanan_penjual_controller extends Controller
{
    public function pesanan()
    {
        try {
            $data_produk = DB::table('view_users_produk_pesanan')
                    ->select(
                        'view_users_produk_pesanan.name',
                        'view_users_produk_pesanan.nama_produk',
                        'view_users_produk_pesanan.no_telp_pemesan',
                        'view_users_produk_pesanan.jumlah',
                        'view_users_produk_pesanan.sub_total',
                        'view_users_produk_pesanan.bukti_pembayaran',
                        'view_users_produk_pesanan.alamat'                        
                    )
                    ->get();


            $data = [
                'data_produk' => $data_produk
            ];


            return view('penjual.pesanan', $data);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function pemesanan($id) // Parameter $id untuk mengambil data yang ingin di edit
    {
        // mengambil data dari database tabel produk sesuai id pada parameter
        try {
            $data_produk = DB::table('daftar_produk')
                    ->select(
                        'daftar_produk.id',
                        'daftar_produk.nama_produk',
                        'daftar_produk.gambar_produk',                        
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
            return view('pemesanan', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
}
