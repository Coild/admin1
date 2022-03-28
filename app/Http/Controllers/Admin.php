<?php

namespace App\Http\Controllers;

use App\Models\{bahanbaku, catatbersih, coa, company, contohbahanbaku, contohkemasan, contohprodukjadi, dip, distribusiproduk, kartustok, kartustokbahan, kartustokbahankemas, kartustokprodukjadi, kemasan, perizinan, pobpabrik, komposisi, laporan, pelulusanproduk, pemusnahanbahanbaku, pemusnahanproduk, penanganankeluhan, penarikanproduk, pendistribusianproduk, pengolahanbatch, pengoprasianalat, pengorasianalat, peralatan, penimbangan, periksaruang, produk, produksi, programpelatihan, programpelatihanhiginitas, rekonsiliasi, ruangtimbang, timbangbahan, timbangproduk};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;

class Admin extends Controller
{
    //COA
    public function tampil_coa()
    {
        $id = Auth::user()->id;
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
        $id = Auth::user()->id;
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
        $id = Auth::user()->id;
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
        $id = Auth::user()->id;
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
        $id = Auth::user()->id;
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
        $id = Auth::user()->id;
        $hasil = [
            'perizinan_file' => $nama,
            'perizinan_nama' => $req['nama'],
            'user_id' => $id,
        ];

        perizinan::insert($hasil);
        // // user::deleted()
        return redirect('/perizinan');
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
    public function tambah_catatbersih(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'catatbersih_produk' => $req['tahun'] . "-" . $req['bulan'] . "-" . '1',
            'catatbersih_batchnum' => $req['batchnum'],
            'catatbersih_prosedurnum' => $req['produk_nama'],
            'catatbersih_namaruang' => $req['namaruang'],
            'catatbersih_carabersih' => $req['carabersih'],
            'catatbersih_pelaksana' => $req['pelaksana'],
            'catatbersih_periksa' => $req['periksa'],
            'catatbersih_lantaidinding' => $req['lantaidinding'] == null ? 0 : 1,
            'catatbersih_meja' => $req['meja'] == null ? 0 : 1,
            'catatbersih_jendela' => $req['jendela'] == null ? 0 : 1,
            'catatbersih_plafon' => $req['plafon'] == null ? 0 : 1,
            'user_id' => $id,
        ];

        catatbersih::insert($hasil);

        return redirect('/pembersihanruangan');
    }

    public function tampil_penerimaanbb()
    {
        // echo Auth::user()->name;
        return view('catatan.dokumen.penerimaanBB');
    }

    //tampil batch
    public function tampil_pengolahanbatch()
    {
        $pabrik = Auth::user()->pabrik;
        $data = pengolahanbatch::all()->where('pabrik', $pabrik);
        $data2 = produk::all();
        return view('catatan.dokumen.pengolahanbatch', ['data' => $data, 'data2' => $data2]);
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
        return view('catatan.dokumen.detailbatch', [
            'id' => $id,
            'data' => $data, 'list_kom' => $kom, 'list_alat' => $alat, 'list_nimbang' => $nimbang
        ]);
    }

