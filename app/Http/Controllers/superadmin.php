<?php

namespace App\Http\Controllers;

use App\Models\pabrik;
use App\Models\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class superadmin extends Controller
{
    public function tampil_dashboard () {
        return view("admin.dashboard");
    }

    public function tampil_pabrik () {
        return view("admin.tambahuser");
    }
    public function register(Request $request)
    {

        $hasil = [
            'nama' => $request['pabrik'],
        ];

        pabrik::insert($hasil);
        $pabrik  = pabrik::all()->where('nama', $request['pabrik'] );
        // dd($pabrik);
        $user = new User;
        $user->nama = ucwords(strtolower($request->username));
        $user->namadepan = $request->namadepan;
        $user->namabelakang = $request->namabelakang;
        $user->level = 1;
        foreach  ($pabrik as $row) {
            $user->pabrik = $row['pabrik_id']; 
        }
        $user->password = bcrypt($request->password);
        $simpan = $user->save();

        if ($simpan) {
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect('/login');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect('showregister');
        }
    }
    public function tampil_protap () {
        return view("admin.ubahprotap");
    }

}
