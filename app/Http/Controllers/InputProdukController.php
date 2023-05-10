<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;


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


            //ambil ekstensi gambar
            $ext_gambar_produk = $gambar_produk->getClientOriginalExtension();
            //ambil nama gambar
            $nama_gambar_produk = $gambar_produk->getClientOriginalName();
            //pindahkan gambar ke folder public/gambar/gambar_produk
            $gambar_produk->move('gambar/gambar_produk/', $nama_gambar_produk);


            $data = [
                'nama_produk' => $request->nama_produk,
                'gambar_produk' => $nama_gambar_produk,
                'stok' => $request->stok_produk,
                'deskripsi_produk' => $request->deskripsi_produk,
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
                        'daftar_produk.stok',
                        'daftar_produk.deskripsi_produk'
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
    
    public function daftar_produk()
    {
        try {
            $data_produk = DB::table('daftar_produk')
                    ->select(
                        'daftar_produk.id',
                        'daftar_produk.nama_produk',
                        'daftar_produk.gambar_produk',
                        'daftar_produk.stok',
                        'daftar_produk.deskripsi_produk'
                    )
                    ->get();


            $data = [
                'data_produk' => $data_produk
            ];


            return view('home_pembeli', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
}
