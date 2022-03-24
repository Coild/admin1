<?php

namespace App\Http\Controllers;

use App\Models\{pengolahanbatch, protap};


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class protapController extends Controller
{
     //COA
     public function tampil_protap ($jenis)
     {
         $id = Auth::user()->id;
         $data = protap::all()->where('protap_pabrik', auth::user()->pabrik)
         ->where('protap_jenis', $jenis);
         return view('protap.tampil_protap', ['list_protap' => $data,  'jenis' => $jenis]);
     }
 
     public function hapus_protap ($id,$jenis)
     {   
        //  echo  $id;
         $data = protap::all()
         ->where('protap_id', 1)->each->delete();;
        //  dd($data);

        return redirect('/tampil_protap/'.$jenis);
         
     }
 
     public function tambah_protap(Request $req)
     {
         $file = $req->file('upload');
         $nama = $file->getClientOriginalName();
         $tujuan_upload = 'asset/protap/';
         $file->move($tujuan_upload, $nama);
         $jenis=$req['jenis'];
         $id = Auth::user()->id;
         $pabrik = Auth::user()->pabrik;
         $hasil = [
             'protap_file' => $nama,
             'protap_nama' => $req['nama'],
             'protap_jenis' => $jenis,
             'protap_pabrik'=> $pabrik,
             'user_id' => $id,
         ];
 
         protap::insert($hasil);
         // // user::deleted()
         return redirect('/tampil_protap/'.$jenis);
     }

     public function tolak (Request $req)  {
        $data = pengolahanbatch::all()->where('status',1);
        $post = protap::all()->where('id',  $req->id)->each->delete();
        return view("catatanpelaksana.pengolahanbatch",['data' => $data ]);
    }

    public function terima(Request $req) {

        // dd($req->id);
        $pabrik=Auth::user()->pabrik;
        $data = protap::all()->where('pabrik',$pabrik)
        ->where('level',-1);
        $user = protap::all()->where("id", $req->id)->first()->update([
            'status' => 2,
        ]);
        
        return view("catatanpelaksana.dokumen.pengolahanbatch",['data' => $data ]);
    }

}
