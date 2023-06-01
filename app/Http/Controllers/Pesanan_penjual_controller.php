<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;


class Pesanan_penjual_controller extends Controller
{
    public function pesanan()
    {
        try {
            $data_pesanan = DB::table('view_pesanan')
                    ->select(
                        'view_pesanan.name',
                        'view_pesanan.no_telp_pemesan',
                        'view_pesanan.status_pesanan',                                                
                        'view_pesanan.invoice',                                                
                        'view_pesanan.total',                                                
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
    
    public function detail_pesanan($id)
    {
        try {
            $data_pesanan = DB::table('view_detail_pesanan')
                    ->select(
                        'view_detail_pesanan.invoice',
                        'view_detail_pesanan.name',
                        'view_detail_pesanan.nama_produk',
                        'view_detail_pesanan.no_telp_pemesan',
                        'view_detail_pesanan.jumlah',
                        'view_detail_pesanan.sub_total',
                        'view_detail_pesanan.bukti_pembayaran',
                        'view_detail_pesanan.alamat',                  
                        'view_detail_pesanan.status_pesanan'                        
                    )
                    ->where('view_detail_pesanan.invoice', $id)
                    ->get();


            $data = [
                'data_pesanan' => $data_pesanan,
                'id' => $id
            ];


            return view('penjual.detail_pesanan', $data);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function cetak_pdf($id)
    {
    	$data_pesanan = DB::table('view_detail_pesanan')
                    ->select(
                        'view_detail_pesanan.invoice',
                        'view_detail_pesanan.name',
                        'view_detail_pesanan.nama_produk',
                        'view_detail_pesanan.no_telp_pemesan',
                        'view_detail_pesanan.jumlah',
                        'view_detail_pesanan.sub_total',
                        'view_detail_pesanan.bukti_pembayaran',
                        'view_detail_pesanan.alamat',                  
                    )
                    ->where('view_detail_pesanan.invoice', $id)
                    ->get();

        $data = [
            'data_pesanan' => $data_pesanan,
            'id' => $id
        ];
 
    	$pdf = PDF::loadview('penjual.pesanan_pdf',$data);
    	return $pdf->stream('laporan-pegawai-pdf');
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
