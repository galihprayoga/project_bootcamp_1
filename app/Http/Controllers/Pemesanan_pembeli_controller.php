<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Str;


class Pemesanan_pembeli_controller extends Controller
{
    public function keranjang()
    {
        try {
            $data_produk = DB::table('view_users_produk_pesanan')
                    ->select(
                        'view_users_produk_pesanan.nama_produk',
                        'view_users_produk_pesanan.gambar_produk',
                        'view_users_produk_pesanan.jumlah',
                        'view_users_produk_pesanan.sub_total',
                    )
                    ->where('view_users_produk_pesanan.id', Auth::user()->id)
                    ->get();


            $data = [
                'data_produk' => $data_produk
            ];


            return view('keranjang', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
    

    public function pesan_produk(Request $request, $id)
    {
        try {
            $bukti_pembayaran = $request->file('bukti_pembayaran');
            
            //ambil ekstensi gambar
            $ext_bukti_pembayaran = $bukti_pembayaran->getClientOriginalExtension();
            //ambil nama gambar
            $nama_bukti_pembayaran = $bukti_pembayaran->getClientOriginalName();
            //pindahkan gambar ke folder public/gambar/bukti_pembayaran
            $bukti_pembayaran->move('gambar/bukti_pembayaran/', $nama_bukti_pembayaran);
            

            $data = [
                'id_produk' => $request->id,
                'id_user' => $request->id_user,
                'bukti_pembayaran' => $nama_bukti_pembayaran,                
                'no_telp_pemesan' => $request->no_telp_pemesan,
                'jumlah' => $request->jumlah,
                'sub_total' => Str::replace('.','',$request->sub_total),
                'alamat' => $request->alamat,
            ];


            //Start Transaction
            DB::beginTransaction();
            $insert_data = DB::table('pesanan')->insert($data);


            //Commit Transaction
            DB::commit();


            return redirect()->back()->with('message', 'Produk berhasil dipesan');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Pemesanan gagal, silahkan coba lagi!');
        }
    }
}