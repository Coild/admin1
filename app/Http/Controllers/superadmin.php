<?php

namespace App\Http\Controllers;

use App\Models\aturan;
use App\Models\pabrik;
use App\Models\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class superadmin extends Controller
{
    public function tampil_dashboard()
    {
        return view("admin.dashboard");
    }

    public function tampil_pabrik()
    {
        return view("admin.tambahuser");
    }

    public function tampil_audit()
    {
        return view("admin.tambahauditor");
    }

    public function tampil_inspek()
    {
        return view("admin.tambahinspek");
    }

    public function register(Request $request)
    {

        $hasil = [
            'nama' => $request['pabrik'],
            'alamat' => 'Belum',
            'no_hp' => 'Belum',
            'logo' => 'logo.png',
            'struktur' => 'logo.png'
        ];

        pabrik::insert($hasil);
        $pabrik  = pabrik::all()->where('nama', $request['pabrik']);
        // dd($pabrik);
        $user = new User;
        $user->nama = ucwords(strtolower($request->username));
        $user->namadepan = $request->namadepan;
        $user->namabelakang = $request->namabelakang;
        $user->level = 1;
        foreach ($pabrik as $row) {
            $user->pabrik = $row['pabrik_id'];
        }
        $user->password = bcrypt($request->password);
        $simpan = $user->save();

        if ($simpan) {
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect('/dashboard');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect('showregister');
        }
    }

    public function register_audit(Request $request)
    {
        $user = new User;
        $user->nama = ucwords(strtolower($request->username));
        $user->namadepan = $request->namadepan;
        $user->namabelakang = $request->namabelakang;
        $user->level = 4;
        $user->pabrik = 0;
        $user->password = bcrypt($request->password);
        $simpan = $user->save();

        if ($simpan) {
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect('/audit');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect('showregister');
        }
    }

    public function register_inspek(Request $request)
    {
        $user = new User;
        $user->nama = ucwords(strtolower($request->username));
        $user->namadepan = $request->namadepan;
        $user->namabelakang = $request->namabelakang;
        $user->level = 5;
        $user->pabrik = 0;
        $user->password = bcrypt($request->password);
        $simpan = $user->save();

        if ($simpan) {
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect('/audit');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect('showregister');
        }
    }

    public function tampil_protap()
    {
        return view("admin.ubahprotap");
    }

    public function input_aturan(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/aturan/';
        $file->move($tujuan_upload, $nama);
        $data = [
            'nama' => $nama,
            'kategori' => $req['kategori'],
            'tgl_upload' => $req['tgl'],
        ];
        aturan::insert($data);
        // // user::deleted()
        return redirect('dashboard');
    }
}
