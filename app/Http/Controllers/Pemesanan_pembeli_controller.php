<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Str;


class Pemesanan_pembeli_controller extends Controller
{
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
            $insert_data = DB::table('detail_pesanan')->insert($data);


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
            $total = DB::table('detail_pesanan')->where('detail_pesanan.id_user', Auth::user()->id)
            ->where('detail_pesanan.status_pesanan', '=',1)->sum('sub_total');

            $data_pesanan = DB::table('view_detail_pesanan')
                    ->select(
                        'view_detail_pesanan.id_pesanan',
                        'view_detail_pesanan.nama_produk',
                        'view_detail_pesanan.gambar_produk',
                        'view_detail_pesanan.jumlah',
                        'view_detail_pesanan.sub_total',
                    )
                    ->where('view_detail_pesanan.id', Auth::user()->id)
                    ->where('view_detail_pesanan.status_pesanan', '=',1)
                    ->get();

            $data = [
                'data_pesanan' => $data_pesanan,
                'total' => $total
            ];

            if (!empty($data_pesanan)) {
                return view('keranjang_kosong');                
            }else{
                return view('keranjang', $data);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function hapus_produk_keranjang($id)
    {
        try {
            //Start Transaction
            DB::beginTransaction();
            $hapus_produk = DB::table('detail_pesanan')->where('id_pesanan', $id)->delete();


            //Commit Transaction
            DB::commit();


            return redirect()->back()->with('message', 'Data produk berhasil dihapus');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Data gagal dihapus, silahkan coba lagi!');
        }
    }
    
    
    public function pembayaran()
    {
        try {
            $data_pesanan = DB::table('detail_pesanan')
                    ->select(
                        'detail_pesanan.id_pesanan',
                        'detail_pesanan.bukti_pembayaran',
                        'detail_pesanan.jumlah',
                        'detail_pesanan.sub_total',
                        'detail_pesanan.id_produk',
                        'detail_pesanan.id_user',
                        'detail_pesanan.status_pesanan',
                        'detail_pesanan.alamat',
                    )
                    ->where('detail_pesanan.id_user', Auth::user()->id)
                    ->where('detail_pesanan.status_pesanan', '=',1)
                    ->get();

            $data = [
                'data_pesanan' => $data_pesanan
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
                        
            $total = DB::table('detail_pesanan')->where('detail_pesanan.id_user', Auth::user()->id)
            ->where('detail_pesanan.status_pesanan', '=',1)->sum('sub_total');

            $data = [            
                'bukti_pembayaran' => $nama_bukti_pembayaran,                                
                'alamat' => $request->alamat,
                'status_pesanan' => 2,
                'invoice' => time()
            ];

            $data2 = [
                'invoice' => time(),
                'id_user' => Auth::user()->id,
                'status_pesanan' => 2,
                'total' => $total
            ];


            //Start Transaction
            DB::beginTransaction();
            $update_data = DB::table('detail_pesanan')
                ->where('detail_pesanan.id_user', Auth::user()->id)
                ->where('detail_pesanan.status_pesanan', '=',1)              
                ->update($data);
                
            $insert_data = DB::table('pesanan')->insert($data2);
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