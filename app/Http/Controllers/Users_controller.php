<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\auth;


class Users_controller extends Controller
{
    public function report_user()
    {
        try {
            $data_profil = DB::table('users')
                    ->select(
                        'users.id',
                        'users.name',
                        'users.email',
                        'users.no_telp_pemesan',                        
                    )
                    ->get();


            $data = [
                'data_profil' => $data_profil
            ];


            return view('daftar_user', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function edit_profil()
    {
        try {
            $data_user = DB::table('users')
                    ->select(
                        'users.id',
                        'users.name',
                        'users.email',
                        'users.no_telp_pemesan',                        
                    )
                    ->where('users.id', auth::user()->id)
                    ->get();


            $data = [
                'data_user' => $data_user                
            ];


            return view('edit_profil', $data);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function simpan_edit_profil(Request $request)
    {
        try {            
            $data_update = [
                'name' => $request->name,
                'email' => $request->email,
                'no_telp_pemesan' => $request->no_telp_pemesan,                
            ];
           
            //Start Transaction
            DB::beginTransaction();
            $update_profil = DB::table('users')->where('id', auth::user()->id)->update($data_update);


            //Commit Transaction
            DB::commit();


            return redirect()->back()->with('message', 'Data profil berhasil di simpan');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Data gagal di disimpan, silahkan coba lagi!');
        }
    }
}
