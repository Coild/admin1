<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class pemilik extends Controller
{
    public function tampil_aplicant () {
        $pabrik=Auth::user()->pabrik;
        $data = user::all()->where('pabrik',$pabrik)
        ->where('level',-1);
        return view("pemilik.aplicant",['data' => $data ]);
    }

    public function tolak (Request $req)  {
        $post = user::all()->where('id',  $req->id)->each->delete();
    }

    public function terima(Request $req) {

        // dd($req->id);
        $pabrik=Auth::user()->pabrik;
        $data = user::all()->where('pabrik',$pabrik)
        ->where('level',-1);
        $user = user::all()->where("id", $req->id)->first()->update([
            'level' => 3,
        ]);
        
        return view("pemilik.aplicant",['data' => $data ]);
    }

    public function tampil_karyawan () {
        $pabrik=Auth::user()->pabrik;
        $data = user::all()->where('pabrik',$pabrik)
        ->where('level','>=',2);
        return view("pemilik.karyawan",['data' => $data ]);

    }

   public function update_posisi(Request $req){
    $user = user::all()->where("id", $req->id)->first()->update([
        'level' => $req->posisi
    ]);
    $pabrik=Auth::user()->pabrik;
    $data = user::all()->where('pabrik',$pabrik)
    ->where('level','>=',2);
    return view("pemilik.karyawan",['data' => $data ]);
   }
}
