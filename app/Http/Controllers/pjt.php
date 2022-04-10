<?php

namespace App\Http\Controllers;

use App\Models\{contohbahanbaku,contohprodukjadi, contohkemasan, distribusiproduk, kartustokbahankemas, kartustokprodukjadi, kartustokbahan, pengolahanbatch,laporan, Pelatihancpkb, pelulusanproduk, PPbahanbakukeluar, PPbahanbakumasuk, PPkemasankeluar, PPkemasanmasuk, PPprodukjadikeluar, PPprodukjadimasuk, pemusnahanbahanbaku, Pemusnahanbahankemas, Pemusnahanprodukantara, Pemusnahanprodukjadi, penanganankeluhan, penarikanproduk, pengoprasianalat, programpelatihan, ruangtimbang, spesifikasi, Spesifikasibahanbaku, Spesifikasibahankemas, Spesifikasiprodukjadi, timbangbahan, timbangproduk};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pjt extends Controller
{
    public function tampil_pengolahanbatch()
    {
        $data = pengolahanbatch::all()->where('status', 0);
        return view('catatan.dokumen.pengolahanbatch', ['data' => $data]);
    }

    public function terima_batch(Request  $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $user = pengolahanbatch::all()->where("nomor_batch", $id)->first()->update([
            'status' => 3,
        ]);
        $data = pengolahanbatch::all()->where('status', 1);
        return redirect()->route('pengolahanbatch');
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
        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'penambahan contoh kemasan')->first()->update([
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
        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'penambahan contoh produk')->first()->update([
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
        
        contohbahanbaku::all()->where("no_batch", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penambahan contoh bahan baku')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('ambilcontoh');
    }

    public function terima_bahankeluar(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = PPbahanbakukeluar::all()->where("no_batch", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penerimaan bahan keluar')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('penerimaanBB');
    }

    public function terima_bahanmasuk(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        // dd($req['nobatch']);
        
        $user = PPbahanbakumasuk::all()->where("no_loth", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penerimaan bahan masuk')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('penerimaanBB');
    }

    public function terima_produkkeluar(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        
        $user = PPprodukjadikeluar::all()->where("no_batch", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penerimaan produk keluar')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('penerimaanBB');
    }

    public function terima_produkmasuk(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        
        $user = PPprodukjadimasuk::all()->where("no_loth", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penerimaan produk masuk')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('penerimaanBB');
    }

    public function terima_kemasankeluar(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        
        
        $user = PPkemasankeluar::all()->where("no_batch", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penerimaan kemasan keluar')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('penerimaanBB');
    }

    public function terima_kemasanmasuk(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = PPkemasanmasuk::all()->where("no_loth", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penerimaan kemasan masuk')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('penerimaanBB');
    }

    //terima pelatihan higi sani
    public function terima_pelatihanhigisani(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd(  $req['nobatch']);
        $user = programpelatihan::all()->where("kode_pelatihan", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','pelatihan higiene dan sanitasi')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('program-dan-pelatihan-higiene-dan-sanitasi');
    }

    public function terima_pelatihancpkb(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = Pelatihancpkb::all()->where("kode_pelatihan", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','pelatihan cpkb')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('program-dan-pelatihan-higiene-dan-sanitasi');
    }

    //pengoperasianalat
    public function terima_operasialat(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = pengoprasianalat::all()->where("id_operasi", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','pengoperasian alat')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('pengoprasian-alat');
    }

    //distribusi produk
    public function terima_distribusiproduk(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = distribusiproduk::all()->where("kode_distribusi", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','distribusi produk')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('pendistribusian-produk');
    }

    //penimbangan
    public function terima_penimbanganbahan(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = timbangbahan::all()->where("no_loth", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penimbangan bahan')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('penimbangan');
    }

    public function terima_penimbanganproduk(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = timbangproduk::all()->where("no_batch", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','penimbangan produk utama')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('penimbangan');
    }

    public function terima_penimbanganruang(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = ruangtimbang::all()->where("no_loth", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','ruang timbang')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('penimbangan');
    }

    //pelulusan produk
    public function terima_pelulusanproduk(Request $req) {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = pelulusanproduk::all()->where("no_batch", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan ::all()->where('laporan_batch',$req['nobatch'])
        ->where('laporan_nama','pelulusan produk jadi')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        return redirect()->route('pelulusan-produk');
    }


    //bawah
    public function terima_penanganankeluhan(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = penanganankeluhan::where("id_penanganankeluhan", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'penanganan keluhan')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = penanganankeluhan::all()->where('status', 1);
        return redirect()->route('penanganan-keluhan');
    }
    public function terima_penarikanproduk(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = penarikanproduk::where("id_produk_penarikan", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'penarikan produk')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = penarikanproduk::all()->where('status', 1);
        return redirect()->route('penarikan-produk');
    }
    public function terima_pemusnahanbahanbaku(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = pemusnahanbahanbaku::where("id_pemusnahanbahan", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'pemusnahan bahan')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = pemusnahanbahanbaku::all()->where('status', 1);
        return redirect()->route('pemusnahan-produk');
    }
    public function terima_pemusnahanbahankemas(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = Pemusnahanbahankemas::where("id_pemusnahanbahankemas", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'pemusnahan bahan kemas')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = Pemusnahanbahankemas::all()->where('status', 1);
        return redirect()->route('pemusnahan-produk');
    }
    public function terima_pemusnahanprodukantara(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = Pemusnahanprodukantara::where("id_pemusnahanprodukantara", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'pemusnahan produk antara')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = Pemusnahanprodukantara::all()->where('status', 1);
        return redirect()->route('pemusnahan-produk');
    }
    public function terima_pemusnahanprodukjadi(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = Pemusnahanprodukjadi::where("id_pemusnahanprodukjadi", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'pemusnahan produk jadi')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = Pemusnahanprodukjadi::all()->where('status', 1);
        return redirect()->route('pemusnahan-produk');
    }
    public function terima_stokbahanbaku(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = kartustokbahan::where("id_kartustokbahan", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'kartu stok bahan baku')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = kartustokbahan::all()->where('status', 1);
        return redirect()->route('kartu-stok');
    }
    public function terima_stokbahankemas(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = kartustokbahankemas::where("id_kartustokbahankemas", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'kartu stok bahan kemas')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = kartustokbahankemas::all()->where('status', 1);
        return redirect()->route('kartu-stok');
    }
    public function terima_stokprodukjadi(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = kartustokprodukjadi::where("id_kartustokprodukjadi", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'kartu stok produk jadi')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = kartustokprodukjadi::all()->where('status', 1);
        return redirect()->route('kartu-stok');
    }
    public function terima_pemeriksaanbahanbaku(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = Spesifikasibahanbaku::where("id_spesifikasibahanbaku", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'Pemeriksaan Bahan Baku')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = Spesifikasibahanbaku::all()->where('status', 1);
        return redirect()->route('pemeriksaan-bahan');
    }
    public function terima_pemeriksaanbahankemas(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = Spesifikasibahankemas::where("id_spesifikasibahankemas", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'Pemeriksaan Bahan Kemas')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = Spesifikasibahankemas::all()->where('status', 1);
        return redirect()->route('pemeriksaan-bahan');
    }
    public function terima_pemeriksaanprodukjadi(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = Spesifikasiprodukjadi::where("id_spesifikasiprodukjadi", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'Pemeriksaan Produk Jadi')->first()->update([
            'laporan_diterima' =>  Auth::user()->nama,
            'tgl_diterima' => $tgl
        ]);
        $data = Spesifikasiprodukjadi::all()->where('status', 1);
        return redirect()->route('pemeriksaan-bahan');
    }

    



    //sidebar
    public function tampil_bahan_baku()
    {
        $id = Auth::user()->pabrik;
        $data = spesifikasi::all()->where('pabrik_id', $id)
            ->where('kategori', 1);
        return view('spesifikasi.bahanbaku', ['list' => $data]);
    }

    public function tampil_bahan_kemas()
    {
        $id = Auth::user()->pabrik;
        $data = spesifikasi::all()->where('pabrik_id', $id)
            ->where('kategori', 2);
        return view('spesifikasi.bahankemas', ['list' => $data]);
    }

    public function tampil_produk_antara()
    {
        $id = Auth::user()->pabrik;
        $data = spesifikasi::all()->where('pabrik_id', $id)
            ->where('kategori', 3);
        return view('spesifikasi.produkantara', ['list' => $data]);
    }

    public function tampil_produk_jadi()
    {
        $id = Auth::user()->pabrik;
        $data = spesifikasi::all()->where('pabrik_id', $id)
            ->where('kategori', 3);
        return view('spesifikasi.produkantara', ['list' => $data]);
    }

    public function tambah_bahan_baku(Request $req)
    {
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

    public function tambah_bahan_kemas(Request $req)
    {
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

    public function tambah_produk_antara(Request $req)
    {
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

    public function tambah_produk_jadi(Request $req)
    {
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
