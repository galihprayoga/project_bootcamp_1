<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\auth;
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

    public function verifikasi_pembayaran($id)
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
                    )
                    ->where('view_detail_pesanan.invoice', $id)
                    ->get();

            $data = [
                'data_pesanan' => $data_pesanan,
                'id' => $id
            ];      

            $data2 = [
                'status_pesanan' => 3,                
            ];


            //Start Transaction
            DB::beginTransaction();
            $update_data_detail_pesanan = DB::table('detail_pesanan')
                ->where('detail_pesanan.invoice', $id)
                ->update($data2);

            $update_data_pesanan = DB::table('pesanan')
                ->where('pesanan.invoice', $id)
                ->update($data2);
                
            //Commit Transaction
            DB::commit();

            return redirect()->back()->with('message', 'Pembayaran berhasil di verifikasi!');

        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Cetak alamat gagal, silahkan coba lagi!');
        }
    }
    
    public function cetak_pdf($id)
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
                    )
                    ->where('view_detail_pesanan.invoice', $id)
                    ->get();

            $data = [
                'data_pesanan' => $data_pesanan,
                'id' => $id
            ];      

            $data2 = [
                'status_pesanan' => 4,                
            ];


            //Start Transaction
            DB::beginTransaction();
            $update_data_detail_pesanan = DB::table('detail_pesanan')
                ->where('detail_pesanan.invoice', $id)
                ->update($data2);

            $update_data_pesanan = DB::table('pesanan')
                ->where('pesanan.invoice', $id)
                ->update($data2);
                
            //Commit Transaction
            DB::commit();


            $pdf = PDF::loadview('penjual.pesanan_pdf',$data)->setPaper('a6');
            return $pdf->stream('cetak-alamat-pdf');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Cetak alamat gagal, silahkan coba lagi!');
        }
    }

    
}