    public function cetak_pengolahanbatch(Request $req)
    {
        $id = $req['nobatch'];  
        // dd($id);
        $data = pengolahanbatch::all()->where('nomor_batch', $id);
        $kom = komposisi::all()->where('nomor_batch', $id);
        // dd($kom);
        $alat = peralatan::all()->where('nomor_batch', $id);
        $nimbang = penimbangan::all()->where('nomor_batch', $id);
        return view('print.pengolahanbatch', [
            'data' => $data, 'list_kom' => $kom, 'list_alat' => $alat, 'list_nimbang' => $nimbang

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
            'bentuk_kategory' => $req['bentuk_kategori'],
            'kemasan' => $req['kemasan'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        $laporan = [
           'laporan_nama' => 'pengolahan batch',
           'laporan_batch' => $req['no_batch'],
           'laporan_diajukan' => Auth::user()->nama,
           'laporan_diterima' => "belum",
           'tgl_diajukan' => $tgl,
           'tgl_diterima' => $tgl,
            "user_id" => $id,
        ];

        // dd($hasil);
        laporan::insert($laporan);
        pengolahanbatch::insert($hasil);
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
        $id = Auth::user()->id;
        $hasil = [
            'company_nama' => $req['nama'],
            'company_alamat' => $req['alamat'],
            'company_telepon' => $req['telp'],
            'company_logo' => $nama,
            'user_id' => $id,
        ];

        company::insert($hasil);
        // // user::deleted()
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
    

    public function tampil_setting()
    {
        if (Auth::user()->level < 0) {
            return view('tunggu');
        } else {
            $id = Auth::user()->id;
            $kom = company::all()->where('user_id', $id);
            $produk = produk::all()->where('user_id', $id);
            $kemasan = kemasan::all()->where('user_id', $id);
            $bahanbaku = bahanbaku::all()->where('user_id', $id);
            return view('setting', [
                'list_com' => $kom, 'list_produk' => $produk, 'list_kemasan' => $kemasan, 'list_bahanbaku' => $bahanbaku
            ]);
        }
    }

    public function tampil_laporan()
    {
        $data = laporan::all()->where('laporan_diterima','!=','belum');
        return view('laporan', ['batch' => $data]);
    }

    public function tampil_periksapersonil()
    {
        return "loading";
    }

    public function tampil_periksasanialat()
    {
        return view('catatan.higidansani.periksasanialat');
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

        periksaruang::insert($hasil);

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
        $hasil = [
            'id_programpelatihan' => $req['kode_pelatihan'],
            'materi_pelatihan' => $req['materi_pelatihan'],
            'peserta_pelatihan' => $req['peserta_pelatihan'],
            'pelatih' => $req['pelatih'],
            'metode_pelatihan' => $req['metode_pelatihan'],
            'jadwal_mulai_pelatihan' => $req['mulai'],
            'jadwal_berakhir_pelatihan' => $req['berakhir'],
            'metode_penilaian' => $req['metode_penilaian'],
            'user_id' => $id,
        ];

        programpelatihan::insert($hasil);

        return redirect('/program-dan-pelatihan-higiene-dan-sanitasi');
    }
    public function tampil_programpelatihanhigienitasdansanitasi()
    {
        $data = programpelatihan::all();
        return view('catatan.dokumen.programpelatihanhiginitas', ['data' => $data]);
    }
    public function tambah_keluhan(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'id_penanganankeluhan' => $req['kode_keluhan'],
            'nama_customer' => $req['nama_customer'],
            'tanggal_keluhan' => $req['tanggal_keluhan'],
            'keluhan' => $req['keluhan'],
            'tanggal_ditanggapi' => $req['tanggal_tanggapi_keluhan'],
            'produk_yang_digunakan' => $req['produk_yang_digunakan'],
            'penanganan_keluhan' => $req['penanganan_keluhan'],
            'tindak_lanjut' => $req['tindak_lanjut'],
            'user_id' => $id,
        ];

        penanganankeluhan::insert($hasil);

        return redirect('/penanganan-keluhan');
    }
    public function tampil_penanganankeluhan()
    {
        $data = penanganankeluhan::all();
        return view('catatan.dokumen.penanganankeluhan', ['data' => $data]);
    }
    public function tambah_penarikan(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'id_produk_penarikan' => $req['kode_penarikan'],
            'tanggal_penarikan' => $req['tanggal'],
            'nama_distributor' => $req['nama_distributor'],
            'produk_ditarik' => $req['produk_ditarik'],
            'jumlah_produk_ditarik' => $req['jumlah_produk_ditarik'],
            'id_batch' => $req['no_batch'],
            'alasan_penarikan' => $req['alasan_penarikan'],
            'user_id' => $id,
        ];

        penarikanproduk::insert($hasil);

        return redirect('/penarikan-produk');
    }
    public function tampil_penarikanproduk()
    {
        $data = penarikanproduk::all();
        return view('catatan.dokumen.penarikanproduk', ['data' => $data]);
    }
    public function tambah_distribusi(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'id_distribusi' => $req['kode_distribusi'],
            'tanggal' => $req['tanggal'],
            'id_batch' => $req['no_batch'],
            'jumlah' => $req['jumlah'],
            'nama_distributor' => $req['nama_distributor'],
            'user_id' => $id,
        ];

        distribusiproduk::insert($hasil);

        return redirect('/pendistribusian-produk');
    }
    public function tampil_distribusi()
    {
        $data = distribusiproduk::all();
        return view('catatan.dokumen.pendistribusianproduk', ['data' => $data]);
    }
    public function tambah_operasialat(Request $req)
    {
        $id = Auth::user()->id;
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
            'user_id' => $id,
        ];

        pengoprasianalat::insert($hasil);

        return redirect('/pengoprasian-alat');
    }
    public function tampil_pengorasianalat()
    {
        $data = pengoprasianalat::all();
        return view('catatan.dokumen.pengoprasianalat', ['data' => $data]);
    }
    public function tambah_pelulusan(Request $req)
    {
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
            'berat_jenis' => $req['nerat_jenis'],
            'kesimpulan' => $req['kesimpulan'],
            'user_id' => $id,
        ];

