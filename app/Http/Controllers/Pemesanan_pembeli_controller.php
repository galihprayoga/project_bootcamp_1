<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Str;


class Pemesanan_pembeli_controller extends Controller
{
    public function do_tambah_keranjang(Request $request, $id)
    {
        try {
            $data = [
                'id_produk' => $request->id,
                'id_user' => $request->id_user,                
                'jumlah' => $request->jumlah,
                'sub_total' => Str::replace('.','',$request->sub_total),
                'status_pesanan' => 1,                
            ];


            //Start Transaction
            DB::beginTransaction();
            $insert_data = DB::table('pesanan')->insert($data);


            //Commit Transaction
            DB::commit();


            return redirect(route('keranjang'));
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Pemesanan gagal, silahkan coba lagi!');
        }
    }

    public function keranjang()
    {
        try {
            $data_produk = DB::table('view_pesanan')
                    ->select(
                        'view_pesanan.nama_produk',
                        'view_pesanan.gambar_produk',
                        'view_pesanan.jumlah',
                        'view_pesanan.sub_total',
                    )
                    ->where('view_pesanan.id', Auth::user()->id)
                    ->where('view_pesanan.status_pesanan', '=',1)
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
    
    public function pembayaran()
    {
        try {
            $data_produk = DB::table('pesanan')
                    ->select(
                        'pesanan.id_pesanan',
                        'pesanan.bukti_pembayaran',
                        'pesanan.jumlah',
                        'pesanan.sub_total',
                        'pesanan.id_produk',
                        'pesanan.id_user',
                        'pesanan.status_pesanan',
                        'pesanan.alamat',
                    )
                    ->where('pesanan.id_user', Auth::user()->id)
                    ->where('pesanan.status_pesanan', '=',1)
                    ->get();
                    // dd($data_produk);

            $data = [
                'data_produk' => $data_produk
            ];


            return view('pembayaran', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function simpan_pembayaran(Request $request)
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
                'bukti_pembayaran' => $nama_bukti_pembayaran,                                
                'alamat' => $request->alamat,
                'status_pesanan' => 2,
            ];


            //Start Transaction
            DB::beginTransaction();
            $update_data = DB::table('pesanan')
                ->where('pesanan.id_user', Auth::user()->id)
                ->where('pesanan.status_pesanan', '=',1)              
                ->update($data);


            //Commit Transaction
            DB::commit();


            return redirect(route('keranjang'));
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Pembayaran gagal, silahkan coba lagi!');
        }
    }
}