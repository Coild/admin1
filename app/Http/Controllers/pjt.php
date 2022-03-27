<?php
namespace App\Http\Controllers;

use App\Models\pengolahanbatch;
use Illuminate\Http\Request;

class pjt extends Controller
{
    public function tampil_pengolahanbatch() {
        $data = pengolahanbatch::all()->where('status',1);
        return view('catatanpelaksana.dokumen.pengolahanbatch',['data'=>$data]);
    }

    public function terima_pengolahanbatch(Request $req) {
        // dd($req);
        $user = pengolahanbatch::all()->where("nomor_batch", $req['id'])->first()->update([
            'status' => 2,
        ]);
        // return view('catatanpelaksana.dokumen.pengolahanbatch',['data'=>$data]);
        return redirect('/pjt_pengolahanbatch');
    }
}
