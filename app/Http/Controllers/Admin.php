<?php

namespace App\Http\Controllers;

// use App\Models\{pabrik,bahanbaku, catatbersih, coa, company, contohbahanbaku, contohkemasan, contohprodukjadi, dip, distribusiproduk, Kalibrasialat, kartustok, kartustokbahan, kartustokbahankemas, kartustokprodukjadi, kemasan, perizinan, pobpabrik, komposisi, laporan, Pelatihancpkb, pelulusanproduk, pemusnahanbahanbaku, pemusnahanproduk, penanganankeluhan, penarikanproduk, pendistribusianproduk, pengolahanbatch, pengoprasianalat, pengorasianalat, peralatan, penimbangan, Periksaalat, Periksapersonil, periksaruang, PPbahanbakukeluar, PPbahanbakumasuk, PPkemasankeluar, PPkemasanmasuk, PPprodukjadikeluar, PPprodukjadimasuk, produk, produksi, programpelatihan, programpelatihanhiginitas, rekonsiliasi, ruangtimbang, timbangbahan, timbangproduk};
use App\Models\{aturan, jabatan, pabrik, bahanbaku, catatbersih, coa, company, contohbahanbaku, contohkemasan, contohprodukjadi, dip, distribusiproduk, Kalibrasialat, kartustok, kartustokbahan, kartustokbahankemas, kartustokprodukjadi, kemasan, perizinan, pobpabrik, komposisi, laporan, Pelatihancpkb, pelulusanproduk, pemusnahanbahanbaku, Pemusnahanbahankemas, pemusnahanproduk, Pemusnahanprodukantara, Pemusnahanprodukjadi, penanganankeluhan, penarikanproduk, pendistribusianproduk, pengolahanbatch, pengoprasianalat, pengorasianalat, peralatan, penimbangan, Periksaalat, Periksapersonil, periksaruang, PPbahanbakukeluar, PPbahanbakumasuk, PPkemasankeluar, PPkemasanmasuk, PPprodukjadikeluar, PPprodukjadimasuk, produk, produksi, programpelatihan, programpelatihanhiginitas, rekonsiliasi, ruangtimbang, timbangbahan, timbangproduk};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    public function dashboard()
    {
        $pabrik = pabrik::all()->where('pabrik_id', Auth::user()->pabrik);
        foreach ($pabrik as $data) {
            $struktur = $data['struktur'];
        }

        $isibaru = aturan::all()->where('kategori', 'Aturan Baru')->sortByDesc('tgl_upload')->first();
        $isiproduk = aturan::all()->where('kategori', 'Aturan Produk')->sortByDesc('tgl_upload')->first();
        $isipabrik = aturan::all()->where('kategori', 'Aturan Pabrik')->sortByDesc('tgl_upload')->first();
        $isiiklan = aturan::all()->where('kategori', 'Aturan Iklan')->sortByDesc('tgl_upload')->first();

        $baru = isset($isibaru) ? 'asset/aturam/' . $isibaru['nama'] : '#';
        $pabrik = isset($isipabrik['nama']) ?  'asset/aturam/' . $isipabrik['nama'] : '#';
        $produk = isset($isiproduk) ?  'asset/aturam/' . $isiproduk['nama'] : '#';
        $iklan = isset($isiiklan) ?  'asset/aturam/' . $isiiklan['nama'] : '#';

        return view('dashboard', ['struktur' => $struktur ??  '', 'baru' => $baru, 'produk' => $produk, 'pabrik' => $pabrik, 'iklan' => $iklan]);
    }

    //COA
    public function tampil_coa()
    {
        $id = Auth::user()->pabrik;
        $data = coa::all()->where('user_id', $id);
        return view('/coa', ['list_coa' => $data]);
    }

    public function hapus_coa($id)
    {
        $data = coa::all()->where('coa_id', $id);
        // dd($data);
        unlink("asset/coa/" . $data[0]['coa_file']);
        $post = coa::all()->where('coa_id', $id)->each->delete();

        return redirect('/coa');
    }

    public function tambah_coa(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/coa/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->pabrik;
        $hasil = [
            'coa_file' => $nama,
            'coa_nama' => $req['nama'],
            'user_id' => $id,
        ];

        coa::insert($hasil);
        // // user::deleted()
        return redirect('/coa');
    }

    //DIP
    public function tampil_dip()
    {
        $id = Auth::user()->pabrik;
        $data = dip::all()->where('user_id', $id);
        return view('/dip', ['list_dip' => $data]);
    }

    public function hapus_dip($id)
    {
        $data = dip::all()->where('dip_id', $id);
        // dd($data);
        unlink("asset/dip/" . $data[0]['dip_file']);
        $post = dip::all()->where('dip_id', $id)->each->delete();

        return redirect('/dip');
    }

    public function tambah_dip(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/dip/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->pabrik;
        $hasil = [
            'dip_file' => $nama,
            'dip_nama' => $req['nama'],
            'user_id' => $id,
        ];

        dip::insert($hasil);
        // // user::deleted()
        return redirect('/dip');
    }

    //perizinan
    public function tampil_perizinan()
    {
        $id = Auth::user()->pabrik;
        $data = perizinan::all()->where('user_id', $id);
        return view('/perizinan', ['list_perizinan' => $data]);
    }

    public function hapus_perizinan($id)
    {
        $data = perizinan::all()->where('perizinan_id', $id);
        // dd($data);
        unlink("asset/perizinan/" . $data[0]['perizinan_file']);
        $post = perizinan::all()->where('perizinan_id', $id)->each->delete();

        return redirect('/perizinan');
    }

    public function tambah_perizinan(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/perizinan/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->pabrik;
        $hasil = [
            'perizinan_file' => $nama,
            'perizinan_nama' => $req['nama'],
            'user_id' => $id,
        ];

        perizinan::insert($hasil);
        // // user::deleted()
        return redirect('/perizinan');
    }

    //DIP
    public function tampil_jabatan()
    {
        $id = Auth::user()->pabrik;
        $data = jabatan::all()->where('user_id', $id);
        return view('jabatanpersonil', ['list_dip' => $data]);
    }

    public function hapus_jabatan($id)
    {
        $data = jabatan::all()->where('jabatan_id', $id);
        // dd($data);
        unlink("asset/dip/" . $data[0]['jabatan_file']);
        $post = jabatan::all()->where('jabatan_id', $id)->each->delete();

        return redirect('/jabatan');
    }

    public function tambah_jabatan(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/dip/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->pabrik;
        $hasil = [
            'jabatan_file' => $nama,
            'jabatan_nama' => $req['nama'],
            'user_id' => $id,
        ];

        jabatan::insert($hasil);
        // // user::deleted()
        return redirect('/jabatan');
    }

    //pob
    public function tampil_pobpabrik()
    {
        $id = Auth::user()->id;
        $data = pobpabrik::all()->where('user_id', $id);
        return view('/pobpabrik', ['list_pobpabrik' => $data]);
    }

    public function hapus_pobpabrik($id)
    {
        $data = pobpabrik::all()->where('pobpabrik_id', $id);
        // dd($data);
        unlink("asset/pobpabrik/" . $data[0]['pobpabrik_file']);
        $post = pobpabrik::all()->where('pobpabrik_id', $id)->each->delete();

        return redirect('/pobpabrik');
    }

    public function tambah_pobpabrik(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/pobpabrik/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->id;
        $hasil = [
            'pobpabrik_file' => $nama,
            'pobpabrik_nama' => $req['nama'],
            'user_id' => $id,
        ];

        pobpabrik::insert($hasil);
        // // user::deleted()
        return redirect('/pobpabrik');
    }

    //catat bersh ruangan

    public function tampil_penerimaanbb()
    {
        $pabrik = Auth::user()->pabrik;
        $data = PPbahanbakumasuk::all()->where('pabrik', $pabrik);
        $data1 = PPbahanbakukeluar::all()->where('pabrik', $pabrik);
        $data2 = PPprodukjadimasuk::all()->where('pabrik', $pabrik);
        $data3 = PPprodukjadikeluar::all()->where('pabrik', $pabrik);
        $data4 = PPkemasanmasuk::all()->where('pabrik', $pabrik);
        $data5 = PPkemasankeluar::all()->where('pabrik', $pabrik);
        return view('catatan.dokumen.penerimaanBB', ['data' => $data, 'data1' => $data1, 'data2' => $data2, 'data3' => $data3, 'data4' => $data4, 'data5' => $data5]);
    }
    public function tambah_penerimaanbbmasuk(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_bahan' => $req['nama_bahanbaku'],
            'no_pob' => $req['pob_no'],
            'no_loth' => $req['no_loth'],
            'pemasok' => $req['pemasok'],
            'jumlah' => $req['jumlah'],
            'no_kontrol' => $req['no_kontrol'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];
        PPbahanbakumasuk::insert($data);
        // // user::deleted()
        return redirect('penerimaanBB');
    }
    public function tambah_penerimaanbbkeluar(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_bahan' => $req['nama_bahanbaku'],
            'untuk_produk' => $req['untuk_produk'],
            'no_batch' => $req['no_batch'],
            'jumlah' => $req['jumlah'],
            'sisa' => $req['sisa'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];
        PPbahanbakukeluar::insert($data);
        // // user::deleted()
        return redirect('penerimaanBB');
    }
    public function tambah_penerimaanprdukmasuk(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_produkjadi' => $req['nama_produkjadi'],
            'no_pob' => $req['pob_no'],
            'no_loth' => $req['no_loth'],
            'pemasok' => $req['pemasok'],
            'jumlah' => $req['jumlah'],
            'no_kontrol' => $req['no_kontrol'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];
        PPprodukjadimasuk::insert($data);
        // // user::deleted()
        return redirect('penerimaanBB');
    }
    public function tambah_penerimaanprodukkeluar(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_produk' => $req['nama_produk'],
            'untuk_produk' => $req['untuk_produk'],
            'no_batch' => $req['no_batch'],
            'jumlah' => $req['jumlah'],
            'sisa' => $req['sisa'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];
        PPprodukjadikeluar::insert($data);
        // // user::deleted()
        return redirect('penerimaanBB');
    }
    public function tambah_penerimaakemasanmasuk(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_kemasan' => $req['nama_kemasan'],
            'no_pob' => $req['pob_no'],
            'no_loth' => $req['no_loth'],
            'pemasok' => $req['pemasok'],
            'jumlah' => $req['jumlah'],
            'no_kontrol' => $req['no_kontrol'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];
        PPkemasanmasuk::insert($data);
        // // user::deleted()
        return redirect('penerimaanBB');
    }
    public function tambah_penerimaankemasankeluar(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_kemasan' => $req['nama_kemasan'],
            'untuk_produk' => $req['untuk_produk'],
            'no_batch' => $req['no_batch'],
            'jumlah' => $req['jumlah'],
            'sisa' => $req['sisa'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];
        PPkemasankeluar::insert($data);
        // // user::deleted()
        return redirect('penerimaanBB');
    }
    //tampil batch
    public function tampil_pengolahanbatch()
    {
        $pabrik = Auth::user()->pabrik;
        if(Auth::user()->level==2){
            $data = pengolahanbatch::all()->where('pabrik', $pabrik)->where('status',0);
        }
        else{
        $data = pengolahanbatch::all()->where('pabrik', $pabrik);}

        return view('catatan.dokumen.pengolahanbatch', ['data' => $data]);
    }

    public function tampil_detilbatch(Request $req)
    {
        // dd($req);
        $id = $req['nobatch'];
        $data = pengolahanbatch::all()->where('nomor_batch', $id);
        $kom = komposisi::all()->where('nomor_batch', $id);
        $alat = peralatan::all()->where('nomor_batch', $id);
        $nimbang = penimbangan::all()->where('nomor_batch', $id);
        return view('catatan.dokumen.detailbatch', [
            'id' => $id,
            'data' => $data, 'list_kom' => $kom, 'list_alat' => $alat, 'list_nimbang' => $nimbang
        ]);
    }

    public function tampil_detilbatchid($id)
    {
        // dd($req);
        // $id = $req['nobatch'];
        $data = pengolahanbatch::all()->where('nomor_batch', $id);
        $kom = komposisi::all()->where('nomor_batch', $id);
        $alat = peralatan::all()->where('nomor_batch', $id);
        $nimbang = penimbangan::all()->where('nomor_batch', $id);
        $olah = produksi::all()->where('id_batch', $id);
        $rekon = rekonsiliasi::all()->where('id_batch', $id);
        return view('catatan.dokumen.detailbatch', [
            'id' => $id,
            'data' => $data, 'list_kom' => $kom, 'list_alat' => $alat, 'list_nimbang' => $nimbang,
            'list_olah' => $olah, 'rekon' => $rekon
        ]);
    }

    public function ajukan_batch($id)
    {
        $user = pengolahanbatch::all()->where("nomor_batch", $id)->first()->update([
            'status' => 1,
        ]);
        $data = pengolahanbatch::all()->where('nomor_batch', $id);
        $kom = komposisi::all()->where('nomor_batch', $id);
        $alat = peralatan::all()->where('nomor_batch', $id);
        $nimbang = penimbangan::all()->where('nomor_batch', $id);
        $olah = produksi::all()->where('id_batch', $id);
        $rekon = rekonsiliasi::all()->where('id_batch', $id);
        return view('catatan.dokumen.detailbatch', [
            'id' => $id,
            'data' => $data, 'list_kom' => $kom, 'list_alat' => $alat, 'list_nimbang' => $nimbang,
            'list_olah' => $olah, 'rekon' => $rekon
        ]);
    }

    public function tambah_batch(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'pob' => $req['pob'],
            'kode_produk' => $req['kode_produk'],
            'nama_produk' => $req['nama_produk'],
            'nomor_batch' => $req['no_batch'],
            'besar_batch' => $req['besar_batch'],
            'bentuk_sedia' => $req['bentuk_sediaan'],
            'kategori' => $req['kategori'],
            'kemasan' => $req['kemasan'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = pengolahanbatch::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        $laporan = [
            'laporan_nama' => 'pengolahan batch',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        // dd($hasil);
        laporan::insert($laporan);
        return redirect('/pengolahanbatch');
    }

    //komposisi
    public function tambah_komposisi(Request $req)
    {
        $id = Auth::user()->id;
        $nobatch = $req['nobatch'];
        $hasil = [
            'komposisi_id' => $req['id'],
            'kompisisi_nama' => $req['nama'],
            'komposisi_persen' => $req['persen'],
            'nomor_batch' => $nobatch,
            'user_id' => $id,
        ];

        komposisi::insert($hasil);

        $to = $req['nobatch'];
        return redirect('/detil_batch/' . $to);
    }

    //peralatan
    public function tambah_peralatan(Request $req)
    {
        $id = Auth::user()->id;
        $nobatch = $req['nobatch'];
        $hasil = [
            'peralatan_id' => $req['kode'],
            'peralatan_nama' => $req['nama'],
            'nomor_batch' => $nobatch,
            'user_id' => $id,
        ];

        peralatan::insert($hasil);

        $to = $req['nobatch'];
        return redirect('/detil_batch/' . $to);
    }

    //catat penimbangan
    public function tambah_penimbangan(Request $req)
    {
        $id = Auth::user()->id;
        $nobatch = $req['nobatch'];
        $hasil = [
            'penimbangan_kodebahan' => $req['kode_bahan'],
            'penimbangan_namabahan' => $req['nama_bahan'],
            'penimbangan_loth' => $req['no_loth'],
            'penimbangan_jumlahbutuh' => $req['jumlah_butuh'],
            'penimbangan_jumlahtimbang' => $req['jumlah_timbang'],
            'penimbangan_timbangoleh' => $req['ditimbang'],
            'penimbangan_periksaoleh' => $req['diperiksa'],
            'nomor_batch' => $nobatch,
            'user_id' => $id,
        ];

        penimbangan::insert($hasil);

        $to = $req['nobatch'];
        return redirect('/detil_batch/' . $to);
    }

    //olah
    public function tambah_olah(Request $req)
    {
        $id = Auth::user()->id;
        $nobatch = $req['nobatch'];
        $hasil = [
            'isi' => $req['isi'],
            'id_batch' => $nobatch,
            'user_id' => $id,
        ];

        produksi::insert($hasil);

        $to = $req['nobatch'];
        return redirect('/detil_batch/' . $to);
    }

    public function tambah_rekonsiliasi(Request $req)
    {
        $id = Auth::user()->id;
        $nobatch = $req['nobatch'];
        $hasil = [
            'awal' => $req['awal'],
            'akhir' => $req['akhir'],
            'id_batch' => $nobatch,
            'user_id' => $id,
        ];

        rekonsiliasi::insert($hasil);

        $to = $req['nobatch'];
        return redirect('/detil_batch/' . $to);
    }

    public function hapus_komposisi($id, $to)
    {

        $data = komposisi::all()->where('komposisi_id', $id);
        $post = komposisi::all()->where('komposisi_id', $id)->each->delete();
        return redirect('/detil_batch/' . $to);
    }

    public function hapus_peralatan($id, $to)
    {
        $data = peralatan::all()->where('peralatan_id', $id);
        $post = peralatan::all()->where('peralatan_id', $id)->each->delete();

        return redirect('/detil_batch/' . $to);
    }

    public function hapus_penimbangan($id, $to)
    {
        $data = penimbangan::all()->where('penimbangan_id', $id);
        $post = penimbangan::all()->where('penimbangan_id', $id)->each->delete();

        return redirect('/detil_batch/' . $to);
    }

    public function hapus_olah($id, $to)
    {
        $data = produksi::all()->where('produksi_id', $id);
        $post = produksi::all()->where('produksi_id', $id)->each->delete();

        return redirect('/detil_batch/' . $to);
    }

    public function hapus_rekonsiliasi($id, $to)
    {
        $data = rekonsiliasi::all()->where('rekonsiliasi_id', $id);
        $post = rekonsiliasi::all()->where('rekonsiliasi_id', $id)->each->delete();

        return redirect('/detil_batch/' . $to);
    }

    public function tambah_company(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/logo/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->pabrik;
        $user = pabrik::all()->where("pabrik_id", $id)->first()->update([
            'alamat' => $req['alamat'],
            'no_hp' => $req['telp'],
            'logo' => $nama,
        ]);

        return redirect('/setting');
    }

    public function tambah_produk(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'produk_nama' => $req['nama'],
            'produk_kode' => $req['kode'],
            'user_id' => $id,
        ];

        produk::insert($hasil);
        // // user::deleted()
        return redirect('/setting');
    }

    public function tambah_kemasan(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'kemasan_nama' => $req['nama'],
            'user_id' => $id,
        ];

        kemasan::insert($hasil);
        // // user::deleted()
        return redirect('/setting');
    }

    public function tambah_bahanbaku(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'bahanbaku_nama' => $req['nama'],
            'bahanbaku_kode' => $req['kode'],
            'user_id' => $id,
        ];

        bahanbaku::insert($hasil);
        // // user::deleted()
        return redirect('/setting');
    }

    public function hapus_produk($id)
    {
        produk::all()->where('produk_id', $id)->each->delete();
        return redirect('/setting');
    }

    public function hapus_kemasan($id)
    {
        kemasan::all()->where('kemasan_id', $id)->each->delete();
        return redirect('/setting');
    }

    public function hapus_bahanbaku($id)
    {
        bahanbaku::all()->where('bahanbaku_id', $id)->each->delete();
        return redirect('/setting');
    }




    public function tampil_setting()
    {
        if (Auth::user()->level < 0) {
            return view('tunggu');
        } else {
            $id = Auth::user()->id;
            $pabrik = pabrik::all()->where('pabrik_id', Auth::user()->pabrik);

            foreach ($pabrik as $row) {
                $nama = $row['nama'];
                $alamat = $row['alamat'] ?? 'kosong';
                $no_hp = $row['no_hp'];
                $logo = $row['logo'];
            }
            $kom = company::all()->where('user_id', $id);
            $produk = produk::all()->where('user_id', $id);
            $kemasan = kemasan::all()->where('user_id', $id);
            $bahanbaku = bahanbaku::all()->where('user_id', $id);
            return view('setting', [
                'alamat' => $alamat, 'no_hp' => $no_hp, 'nama' => $nama, 'logo' => $logo,
                'list_com' => $kom, 'list_produk' => $produk, 'list_kemasan' => $kemasan, 'list_bahanbaku' => $bahanbaku
            ]);
        }
    }

    public function tampil_laporan()
    {
        $data = laporan::all()->where('laporan_diterima', '!=', 'belum');
        return view('laporan', ['batch' => $data]);
    }

    public function tampil_periksapersonil()
    {
        $data = Periksapersonil::all()->where('laporan_diterima', '!=', 'belum');
        return view('catatan.higidansani.periksapersonil', ['data' => $data]);
    }

    public function tambah_periksapersonil(Request $req)
    {
        $file = $req->file('file');
        $exten = $file->getClientOriginalExtension();
        $nama = $req['nama_personil'] . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten;
        $tujuan_upload = 'health_personil';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nama' => $req['nama_personil'],
            'nama_file' => $nama,
            'pabrik' => $pabrik,
            'user_id' => $id,
        ];
        Periksapersonil::insert($hasil);
        return redirect('/periksapersonil');
    }

    public function tampil_periksasanialat()
    {
        $pabrik = Auth::user()->pabrik;
        $data1 = periksaruang::all();
        $data = Periksaalat::all()->where('pabrik', $pabrik);
        return view('catatan.higidansani.periksasanialat', ['data' => $data, 'data1' => $data1]);
    }
    public function tambah_periksaalat(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'tanggal' => $req['tanggal'],
            'nama_ruangan' => $req['nama_ruangan'],
            'nama_alat' => $req['nama_alat'],
            'bagian_alat' => $req['bagian_alat'],
            'cara_pembersihan' => $req['cara_pembersihan'],
            'pelaksana' => $req['pelaksana'],
            'keterangan' => $req['keterangan'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = Periksaalat::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'periksa sanitasi alat',
            'laporan_batch' => $req['no_batch'] ?? 0,
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/periksasanialat');
    }
    public function tampil_periksasaniruang()
    {
        $pabrik = Auth::user()->pabrik;
        $data = periksaruang::all()->where('pabrik', $pabrik);
        return view('catatan.higidansani.periksasaniruang', ['data' => $data]);
    }
    public function tambah_periksaruang(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'tanggal' => $req['tanggal'],
            'waktu' => $req['waktu'],
            'nama_ruangan' => $req['nama_ruangan'],
            'lantai' => $req['lantai'],
            'dinding' => $req['dinding'],
            'meja' => $req['meja'],
            'jendela' => $req['jendela'],
            'kontainer' => $req['kontainer'],
            'langit' => $req['langit'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = periksaruang::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'periksa sanitasi ruangan',
            'laporan_batch' => $req['no_batch'] ?? 0,
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/periksasaniruang');
    }


    // Bagian Pengawas

    public function tampil_req_batch()
    {
        $data = pengolahanbatch::all()->where('status', 1);
        return view('catatanpelaksana.dokumen.pengolahanbatch', ['data' => $data]);
    }

    public function tolak_batch($id)
    {

        $pabrik = Auth::user()->pabrik;
        $user = pengolahanbatch::all()->where("nomor_batch", $id)->first()->update([
            'status' => 0,
        ]);
        $data = pengolahanbatch::all()->where('status', 1);
        return view('catatanpelaksana.dokumen.pengolahanbatch', ['data' => $data]);
    }

    public function terima_batch($id)
    {
        $pabrik = Auth::user()->pabrik;
        $user = pengolahanbatch::all()->where("nomor_batch", $id)->first()->update([
            'status' => 3,
        ]);
        $data = pengolahanbatch::all()->where('status', 1);
        return view('catatanpelaksana.dokumen.pengolahanbatch', ['data' => $data]);
    }


    //yusril
    public function tambah_pelatihanhiginitas(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_pelatihan' => $req['kode_pelatihan'],
            'materi_pelatihan' => $req['materi_pelatihan'],
            'peserta_pelatihan' => $req['peserta_pelatihan'],
            'pelatih' => $req['pelatih'],
            'metode_pelatihan' => $req['metode_pelatihan'],
            'jadwal_mulai_pelatihan' => $req['mulai'],
            'jadwal_berakhir_pelatihan' => $req['berakhir'],
            'metode_penilaian' => $req['metode_penilaian'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = programpelatihan::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pelatihan higiene dan sanitasi',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/program-dan-pelatihan-higiene-dan-sanitasi');
    }
    public function tambah_pelatihancpkb(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_pelatihan' => $req['kode_pelatihan'],
            'materi_pelatihan' => $req['materi_pelatihan'],
            'peserta_pelatihan' => $req['peserta_pelatihan'],
            'pelatih' => $req['pelatih'],
            'metode_pelatihan' => $req['metode_pelatihan'],
            'jadwal_mulai_pelatihan' => $req['mulai'],
            'jadwal_berakhir_pelatihan' => $req['berakhir'],
            'metode_penilaian' => $req['metode_penilaian'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = Pelatihancpkb::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pelatihan cpkb',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/program-dan-pelatihan-higiene-dan-sanitasi');
    }
    public function tampil_programpelatihanhigienitasdansanitasi()
    {
        $pabrik = Auth::user()->pabrik;
        $data = programpelatihan::all()->where('pabrik', $pabrik);
        $data1 = Pelatihancpkb::all()->where('pabrik', $pabrik);
        return view('catatan.dokumen.programpelatihanhiginitas', ['data' => $data, 'data1' => $data1]);
    }
    public function tambah_keluhan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_keluhan' => $req['kode_keluhan'],
            'nama_customer' => $req['nama_customer'],
            'tanggal_keluhan' => $req['tanggal_keluhan'],
            'keluhan' => $req['keluhan'],
            'tanggal_ditanggapi' => $req['tanggal_tanggapi_keluhan'],
            'produk_yang_digunakan' => $req['produk_yang_digunakan'],
            'penanganan_keluhan' => $req['penanganan_keluhan'],
            'tindak_lanjut' => $req['tindak_lanjut'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = penanganankeluhan::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'penanganan keluhan',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/penanganan-keluhan');
    }
    public function tampil_penanganankeluhan()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = penanganankeluhan::all()->where('pabrik', $pabrik)->where('status', 0);
        } else
            $data = penanganankeluhan::all()->where('pabrik', $pabrik);
        return view('catatan.dokumen.penanganankeluhan', ['data' => $data]);
    }
    public function tambah_penarikan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_penarikan' => $req['kode_penarikan'],
            'tanggal_penarikan' => $req['tanggal'],
            'nama_distributor' => $req['nama_distributor'],
            'produk_ditarik' => $req['produk_ditarik'],
            'jumlah_produk_ditarik' => $req['jumlah_produk_ditarik'],
            'no_batch' => $req['no_batch'],
            'alasan_penarikan' => $req['alasan_penarikan'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = penarikanproduk::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'penarikan produk',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/penarikan-produk');
    }
    public function tampil_penarikanproduk()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = penarikanproduk::all()->where('pabrik', $pabrik)->where('status', 0);
        } else
            $data = penarikanproduk::all()->where('pabrik', $pabrik);
        return view('catatan.dokumen.penarikanproduk', ['data' => $data]);
    }
    public function tambah_distribusi(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_distribusi' => $req['kode_distribusi'],
            'tanggal' => $req['tanggal'],
            'id_batch' => $req['no_batch'],
            'jumlah' => $req['jumlah'],
            'nama_distributor' => $req['nama_distributor'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = distribusiproduk::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'distribusi produk',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/pendistribusian-produk');
    }
    public function tampil_distribusi()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = distribusiproduk::all()->where('pabrik', $pabrik)->where('status', 0);
        } else
            $data = distribusiproduk::all()->where('pabrik', $pabrik);
        return view('catatan.dokumen.pendistribusianproduk', ['data' => $data]);
    }
    public function tambah_operasialat(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'pob' => $req['pelaksanaan_pob'],
            'tanggal' => $req['tanggal'],
            'nama_alat' => $req['nama_alat'],
            'tipe_merek' => $req['tipemerek'],
            'ruang' => $req['ruang'],
            'mulai' => $req['mulai'],
            'selesai' => $req['selesai'],
            'oleh' => $req['oleh'],
            'ket' => $req['ket'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = pengoprasianalat::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pengolahan batch',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        return redirect('/pengoprasian-alat');
    }
    public function tampil_pengorasianalat()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = pengoprasianalat::all()->where('pabrik', $pabrik)->where('status', 0);
        } else
            $data = pengoprasianalat::all()->where('pabrik', $pabrik);
        return view('catatan.dokumen.pengoprasianalat', ['data' => $data]);
    }
    public function tambah_pelulusan(Request $req)
    {
        $pabrik = Auth::user()->pabrik;
        $id = Auth::user()->id;
        $hasil = [
            'nama_bahan' => $req['nama_bahan'],
            'no_batch' => $req['nobatch'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'nama_pemasok' => $req['nama_pemasok'],
            'tanggal' => $req['tanggal'],
            'warna' => $req['warna'],
            'bau' => $req['bau'],
            'ph' => $req['ph'],
            'berat_jenis' => $req['berat_jenis'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = pelulusanproduk::insertGetId($hasil);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pelulusan produk jadi',
            'laporan_batch' => $req['nobatch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/pelulusan-produk');
    }
    public function tampil_pelulusanproduk()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = pelulusanproduk::all()->where('pabrik', $pabrik)->where('status', 0);
        } else
            $data = pelulusanproduk::all()->where('pabrik', $pabrik);
        return view('catatan.dokumen.pelulusanproduk', ['data' => $data]);
    }
    public function tambah_contohbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_bahan' => $req['kode_bahan'],
            'nama_bahanbaku' => $req['nama_bahan'],
            'no_batch' => $req['nobatch'],
            'tanggal_ambil' => $req['tanggal'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_kemasanbox' => $req['jumlah_box'],
            'jumlah_produk' => $req['jumlah_ambil'],
            'jenis_warnakemasan' => $req['jenis_warna_kemasan'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = contohbahanbaku::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'penambahan contoh bahan baku',
            'laporan_batch' => $req['nobatch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/ambilcontoh#pills-home');
    }
    public function tambah_contohproduk(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_produk' => $req['kode_produk'],
            'nama_produkjadi' => $req['nama_produk'],
            'no_batch' => $req['nobatch'],
            'tanggal_ambil' => $req['tanggal'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_kemasanbox' => $req['jumlah_box'],
            'jumlah_produk' => $req['jumlah_ambil'],
            'jenis_warnakemasan' => $req['jenis_warna_kemasan'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = contohprodukjadi::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'penambahan contoh produk',
            'laporan_batch' => $req['nobatch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/ambilcontoh#pills-profile');
    }
    public function tambah_contohkemasan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_kemasan' => $req['kode_kemasan'],
            'nama_kemasan' => $req['nama_kemasan'],
            'no_batch' => $req['nobatch'],
            'tanggal_ambil' => $req['tanggal'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_kemasanbox' => $req['jumlah_box'],
            'jumlah_produk' => $req['jumlah_ambil'],
            'jenis_warnakemasan' => $req['jenis_warna_kemasan'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = contohkemasan::insertGetiD($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'penambahan contoh kemasan',
            'laporan_batch' => $req['nobatch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/ambilcontoh#pills-contact');
    }
    public function tampil_pengambilancontoh()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = contohbahanbaku::all()->where('pabrik', $pabrik)->where('status', 0);
            $data1 = contohprodukjadi::all()->where('pabrik', $pabrik)->where('status', 0);
            $data2 = contohkemasan::all()->where('pabrik', $pabrik)->where('status', 0);
        } else {
            $data = contohbahanbaku::all()->where('pabrik', $pabrik);
            $data1 = contohprodukjadi::all()->where('pabrik', $pabrik);
            $data2 = contohkemasan::all()->where('pabrik', $pabrik);
        }
        return view('catatan.dokumen.pengambilancontoh', ['data' => $data, 'data1' => $data1, 'data2' => $data2]);
    }
    public function tambah_penimbanganbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_timbang' => $req['kode_penimbangan'],
            'tanggal' => $req['tanggal'],
            'nama_bahan' => $req['nama_bahan'],
            'no_loth' => $req['no_loth'],
            'nama_suplier' => $req['nama_suplier'],
            'jumlah_bahan' => $req['jumlah_bahan'],
            'hasil_penimbangan' => $req['hasil_penimbangan'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = timbangbahan::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'penimbangan bahan',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/penimbangan#pills-contact');
    }

    public function tambah_penimbanganprodukantara(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_timbang' => $req['kode_produk'],
            'tanggal' => $req['tanggal'],
            'nama_produk_antara' => $req['nama_produk'],
            'no_batch' => $req['nobatch'],
            'asal_produk' => $req['asal_produk'],
            'jumlah_produk' => $req['jumlah_produk'],
            'hasil_penimbangan' => $req['hasil_penimbangan'],
            'untuk_produk' => $req['untuk_produk'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = timbangproduk::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'penimbangan produk utama',
            'laporan_batch' => $req['nobatch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/penimbangan#pills-contact');
    }
    public function tambah_ruangtimbang(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_ruangtimbang' => $req['kode_ruangtimbang'],
            'tanggal' => $req['tanggal'],
            'nama_bahan_baku' => $req['nama_bahanbaku'],
            'no_loth' => $req['no_loth'],
            'jumlah_bahan_baku' => $req['jumlah_bahanbaku'],
            'jumlah_permintaan' => $req['jumlah_permintaan'],
            'hasil_penimbangan' => $req['hasil_penimbangan'],
            'untuk_produk' => $req['untuk_produk'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = ruangtimbang::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'ruang timbang',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/penimbangan#pills-contact');
    }
    public function tampil_penimbangan()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = timbangbahan::all()->where('pabrik', $pabrik)->where('status', 0);
            $data1 = timbangproduk::all()->where('pabrik', $pabrik)->where('status', 0);
            $data2 = ruangtimbang::all()->where('pabrik', $pabrik)->where('status', 0);
        } else {
            $data = timbangbahan::all()->where('pabrik', $pabrik);
            $data1 = timbangproduk::all()->where('pabrik', $pabrik);
            $data2 = ruangtimbang::all()->where('pabrik', $pabrik);
        }
        return view('catatan.dokumen.penimbangan', ['data' => $data, 'data1' => $data1, 'data2' => $data2]);
    }
    public function tambah_kartustokbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_kartu' => $req['kode_stok'],
            'tanggal' => $req['tanggal'],
            'id_batch' => $req['no_batch'],
            'jumlah' => $req['jumlah'],
            'nama_distributor' => $req['nama_distributor'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = kartustokbahan::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'kartu stok bahan',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/kartu-stok');
    }
    public function tambah_kartustokbahankemas(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'id_kartustokbahankemas' => $req['kode_stok'],
            'tanggal' => $req['tanggal'],
            'id_batch' => $req['no_batch'],
            'jumlah' => $req['jumlah'],
            'nama_distributor' => $req['nama_distributor'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = kartustokbahankemas::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'kartu stok bahan kemas',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/kartu-stok');
    }
    public function tambah_kartustokprodukjadi(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'id_kartustokprodukjadi' => $req['kode_stok'],
            'tanggal' => $req['tanggal'],
            'id_batch' => $req['no_batch'],
            'jumlah' => $req['jumlah'],
            'nama_distributor' => $req['nama_distributor'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = kartustokprodukjadi::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'kartu stok produk jadi',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/kartu-stok');
    }
    public function tampil_kartustok()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = kartustokbahan::all()->where('pabrik', $pabrik)->where('status', 0);
            $data1 = kartustokbahankemas::all()->where('pabrik', $pabrik)->where('status', 0);
            $data2 = kartustokprodukjadi::all()->where('pabrik', $pabrik)->where('status', 0);
        } else {
            $data = kartustokbahan::all()->where('pabrik', $pabrik);
            $data1 = kartustokbahankemas::all()->where('pabrik', $pabrik);
            $data2 = kartustokprodukjadi::all()->where('pabrik', $pabrik);
        }
        return view('catatan.dokumen.kartustok', ['data' => $data, 'data1' => $data1, 'data2' => $data2]);
    }
    public function tambah_pemusnahanbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_pemusnahan' => $req['kode_pemusnahan'],
            'tanggal_pemusnahan' => $req['tanggal'],
            'nama_bahanbaku' => $req['nama_bahanbaku'],
            'no_batch' => $req['no_batch'],
            'asal_bahanbaku' => $req['asal_bahanbaku'],
            'jumlah_bahanbaku' => $req['jumlah_bahanbaku'],
            'alasan_pemusnahan' => $req['alasan_pemusnahan'],
            'cara_pemunsnahan' => $req['cara_pemusnahan'],
            'nama_petugas' => $req['petugas'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = pemusnahanbahanbaku::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pemusnahan bahan',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/pemusnahan-produk');
    }
    public function tambah_pemusnahanbahankemas(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_pemusnahan' => $req['kode_pemusnahan'],
            'tanggal_pemusnahan' => $req['tanggal'],
            'nama_bahan_kemas' => $req['nama_bahankemas'],
            'no_batch' => $req['no_batch'],
            'asal_bahankemas' => $req['asal_bahankemas'],
            'jumlah_bahankemas' => $req['jumlah_bahankemas'],
            'alasan_pemusnahan' => $req['alasan_pemusnahan'],
            'cara_pemunsnahan' => $req['cara_pemusnahan'],
            'nama_petugas' => $req['petugas'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = Pemusnahanbahankemas::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pemusnahan bahan kemas',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/pemusnahan-produk');
    }
    public function tambah_pemusnahanprodukantara(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_pemusnahan' => $req['kode_pemusnahan'],
            'tanggal_pemusnahan' => $req['tanggal'],
            'nama_produkantara' => $req['nama_produkantara'],
            'no_batch' => $req['no_batch'],
            'asal_produkantara' => $req['asal_produkantara'],
            'jumlah_produkantara' => $req['jumlah_produkantara'],
            'alasan_pemusnahan' => $req['alasan_pemusnahan'],
            'cara_pemunsnahan' => $req['cara_pemusnahan'],
            'nama_petugas' => $req['petugas'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = Pemusnahanprodukantara::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pemusnahan produk antara',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/pemusnahan-produk');
    }
    public function tambah_pemusnahanprodukjadi(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_pemusnahan' => $req['kode_pemusnahan'],
            'tanggal_pemusnahan' => $req['tanggal'],
            'nama_produkjadi' => $req['nama_produkantara'],
            'no_batch' => $req['no_batch'],
            'asal_produkjadi' => $req['asal_produkantara'],
            'jumlah_produkjadi' => $req['jumlah_produkantara'],
            'alasan_pemusnahan' => $req['alasan_pemusnahan'],
            'cara_pemunsnahan' => $req['cara_pemusnahan'],
            'nama_petugas' => $req['petugas'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = Pemusnahanprodukjadi::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pemusnahan produk jadi',
            'laporan_batch' => $req['no_batch'],
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->nama,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        return redirect('/pemusnahan-produk');
    }
    public function tampil_pemusnahanproduk()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = pemusnahanbahanbaku::all()->where('pabrik', $pabrik)->where('status', 0);
            $data1 = Pemusnahanbahankemas::all()->where('pabrik', $pabrik)->where('status', 0);
            $data2 = Pemusnahanprodukantara::all()->where('pabrik', $pabrik)->where('status', 0);
            $data3 = Pemusnahanprodukjadi::all()->where('pabrik', $pabrik)->where('status', 0);
        } else {
            $data = pemusnahanbahanbaku::all()->where('pabrik', $pabrik);
            $data1 = Pemusnahanbahankemas::all()->where('pabrik', $pabrik);
            $data2 = Pemusnahanprodukantara::all()->where('pabrik', $pabrik);
            $data3 = Pemusnahanprodukjadi::all()->where('pabrik', $pabrik);
        }
        return view('catatan.dokumen.pemusnahanproduk', ['data' => $data, 'data1' => $data1, 'data2' => $data2, 'data3' => $data3]);
    }
    public function tambah_kalibrasialat(Request $req)
    {
        $file = $req->file('file');
        $exten = $file->getClientOriginalExtension();
        $nama = $req['nama_alat'] . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten;
        $tujuan_upload = 'kalibrasi_alat';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nama_alat' => $req['nama_alat'],
            'nama_file' => $nama,
            'pabrik' => $pabrik,
            'user_id' => $id,
        ];
        Kalibrasialat::insertGetId($hasil);

        return redirect('/kalibrasi-alat');
    }
    public function tampil_kalibrasialat()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = Kalibrasialat::all()->where('pabrik', $pabrik)->where('status', 0);
        } else {
            $data = Kalibrasialat::all()->where('pabrik', $pabrik);
        }
        return view('catatan.dokumen.kalibrasialat', ['data' => $data]);
    }
}
