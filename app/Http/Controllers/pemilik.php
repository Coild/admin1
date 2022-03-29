<?php

namespace App\Http\Controllers;

use App\Models\audit;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class pemilik extends Controller
{
    public function tampil_aplicant()
    {
        $pabrik = Auth::user()->pabrik;
        $data = user::all()->where('pabrik', $pabrik)
            ->where('level', -1);
        return view("pemilik.aplicant", ['data' => $data]);
    }

    public function tolak(Request $req)
    {
        $post = user::all()->where('id',  $req->id)->each->delete();
        return redirect('/aplicant');
    }

    public function terima(Request $req)
    {

        // dd($req->id);
        $pabrik = Auth::user()->pabrik;

        user::all()->where("id", $req->id)->first()->update([
            'level' => 3,
        ]);
        $data = user::all()->where('pabrik', $pabrik)
            ->where('level', -1);

        return view("pemilik.aplicant", ['data' => $data]);
    }

    public function tampil_karyawan()
    {
        $pabrik = Auth::user()->pabrik;
        $data = user::all()->where('pabrik', $pabrik)
            ->where('level', '>=', 2);
        return view("pemilik.karyawan", ['data' => $data]);
    }

    public function hapus_karyawan(Request $req)
    {
        // dd($req);
        $post = user::all()->where('id',  $req->id)->each->delete();
        $pabrik = Auth::user()->pabrik;
        $data = user::all()->where('pabrik', $pabrik)
            ->where('level', '>=', 2);
        return view("pemilik.karyawan", ['data' => $data]);
    }

    public function update_posisi(Request $req)
    {
        $user = user::all()->where("id", $req->id)->first()->update([
            'level' => $req->posisi
        ]);
        $pabrik = Auth::user()->pabrik;
        $data = user::all()->where('pabrik', $pabrik)
            ->where('level', '>=', 2);
        return view("pemilik.karyawan", ['data' => $data]);
    }

    public function list_request()
    {
        $data = audit::all()->where('audit_pabrik', Auth::user()->pabrik);
        return view('pemilik.request', ['data' => $data]);
    }

    public function terima_request(Request $req)
    {
        // dd($req);
        $user = audit::all()->where("audit_pabrik", $req->pabrik)
        ->where("nobatch",$req->nobatch)
        ->where("audit_laporan",$req->laporan)->first()->update([
            'audit_status' => 1
        ]);
        return redirect('bos_audit');
    }
}
