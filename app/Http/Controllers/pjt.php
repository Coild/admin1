<?php
namespace App\Http\Controllers;

use App\Models\{contohbahanbaku,contohprodukjadi, contohkemasan, kartustokbahan, pengolahanbatch,laporan, spesifikasi};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pjt extends Controller
{
    public function tampil_pengolahanbatch() {
        $data = pengolahanbatch::all()->where('status',0);
        return view('catatan.dokumen.pengolahanbatch',['data'=>$data]);
    }

    public function terima_batch($id)
    {
        $pabrik = Auth::user()->pabrik;
        $user = pengolahanbatch::all()->where("nomor_batch", $id)->first()->update([
            'status' => 3,
        ]);
        $data = pengolahanbatch::all()->where('status', 1);
        return view('catatan.dokumen.pengolahanbatch', ['data' => $data]);
    }

    public function terima_ambilbahankemas(Request $req)
    { 
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        contohkemasan::all()->where("no_batch", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);
        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penambahan contoh kemasan')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = contohkemasan::all()->where('status', 1);
        return redirect()->route('ambilcontoh');
    }

    public function terima_ambilprodukjadi(Request $req)
    { 
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = contohprodukjadi::all()->where("no_batch", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);
        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penambahan contoh produk')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = contohprodukjadi::all()->where('status', 1);
        return redirect()->route('ambilcontoh');
    }

    public function terima_ambilbahanbaku(Request $req)
    { 
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = contohbahanbaku::all()->where("no_batch", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);
        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penambahan contoh bahan baku')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = contohbahanbaku::all()->where('status', 1);
        return redirect()->route('ambilcontoh');
    }



    //sidebar
    public function tampil_bahan_baku () {
        $id = Auth::user()->pabrik;
        $data = spesifikasi::all()->where('pabrik_id', $id)
        ->where('kategori',1);
        return view('spesifikasi.bahanbaku', ['list' => $data]);
    }

    public function tampil_bahan_kemas () {
        $id = Auth::user()->pabrik;
        $data = spesifikasi::all()->where('pabrik_id', $id)
        ->where('kategori',2);
        return view('spesifikasi.bahankemas', ['list' => $data]);
    }

    public function tampil_produk_antara () {
        $id = Auth::user()->pabrik;
        $data = spesifikasi::all()->where('pabrik_id', $id)
        ->where('kategori',3);
        return view('spesifikasi.produkantara', ['list' => $data]);
    }

    public function tampil_produk_jadi () {
        $id = Auth::user()->pabrik;
        $data = spesifikasi::all()->where('pabrik_id', $id)
        ->where('kategori',3);
        return view('spesifikasi.produkantara', ['list' => $data]);
    }

    public function tambah_bahan_baku (Request $req) {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/coa/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->pabrik;
        $hasil = [
            'file' => $nama,
            'kategori' => 1,
            'keterangan' => $req['nama'],
            'pabrik_id' => $id,
        ];

        spesifikasi::insert($hasil);
        // // user::deleted()
        return redirect('/spek_bahan_baku');
    }

    public function tambah_bahan_kemas (Request $req) {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/coa/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->pabrik;
        $hasil = [
            'file' => $nama,
            'kategori' => 2,
            'keterangan' => $req['nama'],
            'pabrik_id' => $id,
        ];

        spesifikasi::insert($hasil);
        // // user::deleted()
        return redirect('/spek_bahan_kemas');
    }

    public function tambah_produk_antara (Request $req) {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/coa/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->pabrik;
        $hasil = [
            'file' => $nama,
            'kategori' => 3,
            'keterangan' => $req['nama'],
            'pabrik_id' => $id,
        ];

        spesifikasi::insert($hasil);
        // // user::deleted()
        return redirect('/spek_produk_antara');
    }

    public function tambah_produk_jadi (Request $req) {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/coa/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->pabrik;
        $hasil = [
            'file' => $nama,
            'kategori' => 4,
            'keterangan' => $req['nama'],
            'pabrik_id' => $id,
        ];

        spesifikasi::insert($hasil);
        // // user::deleted()
        return redirect('/spek_produk_jadi');
    }

    public function hapus_bahanbaku($id)
    {
        $data = spesifikasi::all()->where('spesifikasi_id', $id);
        // dd($data);
        unlink("asset/coa/" . $data[0]['file']);
        $post = spesifikasi::all()->where('spesifikasi_id', $id)->each->delete();

        return redirect('/spek_bahan_baku');
    }

    public function hapus_bahankemas($id)
    {
        $data = spesifikasi::all()->where('spesifikasi_id', $id);
        // dd($data);
        unlink("asset/coa/" . $data[0]['file']);
        $post = spesifikasi::all()->where('spesifikasi_id', $id)->each->delete();

        return redirect('/spek_bahan_kemas');
    }

    public function hapus_produkjadi($id)
    {
        $data = spesifikasi::all()->where('spesifikasi_id', $id);
        // dd($data);
        unlink("asset/coa/" . $data[0]['file']);
        $post = spesifikasi::all()->where('spesifikasi_id', $id)->each->delete();

        return redirect('/spek_produk_antara');
    }

    public function hapus_produkantara($id)
    {
        $data = spesifikasi::all()->where('spesifikasi_id', $id);
        // dd($data);
        unlink("asset/coa/" . $data[0]['file']);
        $post = spesifikasi::all()->where('spesifikasi_id', $id)->each->delete();

        return redirect('/spek_produk_jadi');
    }
}