        pelulusanproduk::insert($hasil);

        return redirect('/pelulusan-produk');
    }
    public function tampil_pelulusanproduk()
    {
        $data = pelulusanproduk::all();
        return view('catatan.dokumen.pelulusanproduk', ['data' => $data]);
    }
    public function tambah_contohbahan(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'id_bahanbaku' => $req['kode_bahan'],
            'nama_bahanbaku' => $req['nama_bahan'],
            'no_batch' => $req['nobatch'],
            'tanggal_ambil' => $req['tanggal'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_bahanbakubox' => $req['jumlah_box'],
            'jumlah_produk' => $req['jumlah_ambil'],
            'jenis_warnakemasan' => $req['jenis_warna_kemasan'],
            'kesimpulan' => $req['kesimpulan'],
            'user_id' => $id,
        ];

        contohbahanbaku::insert($hasil);

        return redirect('/ambilcontoh#pills-home');
    }
    public function tambah_contohproduk(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'id_produkjadi' => $req['kode_produk'],
            'nama_produkjadi' => $req['nama_produk'],
            'no_batch' => $req['nobatch'],
            'tanggal_ambil' => $req['tanggal'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_produkbox' => $req['jumlah_box'],
            'jumlah_produk' => $req['jumlah_ambil'],
            'jenis_warnakemasan' => $req['jenis_warna_kemasan'],
            'kesimpulan' => $req['kesimpulan'],
            'user_id' => $id,
        ];

        contohprodukjadi::insert($hasil);

        return redirect('/ambilcontoh#pills-profile');
    }
    public function tambah_contohkemasan(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'id_kemasan' => $req['kode_kemasan'],
            'nama_kemasan' => $req['nama_kemasan'],
            'no_batch' => $req['nobatch'],
            'tanggal_ambil' => $req['tanggal'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_kemasanbox' => $req['jumlah_box'],
            'jumlah_produk' => $req['jumlah_ambil'],
            'jenis_warnakemasan' => $req['jenis_warna_kemasan'],
            'kesimpulan' => $req['kesimpulan'],
            'user_id' => $id,
        ];

        contohkemasan::insert($hasil);

        return redirect('/ambilcontoh#pills-contact');
    }
    public function tampil_pengambilancontoh()
    {
        $data = contohbahanbaku::all();
        $data1 = contohprodukjadi::all();
        $data2 = contohkemasan::all();
        return view('catatan.dokumen.pengambilancontoh', ['data' => $data, 'data1' => $data1, 'data2' => $data2]);
    }
    public function tambah_penimbanganbahan(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'timbang_bahan_id' => $req['kode_penimbangan'],
            'tanggal' => $req['tanggal'],
            'nama_bahan' => $req['nama_bahan'],
            'no_loth' => $req['no_loth'],
            'nama_suplier' => $req['nama_suplier'],
            'jumlah_bahan' => $req['jumlah_bahan'],
            'hasil_penimbangan' => $req['hasil_penimbangan'],
            'pjt' => $req['pjt'],
            'user_id' => $id,
        ];

        timbangbahan::insert($hasil);

        return redirect('/penimbangan#pills-contact');
    }

    public function tambah_penimbanganprodukantara(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'timbang_produk_id' => $req['kode_produk'],
            'tanggal' => $req['tanggal'],
            'nama_produk_antara' => $req['nama_produk'],
            'no_batch' => $req['nobatch'],
            'asal_produk' => $req['asal_produk'],
            'jumlah_produk' => $req['jumlah_produk'],
            'hasil_penimbangan' => $req['hasil_penimbangan'],
            'untuk_produk' => $req['untuk_produk'],
            'pjt' => $req['pjt'],
            'user_id' => $id,
        ];

        timbangproduk::insert($hasil);

        return redirect('/penimbangan#pills-contact');
    }
    public function tambah_ruangtimbang(Request $req)
    {
        $id = Auth::user()->id;
        $hasil = [
            'id_ruangtimbang' => $req['kode_ruangtimbang'],
            'tanggal' => $req['tanggal'],
            'nama_bahan_baku' => $req['nama_bahanbaku'],
            'no_loth' => $req['no_loth'],
            'jumlah_bahan_baku' => $req['jumlah_bahanbaku'],
            'jumlah_permintaan' => $req['jumlah_permintaan'],
            'hasil_penimbangan' => $req['hasil_penimbangan'],
            'untuk_produk' => $req['untuk_produk'],
            'pjt' => $req['pjt'],
            'user_id' => $id,
        ];

        ruangtimbang::insert($hasil);

        return redirect('/penimbangan#pills-contact');
    }
    public function tampil_penimbangan()
    {
        $data = timbangbahan::all();
        $data1 = timbangproduk::all();
        $data2 = ruangtimbang::all();
        return view('catatan.dokumen.penimbangan', ['data' => $data, 'data1' => $data1, 'data2' => $data2]);
    }
    public function tambah_kartustokbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'id_kartustokbahan' => $req['kode_stok'],
            'tanggal' => $req['tanggal'],
            'id_batch' => $req['no_batch'],
            'jumlah' => $req['jumlah'],
            'nama_distributor' => $req['nama_distributor'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        kartustokbahan::insert($hasil);

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

        kartustokbahankemas::insert($hasil);

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

        kartustokprodukjadi::insert($hasil);

        return redirect('/kartu-stok');
    }
    public function tampil_kartustok()
    {
        $pabrik = Auth::user()->pabrik;
        $data = kartustokbahan::all()->where('pabrik', $pabrik);
        $data1 = kartustokbahankemas::all()->where('pabrik', $pabrik);
        $data2 = kartustokprodukjadi::all()->where('pabrik', $pabrik);
        return view('catatan.dokumen.kartustok', ['data' => $data, 'data1' => $data1, 'data2' => $data2]);
    }
    public function tambah_pemusnahanbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'id_pemusnahanbahan' => $req['kode_pemusnahan'],
            'tanggal_pemusnahan' => $req['tanggal'],
            'nama_produk_jadi' => $req['nama_produk_jadi'],
            'id_batch' => $req['no_batch'],
            'asal_produk_jadi' => $req['asal_produk_jadi'],
            'jumlah_produk_jadi' => $req['jumlah_produk_jadi'],
            'alasan_pemusnahan' => $req['alasan_pemusnahan'],
            'cara_pemunsnahan' => $req['cara_pemusnahan'],
            'nama_petugas' => $req['petugas'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        pemusnahanbahanbaku::insert($hasil);

        return redirect('/pemusnahan-produk');
    }
    public function tampil_pemusnahanproduk()
    {
        $pabrik = Auth::user()->pabrik;
        $data = pemusnahanbahanbaku::all()->where('pabrik', $pabrik);
        $data1 = pemusnahanbahanbaku::all()->where('pabrik', $pabrik);
        $data2 = pemusnahanbahanbaku::all()->where('pabrik', $pabrik);
        return view('catatan.dokumen.pemusnahanproduk', ['data' => $data, 'data1' => $data1, 'data2' => $data2]);
    }
}
