<?php
namespace App\Http\Controllers;

use App\Models\{pengolahanbatch,laporan};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pjt extends Controller
{
    public function tampil_pengolahanbatch() {
        $data = pengolahanbatch::all()->where('status',0);
        return view('catatanpelaksana.dokumen.pengolahanbatch',['data'=>$data]);
    }

    public function terima_pengolahanbatch(Request $req) {
        // dd($req);
        $user = pengolahanbatch::all()->where("nomor_batch", $req['id'])->first()->update([
            'status' => 1,
        ]);
        $user = laporan::all()->where("laporan_batch", $req['id'])->first()->update([
            'laporan_diterima' => Auth::user()->nama,
        ]);
        // return view('catatanpelaksana.dokumen.pengolahanbatch',['data'=>$data]);
        return redirect('/pjt_pengolahanbatch');
    } 
}
