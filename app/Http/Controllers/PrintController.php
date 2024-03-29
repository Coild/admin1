<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{contohbahanbaku, contohkemasan, contohprodukjadi, cp_bahan, cp_kemasan, cp_produk, detilalat, Detiloperasialat, Detilperiksaalat, distribusiproduk, pengolahanbatch, komposisi, laporan, pabrik, Pelatihancpkb, pelulusanproduk, pemusnahanbahanbaku, Pemusnahanbahankemas, Pemusnahanprodukantara, Pemusnahanprodukjadi, penanganankeluhan, penarikanproduk, Pengemasanbatchproduk, pengoprasianalat, peralatan, penimbangan, periksaruang, PPbahanbakukeluar, PPbahanbakumasuk, PPkemasankeluar, PPkemasanmasuk, PPprodukjadikeluar, PPprodukjadimasuk, pr_bahankemas, programpelatihan, prosedur_isi, prosedur_tanda, protap, rekonsiliasi, Spesifikasibahanbaku, Spesifikasibahankemas, Spesifikasiprodukjadi, Detilruangan, Kalibrasialat, Periksaalat};
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
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = pengolahanbatch::all()->where('nomor_batch', $id);
        $kom = komposisi::all()->where('nomor_batch', $id);
        $kop = laporan::all()->where('laporan_batch', $id)->where('laporan_nama', 'pengolahan batch');
        $alat = peralatan::all()->where('nomor_batch', $id);
        $nimbang = penimbangan::all()->where('nomor_batch', $id);
        $rekon = rekonsiliasi::all()->where('id_batch', $id);
        return view('print.pengolahanbatch', [
            'data' => $data, 'list_kom' => $kom, 'list_alat' => $alat, 'list_nimbang' => $nimbang,
            'kop' => $kop, 'rekon' => $rekon, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_pengemasanbatch(Request $req)
    {
        $id = $req['nobatch'];
        // dd($id);
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = Pengemasanbatchproduk::all()->where('id_pengemasanbatchproduk', $id)->first();

        $kop = laporan::all()->where('laporan_nomor', $id)->where('laporan_nama', 'pengemasan batch produk');
        $prkemas = pr_bahankemas::all()->where('id_kemasbatch', $id);
        $proisi = prosedur_isi::all()->where('id_kemas', $id);
        $protanda  = prosedur_tanda::all()->where('id_kemas', $id);
        return view('print.pengemasanbatch', [
            'data' => $data,
            'kop' => $kop,  'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'prkemas' => $prkemas, 'proisi' => $proisi, 'protanda' => $protanda,
            'nohp' => $nohp
        ]);
    }

    public function cetak_ambilbahankemas(Request $req)
    {
        $id = $req['id'];
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = contohkemasan::all()->where('id_kemasan', $id)->first();
        // dd($nama);
        // $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'penambahan contoh kemasan');
        $protap = protap::all()->where('protap_id', $data['protap'])->first();
        
        return view('print.ambilbahankemas', [
            'data' => $data, 'protap' => $protap, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_ambilbahanbaku(Request $req)
    {
        $id = $req['id'];
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = contohbahanbaku::all()->where('id_bahanbaku', $req['id']);
        // dd($req['id']);
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'penambahan contoh bahan baku');
        // dd($kop);
        return view('print.ambilbahanbaku', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_ambilprodukjadi(Request $req)
    {

        $id = $req['id'];
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = contohprodukjadi::all()->where('id_produkjadi', $id)->first();
        // dd($data);
        // $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'penambahan contoh produk');
        $protap = protap::all()->where('protap_id', $data['protap'])->first();
        return view('print.ambilprodukjadi', [
            'data' => $data, 'protap' => $protap, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_latihhigisani(Request $req)
    {
        $id = $req['id'];
        // $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'pelatihan higiene dan sanitasi');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = programpelatihan::all()->where('id_programpelatihan', $id)->first();
        // dd($data);
        $protap = protap::all()->where('protap_id', $data['protap'])->first();
        return view('print.pelatihanhigisani', [
            'data' => $data, 'protap' => $protap, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_latihcpkb(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'pelatihan higiene dan sanitasi');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = Pelatihancpkb::all()->where('id_pelatihancpkb', $id)->first();
        // dd($data);
        $protap = protap::all()->where('protap_id', $data['protap'])->first();
        return view('print.pelatihanhigisani', [
            'data' => $data, 'protap' => $protap, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }


    public function cetak_terimabahan(Request $req)
    {
        $id = $req['id'];
        // $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = cp_bahan::all()->where('cp_bahan_id', $id)->first();
        $keluar = PPbahanbakukeluar::all()->where('induk', $id);
        $masuk = PPbahanbakumasuk::all()->where('induk', $id);
        $protap = protap::all()->where('protap_id',$data['protap'])->first();
        // dd(count($keluar));
        return view('print.terimakeluarbahanawal', [
            'keluar' => $keluar, 'masuk' => $masuk,  'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'data' => $data, 'nohp' => $nohp, 'protap' => $protap,
        ]);
    }

    public function cetak_terimaproduk(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = cp_produk::all()->where('cp_produk_id', $id)->first();
        $keluar = PPprodukjadikeluar::all()->where('induk', $id);
        $masuk = PPprodukjadimasuk::all()->where('induk', $id);
        $protap = protap::all()->where('protap_id',$data['protap'])->first();
        // dd($data);
        $protap = protap::all()->where('protap_id',$data['protap'])->first();
        return view('print.terimakeluarproduk', [
            'data' => $data, 'nohp' => $nohp, 'protap' => $protap,
            'keluar' => $keluar, 'masuk' => $masuk, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama
        ]);
    }

    public function cetak_terimakemasan(Request $req)
    {
        $id = $req['id'];
        // $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = cp_kemasan::all()->where('cp_kemasan_id', $id)->first();
        $keluar = PPkemasankeluar::all()->where('induk', $id);
        $masuk = PPkemasanmasuk::all()->where('induk', $id);
        // dd($data);
        $protap = protap::all()->where('protap_id',$data['protap'])->first();
        return view('print.terimakeluarkemasan', [
            'data' => $data, 'nohp' => $nohp, 'protap' => $protap,
            'keluar' => $keluar, 'masuk' => $masuk, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama
        ]);
    }


    public function cetak_alatutama(Request $req)
    {
        $id = $req['id'];
        // $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'penerimaan bahan')->first();
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = pengoprasianalat::all()->where('id_operasi', $id)->first();
        $isi = Detiloperasialat::all()->where('id_induk', $id);
        // dd($i    si);
        $protap = protap::all()->where('protap_id', $data['pob'])->first();
        return view('print.alatutama', [
            'data' => $data, 'protap' => $protap, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'isi' => $isi, 'nohp' => $nohp
        ]);
    }

    public function cetak_distribusiproduk(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'penerimaan bahan')->first();
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = distribusiproduk::all()->where('id_distribusi', $id)->first();
        return view('print.distribusiproduk', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_penanganankeluhan(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        // $data = penanganankeluhan::all()->where('id_penanganankeluhan', $id)->first();
        // dd($data);
        $data = penanganankeluhan::join('protaps', 'penanganankeluhans.protap', '=', 'protaps.protap_id')
            ->get(['penanganankeluhans.*', 'protaps.*'])->first();
        // dd($data);
        return view('print.penanganankeluhan', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_pelulusanproduk(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = pelulusanproduk::all()->where('id_pelulusan', $id)->first();
        // dd($data);
        return view('print.pelulusanproduk', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_penarikanproduk(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nama', 'penerimaan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        // $data = penarikanproduk::all()->where('id_produk_penarikan', $id)->first();
        // dd($data);
        $data = penarikanproduk::join('protaps', 'penarikanproduks.protap', '=', 'protaps.protap_id')
            ->get(['penarikanproduks.*', 'protaps.*'])->first();
        return view('print.penarikanproduk', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_pemusnahanprodukjadi(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nama', 'pemusnahan produk jadi');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = Pemusnahanprodukjadi::all()->where('id_pemusnahanprodukjadi', $id)->first();
        // dd($data);
        return view('print.pemusnahanprodukjadi', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_pemusnahanprodukantara(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nama', 'pemusnahan produk antara');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = Pemusnahanprodukantara::all()->where('id_pemusnahanprodukantara', $id)->first();
        // dd($data);
        return view('print.pemusnahanprodukantara', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_pemusnahanbahan(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nama', 'pemusnahan bahan');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = pemusnahanbahanbaku::all()->where('id_pemusnahanbahan', $id)->first();
        // dd($data);
        return view('print.pemusnahanbahan', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_pemusnahanbahankemas(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nama', 'pemusnahan bahan kemas');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = Pemusnahanbahankemas::all()->where('id_pemusnahanbahankemas', $id)->first();
        // dd($data);
        return view('print.pemusnahanbahankemas', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }


    public function cetak_periksaruang(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'periksa sanitasi ruangan');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = periksaruang::all()->where('id_peperiksaruang', $id)->first();
        // dd($data);
        return view('print.penanganankeluhan', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_pemeriksaansanitasialat(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'periksa sanitasi alat');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = Periksaalat::all()->where('id_periksaalat', $id)->first();

        $dataProtap = protap::all()->where('protap_id', $data->pob_nomor)->first();
        // dd($data);
        $dataDetil = Detilperiksaalat::all()->where('id_induk', $id);
        // dd($dataDetil);
        return view('print.pembersihanalat', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp, 'dataDetil' => $dataDetil, 'dataProtap' => $dataProtap
        ]);
    }

    public function cetak_periksabahanbaku(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'Pemeriksaan Bahan Baku');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = Spesifikasibahanbaku::all()->where('id_spesifikasibahanbaku', $id)->first();
        // dd($data);
        return view('print.periksabahanbaku', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_periksaprodukjadi(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'Pemeriksaan Produk Jadi');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = Spesifikasiprodukjadi::all()->where('id_spesifikasiprodukjadi', $id)->first();
        // dd($data);
        return view('print.periksaprodukjadi', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_periksabahankemas(Request $req)
    {
        $id = $req['id'];
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'Pemeriksaan Bahan Kemas');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        $data = Spesifikasibahankemas::all()->where('id_spesifikasiproSpesifikasibahankemas', $id)->first();
        // dd($data);
        return view('print.periksabahankemas', [
            'data' => $data, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }


    public function cetak_kalibrasialat(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        // echo "ini ".$id;
        // dd($req);
        $data = Kalibrasialat::all()->where('kalibrasi_id', $id)->first();
        // dd($data);
        return Redirect('/asset/kalibrasi_alat/'.$data['nama_file']);
        // return view('print.ambilprodukjadi');
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
        // dd($id);
        $kop = laporan::all()->where('laporan_nomor', $id)->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->where('laporan_nama', 'periksa sanitasi ruangan');
        $datapabrik = pabrik::all()->where('pabrik_id', $id = $req['pabrik'] ?? Auth::user()->pabrik)->first();
        // dd($datapabrik);
        $logo = $datapabrik['logo'];
        $alamat = $datapabrik['alamat'];
        $nama = $datapabrik['nama'];
        $nohp = $datapabrik['no_hp'];
        // $data = periksaruang::all()->where('id_periksaruang', $id)->first();
        $dataDetail = Detilruangan::all()->where('id_induk', $id);
        // dd($dataDetail);
        $data = periksaruang::join('protaps', 'periksaruangs.nomer_prosedur', 'protaps.protap_id')
            ->get(['periksaruangs.*', 'protaps.protap_nama'])->first();

        // dd($data);
            return view('print.pembersihanruangan', [
            'data' => $data, 'dataDetail' => $dataDetail, 'kop' => $kop, 'alamat' => $alamat, 'logo' => $logo, 'nama' => $nama,
            'nohp' => $nohp
        ]);
    }

    public function cetak_terimakeluarbahanawal(Request $req)
    {
        $id = $req['id'];
        // $id = Session::get('data');
        echo "ini " . $id;
        return view('print.terimakeluarbahanawal');
    }
}
