<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{contohbahanbaku, contohkemasan, contohprodukjadi, cp_bahan, cp_kemasan, cp_produk, distribusiproduk, pengolahanbatch, komposisi, laporan, pabrik, Pelatihancpkb, pemusnahanbahanbaku, Pemusnahanbahankemas, Pemusnahanprodukantara, Pemusnahanprodukjadi, penanganankeluhan, penarikanproduk, pengoprasianalat, peralatan, penimbangan, PPbahanbakukeluar, PPbahanbakumasuk, PPkemasankeluar, PPkemasanmasuk, PPprodukjadikeluar, PPprodukjadimasuk, programpelatihan, protap, rekonsiliasi};
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PrintController extends Controller
{

    public function dummy()
    {
        // $id ="sayaa";
        $search = "Bahan Baku";
        $id = protap::all()->where('protap_jenis', 24)->where('protap_nama', 'Bahan Baku');
        dd($id ?? "kosong");
        // return redirect()->route('ambilbahankemas',['id' =>1]);
        // return Redirect::route('ambilbahankemas', ['id' => 1]);//->with(['data' => $id]);
    }

    public function cetak_pengolahanbatch(Request $req)
    {
        $id = $req['nobatch'];
        // dd($id);
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = pengolahanbatch::all()->where('nomor_batch', $id);
        $kom = komposisi::all()->where('nomor_batch', $id);
        $kop = laporan::all()->where('laporan_batch', $id)->where('laporan_nama', 'pengolahan batch');
        $alat = peralatan::all()->where('nomor_batch', $id);
        $nimbang = penimbangan::all()->where('nomor_batch', $id);
        $rekon = rekonsiliasi::all()->where('id_batch', $id);
        return view('print.pengolahanbatch', [
            'data' => $data, 'list_kom' => $kom, 'list_alat' => $alat, 'list_nimbang' => $nimbang,
            'kop' => $kop, 'rekon' => $rekon,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
        ]);
    }

    public function cetak_ambilbahankemas(Request $req)
    {
        $id = $req['id'];
         $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = contohkemasan::all()->where('id_kemasan', $id)->first();
        // dd($nama);
        $kop = laporan::all()->where('laporan_nomor' ,$id)->where('laporan_nomor' ,$id)->where('laporan_nama', 'penambahan contoh kemasan');
        // dd($data);
        return view('print.ambilbahankemas', ['data' => $data, 'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_ambilbahanbaku(Request $req)
    {
        $id = $req['id'];
         $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = contohbahanbaku::all()->where('id_bahanbaku', $id);
        // dd($id);
        $kop = laporan::all()->where('laporan_nomor' ,$id)->where('laporan_nama', 'penambahan contoh bahan baku');
        // dd($kop);
        return view('print.ambilbahanbaku', ['data' => $data, 'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_ambilprodukjadi(Request $req)
    {

        $id = $req['id'];
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = contohprodukjadi::all()->where('id_produkjadi', $id)->first();
        // dd($data);
        $kop = laporan::all()->where('laporan_nomor' ,$id)->where('laporan_nama', 'penambahan contoh produk');
        // dd($kop);
        return view('print.ambilprodukjadi', ['data' => $data, 'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_latihhigisani(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor' ,$id)->where('laporan_nama', 'pelatihan higiene dan sanitasi');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = programpelatihan::all()->where('id_programpelatihan', $id)->first();
        // dd($data);
        return view('print.pelatihanhigisani',['data' => $data,'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_latihcpkb(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor' ,$id)->where('laporan_nama', 'pelatihan higiene dan sanitasi');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = Pelatihancpkb::all()->where('id_pelatihancpkb', $id)->first();
        // dd($data);
        return view('print.pelatihanhigisani',['data' => $data,'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }


    public function cetak_terimabahan(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor' ,$id)->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = cp_bahan::all()->where('cp_bahan_id', $id)->first();
        $keluar = PPbahanbakukeluar::all()->where('induk', $id);
        $masuk = PPbahanbakumasuk::all()->where('induk', $id);
        // dd($data);
        return view('print.terimakeluarbahanawal',['data' => $data,
        'keluar' => $keluar, 'masuk' => $masuk, 'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_terimaproduk(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor' ,$id)->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = cp_produk::all()->where('cp_bahan_id', $id)->first();
        $keluar = PPprodukjadikeluar::all()->where('induk', $id);
        $masuk = PPprodukjadimasuk::all()->where('induk', $id);
        // dd($data);
        return view('print.terimakeluarbahanawal',['data' => $data,
        'keluar' => $keluar, 'masuk' => $masuk, 'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_terimakemasan(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor' ,$id)->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = cp_kemasan::all()->where('cp_bahan_id', $id)->first();
        $keluar = PPkemasankeluar::all()->where('induk', $id);
        $masuk = PPkemasanmasuk::all()->where('induk', $id);
        // dd($data);
        return view('print.terimakeluarbahanawal',['data' => $data,
        'keluar' => $keluar, 'masuk' => $masuk, 'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }


    public function cetak_alatutama(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor' ,$id)->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = pengoprasianalat::all()->where('id_operasi', $id)->first();
        return view('print.alatutama',['data' => $data,'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_distribusiproduk(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor' ,$id)->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = distribusiproduk::all()->where('id_distribusi', $id)->first();
        return view('print.distribusiproduk',['data' => $data,'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_penanganankeluhan(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor' ,$id)->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = penanganankeluhan::all()->where('id_penanganankeluhan', $id)->first();
        // dd($data);
        return view('print.penanganankeluhan',['data' => $data,'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_pelulusanproduk(Request $req)
    {
        // $id = Session::get('data');
        // echo "ini ".$id;
        return " <h1> not found </h1>";
    }

    public function cetak_penarikanproduk(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = penarikanproduk::all()->where('id_produk_penarikan', $id)->first();
        // dd($data);
        return view('print.penarikanproduk',['data' => $data,'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_pemusnahanprodukjadi(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nama', 'pemusnahan produk jadi');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = Pemusnahanprodukjadi::all()->where('id_pemusnahanprodukjadi', $id)->first();
        // dd($data);
        return view('print.pemusnahanprodukjadi',['data' => $data,'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_pemusnahanprodukantara(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nama', 'pemusnahan produk antara');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = Pemusnahanprodukantara::all()->where('id_pemusnahanprodukantara', $id)->first();
        // dd($data);
        return view('print.pemusnahanprodukantara',['data' => $data,'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_pemusnahanbahan(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nama', 'pemusnahan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = pemusnahanbahanbaku::all()->where('id_pemusnahanbahan', $id)->first();
        // dd($data);
        return view('print.pemusnahanbahan',['data' => $data,'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }

    public function cetak_pemusnahanbahankemas(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nama', 'pemusnahan bahan kemas');
        $datapabrik = pabrik::all()->where('pabrik_id',Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $data = Pemusnahanbahankemas::all()->where('id_pemusnahanbahankemas', $id)->first();
        // dd($data);
        return view('print.pemusnahanbahankemas',['data' => $data,'kop' => $kop
        ,'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama]);
    }




    public function cetak_ambilbprodukjadi(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        // echo "ini ".$id;
        return view('print.ambilprodukjadi');
    }

    public function cetak_ambilbahabaku(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        // echo "ini ".$id;
        return view('print.ambilbahabaku');
    }

    public function cetak_ceklisdanttd(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        // echo "ini ".$id;
        return view('print.ceklisdanttd');
    }



    public function cetak_higidansani(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        // echo "ini ".$id;
        return view('print.higidansani');
    }

    public function cetak_pembersihanalat(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        // echo "ini ".$id;
        return view('print.pembersihanalat');
    }

    public function cetak_pembersihanmixer(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        // echo "ini ".$id;
        return view('print.pembersihanmixer');
    }

    public function cetak_pembersihanruangan(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        // echo "ini ".$id;
        return view('print.pembersihanruangan');
    }

    public function cetak_periksabahanbaku(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        // echo "ini ".$id;
        return view('print.periksabahanbaku');
    }

    public function cetak_periksaprodukjadi(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        // echo "ini ".$id;
        return view('print.periksaprodukjadi');
    }

    public function cetak_periksabahankemas(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        // echo "ini ".$id;
        return view('print.periksabahankemas');
    }

    public function cetak_terimakeluarbahanawal(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        echo "ini " . $id;
        return view('print.terimakeluarbahanawal');
    }
}
