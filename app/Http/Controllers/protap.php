<?php

namespace App\Http\Controllers;

use app\Models\{berinomorbatch};

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class protap extends Controller
{
     //COA
     public function tampil_coa()
     {
         $id = Auth::user()->id;
         $data = berinomorbatch::all()->where('user_id', $id);
         return view('/coa', ['list_coa' => $data]);
     }
 
     public function hapus_coa($id)
     {
         $data = berinomorbatch::all()->where('coa_id', $id);
         // dd($data);
         unlink("asset/coa/" . $data[0]['coa_file']);
         $post = berinomorbatch::all()->where('coa_id', $id)->each->delete();
 
         return redirect('/coa');
     }
 
     public function tambah_coa(Request $req)
     {
         $file = $req->file('upload');
         $nama = $file->getClientOriginalName();
         $tujuan_upload = 'asset/coa/';
         $file->move($tujuan_upload, $nama);
         $id = Auth::user()->id;
         $hasil = [
             'coa_file' => $nama,
             'coa_nama' => $req['nama'],
             'user_id' => $id,
         ];
 
         berinomorbatch::insert($hasil);
         // // user::deleted()
         return redirect('/coa');
     }
}
