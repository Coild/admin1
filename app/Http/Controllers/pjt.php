<?php

namespace App\Http\Controllers;

use App\Models\{contohbahanbaku, contohprodukjadi, contohkemasan, cp_bahan, cp_kemasan, cp_produk, distribusiproduk, kartustokbahankemas, kartustokprodukjadi, kartustokbahan, kartustokprodukantara, pengolahanbatch, laporan, notif, Pelatihancpkb, pelulusanproduk, PPbahanbakukeluar, PPbahanbakumasuk, PPkemasankeluar, PPkemasanmasuk, PPprodukjadikeluar, PPprodukjadimasuk, pemusnahanbahanbaku, Pemusnahanbahankemas, Pemusnahanprodukantara, Pemusnahanprodukjadi, penanganankeluhan, penarikanproduk, Pengemasanbatchproduk, pengoprasianalat, Periksaalat, periksaruang, programpelatihan, ruangtimbang, spesifikasi, Spesifikasibahanbaku, Spesifikasibahankemas, Spesifikasiprodukjadi, timbangbahan, timbangproduk, log};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = pengolahanbatch::all()->where("nomor_batch", $id)->first()->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_batch', $req['id'])
            ->where('laporan_nama', 'pengolahan batch')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);

            notif::all()->where('notif_laporan', 'pengolahan batch')
            ->where('notif_2',$req['no'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan pengolahan batch',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);

        return redirect()->route('pengolahanbatch');
    }

    public function terima_kemasbatch(Request  $req)
    {
        $id = $req['id'];
        // dd($id);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = Pengemasanbatchproduk::all()->where("id_pengemasanbatchproduk", $id)->first()->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])
            ->where('laporan_nama', 'pengemasan batch produk')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'pengemasan batch')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan pengemasan batch',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);


        return redirect()->route('pengemasan-batch');
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
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
        $data = contohkemasan::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'penambahan contoh kemasan')
            ->where('notif_2',$req['no'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan penambahan contoh kemasan',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);


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
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
        $data = contohprodukjadi::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'penambahan contoh produk')
            ->where('notif_2',$req['no'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan penambahan contoh produk',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
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

        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'penambahan contoh bahan baku')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'penambahan contoh bahan baku')
            ->where('notif_2',$req['no'])->first()->update([
                'notif_3'  => 1
            ]);


            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan penambahan contoh bahan baku',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('ambilcontoh');
    }

    public function terima_cp_bahan(Request $req)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        // dd($req['nobatch']);

        $user = cp_bahan::all()->where("cp_bahan_id", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        // dd($req);

        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'penerimaan bahan')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'penerimaan bahan')
            ->where('notif_2',$req['nobatch'])->first()->update([
                'notif_3'  => 1
            ]);

            
            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan penerimaan bahan',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('penerimaanBB');
    }



    public function terima_cp_produk(Request $req)
    { 
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        $user = cp_produk::all()->where("cp_produk_id", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'penerimaan produk')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'penerimaan produk')
            ->where('notif_2',$req['nobatch'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan penerimaan produk',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);

        return redirect()->route('penerimaanBB');
    }

    public function terima_cp_kemasan(Request $req)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = cp_kemasan::all()->where("cp_kemasan_id", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'penerimaan kemasan')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'penerimaan kemasan')
            ->where('notif_2',$req['nobatch'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan penerimaan kemasan',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('penerimaanBB');
    }

    //terima pelatihan higi sani
    public function terima_pelatihanhigisani(Request $req)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req);
        $user = programpelatihan::all()->where("kode_pelatihan", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'pelatihan higiene dan sanitasi')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'pelatihan higiene dan sanitasi')
            ->where('notif_2',$req['no'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan pelatihan higiene dan sanitasi',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('program-dan-pelatihan-higiene-dan-sanitasi');
    }

    public function terima_pelatihancpkb(Request $req)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req);
        $user = Pelatihancpkb::all()->where("kode_pelatihan", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'pelatihan cpkb')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'pelatihan cpkb')
            ->where('notif_2',$req['no'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan pelatihan cpkb',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('program-dan-pelatihan-higiene-dan-sanitasi');
    }

    //pengoperasianalat
    public function terima_operasialat(Request $req)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = pengoprasianalat::where("id_operasi", $req['nobatch'])->update([
            'status' => 1,
        ]);

        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'pengoperasian alat')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'pengoprasian alat')
            ->where('notif_2',$req['nobatch'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan pengoperasiian alat',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('pengoprasian-alat');
    }


    public function terimaperiksaruang(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = periksaruang::where("id_periksaruang", $req['id'])->first()->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'Periksa Sanitasi Ruangan')->first()->update([
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = periksaruang::all()->where('status', 1);

        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'Periksa Sanitasi Ruangan')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' menerima laporan periksa sanitasi ruang',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect()->route('periksasaniruang');

    }


    //distribusi produk
    public function terima_distribusiproduk(Request $req)
    {
        // dd($req['nobatch']);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = distribusiproduk::all()->where("id_distribusi", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan::all()->where('laporan_nomor', $req['nobatch'])
            ->where('laporan_nama', 'distribusi produk')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'distribusi produk')
            ->where('notif_2',$req['nobatch'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan distribusi produk',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('pendistribusian-produk');
    }

    //penimbangan
    public function terima_penimbanganbahan(Request $req)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = timbangbahan::all()->where("no_loth", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'penimbangan bahan')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'penimbangan bahan')
            ->where('notif_2',$req['no'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan penimbangan bahan',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('penimbangan');
    }

    public function terima_penimbanganproduk(Request $req)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = timbangproduk::all()->where("no_batch", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'penimbangan produk utama')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'penimbangan produk')
            ->where('notif_2',$req['no'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan penimbangan produk',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);

        return redirect()->route('penimbangan');
    }

    public function terima_penimbanganruang(Request $req)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = ruangtimbang::all()->where("id_ruangtimbang", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan::all()->where('laporan_nomor', $req['nobatch'])
            ->where('laporan_nama', 'ruang timbang')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'ruang penimbangan')
            ->where('notif_2',$req['no'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan ruang timbang',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('penimbangan');
    }

    //pelulusan produk
    public function terima_pelulusanproduk(Request $req)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req['nobatch']);
        $user = pelulusanproduk::all()->where("no_batch", $req['nobatch'])->first()->update([
            'status' => 1,
        ]);

        laporan::all()->where('laporan_batch', $req['nobatch'])
            ->where('laporan_nama', 'pelulusan produk jadi')->first()->update([
                'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
                'tgl_diterima' => $tgl
            ]);
            notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'pelulusan produk')
            ->where('notif_2',$req['no'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan pelulusan produk',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);

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
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'Penanganan Keluhan')->first()->update([
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'Penanganan Keluhan')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);
        $data = penanganankeluhan::all()->where('status', 1);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' menerima laporan penanganan keluhan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);


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
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = penarikanproduk::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'penarikan produk')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan penarikan produk',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
            
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
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'pemusnahan bahan baku')->first()->update([
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = pemusnahanbahanbaku::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'pemusnahan bahan baku')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan pemusnahan bahan baku',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
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
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = Pemusnahanbahankemas::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'pemusnahan bahan kemas')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan pemusnahan bahan kemas',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
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
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = Pemusnahanprodukantara::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'pemusnahan produk antara')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan pemusnahan produk antara',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);

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
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = Pemusnahanprodukjadi::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'pemusnahan produk jadi')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan pemusnahan produk jadi',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
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
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'Kartu Stok Bahan Baku')->first()->update([
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = kartustokbahan::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'Kartu Stok Bahan Baku')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan kartu stok bahan baku',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
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
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'kartu stok bahan kemas')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);
            
        $data = kartustokbahankemas::all()->where('status', 1);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menerima laporan kartu stok bahan kemas',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

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
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = kartustokprodukjadi::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'kartu stok produk jadi')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan kartu stok produk jadi',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('kartu-stok');
    }
    public function terima_stokprodukantara(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = kartustokprodukantara::where("id_kartustokprodukantara", $req['id'])->update([
            'status' => 1,
        ]);
        laporan::all()->where('laporan_nomor', $req['id'])->where('laporan_nama', 'kartu stok produk antara')->first()->update([
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = kartustokprodukantara::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'kartu stok produk antara')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan kartu stok produk antara',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
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
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = Spesifikasibahanbaku::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'Pemeriksaan Bahan Baku')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan Pemeriksaan Bahan Baku',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);

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
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = Spesifikasibahankemas::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'Pemeriksaan Bahan Kemas')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan Pemeriksaan Bahan Kemas',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
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
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);
        $data = Spesifikasiprodukjadi::all()->where('status', 1);
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'Pemeriksaan Produk Jadi')
            ->where('notif_2',$req['id'])->first()->update([
                'notif_3'  => 1
            ]);

            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan Pemeriksaan Produk Jadi',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('pemeriksaan-bahan');
    }

    //higiene dan sanitasi

    public function terima_periksaalat(Request $req) {
        // dd($req['id']);
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $pabrik = Auth::user()->pabrik;
        $user = Periksaalat::where("id_periksaalat", $req['id_periksaalat'])->update([
            'status' => 1,
        ]);

        
        laporan::all()->where('laporan_nomor', $req['id_periksaalat'])->where('laporan_nama', 'periksa sanitasi alat')->first()->update([
            'laporan_diterima' =>  Auth::user()->namadepan.' '.Auth::user()->namabelakang,
            'tgl_diterima' => $tgl
        ]);

        $data = periksaalat::all()->where('status', 1);
        
        notif::all()->where('id_pabrik', Auth::user()->pabrik)
            ->where('notif_laporan', 'pemeriksaan sanitasi alat')
            ->where('notif_2',$req['id_periksaalat'])->first()->update([
                'notif_3'  => 1
            ]);

            
            $log = [
                'log_isi' => Auth::user()->namadepan . ' menerima laporan pemeriksaan sanitasi alat',
                'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            log::insert($log);
        return redirect()->route('periksasanialat');
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
            ->where('kategori', 4);
        return view('spesifikasi.produkjadi', ['list' => $data]);
    }

    public function tambah_bahan_baku(Request $req)
    {
        $file = $req->file('upload');
        $exten = $file->getClientOriginalExtension();
        $nama = Str::random(10).$req['nama'] . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten;
        $tujuan_upload = 'asset/coa/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->pabrik;
        $hasil = [
            'file' => $nama,
            'kategori' => 1,
            'keterangan' => $req['nama'],
            'pabrik_id' => $id,
        ];

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah spesifikasi bahan baku',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        spesifikasi::insert($hasil);
        // // user::deleted()
        
        return redirect('/spek_bahan_baku')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function tambah_bahan_kemas(Request $req)
    {
        $file = $req->file('upload');
        $exten = $file->getClientOriginalExtension();
        $nama = Str::random(10).$req['nama'] . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten;
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

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah spesifikasi bahan kemas',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);


        return redirect('/spek_bahan_kemas')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function tambah_produk_antara(Request $req)
    {
        $file = $req->file('upload');
        $exten = $file->getClientOriginalExtension();
        $nama = Str::random(10).$req['nama'] . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten;
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

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah spesifikasi produk antara',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/spek_produk_antara')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function tambah_produk_jadi(Request $req)
    {
        $file = $req->file('upload');
        $exten = $file->getClientOriginalExtension();
        $nama = Str::random(10).$req['nama'] . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten;
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

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah spesifikasi produk jadi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);


        return redirect('/spek_produk_jadi')->with('success', 'Data Berhasil Ditambahkan!');;
    }

    public function hapus_bahanbaku(Request $req)
    {
        $data = spesifikasi::all()->where('spesifikasi_id', $req->idBB)->first();
        // dd($data);
        unlink("asset/coa/" . $data->file);


        $post = spesifikasi::all()->where('spesifikasi_id', $req->idBB)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menghapus spesifikasi bahan baku',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);


        return redirect('/spek_bahan_baku')->with('success', 'Data Berhasil Dihapus!');
    }

    public function hapus_bahankemas(Request $req)
    {
        $data = spesifikasi::all()->where('spesifikasi_id', $req->idBB)->first();
        // dd($data);
        unlink("asset/coa/" . $data->file);
        $post = spesifikasi::all()->where('spesifikasi_id', $req->idBB)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menghapus spesifikasi bahan kemas',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/spek_bahan_kemas')->with('success', 'Data Berhasil Dihapus!');
    }

    public function hapus_produkjadi(Request $req)
    {
        $data = spesifikasi::all()->where('spesifikasi_id', $req->idBB)->first();
        // dd($data);
        unlink("asset/coa/" . $data->file);
        $post = spesifikasi::all()->where('spesifikasi_id', $req->idBB)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menghapus spesifikasi produk jadi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/spek_produk_jadi')->with('success', 'Data Berhasil Dihapus!');
    }

    public function hapus_produkantara(Request $req)
    {
        $data = spesifikasi::all()->where('spesifikasi_id', $req->idBB)->first();
        // dd($data);
        unlink("asset/coa/" . $data->file);
        $post = spesifikasi::all()->where('spesifikasi_id', $req->idBB)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menghapus spesifikasi produk antara',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/spek_produk_antara')->with('success', 'Data Berhasil Dihapus!');;
    }
}
