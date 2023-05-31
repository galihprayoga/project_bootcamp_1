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
            $data_pesanan = DB::table('view_pesanan')
                    ->select(
                        'view_pesanan.name',
                        'view_pesanan.nama_produk',
                        'view_pesanan.no_telp_pemesan',
                        'view_pesanan.jumlah',
                        'view_pesanan.sub_total',
                        'view_pesanan.bukti_pembayaran',
                        'view_pesanan.alamat'                        
                    )
                    ->get();


            $data = [
                'data_pesanan' => $data_pesanan
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
            $data_pesanan = DB::table('daftar_produk')
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
                'data_pesanan' => $data_pesanan,
                'id' => $id
            ];

            // menampilkan halaman view edit_produk.blade.php dengan data dari object $data
            return view('pemesanan', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
}
