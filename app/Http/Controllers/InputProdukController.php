<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class InputProdukController extends Controller
{
    public function input_produk()
    {
        return view('penjual.input_produk');
    }


    public function simpan_input_produk(Request $request)
    {
        try {
            $gambar_produk = $request->file('gambar_produk');
            $gambar_produk_2 = $request->file('gambar_produk_2');
            $gambar_produk_3 = $request->file('gambar_produk_3');


            //ambil ekstensi gambar
            $ext_gambar_produk = $gambar_produk->getClientOriginalExtension();
            //ambil nama gambar
            $nama_gambar_produk = $gambar_produk->getClientOriginalName();
            //pindahkan gambar ke folder public/gambar/gambar_produk
            $gambar_produk->move('gambar/gambar_produk/', $nama_gambar_produk);
            
            //ambil ekstensi gambar
            $ext_gambar_produk_2 = $gambar_produk_2->getClientOriginalExtension();
            //ambil nama gambar
            $nama_gambar_produk_2 = $gambar_produk_2->getClientOriginalName();
            //pindahkan gambar ke folder public/gambar/gambar_produk
            $gambar_produk_2->move('gambar/gambar_produk/', $nama_gambar_produk_2);
            
            //ambil ekstensi gambar
            $ext_gambar_produk_3 = $gambar_produk_3->getClientOriginalExtension();
            //ambil nama gambar
            $nama_gambar_produk_3 = $gambar_produk_3->getClientOriginalName();
            //pindahkan gambar ke folder public/gambar/gambar_produk
            $gambar_produk_3->move('gambar/gambar_produk/', $nama_gambar_produk_3);        

            $data = [
                'nama_produk' => $request->nama_produk,
                'gambar_produk' => $nama_gambar_produk,
                'gambar_produk_2' => $nama_gambar_produk_2,
                'gambar_produk_3' => $nama_gambar_produk_3,
                'stok' => $request->stok_produk,
                'deskripsi_produk' => $request->deskripsi_produk,
                'harga' => $request->harga,
            ];


            //Start Transaction
            DB::beginTransaction();
            $insert_data = DB::table('daftar_produk')->insert($data);


            //Commit Transaction
            DB::commit();


            return redirect()->back()->with('message', 'Data produk berhasil di input');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Data gagal di input, silahkan coba lagi!');
        }
    }

    public function report_produk()
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


            return view('penjual.report_produk', $data);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function edit_produk($id)
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
                    ->where('daftar_produk.id', $id)
                    ->get();


            $data = [
                'data_produk' => $data_produk,
                'id' => $id
            ];


            return view('penjual.edit_produk', $data);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function simpan_edit_produk(Request $request, $id)
    {
        try {
            $gambar_produk = $request->file('gambar_produk');
            $gambar_produk_2 = $request->file('gambar_produk_2');
            $gambar_produk_3 = $request->file('gambar_produk_3');


            if($gambar_produk != ""){
                //ambil ekstensi gambar
                $ext_gambar_produk = $gambar_produk->getClientOriginalExtension();
                //ambil nama gambar
                $nama_gambar_produk = $gambar_produk->getClientOriginalName();
                //pindahkan gambar ke folder public/gambar/gambar_produk
                $gambar_produk->move('gambar/gambar_produk/', $nama_gambar_produk);
            } else{
                $nama_gambar_produk = $request->gambar_produk_lama;
            }
            if($gambar_produk_2 != ""){
                //ambil ekstensi gambar
                $ext_gambar_produk_2 = $gambar_produk_2->getClientOriginalExtension();
                //ambil nama gambar
                $nama_gambar_produk_2 = $gambar_produk_2->getClientOriginalName();
                //pindahkan gambar ke folder public/gambar/gambar_produk
                $gambar_produk_2->move('gambar/gambar_produk/', $nama_gambar_produk_2);
            } else{
                $nama_gambar_produk_2 = $request->gambar_produk_lama_2;
            }
            if($gambar_produk_3 != ""){
                //ambil ekstensi gambar
                $ext_gambar_produk_3 = $gambar_produk_3->getClientOriginalExtension();
                //ambil nama gambar
                $nama_gambar_produk_3 = $gambar_produk_3->getClientOriginalName();
                //pindahkan gambar ke folder public/gambar/gambar_produk
                $gambar_produk_3->move('gambar/gambar_produk/', $nama_gambar_produk_3);
            } else{
                $nama_gambar_produk_3 = $request->gambar_produk_lama_3;
            }
        

            $data_update = [
                'nama_produk' => $request->nama_produk,
                'gambar_produk' => $nama_gambar_produk,
                'gambar_produk_2' => $nama_gambar_produk_2,
                'gambar_produk_3' => $nama_gambar_produk_3,
                'stok' => $request->stok_produk,
                'deskripsi_produk' => $request->deskripsi_produk,
                'harga' => $request->harga,
            ];
           
            //Start Transaction
            DB::beginTransaction();
            $update_produk = DB::table('daftar_produk')->where('id', $id)->update($data_update);


            //Commit Transaction
            DB::commit();


            return redirect()->back()->with('message', 'Data produk berhasil di simpan');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Data gagal di disimpan, silahkan coba lagi!');
        }
    }

    public function hapus_produk($id)
    {
        try {
            //Start Transaction
            DB::beginTransaction();
            $hapus_produk = DB::table('daftar_produk')->where('id', $id)->delete();


            //Commit Transaction
            DB::commit();


            return redirect()->back()->with('message', 'Data produk berhasil dihapus');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Data gagal dihapus, silahkan coba lagi!');
        }
    }



    
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

    public function pesanan()
    {
        try {
            $data_produk = DB::table('view_users_produk_pesanan')
                    ->select(
                        'view_users_produk_pesanan.name',
                        'view_users_produk_pesanan.nama_produk',
                        'view_users_produk_pesanan.no_telp_pemesan',
                        'view_users_produk_pesanan.jumlah',
                        'view_users_produk_pesanan.total_harga',
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
}
