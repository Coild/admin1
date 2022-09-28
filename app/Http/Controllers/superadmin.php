<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\aturan;
use App\Models\pabrik;
use App\Models\logadmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class superadmin extends Controller
{
    public function tampil_dashboard()
    {
        return view("admin.dashboard");
    }

    public function tampil_pabrik()
    {
        // $data  = pabrik::all();

        $data = DB::table('pabriks')
            ->leftJoin('users', 'pabriks.pabrik_id', '=', 'users.id')
            ->get(['pabriks.*', 'pabriks.nama as nama_pabrik', 'users.*', 'users.nama as username_pabrik', 'pabriks.no_hp as phone']);
        // ddd($data);
        return view("admin.tambahuser", ['data' => $data]);
    }

    public function tampil_audit()
    {
        $data = user::all()->where('level', 4);
        return view("admin.tambahauditor", ['data' => $data]);
    }


    public function register(Request $request)
    {

        $cek = User::all()->where('nama',  ucwords(strtolower($request->username)))->count();
        // dd($cek);
        if ($cek > 0) {
            // Session::flash('errors', ['' => 'Data Gagal Ditambah Username telah digunakan']);
            return redirect('/audit')->with('message', 'Data Gagal Ditambah Username telah digunakan');
        } else {
            $cek = pabrik::all()->where('nama',  ucwords(strtolower($request['pabrik'])))->count();
            if ($cek > 0) {
                return redirect('/audit')->with('message', 'Data Gagal Ditambah Nama Pabrik telah digunakan');
            } else {
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
                    Session::flash('success', 'Data Berhasil Ditambah');
                    return redirect('/pabrik');
                } else {
                    Session::flash('errors', ['' => 'Data Gagal Ditambah']);
                    return redirect('pabrik');
                }
            }
        }
    }

    public function register_audit(Request $request)
    {
        $cek = User::all()->where('nama',  ucwords(strtolower($request->username)))->count();
        // dd($cek);
        if ($cek > 0) {
            // Session::flash('errors', ['' => 'Data Gagal Ditambah Username telah digunakan']);
            return redirect('/audit')->with('message', 'Data Gagal Ditambah Username telah digunakan');
        } else {
            $user = new User;
            $user->nama = ucwords(strtolower($request->username));
            $user->namadepan = $request->namadepan;
            $user->namabelakang = $request->namabelakang;
            $user->level = 4;
            $user->pabrik = 0;
            $user->password = bcrypt($request->password);
            $simpan = $user->save();


            if ($simpan) {
                Session::flash('success', 'Data Berhasil Ditambah');
                return redirect('/audit');
            } else {
                Session::flash('errors', ['' => 'Data Gagal Ditambah Username telah digunakan']);
                return redirect('/audit');
            }
        }
    }

    public function tampil_protap()
    {
        $Baru = aturan::all()->where('kategori', 'Aturan Baru');
        $Produk = aturan::all()->where('kategori', 'Aturan Produk');
        $Pabrik = aturan::all()->where('kategori', 'Aturan Pabrik');
        $Iklan = aturan::all()->where('kategori', 'Aturan Iklan');
        return view("admin.protap", compact("Baru", "Produk", "Pabrik", "Iklan"));
    }
    public function tampil_updateprotap()
    {
        $isibaru = aturan::all()->where('kategori', 'Aturan Baru')->sortByDesc('tgl_upload')->first();
        $isiproduk = aturan::all()->where('kategori', 'Aturan Produk')->sortByDesc('tgl_upload')->first();
        $isipabrik = aturan::all()->where('kategori', 'Aturan Pabrik')->sortByDesc('tgl_upload')->first();
        $isiiklan = aturan::all()->where('kategori', 'Aturan Iklan')->sortByDesc('tgl_upload')->first();

        $baru = isset($isibaru) ? 'asset/aturam/' . $isibaru['nama'] : '#';
        $pabrik = isset($isipabrik['nama']) ?  'asset/aturam/' . $isipabrik['nama'] : '#';
        $produk = isset($isiproduk) ?  'asset/aturam/' . $isiproduk['nama'] : '#';
        $iklan = isset($isiiklan) ?  'asset/aturam/' . $isiiklan['nama'] : '#';

        return view('admin.protap', ['struktur' => $struktur ??  '', 'baru' => $baru, 'produk' => $produk, 'pabrik' => $pabrik, 'iklan' => $iklan]);
    }
    public function input_aturan(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $filename = md5(date('Y-m-d H:i:s:u'));
        $tujuan_upload = 'asset/aturan/';
        $file->move($tujuan_upload, $filename . '.pdf');
        // dd($filename.$nama);
        $data = [
            'nama' => $filename = md5(date('Y-m-d H:i:s:u')) . '.pdf',
            'kategori' => $req['kategori'],
            'tgl_upload' => $req['tgl'],
        ];
        aturan::insert($data);
        // // user::deleted()
        return redirect('update-protap');
    }

    public function hapus_aturan(Request $req)
    {
        $id = $req['id'];   
        aturan::all()->where('aturan_id', $id)->each->delete();
        // // user::deleted()
        return redirect('update-protap');
    }

    public function hapus_auditor(Request $req)
    {
        // dd($req->id);
        if (!isset($req['_token'])) {
            return Redirect::back();
        }
        $post = user::all()->where('id',  $req->id)->each->delete();
        // dd($post);
        // $pabrik = Auth::user()->pabrik;
        // $data = user::all()->where('pabrik', $pabrik)
        //     ->where('level', '>=', 4);

        if ($post) {
            $log = [
                'log_isi' => "Admin" . ' <b> Menghapus ' . $req->namadepan . ' ' .  $req->namabelakang . ' </b> &nbsp dari Auditor',
                'log_pabrik' => 0,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => 0
            ];
            logadmin::insert($log);

            return redirect('/audit')->with('success', 'Berhasil dihapus!');
        } else {
            return redirect('/audit')->with('error', 'Gagal dihapus!');
        }


        // return view("pemilik.karyawan", ['data' => $data]);
    }
}
