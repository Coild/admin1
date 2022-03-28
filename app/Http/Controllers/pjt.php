<?php
namespace App\Http\Controllers;

use App\Models\{pengolahanbatch,laporan};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pjt extends Controller
{
    public function tampil_pengolahanbatch() {
        $data = pengolahanbatch::all()->where('status',0);
        return view('catatanpelaksana.dokumen.pengolahanbatch',['data'=>$data]);
    }

    public function terima_pengolahanbatch(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $user = pengolahanbatch::all()->where("nomor_batch", $req['id'])->first()->update([
            'status' => 1,
        ]);
        $user = laporan::all()->where("laporan_batch", $req['id'])->first()->update([
            'laporan_diterima' => Auth::user()->nama,
            'tgl_diterima' => $tgl,
        ]);
        // return view('catatanpelaksana.dokumen.pengolahanbatch',['data'=>$data]);
        return redirect('/pjt_pengolahanbatch');
    } 
}
