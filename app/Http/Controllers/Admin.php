<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\log;
use Illuminate\Http\Request;
use App\Models\Detiloperasialat;
use App\Models\Detilperiksaalat;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\{aturan, cp_bahan, cp_kemasan, cp_produk, jabatan, pabrik, bahanbaku, catatbersih, coa, company, contohbahanbaku, contohkemasan, contohprodukjadi, detilalat, Detilruangan, detiltimbangbahan, detiltimbanghasil, detiltimbangproduk, dip, distribusiproduk, Kalibrasialat, kartustok, kartustokbahan, kartustokbahankemas, kartustokprodukantara, kartustokprodukjadi, kemasan, perizinan, pobpabrik, komposisi, laporan, notif, Pelatihancpkb, pelulusanproduk, pemusnahanbahanbaku, pemusnahanbahankema, pemusnahanprodukantara, pemusnahanprodukjadi, penanganankeluhan, penarikanproduk, pendistribusianproduk, Pengemasanbatchproduk, pengolahanbatch, pengoprasianalat, pengorasianalat, peralatan, penimbangan, Periksaalat, Periksapersonil, periksaruang, Periksasaniruang, PPbahanbakukeluar, PPbahanbakumasuk, PPkemasankeluar, PPkemasanmasuk, PPprodukjadikeluar, PPprodukjadimasuk, pr_bahankemas, produk, produkantara, produksi, programpelatihan, programpelatihanhiginitas, prosedur_isi, prosedur_tanda, protap, rekonsiliasi, ruangtimbang, Spesifikasibahanbaku, Spesifikasibahankemas, Spesifikasiprodukjadi, timbangbahan, timbangproduk};
use Illuminate\Support\Facades\Redirect;

use function PHPUnit\Framework\isNull;

$a = 0;
$b = 0;

class Admin extends Controller
{

    public function lihatpdf(Request $req)
    {

        // dd($req);
        if (is_null($req['_token'])) {
            return Redirect::back();
        }
        return view('lihatpdf', ['pdf' => $req['path']]);
    }

    public function bersih($string)
    {
        //$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z\-]/', '', $string); // Removes special chars.

    }

    public function bersih_angka($string)
    {
        //$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.

    }

    public function bersih_karakter($string)
    {
        //$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9.,\-]/', ' ', $string); // Removes special chars.

    }

    public function coba(Request $req)
    {
        if (isNull($req)) {
            return Redirect::back();
        } else {
            // dd('isi');
            dd($req);
        }
        // dd($req);
    }

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

        $tglbaru = isset($isibaru) ? $isibaru['tgl_upload'] : 'Belum ada aturan';
        $tglpabrik = isset($isipabrik) ?  $isipabrik['tgl_upload'] : 'Belum ada aturan';
        $tglproduk = isset($isiproduk) ?  $isiproduk['tgl_upload'] : 'Belum ada aturan';
        $tgliklan = isset($isiiklan) ?  $isiiklan['tgl_upload'] : 'Belum ada aturan';


        $baru = isset($isibaru) ? 'asset/aturan/' . $isibaru['nama'] : '#';
        $pabrik = isset($isipabrik['nama']) ?  'asset/aturan/' . $isipabrik['nama'] : '#';
        $produk = isset($isiproduk) ?  'asset/aturan/' . $isiproduk['nama'] : '#';
        $iklan = isset($isiiklan) ?  'asset/aturan/' . $isiiklan['nama'] : '#';

        return view('dashboard', [
            'struktur' => $struktur ??  '', 'baru' => $baru, 'produk' => $produk, 'pabrik' => $pabrik, 'iklan' => $iklan,
            'tglbaru' => $tglbaru, 'tglproduk' => $tglproduk, 'tglpabrik' => $tglpabrik, 'tgliklan' => $tgliklan
        ]);
    }


    //COA
    public function tampil_coa()
    {
        $id = Auth::user()->pabrik;
        $data = coa::all()->where('user_id', $id);
        return view('/coa', ['list_coa' => $data]);
    }

    public function hapus_coa(Request $req)
    {
        $id = $req->id;
        $data = coa::all()->where('coa_id', $id)->first();
        // dd($data);
        unlink("asset/coa/" . $data['coa_file']);
        $post = coa::all()->where('coa_id', $id)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menghapus laporan COA',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/coa')->with('success', 'Data berhasil dihapus!');
    }

    public function tambah_coa(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $filename = md5(date('Y-m-d H:i:s:u')) . '.pdf';
        $tujuan_upload = 'asset/coa/';
        $file->move($tujuan_upload, $filename);
        $id = Auth::user()->pabrik;
        $hasil = [
            'coa_file' => $filename,
            'coa_nama' => Admin::bersih($req['nama']),
            'user_id' => $id,
        ];

        coa::insert($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan COA',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/coa');
    }

    //DIP
    public function tampil_dip()
    {
        $id = Auth::user()->pabrik;
        $data = dip::all()->where('user_id', $id);
        return view('/dip', ['list_dip' => $data]);
    }

    public function hapus_dip(Request $req)
    {
        $id = $req->id;
        $data = dip::all()->where('dip_id', $id)->first();
        // dd($data);
        unlink("asset/dip/" . $data['dip_file']);
        $post = dip::all()->where('dip_id', $id)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menghapus laporan DIP',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/dip')->with('success', 'Data berhasil dihapus!');
    }

    public function tambah_dip(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $filename = md5(date('Y-m-d H:i:s:u')) . '.pdf';
        $tujuan_upload = 'asset/dip/';
        $file->move($tujuan_upload, $filename);
        $id = Auth::user()->pabrik;
        $hasil = [
            'dip_file' => $filename,
            'dip_nama' => Admin::bersih($req['nama']),
            'user_id' => $id,
        ];

        dip::insert($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan DIP',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/dip');
    }

    //perizinan
    public function tampil_perizinan()
    {
        $id = Auth::user()->pabrik;
        $data = perizinan::all()->where('user_id', $id);
        return view('/perizinan', ['list_perizinan' => $data]);
    }

    public function hapus_perizinan(Request $req)
    {
        $id = $req->id;
        $data = perizinan::all()->where('perizinan_id', $id)->first();
        // dd($data);
        unlink("asset/perizinan/" . $data['perizinan_file']);
        $post = perizinan::all()->where('perizinan_id', $id)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengahapus laporan perizinan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/perizinan')->with('success', 'Data berhasil dihapus!');
    }

    public function tambah_perizinan(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/perizinan/';
        $filename = md5(date('Y-m-d H:i:s:u')) . '.pdf';
        $file->move($tujuan_upload, $filename);
        $id = Auth::user()->pabrik;
        $hasil = [
            'perizinan_file' => $filename,
            'perizinan_nama' => Admin::bersih($req['nama']),
            'user_id' => $id,
        ];

        perizinan::insert($hasil);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan perizinan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

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
        $post = jabatan::all()->where('jabatan_id', $id)->each->delete();

        unlink("asset/dip/" . $data[0]['jabatan_file']);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menghapus laporan jabatan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/jabatan')->with('success', 'Data berhasil dihapus!');
    }

    public function tambah_jabatan(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/dip/';
        $filename = md5(date('Y-m-d H:i:s:u')) . '.pdf';
        $file->move($tujuan_upload, $filename);
        $id = Auth::user()->pabrik;
        $hasil = [
            'jabatan_file' => $filename,
            'jabatan_nama' => Admin::bersih($req['nama']),
            'user_id' => $id,
        ];

        jabatan::insert($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan jabatan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

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
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menghapus laporan protap pabrik',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/pobpabrik')->with('success', 'Data berhasil dihapus!');
    }

    public function tambah_pobpabrik(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/pobpabrik/';
        $filename = md5(date('Y-m-d H:i:s:u')) . '.pdf';
        $file->move($tujuan_upload, $filename);
        $id = Auth::user()->id;
        $hasil = [
            'pobpabrik_file' => $filename,
            'pobpabrik_nama' => Admin::bersih($req['nama']),
            'user_id' => $id,
        ];

        pobpabrik::insert($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan protap pabrik',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/pobpabrik');
    }


    public function tampil_detilruangan(Request $req)
    {
        $pabrik = Auth::user()->pabrik;
        // $pelaksana = \App\Models\User::all()->where('id', $req->pelaksana)->first();
        // dd($pelaksana);
        // dd(' ini '.$req->id_ruangan);
        $id = $req->id_ruangan ?? session()->get('induk_ruang');
        $nama_ruangan = $req->nama_ruangan ?? session()->get('nama_ruangan');
        session(['induk_ruang' => $id, 'nama_ruangan' => $nama_ruangan]);
        // dd( $nama_ruangan);
        $data = Detilruangan::all()->where('id_induk', $id);

        // $data = Detilruangan::all()->where('id', $req->id_ruangan);

        return view('catatanpelaksana.higidansani.detilruang', [
            'data' => $data,
            'nama_ruangan' => $nama_ruangan,
            'status' => $req->status,
            'pelaksana' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'id_ruangan' => session()->get('induk_ruang')
        ]);
    }

    //catat bersh ruangan

    public function tampil_detilbb(Request $req)
    {
        $pabrik = Auth::user()->pabrik;
        $induk = $req['induk'];
        $jenis = $req['jenis'];
        $nama = $req['nama'];
        if ($jenis == 1) {
            $status = cp_bahan::all('status')->where('cp_bahan_id')->first();
        }
        if ($jenis == 2) {
            $status = cp_produk::all('status')->where('cp_produk_id')->first();
        }
        if ($jenis == 3) {
            $status = cp_kemasan::all('status')->where('cp_kemasan_id')->first();
        }
        $protap_bahan = protap::all()->where('protap_jenis', 1)->where('protap_detil', 1);
        $protap_produk = protap::all()->where('protap_jenis', 1)->where('protap_detil', 2);
        $protap_kemasan = protap::all()->where('protap_jenis', 1)->where('protap_detil', 3);
        $status = $req['status_induk'];
        session(['induk' => $induk]);
        session(['jenis' => $jenis]);
        session(['nama' => $nama]);
        if ($jenis == 1) {
            $data1 = PPbahanbakumasuk::all()->where('pabrik', $pabrik)->where('induk', $induk);
            $data2 = PPbahanbakukeluar::all()->where('pabrik', $pabrik)->where('induk', $induk);
        } elseif ($jenis == 2) {
            $data1 = PPprodukjadimasuk::all()->where('pabrik', $pabrik)->where('induk', $induk);
            $data2 = PPprodukjadikeluar::all()->where('pabrik', $pabrik)->where('induk', $induk);
        } else {
            $data1 = PPkemasanmasuk::all()->where('pabrik', $pabrik)->where('induk', $induk);
            $data2 = PPkemasankeluar::all()->where('pabrik', $pabrik)->where('induk', $induk);
        }
        return view('catatan.dokumen.detailpenerimaanBB', [
            'jenis' => $jenis, 'induk' => $induk, 'nama' => $nama, 'status' => $status,
            'data1' => $data1, 'data2' => $data2, 'protap_bahan' => $protap_bahan,
            'protap_produk' => $protap_produk, 'protap_kemasan' => $protap_kemasan,
            'status' => $status
        ]);
    }

    public function tampil_detilbbid()
    {
        // global $a,$b;
        $jenis = session()->get('jenis');
        $induk =  session()->get('induk');
        $nama  =  session()->get('nama');
        $pabrik = Auth::user()->pabrik;
        $protap_bahan = protap::all()->where('protap_jenis', 1)->where('protap_detil', 1);
        $protap_produk = protap::all()->where('protap_jenis', 1)->where('protap_detil', 2);
        $protap_kemasan = protap::all()->where('protap_jenis', 1)->where('protap_detil', 3);
        if ($jenis == 1) {
            $status = cp_bahan::all('status')->where('cp_bahan_id')->first();
        }
        if ($jenis == 2) {
            $status = cp_produk::all('status')->where('cp_produk_id')->first();
        }
        if ($jenis == 3) {
            $status = cp_kemasan::all('status')->where('cp_kemasan_id')->first();
        }
        // dd($req);
        if ($jenis == 1) {
            $data1 = PPbahanbakumasuk::all()->where('pabrik', $pabrik)->where('induk', $induk);
            $data2 = PPbahanbakukeluar::all()->where('pabrik', $pabrik)->where('induk', $induk);
        } elseif ($jenis == 2) {
            $data1 = PPprodukjadimasuk::all()->where('pabrik', $pabrik)->where('induk', $induk);
            $data2 = PPprodukjadikeluar::all()->where('pabrik', $pabrik)->where('induk', $induk);
        } else {
            $data1 = PPkemasanmasuk::all()->where('pabrik', $pabrik)->where('induk', $induk);
            $data2 = PPkemasankeluar::all()->where('pabrik', $pabrik)->where('induk', $induk);
        }
        return view('catatan.dokumen.detailpenerimaanBB', [
            'jenis' => $jenis, 'induk' => $induk, 'nama' => $nama, 'status' => $status,
            'data1' => $data1, 'data2' => $data2, 'protap_bahan' => $protap_bahan,
            'protap_produk' => $protap_produk, 'protap_kemasan' => $protap_kemasan,
            'status' => $status
        ]);
    }

    public function tampil_penerimaanbb()
    {
        $pabrik = Auth::user()->pabrik;
        $bahanbaku = bahanbaku::all()->where('user_id', $pabrik);
        $produk = produk::all()->where('user_id', $pabrik);
        $kemasan = kemasan::all()->where('user_id', $pabrik);
        $protap1 = protap::all()->where('protap_jenis', 1)
            ->where('protap_detil', 1);
        $protap2 = protap::all()->where('protap_jenis', 1)
            ->where('protap_detil', 2);
        $protap3 = protap::all()->where('protap_jenis', 1)
            ->where('protap_detil', 3);
        // dd($bahanbaku);

        $data1 = cp_bahan::join('protaps', 'cp_bahans.protap', '=', 'protaps.protap_id')
            ->get(['cp_bahans.*', 'protaps.protap_nama', 'protap_id'])->where('cp_bahans.pabrik', $pabrik);
        $data2 = cp_produk::join('protaps', 'cp_produks.protap', '=', 'protaps.protap_id')
            ->get(['cp_produks.*', 'protaps.protap_nama', 'protap_id'])->where('cp_produks.pabrik', $pabrik);
        $data3 = cp_kemasan::join('protaps', 'cp_kemasans.protap', '=', 'protaps.protap_id')
            ->get(['cp_kemasans.*', 'protaps.protap_nama', 'protap_id'])->where('cp_kemasans.pabrik', $pabrik);

        return view('catatan.dokumen.penerimaanBB', [
            'data1' => $data1, 'data2' => $data2, 'data3' => $data3, 'bahanbaku' => $bahanbaku, 'produk' => $produk, 'kemasan' => $kemasan,
            'protap1' => $protap1, 'protap2' => $protap2, 'protap3' => $protap3,
        ]);
    }

    public function tambah_terimabahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // dd($req);
        $data = [
            'protap' => $req['protap'],
            'nama' => $req['nama'],
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'kode' => $req['kode'],
            'ruang' => Admin::bersih($req['ruang']),
            'pabrik' => $pabrik,
            'status' => 0,
        ];

        $nomer = cp_bahan::insertGetId($data);

        $laporan = [
            'laporan_nama' => 'penerimaan bahan',
            'laporan_batch' => Admin::bersih_angka($nomer),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "penerimaan bahan",
            'notif_link' => 'penerimaanBB',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah bahan baku',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect()->route('penerimaanBB');
    }

    public function tambah_terimaproduk(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        $data = [
            'protap' => $req['protap'],
            'nama' => $req['nama'],
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'kode' => $req['kode'],
            'ruang' => Admin::bersih($req['ruang']),
            'pabrik' => $pabrik,
            'status' => 0,
        ];

        $nomer = cp_produk::insertGetId($data);

        $laporan = [
            'laporan_nama' => 'penerimaan produk',
            'laporan_batch' => Admin::bersih_angka($nomer),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "penerimaan produk",
            'notif_link' => 'penerimaanBB',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah produk jadi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect()->route('penerimaanBB');
    }

    public function tambah_terimakemasan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        $data = [
            'protap' => $req['protap'],
            'nama' => $req['nama'],
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'kode' => $req['kode'],
            'ruang' => Admin::bersih($req['ruang']),
            'pabrik' => $pabrik,
            'status' => 0,
        ];

        $nomer = cp_kemasan::insertGetId($data);

        $laporan = [
            'laporan_nama' => 'penerimaan kemasan',
            'laporan_batch' => $nomer,
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "penerimaan kemasan",
            'notif_link' => 'penerimaanBB',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah kemasan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect()->route('penerimaanBB');
    }



    public function edit_detilperiksaruang(Request $req)
    {
        // dd($req);
        $dataAwal = Detilruangan::all()->where('id', $req->id_ruangan)->first();
        // dd($dataAwal);
        $id = Auth::user()->id;
        // $cpid = $req['cpid'];
        $pabrik = Auth::user()->pabrik;
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        // $tgl = $tgl->format('Y-m-d');

        if ($req['lantai'] == 'Sudah') {
            if ($dataAwal['lantai'] != null) {
                $tglLamalantai = new \DateTime(Carbon::create($dataAwal['lantai'])->toDateTimeString());
                $lantai = $tglLamalantai;
            } else {
                $lantai = $tgl;
            }
        } else {
            $lantai = null;
        }


        if ($req['meja'] == 'Sudah') {
            if ($dataAwal['meja'] != null) {
                $tglLamameja = new \DateTime(Carbon::create($dataAwal['meja'])->toDateTimeString());
                $meja = $tglLamameja;
            } else {
                $meja = $tgl;
            }
        } else {
            $meja = null;
        }

        if ($req['jendela'] == 'Sudah') {
            if ($dataAwal['jendela'] != null) {
                $tglLamajendela = new \DateTime(Carbon::create($dataAwal['jendela'])->toDateTimeString());
                $jendela = $tglLamajendela;
            } else {
                $jendela = $tgl;
            }
        } else {
            $jendela = null;
        }

        if ($req['langit'] == 'Sudah') {
            if ($dataAwal['langit'] != null) {
                $tglLamalangit = new \DateTime(Carbon::create($dataAwal['langit'])->toDateTimeString());
                $langit = $tglLamalangit;
                // dd($langit);
            } else {
                $langit = $tgl;
            }
        } else {
            $langit = null;
        }


        Detilruangan::all()->where('id', $req->id_ruangan)->first()->update([
            'lantai' => $lantai,
            'meja' => $meja,
            'jendela' => $jendela,
            'langit' => $langit,
            'pelaksana' => Admin::bersih($req->pelaksana),
            'diperiksa_oleh' => Admin::bersih($req->diperiksa_oleh),
            'keterangan' => Admin::bersih($req->keterangan),
        ]);

        // dd($dataygdiubah);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "Periksa ruang",
        //     'notif_link' => 'periksasaniruang',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan detil periksa sanitasi ruang',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect()->route('detilruangan');
    }


    public function edit_periksaruang(Request $req)
    {
        // dd($req);

        $id = Auth::user()->id;
        // $cpid = $req['cpid'];
        $pabrik = Auth::user()->pabrik;
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());

        $time = strtotime($req->tanggal_prosedur);

        $newformat = date('Y-m-d', $time);

        Periksaruang::all()->where('id_periksaruang', $req->id)->first()->update([
            'nomer_prosedur' => $req->nomer_prosedur,
            'tanggal_prosedur' => $newformat,
            'nama_ruangan' => Admin::bersih($req->nama_ruangan),
            'cara_pembersihan' => Admin::bersih($req->cara_pembersihan)
        ]);


        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan periksa sani ruang',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect()->route('periksasaniruang');
    }


    public function edit_terimabahan(Request $req)
    {
        $id = Auth::user()->id;
        $cpid = $req['cpid'];
        $pabrik = Auth::user()->pabrik;
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        $data = [
            'protap' => $req['protap'],
            'nama' => $req['nama'],
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'kode' => Admin::bersih_angka($req['kode']),
            'ruang' => Admin::bersih($req['ruang']),
            'pabrik' => $pabrik,
            'status' => 0,
        ];
        // dd($cpid);

        cp_bahan::all()->where('cp_bahan_id', $cpid)->first()->update([
            'protap' => $req['protap'],
            'nama' => $req['nama'],
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'kode' => $req['kode'],
            'ruang' => $req['ruang'],
            'pabrik' => $pabrik,
            'status' => 0,
        ]);

        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "penerimaan bahan",
        //     'notif_link' => 'penerimaanBB',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan penerimaan bahan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect()->route('penerimaanBB');
    }

    public function edit_terimaproduk(Request $req)
    {
        $id = Auth::user()->id;
        $cpid = $req['cpid'];
        $pabrik = Auth::user()->pabrik;

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        $data = [
            'protap' => $req['protap'],
            'nama' => $req['nama'],
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'kode' => $req['kode'],
            'ruang' => Admin::bersih($req['ruang']),
            'pabrik' => $pabrik,
            'status' => 0,
        ];
        // dd($data);
        cp_produk::all()->where('cp_produk_id', $cpid)->first()->update($data);

        // $nomer = cp_produk::insertGetId($data);

        // cp_produk::all()->where('cp_produk_id', $cpid)->first()->update($data);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "penerimaan produk",
        //     'notif_link' => 'penerimaanBB',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan penerimaan produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect()->route('penerimaanBB');
    }

    public function edit_terimakemasan(Request $req)
    {
        $id = Auth::user()->id;
        $cpid = $req['cpid'];
        $pabrik = Auth::user()->pabrik;

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        $data = [
            'protap' => $req['protap'],
            'nama' => $req['nama'],
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'kode' => Admin::bersih_angka($req['kode']),
            'ruang' => Admin::bersih($req['ruang']),
            'pabrik' => $pabrik,
            'status' => 0,
        ];
        cp_kemasan::all()->where('cp_kemasan_id', $cpid)->first()->update($data);

        // cp_kemasan::all()->where('cp_kemasan_id', $cpid)->first()->update($data);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "penerimaan kemasan",
        //     'notif_link' => 'penerimaanBB',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan penerimaan kemasan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect()->route('penerimaanBB');
    }

    public function tambah_penerimaanbbmasuk(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_bahan' => $req['nama_bahanbaku'],
            'no_loth' => Admin::bersih_angka($req['no_loth']),
            'pemasok' => Admin::bersih($req['pemasok']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'no_kontrol' => Admin::bersih_angka($req['no_kontrol']),
            'kedaluwarsa' => $req['kedaluwarsa'],
            'pabrik' => $pabrik,
            'induk' => $req['induk'],
            'user_id' => $id,
        ];
        PPbahanbakumasuk::insert($data);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan ",
            'notif_laporan' => "penerimaan bahan",
            'notif_link' => 'penerimaanBB',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => 0,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan penerimaan bahan baku masuk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilterimabbid');
    }


    public function tambah_penerimaanbbkeluar(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_bahan' => $req['nama_bahanbaku'],
            'untuk_produk' => Admin::bersih($req['untuk_produk']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'sisa' => $req['sisa'],
            'pabrik' => $pabrik,
            'induk' => $req['induk'],
            'user_id' => $id,
        ];
        PPbahanbakukeluar::insert($data);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan ",
            'notif_laporan' => "penerimaan bahan",
            'notif_link' => 'penerimaanBB',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => 0,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan penerimaan bahan baku keluar',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilterimabbid');
    }


    public function tambah_penerimaanprdukmasuk(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_produkjadi' => Admin::bersih($req['nama_produkjadi']),
            'no_loth' => Admin::bersih_angka($req['no_loth']),
            'pemasok' => Admin::bersih($req['pemasok']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'no_kontrol' => Admin::bersih_angka($req['no_kontrol']),
            'kedaluwarsa' => $req['kedaluwarsa'],
            'pabrik' => $pabrik,
            'induk' => $req['induk'],
            'user_id' => $id,
        ];
        PPprodukjadimasuk::insert($data);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan ",
            'notif_laporan' => "penerimaan produk",
            'notif_link' => 'penerimaanBB',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => 0,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan penerimaan produk masuk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilterimabbid');
    }


    public function tambah_penerimaanprodukkeluar(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_produk' => Admin::bersih($req['nama_produk']),
            'untuk_produk' => Admin::bersih($req['untuk_produk']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'sisa' => $req['sisa'],
            'pabrik' => $pabrik,
            'induk' => $req['induk'],
            'user_id' => $id,
        ];
        PPprodukjadikeluar::insert($data);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan ",
            'notif_laporan' => "penerimaan produk",
            'notif_link' => 'penerimaanBB',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => 0,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan penerimaan produk keluar',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilterimabbid');
    }
    public function tambah_penerimaakemasanmasuk(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_kemasan' => Admin::bersih($req['nama_kemasan']),
            'no_loth' => Admin::bersih_angka($req['no_loth']),
            'pemasok' => Admin::bersih($req['pemasok']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'no_kontrol' => Admin::bersih_angka($req['no_kontrol']),
            'kedaluwarsa' => $req['kedaluwarsa'],
            'pabrik' => $pabrik,
            'induk' => $req['induk'],
            'user_id' => $id,
        ];
        PPkemasanmasuk::insert($data);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan ",
            'notif_laporan' => "penerimaan kemasan",
            'notif_link' => 'penerimaanBB',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => 0,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan penerimaan kemasan masuk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);


        return redirect('/detilterimabbid');
    }
    public function tambah_penerimaankemasankeluar(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $data = [
            'tanggal' => $req['tanggal'],
            'nama_kemasan' => Admin::bersih($req['nama_kemasan']),
            'untuk_produk' => Admin::bersih($req['untuk_produk']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'sisa' => $req['sisa'],
            'pabrik' => $pabrik,
            'induk' => $req['induk'],
            'user_id' => $id,
        ];
        PPkemasankeluar::insert($data);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan ",
            'notif_laporan' => "penerimaan kemasan",
            'notif_link' => 'penerimaanBB',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => 0,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan penerimaan kemasan keluar',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilterimabbid');
    }

    public function edit_penerimaanbbmasuk(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $data = [
            'nama_bahan' => $req['nama_bahanbaku'],
            'no_loth' => Admin::bersih_angka($req['no_loth']),
            'pemasok' => Admin::bersih($req['pemasok']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'no_kontrol' => Admin::bersih_angka($req['no_kontrol']),
            'kedaluwarsa' => $req['kedaluwarsa'],
        ];
        PPbahanbakumasuk::all()->where('id_ppbahanbaku', $id)->first()->update($data);


        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan penerimaan bahan baku masuk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilterimabbid');
    }
    public function edit_penerimaanbbkeluar(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $data = [
            'nama_bahan' => $req['nama_bahanbaku'],
            'untuk_produk' => Admin::bersih($req['untuk_produk']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'sisa' => $req['sisa'],
        ];
        PPbahanbakukeluar::all()->where('id_ppbahanbakukeluar', $id)->first()->update($data);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan penerimaan bahan baku kel;uar',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilterimabbid');
    }
    public function edit_penerimaanprdukmasuk(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        // dd($id);
        $data = [
            'nama_produkjadi' => $req['nama_produkjadi'],
            'no_loth' => Admin::bersih_angka($req['no_loth']),
            'pemasok' => Admin::bersih($req['pemasok']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'no_kontrol' => Admin::bersih_angka($req['no_kontrol']),
            'kedaluwarsa' => $req['kedaluwarsa'],
        ];
        PPprodukjadimasuk::all()->where('id_produkjadimasuk', $id)->first()->update($data);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan penerimaan produk jadi masuk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilterimabbid');
    }

    public function edit_penerimaanprodukkeluar(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $data = [
            'nama_produk' => $req['nama_produk'],
            'untuk_produk' => Admin::bersih($req['untuk_produk']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'sisa' => $req['sisa'],
            'pabrik' => $pabrik,
            'induk' => $req['induk']
        ];
        PPprodukjadikeluar::all()->where('id_ppprodukjadikeluar', $id)->first()->update($data);


        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan penerimaan produk jadi keluar',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilterimabbid');
    }


    public function edit_penerimaakemasanmasuk(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $data = [
            'nama_kemasan' => Admin::bersih($req['nama_kemasan']),
            'no_loth' => Admin::bersih_angka($req['no_loth']),
            'pemasok' => Admin::bersih($req['pemasok']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'no_kontrol' => Admin::bersih_angka($req['no_kontrol']),
            'kedaluwarsa' => $req['kedaluwarsa'],
        ];
        PPkemasanmasuk::all()->where('id_kemasanmasuk', $id)->first()->update($data);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan penerimaan kemasan masuk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/detilterimabbid');
    }
    public function edit_penerimaankemasankeluar(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $data = [
            'nama_kemasan' => $req['nama_kemasan'],
            'untuk_produk' => Admin::bersih($req['untuk_produk']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'sisa' => $req['sisa'],
        ];
        PPkemasankeluar::all()->where('id_ppkemasankeluar', $id)->first()->update($data);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan penerimaan kemasan keluar',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilterimabbid');
    }

    //tampil kemas batch
    public function tampil_kemasbatch()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = pengolahanbatch::all()->where('pabrik', $pabrik); //;
            // dd($pabrik);
        } else {
            $data = pengolahanbatch::all()->where('pabrik', $pabrik);
            // echo "halo";
        }
        $data2 = produk::all()->where('user_id', Auth::user()->pabrik);
        $data3 = kemasan::all()->where('user_id', Auth::user()->pabrik);

        return view('catatan.dokumen.pengemasanbatch', [
            'data' => $data,
            'data2' => $data2, 'data3' => $data3
        ]);
    }

    public function tampil_detilkemasbatch(Request $req)
    {
        // dd($req);
        $pabrik = Auth::user()->pabrik;
        $id = $req['nobatch'] ??  session()->get('detilkemasbatch');
        session(['detilkemasbatch' => $req['nobatch'] ??  $id]);
        $data = Pengemasanbatchproduk::all()->where('id_pengemasanbatchproduk', $id)->first();
        // dd($data);
        $dp = protap::all()->where('protap_id', $data['protap'])->first();
        // dd($dp);
        $kemasan = kemasan::all()->where('user_id', $pabrik);
        $prkemas = pr_bahankemas::all()->where('id_kemasbatch', $id);
        $proisi = prosedur_isi::all()->where('id_kemas', $id);
        $protanda  = prosedur_tanda::all()->where('id_kemas', $id);
        // dd($kemasan);
        return view('catatan.dokumen.detilkemasbatch', [
            'id' => $id,
            'data' => $data, 'kemasan' => $kemasan, 'prkemas' => $prkemas,
            'proisi' => $proisi, 'protanda' => $protanda,
            'status' => $req['status'], 'dp' => $dp
        ]);
    }

    public function tambah_protanda(Request $req)
    {
        $id = session()->get('detilkemasbatch');
        $pabrik = Auth::user()->pabrik;
        $data = [
            'isi' => Admin::bersih($req['isi']),
            'id_kemas' => $id,
        ];
        prosedur_tanda::insert($data);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan prosedur penanda pengemasan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/detilkemasbatch');
    }

    public function tambah_proisi(Request $req)
    {
        $id = session()->get('detilkemasbatch');
        $pabrik = Auth::user()->pabrik;
        $data = [
            'isi' => Admin::bersih($req['isi']),
            'id_kemas' => $id,
        ];
        prosedur_isi::insert($data);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan prosedur pengisian batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilkemasbatch');
    }

    public function tambah_prkemas(Request $req)
    {
        $id = session()->get('detilkemasbatch');
        $pabrik = Auth::user()->pabrik;
        $data = [
            'kode_kemas' => $req['kode'],
            'nama_kemas' => $req['nama'],
            'j_butuh' => $req['jbutuh'],
            'j_tolak' => $req['jtolak'],
            'no_qc' => Admin::bersih_angka($req['noqc']),
            'j_pakai' => $req['jpakai'],
            'j_kembali' => $req['jkembali'],
            'id_kemasbatch' => $id,
        ];
        // dd($data);
        pr_bahankemas::insert($data);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan penerimaan dan rekonsiliasi pengemasan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilkemasbatch');
    }

    public function edit_protanda(Request $req)
    {
        $id = session()->get('detilkemasbatch');
        $pabrik = Auth::user()->pabrik;
        $key = $req['key'];
        $data = [
            'isi' => Admin::bersih($req['isi']),
            'id_kemas' => $id,
        ];
        // dd($req);
        prosedur_tanda::all()->where("id_protanda", $key)->first()->update($data);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan prosedur penanda pengemasan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/detilkemasbatch')->with('success', 'Data berhasil diubah!');
    }

    public function edit_proisi(Request $req)
    {
        $id = session()->get('detilkemasbatch');
        $pabrik = Auth::user()->pabrik;
        $key = $req['key'];
        $data = [
            'isi' => Admin::bersih($req['isi']),
            'id_kemas' => $id,
        ];
        prosedur_isi::all()->where("id_proisi", $key)->first()->update($data);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan prosedur pengisian batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilkemasbatch')->with('success', 'Data berhasil diubah!');
    }

    public function edit_prkemas(Request $req)
    {
        $id = session()->get('detilkemasbatch');
        $pabrik = Auth::user()->pabrik;
        $key = $req['key'];
        // dd($key);
        $data = [
            'kode_kemas' => $req['kode'],
            'nama_kemas' => $req['nama'],
            'j_butuh' => $req['jbutuh'],
            'j_tolak' => $req['jtolak'],
            'no_qc' => Admin::bersih_angka($req['noqc']),
            'j_pakai' => $req['jpakai'],
            'j_kembali' => $req['jkembali'],
            'id_kemasbatch' => $id,
        ];
        pr_bahankemas::all()->where("id_pr_bahankemas", $key)->first()->update($data);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan penerimaan dan rekonsiliasi pengemasan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detilkemasbatch')->with('success', 'Data berhasil diubah!');
    }



    //tampil batch
    public function tampil_pengolahanbatch()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = pengolahanbatch::join('protaps', 'pengolahanbatches.pob', '=', 'protaps.protap_id')
                ->get(['pengolahanbatches.*', 'protaps.protap_nama', 'protap_id']); //;
            // dd($pabrik);
        } else {
            $data = pengolahanbatch::join('protaps', 'pengolahanbatches.pob', '=', 'protaps.protap_id')
                ->get(['pengolahanbatches.*', 'protaps.protap_nama', 'protap_id']);
            // echo "halo";
        }
        // dd($data);
        $data2 = produk::all()->where('user_id', Auth::user()->pabrik);
        $data3 = kemasan::all()->where('user_id', Auth::user()->pabrik);
        $protap = protap::all()->where('user_id', Auth::user()->pabrik)->where('protap_jenis', 8);
        // dd(Auth::user()->pabrik);

        return view('catatan.dokumen.pengolahanbatch', ['data' => $data, 'data2' => $data2, 'data3' => $data3, 'protap' => $protap]);
    }
    public function tampil_detilbatch(Request $req)
    {
        // dd($req);


        $id = $req['nobatch'] ??  session()->get('detilbatch');
        session(['detilbatch' => $req['nobatch'] ??  $id]);

        $data = pengolahanbatch::all()->where('nomor_batch', $id)->first();
        $nomer_protap = protap::findOrFail($data['pob']);
        // dd($nomer_protap);
        // $data = [$data];
        // dd($data['nomor_batch']);
        $kom = komposisi::all()->where('nomor_batch', $id);
        $alat = peralatan::all()->where('nomor_batch', $id);
        $nimbang = penimbangan::all()->where('nomor_batch', $id);
        $olah = produksi::all()->where('id_batch', $id);
        $rekon = rekonsiliasi::all()->where('id_batch', $id);
        $bahanbaku = bahanbaku::all()->where('user_id', Auth::user()->pabrik);
        return view('catatan.dokumen.detailbatch', [
            'id' => $id, 'no' => $req['nomor'],
            'data' => $data, 'list_kom' => $kom, 'list_alat' => $alat, 'list_nimbang' => $nimbang,
            'list_olah' => $olah, 'rekon' => $rekon,
            'status' => $req['status'], 'bahanbaku' => $bahanbaku, 'nomer_protap' => $nomer_protap

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
            'nomor_batch' => Admin::bersih_angka($req['no_batch']),
            'besar_batch' => Admin::bersih_angka($req['besar_batch']),
            'bentuk_sedia' => Admin::bersih_angka($req['bentuk_sediaan']),
            'kategori' => Admin::bersih_angka($req['kategori']),
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
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        // dd($hasil);
        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pengolahan batch",
            'notif_link' => 'pengolahanbatch',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/pengolahanbatch');
    }

    public function edit_batch(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'pob' => $req['pob'],
            'kode_produk' => $req['kode_produk'],
            'nama_produk' => $req['nama_produk'],
            'nomor_batch' => Admin::bersih_angka($req['no_batch']),
            'besar_batch' => Admin::bersih_angka($req['besar_batch']),
            'bentuk_sedia' => Admin::bersih_angka($req['bentuk_sediaan']),
            'kategori' => Admin::bersih_angka($req['kategori']),
            'kemasan' => $req['kemasan'],
        ];

        $nomer = pengolahanbatch::where('batch', $id)->update($hasil);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "pengolahan batch",
        //     'notif_link' => 'penerimaanBB',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pengolahanbatch');
    }

    //komposisi
    public function tambah_komposisi(Request $req)
    {
        $id = Auth::user()->id;
        $nobatch = $req['nobatch'];
        $hasil = [
            'komposisi_kode' => Admin::bersih_angka($req['id']),
            'kompisisi_nama' => Admin::bersih($req['nama']),
            'komposisi_persen' => Admin::bersih_angka($req['persen']),
            'nomor_batch' => Admin::bersih_angka($nobatch),
            'user_id' => $id,
        ];

        komposisi::insert($hasil);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan komposisi pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        $to = $req['nobatch'];
        return redirect('/detil_batch/')->with('success', 'Data berhasil ditambah!');
    }

    //peralatan
    public function tambah_peralatan(Request $req)
    {
        $id = Auth::user()->id;
        $nobatch = $req['nobatch'];
        $hasil = [
            'peralatan_kode' => $req['kode'],
            'peralatan_nama' => Admin::bersih($req['nama']),
            'nomor_batch' => Admin::bersih_angka($nobatch),
            'user_id' => $id,
        ];

        peralatan::insert($hasil);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan peralatan pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);


        $to = $req['nobatch'];
        return redirect('/detil_batch/')->with('success', 'Data berhasil ditambah!');
    }

    //catat penimbangan
    public function tambah_penimbangan(Request $req)
    {
        $id = Auth::user()->id;
        $nobatch = $req['nobatch'];
        $hasil = [
            'penimbangan_kodebahan' => Admin::bersih_angka($req['kode_bahan']),
            'penimbangan_namabahan' => Admin::bersih($req['nama_bahan']),
            'penimbangan_loth' => Admin::bersih_angka($req['no_loth']),
            'penimbangan_jumlahbutuh' => $req['jumlah_butuh'] . ' ' . $req['satuan'],
            'penimbangan_jumlahtimbang' => $req['jumlah_timbang'] . ' ' . $req['satuan2'],
            'penimbangan_timbangoleh' => Admin::bersih($req['ditimbang']),
            'penimbangan_periksaoleh' => Admin::bersih($req['diperiksa']),
            'nomor_batch' => Admin::bersih_angka($nobatch),
            'user_id' => $id,
        ];
        // dd($hasil);
        penimbangan::insert($hasil);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan penimbangan pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        $to = $req['nobatch'];
        return redirect('/detil_batch/')->with('success', 'Data berhasil ditambah!');
    }

    //olah
    public function tambah_olah(Request $req)
    {
        $id = Auth::user()->id;
        $nobatch = $req['nobatch'];
        $hasil = [
            'isi' => Admin::bersih($req['isi']),
            'id_batch' => Admin::bersih_angka($nobatch),
            'user_id' => $id,
        ];

        produksi::insert($hasil);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan perlakuan pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        $to = $req['nobatch'];
        return redirect('/detil_batch/')->with('success', 'Data berhasil ditambah!');
    }

    public function tambah_rekonsiliasi(Request $req)
    {
        $id = Auth::user()->id;
        $nobatch = $req['nobatch'];
        $hasil = [
            'awal' => Admin::bersih_angka($req['awal']),
            'akhir' => Admin::bersih_angka($req['akhir']),
            'id_batch' => Admin::bersih_angka($nobatch),
            'user_id' => $id,
        ];

        rekonsiliasi::insert($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan rekonsiliasi pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        $to = $req['nobatch'];
        return redirect('/detil_batch/')->with('success', 'Data berhasil ditambah!');
    }

    public function hapus_komposisi($id)
    {

        $data = komposisi::all()->where('komposisi_id', $id);
        $post = komposisi::all()->where('komposisi_id', $id)->each->delete();

        $log = [
            'log_isi' => Auth::user()->namadepan . ' menghapus laporan komposisi pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detil_batch/')->with('success', 'Data berhasil dihapus!');
    }

    public function hapus_peralatan($id)
    {
        $data = peralatan::all()->where('peralatan_id', $id);
        $post = peralatan::all()->where('peralatan_id', $id)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menghapus laporan peralatan pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detil_batch/')->with('success', 'Data berhasil dihapus!');
    }

    public function hapus_penimbangan($id)
    {
        $data = penimbangan::all()->where('penimbangan_id', $id);
        $post = penimbangan::all()->where('penimbangan_id', $id)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menghapus laporan penimbangan pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/detil_batch/')->with('success', 'Data berhasil dihapus!');
    }

    public function hapus_olah($id)
    {
        $data = produksi::all()->where('produksi_id', $id);
        $post = produksi::all()->where('produksi_id', $id)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menghapus laporan perlakuan pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detil_batch/')->with('success', 'Data berhasil dihapus!');
    }

    public function hapus_rekonsiliasi($id)
    {
        $data = rekonsiliasi::all()->where('rekonsiliasi_id', $id);
        $post = rekonsiliasi::all()->where('rekonsiliasi_id', $id)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menghapus laporan rekonsiliasi pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detil_batch/')->with('success', 'Data berhasil dihapus!');
    }

    public function tambah_company(Request $req)
    {
        $id = Auth::user()->pabrik;
        if ($req->file('upload') != null) {
            $file = $req->file('upload');
            $nama = $file->getClientOriginalName();
            $tujuan_upload = 'asset/logo/';
            $ext = pathinfo($nama, PATHINFO_EXTENSION);
            $file->move($tujuan_upload, session('pabrik') . '.' . $ext);

            $user = pabrik::all()->where("pabrik_id", $id)->first()->update([
                'nama' => Admin::bersih_karakter($req['nama']),
                'alamat' => Admin::bersih_karakter($req['alamat']),
                'no_hp' => Admin::bersih_angka($req['telp']),
                'logo' =>  session('pabrik') . '.' . $ext,
            ]);
        } else {
            $user = pabrik::all()->where("pabrik_id", $id)->first()->update([
                'nama' => Admin::bersih_karakter($req['nama']),
                'alamat' => Admin::bersih_karakter($req['alamat']),
                'no_hp' => Admin::bersih_angka($req['telp']),
            ]);
        }

        // dd($req);


        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah pabrik',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/setting');
    }

    public function tambah_produk(Request $req)
    {
        $id = Auth::user()->pabrik;
        $hasil = [
            'produk_nama' => Admin::bersih($req['nama']),
            'produk_kode' => Admin::bersih_angka($req['kode']),
            'user_id' => $id,
        ];

        produk::insert($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);


        return redirect('/setting');
    }
    public function tambah_produkantara(Request $req)
    {
        $id = Auth::user()->pabrik;
        $hasil = [
            'produkantara_nama' => Admin::bersih($req['nama']),
            'produkantara_kode' => Admin::bersih_angka($req['kode']),
            'user_id' => $id,
        ];

        produkantara::insert($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah produk antara',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/setting');
    }

    public function tambah_kemasan(Request $req)
    {
        $id = Auth::user()->pabrik;
        $hasil = [
            'kemasan_nama' => Admin::bersih($req['nama']),
            'kemasan_kode' => Admin::bersih_angka($req['kode']),
            'user_id' => $id,
        ];

        // dd($hasil);

        kemasan::insert($hasil);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah kemasan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);


        return redirect('/setting');
    }

    public function tambah_bahanbaku(Request $req)
    {
        $id = Auth::user()->pabrik;
        $hasil = [
            'bahanbaku_nama' => Admin::bersih($req['nama']),
            'bahanbaku_kode' => Admin::bersih_angka($req['kode']),
            'user_id' => $id,
        ];

        bahanbaku::insert($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah bahan baku',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/setting');
    }

    public function hapus_produk($id)
    {
        produk::all()->where('produk_id', $id)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menghapus produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/setting')->with('success', 'Data berhasil dihapus!');
    }

    public function hapus_kemasan($id)
    {
        kemasan::all()->where('kemasan_id', $id)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menghapus kemasan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/setting')->with('success', 'Data berhasil dihapus!');
    }

    public function hapus_bahanbaku($id)
    {
        bahanbaku::all()->where('bahanbaku_id', $id)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menghapus bahan baku',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/setting')->with('success', 'Data berhasil dihapus!');
    }
    public function hapus_produkantara($id)
    {
        produkantara::all()->where('produkantara_id', $id)->each->delete();
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menghapus produk antara',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/setting')->with('success', 'Data berhasil dihapus!');
    }

    public function tampil_setting()
    {
        if (Auth::user()->level < 0) {
            return view('tunggu');
        } else {
            $id = Auth::user()->pabrik;
            $pabrik = pabrik::all()->where('pabrik_id', Auth::user()->pabrik);

            foreach ($pabrik as $row) {
                $nama = $row['nama'];
                $alamat = $row['alamat'] ?? 'kosong';
                $no_hp = $row['no_hp'];
                $logo = $row['logo'];
            }
            $kom = company::all()->where('user_id', $id);
            $produk = produk::all()->where('user_id', $id);
            $produkantara = produkantara::all()->where('user_id', $id);
            $kemasan = kemasan::all()->where('user_id', $id);
            $bahanbaku = bahanbaku::all()->where('user_id', $id);
            return view('setting', [
                'alamat' => $alamat ?? "kosong", 'no_hp' => $no_hp ?? "kosong", 'nama' => $nama ?? "kosong", 'logo' => $logo ?? "kosong",
                'list_com' => $kom, 'list_produk' => $produk, 'list_produkantara' => $produkantara, 'list_kemasan' => $kemasan, 'list_bahanbaku' => $bahanbaku
            ]);
        }
    }

    public function tampil_laporan(Request $req)
    {
        $id = Auth::user()->pabrik;
        // $produk  = produk::all()->where('user_id', Auth::user()->pabrik);
        $data = laporan::all()->where('pabrik_id', $id)->where('laporan_diterima', '!=', 'belum');
        // dd($data);
        return view('laporan', compact('data'));
    }

    public function tampil_periksapersonil()
    {
        $data = Periksapersonil::all()->where('pabrik', Auth::user()->pabrik);
        return view('catatan.higidansani.periksapersonil', ['data' => $data]);
    }

    public function tambah_periksapersonil(Request $req)
    {
        $file = $req->file('file');
        $exten = $file->getClientOriginalExtension();
        $nama = Admin::bersih($req['nama_personil']) . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten;
        $tujuan_upload = 'asset/health_personil';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nama' => Admin::bersih($req['nama_personil']),
            'nama_file' => $nama,
            'pabrik' => $pabrik,
            'user_id' => $id,
        ];
        $nomer = Periksapersonil::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'Periksa Personil',
            'laporan_batch' => 'dummy',
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pemeriksaan personil",
            'notif_link' => 'periksapersonil',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan periksa personil',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/periksapersonil');
    }
    public function edit_periksapersonil(Request $req)
    {
        $tujuan_upload = 'asset/health_personil';
        $nama = $req['filename'];
        $file = $req->file('file');
        $exten = $file->getClientOriginalExtension();
        $filedelete = $tujuan_upload . "/" . $nama;
        File::delete(public_path("/" . $filedelete));
        $file = $req->file('file');
        $namasimpan = Admin::bersih($req['nama_personil']) . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten;
        $file->move($tujuan_upload, $namasimpan);
        Periksapersonil::where('personil_id', $req['id'])
            ->update([
                'nama' => Admin::bersih($req['nama_personil']),
                'nama_file' => $req['nama_personil'] . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten,
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "Periksa Personil")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);


        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan periksa personil',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/periksapersonil');
    }

    public function tampil_periksasanialat()
    {
        $pabrik = Auth::user()->pabrik;
        $data1 = periksaruang::all();
        $data2 = protap::all()->where('protap_jenis', 21);

        $data = Periksaalat::join('protaps', 'periksaalats.pob_nomor', '=', 'protaps.protap_id')
            ->get(['periksaalats.*', 'protaps.protap_nama', 'protap_id']);

        return view('catatan.higidansani.periksasanialat', [
            'data' => $data,
            'data1' => $data1,
            'data2' => $data2
        ]);
    }



    public function tambah_periksaalat(Request $req)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'tanggal' => $tgl,
            'pob_nomor' => $req['pob_nomor'],
            'nama_ruangan' => $req['nama_ruangan'],
            'nama_alat' => Admin::bersih($req['nama_alat']),
            'type_merk' => Admin::bersih($req['type_merk']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = Periksaalat::insertGetId($hasil);


        $laporan = [
            'laporan_nama' => 'periksa sanitasi alat',
            'laporan_batch' => Admin::bersih_angka($req['no_batch']) ?? 0,
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pemeriksaan sanitasi alat",
            'notif_link' => 'periksasanialat',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pemeriksaan sanitasi alat',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/periksasanialat');
    }



    public function edit_periksaalat(Request $req)
    {
        // dd($req);
        Periksaalat::where('id_periksaalat', $req['id'])
            ->update([
                'pob_nomor' => $req['pob_nomor'],
                'nama_ruangan' => $req['nama_ruangan'],
                'nama_alat' => Admin::bersih($req['nama_alat']),
                'type_merk' => Admin::bersih($req['type_merk']),
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        // laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "periksa sanitasi alat")->update([
        //     'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
        //     'laporan_diterima' => "belum",
        //     'tgl_diajukan' => $tgl,
        // ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "penmeriksaan sanitasi alat",
        //     'notif_link' => 'periksasanialat',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan pemeriksaan sanitasi alat',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/periksasanialat');
    }
    public function tampil_periksasaniruang()
    {
        $pabrik = Auth::user()->pabrik;
        $data2 = protap::all()->where('protap_jenis', 22);
        // $data = periksaruang::all()->where('pabrik', $pabrik);
        $data = periksaruang::join('protaps', 'periksaruangs.nomer_prosedur', '=', 'protaps.protap_id')
            ->get(['periksaruangs.*', 'protaps.protap_nama', 'protap_id']);
        return view('catatanpelaksana.higidansani.periksasaniruang', [
            'data' => $data,
            'data2' => $data2
        ]);
    }

    public function tambah_periksaruang(Request $req)
    {
        // dd($req);
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'tanggal_prosedur' => $req['tanggal_prosedur'],
            'nomer_prosedur' => $req['nomer_prosedur'],
            'nama_ruangan' => Admin::bersih($req['nama_ruangan']),
            'cara_pembersihan' => Admin::bersih($req['cara_pembersihan']),
            'user_id' => $id,
            'pabrik' => $pabrik,
            'status' => 0
        ];

        $nomer = periksaruang::insertGetId($hasil);
        // dd($nomer);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());


        $inilaporan = [
            'laporan_nama' => 'Periksa Sanitasi Ruangan',
            'laporan_batch' => Admin::bersih_angka($req['no_batch']) ?? $nomer,
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];
        laporan::insert($inilaporan);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "Periksa Sanitasi Ruangan",
            'notif_link' => 'periksasaniruang',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pemeriksaan sanitasi ruang',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/periksasaniruang');
    }

    public function tambah_detilperiksaruang(Request $req)
    {
        // dd($req);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        // $tgl = $tgl->format('Y-m-d');
        if ($req['lantai'] == 'Sudah') {
            $lantai = $tgl;
        } else {
            $lantai = null;
        }

        if ($req['meja'] == 'Sudah') {
            $meja = $tgl;
        } else {
            $meja = null;
        }

        if ($req['jendela'] == 'Sudah') {
            $jendela = $tgl;
        } else {
            $jendela = null;
        }

        if ($req['langit'] == 'Sudah') {
            $langit = $tgl;
        } else {
            $langit = null;
        }


        $laporan = [
            'id_induk' => $req->id_induk,
            'lantai' => $lantai,
            'meja' => $meja,
            'jendela' => $jendela,
            'langit' => $langit,
            'keterangan' =>  Admin::bersih($req->keterangan),
            'pelaksana' => Admin::bersih($req->pelaksana),
            'diperiksa_oleh' => Admin::bersih($req->diperiksa_oleh)
        ];

        $nomer = Detilruangan::insertGetId($laporan);

        // date_default_timezone_set("Asia/Jakarta");
        // $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        // $tgl = $tgl->format('Y-m-d');

        // $inilaporan = [
        //     'laporan_nama' => 'periksa sanitasi ruangan',
        //     'laporan_batch' => $req['no_batch'],
        //     'laporan_nomor' => $nomer,
        //     'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
        //     'laporan_diterima' => "belum",
        //     'tgl_diajukan' => $tgl,
        //     'tgl_diterima' => $tgl,
        //     'pabrik_id'  =>  $pabrik,
        //     "user_id" => $id,
        // ];
        // laporan::insert($inilaporan);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "Detil Laporan Pemeriksaan Ruangan",
            'notif_link' => 'periksasaniruang',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah detil laporan pemeriksaan sanitasi ruang',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/detilruangan');
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
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menolak laporan pengolahan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return view('catatanpelaksana.dokumen.pengolahanbatch', ['data' => $data]);
    }


    //yusril
    public function tambah_pelatihanhiginitas(Request $req)
    {
        // dd($req);
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'kode_pelatihan' =>  Admin::bersih_angka($req['kode_pelatihan']),
            'materi_pelatihan' => Admin::bersih($req['materi_pelatihan']),
            'peserta_pelatihan' => Admin::bersih($req['peserta_pelatihan']),
            'pelatih' =>  Admin::bersih($req['pelatih']),
            'metode_pelatihan' => Admin::bersih($req['metode_pelatihan']),
            'jadwal_mulai_pelatihan' => $req['mulai'],
            'jadwal_berakhir_pelatihan' => $req['berakhir'],
            'metode_penilaian' => Admin::bersih($req['metode_penilaian']),
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
            'laporan_batch' => Admin::bersih_angka($req['kode_pelatihan']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pelatihan higiene dan sanitasi",
            'notif_link' => 'program-dan-pelatihan-higiene-dan-sanitasi',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan pelatihan higiene dan sanitasi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/program-dan-pelatihan-higiene-dan-sanitasi');
    }
    public function tambah_pelatihancpkb(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'kode_pelatihan' => Admin::bersih_angka($req['kode_pelatihan']),
            'materi_pelatihan' => Admin::bersih($req['materi_pelatihan']),
            'peserta_pelatihan' => Admin::bersih($req['peserta_pelatihan']),
            'pelatih' => Admin::bersih($req['pelatih']),
            'metode_pelatihan' => Admin::bersih($req['metode_pelatihan']),
            'jadwal_mulai_pelatihan' => $req['mulai'],
            'jadwal_berakhir_pelatihan' => $req['berakhir'],
            'metode_penilaian' => Admin::bersih($req['metode_penilaian']),
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
            'laporan_batch' => Admin::bersih_angka($req['kode_pelatihan']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pelatihan cpkb",
            'notif_link' => 'program-dan-pelatihan-higiene-dan-sanitasi',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan pelatihan cpkb',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/program-dan-pelatihan-higiene-dan-sanitasi');
    }

    public function edit_pelatihanhiginitas(Request $req)
    {
        // dd($req);
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'kode_pelatihan' => Admin::bersih_angka($req['kode_pelatihan']),
            'materi_pelatihan' => Admin::bersih($req['materi_pelatihan']),
            'peserta_pelatihan' => Admin::bersih($req['peserta_pelatihan']),
            'pelatih' => Admin::bersih($req['pelatih']),
            'metode_pelatihan' => Admin::bersih($req['metode_pelatihan']),
            'jadwal_mulai_pelatihan' => $req['mulai'],
            'jadwal_berakhir_pelatihan' => $req['berakhir'],
            'metode_penilaian' => Admin::bersih($req['metode_penilaian']),
        ];
        // dd($hasil);

        $nomer = programpelatihan::all()->where('id_programpelatihan', $id)->first()->update($hasil);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "pelatihan higiene dan sanitasi",
        //     'notif_link' => 'program-dan-pelatihan-higiene-dan-sanitasi',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan pelatihan higiene dan sanitasi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/program-dan-pelatihan-higiene-dan-sanitasi');
    }

    public function edit_pelatihancpkb(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'kode_pelatihan' => Admin::bersih_angka($req['kode_pelatihan']),
            'materi_pelatihan' => Admin::bersih($req['materi_pelatihan']),
            'peserta_pelatihan' => Admin::bersih($req['peserta_pelatihan']),
            'pelatih' => Admin::bersih($req['pelatih']),
            'metode_pelatihan' => Admin::bersih($req['metode_pelatihan']),
            'jadwal_mulai_pelatihan' => $req['mulai'],
            'jadwal_berakhir_pelatihan' => $req['berakhir'],
            'metode_penilaian' => Admin::bersih($req['metode_penilaian']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = Pelatihancpkb::all()->where('id_pelatihancpkb', $id)->first()->update($hasil);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "pelatihan cpkb",
        //     'notif_link' => 'program-dan-pelatihan-higiene-dan-sanitasi',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan pelatihan higiene dan sanitasi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/program-dan-pelatihan-higiene-dan-sanitasi');
    }

    public function tampil_programpelatihanhigienitasdansanitasi()
    {
        $pabrik = Auth::user()->pabrik;

        $data = programpelatihan::join('protaps', 'programpelatihans.protap', '=', 'protaps.protap_id')
            ->get(['programpelatihans.*', 'protaps.protap_nama', 'protap_id'])->where('pabrik', $pabrik);
        $data1 = Pelatihancpkb::join('protaps', 'pelatihancpkbs.protap', '=', 'protaps.protap_id')
            ->get(['pelatihancpkbs.*', 'protaps.protap_nama', 'protap_id'])->where('pabrik', $pabrik);
        $protap1 = protap::all()->where('protap_jenis', 4)->where('protap_detil', 1);
        $protap2 = protap::all()->where('protap_jenis', 4)->where('protap_detil', 2);
        return view('catatan.dokumen.programpelatihanhiginitas', [
            'data' => $data, 'data1' => $data1,
            'protap1' => $protap1, 'protap2' => $protap2
        ]);
    }
    public function tambah_keluhan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap_induk'],
            'kode_keluhan' => Admin::bersih_angka($req['kode_keluhan']),
            'nama_customer' => Admin::bersih($req['nama_customer']),
            'tanggal_keluhan' => $req['tanggal_keluhan'],
            'keluhan' => Admin::bersih($req['keluhan']),
            'tanggal_ditanggapi' => $req['tanggal_tanggapi_keluhan'],
            'produk_yang_digunakan' => Admin::bersih($req['produk_yang_digunakan']),
            'penanganan_keluhan' => Admin::bersih($req['penanganan_keluhan']),
            'tindak_lanjut' => Admin::bersih($req['tindak_lanjut']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = penanganankeluhan::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'Penanganan Keluhan',
            'laporan_batch' => 'dummy',
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "Penanganan Keluhan",
            'notif_link' => 'penanganan-keluhan',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan penangganan keluhan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/penanganan-keluhan');
    }
    public function edit_penanganankeluhan(Request $req)
    {
        penanganankeluhan::where('id_penanganankeluhan', $req['id'])
            ->update([
                'protap' => $req['protap_induk'],
                'kode_keluhan' => Admin::bersih_angka($req['kode_keluhan']),
                'nama_customer' => Admin::bersih($req['nama_customer']),
                'tanggal_keluhan' => $req['tanggal_keluhan'],
                'keluhan' => Admin::bersih($req['keluhan']),
                'tanggal_ditanggapi' => $req['tanggal_tanggapi_keluhan'],
                'produk_yang_digunakan' => Admin::bersih($req['produk_yang_digunakan']),
                'penanganan_keluhan' => Admin::bersih($req['penanganan_keluhan']),
                'tindak_lanjut' => Admin::bersih($req['tindak_lanjut']),
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "penanganan keluhan")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "penangganan keluhan",
        //     'notif_link' => 'penanganan-keluhan',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan penangganan keluhan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/penanganan-keluhan');
    }
    public function tampil_penanganankeluhan()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            // $data = penanganankeluhan::all()->where('pabrik', $pabrik);
            $data = penanganankeluhan::join('protaps', 'penanganankeluhans.protap', '=', 'protaps.protap_id')
                ->get(['penanganankeluhans.*', 'protaps.protap_nama', 'protap_id']);
        } else {
            // $data = penanganankeluhan::all()->where('pabrik', $pabrik);
            $produk = produk::all()->where('user_id', $pabrik);
            $data = penanganankeluhan::join('protaps', 'penanganankeluhans.protap', '=', 'protaps.protap_id')
                ->get(['penanganankeluhans.*', 'protaps.protap_nama', 'protap_id']);
        }

        $data2 = protap::all()->where('protap_jenis', 13);
        return view('catatan.dokumen.penanganankeluhan', [
            'data' => $data,
            'produk' => $produk ?? "",
            'data2' => $data2
        ]);
    }
    public function tambah_penarikan(Request $req)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');

        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap_induk'],
            'kode_penarikan' => Admin::bersih_angka($req['kode_penarikan']),
            'tanggal_penarikan' => $tgl,
            'nama_distributor' => Admin::bersih($req['nama_distributor']),
            'produk_ditarik' => $req['produk_ditarik'],
            'jumlah_produk_ditarik' => $req['jumlah_produk_ditarik'] . ' ' . $req['satuan'],
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'alasan_penarikan' => Admin::bersih($req['alasan_penarikan']),
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
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "penarikan produk",
            'notif_link' => 'penarikan-produk',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan penarikan produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/penarikan-produk');
    }

    public function edit_penarikanproduk(Request $req)
    {
        // dd($req);
        penarikanproduk::where('id_produk_penarikan', $req['id'])
            ->update([
                'protap' => $req['protap_induk'],
                'kode_penarikan' => Admin::bersih_angka($req['kode_penarikan']),
                // 'tanggal_penarikan' => $req['tanggal'],
                'nama_distributor' => Admin::bersih($req['nama_distributor']),
                'produk_ditarik' => Admin::bersih($req['produk_ditarik']),
                'jumlah_produk_ditarik' => $req['jumlah_produk_ditarik'] . ' ' . $req['satuan'],
                'no_batch' => Admin::bersih_angka($req['no_batch']),
                'alasan_penarikan' => Admin::bersih($req['alasan_penarikan']),
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "penarikan produk")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "penarikan produk",
        //     'notif_link' => 'penarikan-produk',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan penarikan produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/penarikan-produk');
    }
    public function tampil_penarikanproduk()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            // $data = penarikanproduk::all()->where('pabrik', $pabrik);
            $data = penarikanproduk::join('protaps', 'penarikanproduks.protap', '=', 'protaps.protap_id')
                ->get(['penarikanproduks.*', 'protaps.protap_nama', 'protap_id']);
        } else {
            // $data = penarikanproduk::all()->where('pabrik', $pabrik);
            $data = penarikanproduk::join('protaps', 'penarikanproduks.protap', '=', 'protaps.protap_id')
                ->get(['penarikanproduks.*', 'protaps.protap_nama', 'protap_id']);
            $produk = produk::all()->where('user_id', $pabrik);
        }

        $data2 = protap::all()->where('protap_jenis', 14);
        return view('catatan.dokumen.penarikanproduk', [
            'data' => $data,
            'produk' => $produk ?? [],
            'data2' => $data2
        ]);
    }
    public function tambah_distribusi(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' =>  $req['protap'],
            'kode_distribusi' => Admin::bersih_angka($req['kode_distribusi']),
            'tanggal' => $req['tanggal'],
            'id_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'nama_distributor' => Admin::bersih($req['nama_distributor']),
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
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "distribusi produk",
            'notif_link' => 'pendistribusian-produk',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan distribusi produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pendistribusian-produk');
    }
    public function edit_distribusi(Request $req)
    {
        $id = $req['id'];
        // dd($req);
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'kode_distribusi' => Admin::bersih_angka($req['kode_distribusi']),
            'id_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'nama_distributor' => Admin::bersih($req['nama_distributor']),
        ];

        $nomer = distribusiproduk::where('id_distribusi', $id)->update($hasil);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "distribusi produk",
        //     'notif_link' => 'pendistribusian-produk',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan distribusi produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pendistribusian-produk');
    }
    public function tampil_distribusi()
    {
        $pabrik = Auth::user()->pabrik;
        $data = distribusiproduk::join('protaps', 'distribusiproduks.protap', '=', 'protaps.protap_id')
            ->get(['distribusiproduks.*', 'protaps.protap_nama', 'protap_id'])->where('pabrik', $pabrik);
        $protap = protap::all()->where('protap_jenis', 25);
        return view('catatan.dokumen.pendistribusianproduk', ['data' => $data, 'protap' => $protap]);
    }
    public function tambah_operasialat(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'pob' => $req['pob_no'],
            'tanggal' => $req['tanggal'],
            'nama_alat' => Admin::bersih($req['nama_alat']),
            'tipe_merek' => Admin::bersih($req['tipemerek']),
            'ruang' => Admin::bersih($req['ruang']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = pengoprasianalat::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pengoperasian alat',
            'laporan_batch' => Admin::bersih_angka($req['no_batch']) ?? $nomer,
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pengoprasian alat",
            'notif_link' => 'pengoprasian-alat',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan pengoperasian alat',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/pengoprasian-alat');
    }

    public function edit_operasialat(Request $req)
    {
        // dd($req);
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'pob' => $req['protap'],
            'nama_alat' => Admin::bersih($req['nama_alat']),
            'tipe_merek' => Admin::bersih($req['tipemerek']),
            'ruang' => Admin::bersih($req['ruang']),
        ];
        // dd($req);
        $nomer = pengoprasianalat::where('id_operasi', $req['id'])->update($hasil);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
            'notif_laporan' => "pengoperasian alat",
            'notif_link' => 'pengoprasian-alat',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => 0,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan pengoperasian alat',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pengoprasian-alat');
    }

    public function tambah_detilalat(Request $req)
    {

        // dd(Detilperiksaalat::all());
        $id = Auth::user()->id;
        $induk =  $req['id_alat'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'id_induk' => $req['id_alat'],
            // 'mulai_pemakaian' => $req['mulai_pemakaian'],
            // 'selesai_pemakaian' => $req['selesai_pemakaian'],
            // 'produksi' => $req['produksi'],
            // 'no_batch' => $req['no_batch'],
            'diperiksa_oleh' => Admin::bersih($req['diperiksa_oleh']),
            'mulai_pembersihan' => $req['mulai_pembersihan'],
            'selesai_pembersihan' => $req['selesai_pembersihan'],
            'keterangan' => Admin::bersih($req['keterangan'])
        ];

        // $nomer = detilalat::insertGetId($hasil);
        Detilperiksaalat::insert($hasil);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan ",
            'notif_laporan' => "Detil Pembersihan Alat",
            'notif_link' => 'periksasanialat',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => 0,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan detil pemeriksaan sanitasi alat',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/periksasanialat');
    }

    public function tambah_detiloperasilalat(Request $req)
    {

        // dd(Detilperiksaalat::all());
        $id = Auth::user()->id;
        $induk =  $req['id_alat'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'id_induk' => $req['id_alat'],
            'mulai_pemakaian' => $req['mulai_pemakaian'],
            'selesai_pemakaian' => $req['selesai_pemakaian'],
            'produksi' => Admin::bersih($req['produksi']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            // 'diperiksa_oleh' => $req['diperiksa_oleh'],
            // 'mulai_pembersihan' => $req['mulai_pembersihan'],
            // 'selesai_pembersihan' => $req['selesai_pembersihan'],
            'keterangan' => Admin::bersih($req['keterangan'])
        ];

        // $nomer = detilalat::insertGetId($hasil);
        Detiloperasialat::insert($hasil);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan ",
            'notif_laporan' => "Detil Pengoperasian Alat",
            'notif_link' => 'pengoprasian-alat',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => 0,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan detil pengoprasian alat',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pengoprasian-alat');
    }


    public function edit_detilalat(Request $req)
    {
        // dd($req);
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'mulai_pemakaian' => $req['mulai_pemakaian'],
            'selesai_pemakaian' => $req['selesai_pemakaian'],
            'produksi' => Admin::bersih($req['produksi']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            // 'mulai_pembersihan' => $req['mulai_pembersihan'],
            // 'selesai_pembersihan' => $req['selesai_pembersihan'],
            // 'diperiksa_oleh' => $req['diperiksa_oleh'],
            'keterangan' => Admin::bersih($req['keterangan']),
        ];
        // dd($req);
        $nomer = Detiloperasialat::where('id', $req['Modalid_detilalat'])->update($hasil);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan detil operasi alat',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        // return \Illuminate\Support\Facades\Redirect::back();

        return redirect('/pengoprasian-alat');
    }

    public function edit_detilperiksaalat(Request $req)
    {
        // dd($req);
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            // 'mulai_pemakaian' => $req['mulai_pemakaian'],
            // 'selesai_pemakaian' => $req['selesai_pemakaian'],
            // 'produksi' => $req['produksi'],
            // 'no_batch' => $req['no_batch'],
            'mulai_pembersihan' => $req['mulai_pembersihan'],
            'selesai_pembersihan' => $req['selesai_pembersihan'],
            'diperiksa_oleh' => Admin::bersih($req['diperiksa_oleh']),
            'keterangan' => Admin::bersih($req['keterangan']),
        ];
        // dd($req);
        $nomer = Detilperiksaalat::where('id_detilalat', $req['Modalid_detilalat'])->update($hasil);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan detil periksa sanitasi alat',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        // return \Illuminate\Support\Facades\Redirect::back();

        return redirect('/periksasanialat');
    }



    public function tampil_pengorasianalat()
    {
        $pabrik = Auth::user()->pabrik;
        $protap = protap::all('protap_nama', 'protap_id', 'protap_jenis')->where('protap_jenis', 5);
        // dd($protap);
        if (Auth::user()->level == 2) {
            $data = pengoprasianalat::join('protaps', 'pengoprasianalats.pob', '=', 'protaps.protap_id')
                ->get(['pengoprasianalats.*', 'protaps.protap_nama', 'protap_id', 'protap_id']); //all()->where('pabrik', $pabrik);
        } else
            $data = pengoprasianalat::join('protaps', 'pengoprasianalats.pob', '=', 'protaps.protap_id')
                ->get(['pengoprasianalats.*', 'protaps.protap_nama', 'protap_id']);

        return view('catatan.dokumen.pengoprasianalat', compact('data', 'protap'));
    }

    public function tampil_detiloperasialat(Request $req)
    {
        // dd($req);
        $pabrik = Auth::user()->pabrik;
        // session(['idoperasi' => $req['induk']]);
        $data = Detiloperasialat::all()->where('id_induk', $req['id_alat']);
        return view('catatan.dokumen.detiloperasialat', ['data' => $data, 'status' => $req->status, 'id_alat' => $req->id_alat]);
    }


    public function tampil_detilperiksaalat(Request $req)
    {
        // dd($req);
        $pabrik = Auth::user()->pabrik;
        // session(['idoperasi' => $req['induk']]);
        $data = Detilperiksaalat::all()->where('id_induk', $req['id_alat']);
        return view('catatan.higidansani.detilalat', [
            'data' => $data,
            'status' => $req->status,
            'id_alat' => $req->id_alat
        ]);
    }


    public function tambah_pelulusan(Request $req)
    {
        $pabrik = Auth::user()->pabrik;
        $id = Auth::user()->id;
        $hasil = [
            'protap' => $req['protap'],
            'nama_bahan' => $req['nama_bahan'],
            'no_batch' => Admin::bersih_angka($req['nobatch']),
            'kedaluwarsa' => $req['kedaluwarsa'],
            'nama_pemasok' => Admin::bersih($req['nama_pemasok']),
            'tanggal' => $req['tanggal'],
            'warna' => Admin::bersih_angka($req['warna']),
            'bau' => Admin::bersih_angka($req['bau']),
            'ph' => Admin::bersih_angka($req['ph']),
            'berat_jenis' => Admin::bersih_angka($req['berat_jenis']),
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
            'laporan_batch' => Admin::bersih_angka($req['nobatch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pelulusan produk",
            'notif_link' => 'pelulusan-produk',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pelulusan produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/pelulusan-produk');
    }

    public function edit_pelulusan(Request $req)
    {
        $id = $req['id'];

        $hasil = [
            'protap' => $req['protap'],
            'nama_bahan' => $req['nama_bahan'],
            'no_batch' => Admin::bersih_angka($req['nobatch']),
            'kedaluwarsa' => $req['kedaluwarsa'],
            'nama_pemasok' => Admin::bersih($req['nama_pemasok']),
            'warna' => Admin::bersih_angka($req['warna']),
            'bau' => Admin::bersih_angka($req['bau']),
            'ph' => Admin::bersih_angka($req['ph']),
            'berat_jenis' => Admin::bersih_angka($req['berat_jenis']),
        ];
        $nomer = pelulusanproduk::where('id_pelulusan', $id)->update($hasil);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "pelulusan produk",
        //     'notif_link' => 'pelulusan-produk',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan pelulusan produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/pelulusan-produk');
    }
    public function tampil_pelulusanproduk()
    {
        $pabrik = Auth::user()->pabrik;
        $data = pelulusanproduk::join('protaps', 'pelulusanproduks.protap', '=', 'protaps.protap_id')
            ->get(['pelulusanproduks.*', 'protaps.protap_nama', 'protap_id', 'protaps.protap_id'])->where('pabrik', $pabrik);
        $bahanbaku = bahanbaku::all()->where('user_id', $pabrik);
        $protap = protap::all()->where('protap_jenis', 11);

        return view('catatan.dokumen.pelulusanproduk', ['data' => $data, 'protap' => $protap, 'bahanbaku' => $bahanbaku ?? []]);
    }
    public function tambah_contohbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'kode_bahan' => $req['kode_bahan'],
            'nama_bahanbaku' => $req['nama_bahan'],
            'no_batch' => Admin::bersih_angka($req['nobatch']),
            'tanggal_ambil' => $req['tanggal'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_kemasanbox' => $req['jumlah_box'] . ' ' . $req['satuanbox'],
            'jumlah_produk' => $req['jumlah_ambil'] . ' ' . $req['satuanproduk'],
            'jenis_warnakemasan' => Admin::bersih($req['jenis_warna_kemasan']),
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
            'laporan_batch' => Admin::bersih_angka($req['nobatch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "penambahan contoh bahan baku",
            'notif_link' => 'ambilcontoh',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah contoh bahan baku',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/ambilcontoh');
    }
    public function tambah_contohproduk(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'kode_produk' => $req['kode_produk'],
            'nama_produkjadi' => $req['nama_produk'],
            'no_batch' => Admin::bersih_angka($req['nobatch']),
            'tanggal_ambil' => $req['tanggal'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_kemasanbox' => $req['jumlah_box'] . ' ' . $req['satuanbox'],
            'jumlah_produk' => $req['jumlah_ambil'] . ' ' . $req['satuanproduk'],
            'jenis_warnakemasan' => Admin::bersih($req['jenis_warna_kemasan']),
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
            'laporan_batch' => Admin::bersih_angka($req['nobatch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "penambahan contoh produk",
            'notif_link' => 'ambilcontoh',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah contoh produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/ambilcontoh#pills-profile');
    }
    public function tambah_contohkemasan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'kode_kemasan' => $req['kode_kemasan'],
            'nama_kemasan' => $req['nama_kemasan'],
            'no_batch' => Admin::bersih_angka($req['nobatch']),
            'tanggal_ambil' => $req['tanggal'],
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_kemasanbox' => $req['jumlah_box'] . ' ' . $req['satuanbox'],
            'jumlah_produk' => $req['jumlah_ambil'] . ' ' . $req['satuanproduk'],
            'jenis_warnakemasan' => Admin::bersih($req['jenis_warna_kemasan']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];


        $nomer = contohkemasan::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'penambahan contoh kemasan',
            'laporan_batch' => Admin::bersih_angka($req['nobatch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "penambahan contoh kemasan",
            'notif_link' => 'ambilcontoh',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah contoh kemasan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/ambilcontoh#pills-contact');
    }

    public function edit_contohbahan(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'kode_bahan' => $req['kode_bahan'],
            'nama_bahanbaku' => $req['nama_bahan'],
            'no_batch' => Admin::bersih_angka($req['nobatch']),
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_kemasanbox' => $req['jumlah_box'] . ' ' . $req['satuanbox'],
            'jumlah_produk' => $req['jumlah_ambil'] . ' ' . $req['satuanproduk'],
            'jenis_warnakemasan' => Admin::bersih($req['jenis_warna_kemasan']),
        ];

        contohbahanbaku::all()->where('id_bahanbaku', $id)->first()->update($hasil);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "penambahan contoh bahan baku",
        //     'notif_link' => 'ambilcontoh#pills-profile',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan bahan baku',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/ambilcontoh');
    }
    public function edit_contohproduk(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'kode_produk' => $req['kode_produk'],
            'nama_produkjadi' => $req['nama_produk'],
            'no_batch' => Admin::bersih_angka($req['nobatch']),
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_kemasanbox' => $req['jumlah_box'] . ' ' . $req['satuanbox'],
            'jumlah_produk' => $req['jumlah_ambil'] . ' ' . $req['satuanproduk'],
            'jenis_warnakemasan' => Admin::bersih($req['jenis_warna_kemasan']),
        ];
        // dd($hasil);
        $nomer = contohprodukjadi::all()->where('id_produkjadi', $id)->first()->update($hasil);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "penambahan contoh produk",
        //     'notif_link' => 'ambilcontoh#pills-profile',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/ambilcontoh#pills-profile');
    }
    public function edit_contohkemasan(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        // dd($req);
        $hasil = [
            'protap' => $req['protap'],
            'kode_kemasan' => $req['kode_kemasan'],
            'nama_kemasan' => $req['nama_kemasan'],
            'no_batch' => Admin::bersih_angka($req['nobatch']),
            'kedaluwarsa' => $req['kedaluwarsa'],
            'jumlah_kemasanbox' => $req['jumlah_box'] . ' ' . $req['satuanbox'],
            'jumlah_produk' => $req['jumlah_ambil'] . ' ' . $req['satuanproduk'],
            'jenis_warnakemasan' => Admin::bersih($req['jenis_warna_kemasan']),
        ];


        $nomer = contohkemasan::all()->where('id_kemasan', $id)->first()->update($hasil);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "penambahan contoh kemasan",
        //     'notif_link' => 'ambilcontoh',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengubah laporan kemasan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/ambilcontoh');
    }

    public function tampil_pengambilancontoh()
    {
        $pabrik = Auth::user()->pabrik;
        $protap1 = protap::all()->where('protap_jenis', 2)
            ->where('protap_detil', 1);
        $protap2 = protap::all()->where('protap_jenis', 2)
            ->where('protap_detil', 2);
        $protap3 = protap::all()->where('protap_jenis', 2)
            ->where('protap_detil', 3);

        $data = contohbahanbaku::join('protaps', 'contohbahanbakus.protap', '=', 'protaps.protap_id')
            ->get(['contohbahanbakus.*', 'protaps.protap_nama', 'protap_id'])->where('pabrik', $pabrik);
        $data1 = contohprodukjadi::join('protaps', 'contohprodukjadis.protap', '=', 'protaps.protap_id')
            ->get(['contohprodukjadis.*', 'protaps.protap_nama', 'protap_id'])->where('pabrik', $pabrik);
        $data2 = contohkemasan::join('protaps', 'contohkemasans.protap', '=', 'protaps.protap_id')
            ->get(['contohkemasans.*', 'protaps.protap_nama', 'protap_id'])->where('pabrik', $pabrik);
        $bahanbaku = bahanbaku::all()->where('user_id', $pabrik);
        $produk = produk::all()->where('user_id', $pabrik);
        $kemasan = kemasan::all()->where('user_id', $pabrik);

        $x = [];
        return view('catatan.dokumen.pengambilancontoh', [
            'data' => $data, 'data1' => $data1,
            'data2' => $data2, 'bahanbaku' => $bahanbaku ?? $x, 'produk' => $produk ?? $x,
            'kemasan' => $kemasan ?? $x, 'protap1' => $protap1, 'protap2' => $protap2, 'protap3' => $protap3
        ]);
    }
    public function tambah_penimbanganbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'tanggal' => $req['tanggal'],
            'no_loth' => Admin::bersih_angka($req['no_loth']),
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
            'laporan_batch' => Admin::bersih_angka($req['no_batch']) ?? Admin::bersih_angka($req['no_loth']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);

        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "penimbangan bahan",
            'notif_link' => 'penimbangan',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan penimbangan bahan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/penimbangan#pills-contact');
    }

    public function tambah_penimbanganprodukantara(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'tanggal' => $req['tanggal'],
            'no_batch' => Admin::bersih_angka($req['nobatch']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];
        // dd($hasil);

        $nomer = timbangproduk::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'penimbangan produk utama',
            'laporan_batch' => Admin::bersih_angka($req['nobatch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "penimbangan produk antara",
            'notif_link' => 'penimbangan',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan penimbangan produk antara',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/penimbangan#pills-contact');
    }
    public function tambah_ruangtimbang(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap'],
            'tanggal' => $req['tanggal'],
            'nama_bahan_baku' => $req['nama_bahanbaku'],

            'jumlah_bahan_baku' => $req['jumlah_bahanbaku'] . ' ' . $req['satuan'],
            'hasil_timbang' => Admin::bersih_angka($req['hasil_penimbangan']),
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
            'laporan_batch' => Admin::bersih_angka($req['no_batch']) ?? Admin::bersih_angka($req['no_loth']) ?? '-',
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "ruang penimbangan",
            'notif_link' => 'penimbangan',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah laporan ruang penimbangan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/penimbangan#pills-contact');
    }

    public function tambah_ruang(Request $req)
    {
        // dd($req);
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nomer_prosedur' => $req['tanggal'],
            'tanggal_prosedur' => $req['nama'],
            'nama_ruangan' => $req['jumlah_bahanbaku'],
            'hasil_timbang' => $req['hasil_penimbangan'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = periksaruang::insert($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'ruang timbang',
            'laporan_batch' => Admin::bersih_angka($req['no_batch']) ?? Admin::bersih_angka($req['no_loth']) ?? '-',
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah catatan periksa ruangan",
            'notif_laporan' => "ruang penimbangan",
            'notif_link' => 'penimbangan',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Menambah catatan periksa ruangan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/penimbangan#pills-contact');
    }

    public function edit_penimbanganbahan(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'no_loth' => Admin::bersih_angka($req['no_loth']),
            'protap' => $req['protap'],
        ];

        $nomer = timbangbahan::where('timbang_bahan_id', $id)->update($hasil);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "penimbangan bahan",
        //     'notif_link' => 'penimbangan',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan penimbangan bahan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/penimbangan#pills-contact');
    }
    public function edit_penimbanganprodukantara(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'no_batch' => Admin::bersih_angka($req['nobatch']),
            'protap' => $req['protap'],
        ];
        // dd($hasil);

        $nomer = timbangproduk::where('timbang_produk_id', $id)->update($hasil);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "penimbangan produk antara",
        //     'notif_link' => 'penimbangan',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan penimbangan produk antara',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/penimbangan#pills-contact');
    }
    public function edit_ruangtimbang(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nama_bahan_baku' => $req['nama_bahanbaku'],
            'jumlah_bahan_baku' => $req['jumlah_bahanbaku'] . ' ' . $req['satuan'],
            'hasil_timbang' => Admin::bersih_angka($req['hasil_penimbangan']),
            'protap' => $req['protap'],
        ];
        $nomer = ruangtimbang::where('id_ruangtimbang', $id)->update($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan ruang timbang',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/penimbangan#pills-contact');
    }
    public function tampil_penimbangan()
    {
        $pabrik = Auth::user()->pabrik;

        $data = timbangbahan::join('protaps', 'timbangbahans.protap', '=', 'protaps.protap_id')
            ->get(['timbangbahans.*', 'protaps.protap_nama', 'protap_id'])->where('pabrik', $pabrik);
        $data1 = timbangproduk::join('protaps', 'timbangproduks.protap', '=', 'protaps.protap_id')
            ->get(['timbangproduks.*', 'protaps.protap_nama', 'protap_id'])->where('pabrik', $pabrik);
        $data2 = ruangtimbang::join('protaps', 'ruangtimbangs.protap', '=', 'protaps.protap_id')
            ->get(['ruangtimbangs.*', 'protaps.protap_nama', 'protap_id'])->where('pabrik', $pabrik);
        $bahanbaku = bahanbaku::all()->where('user_id', $pabrik);
        $produkantara = produkantara::all()->where('user_id', $pabrik);
        $protap1 =  protap::all()->where('protap_jenis', 7)->where('protap_detil', 1);
        $protap2 =  protap::all()->where('protap_jenis', 7)->where('protap_detil', 2);
        $protap3 =  protap::all()->where('protap_jenis', 7)->where('protap_detil', 3);
        // dd($produkantara);
        return view('catatan.dokumen.penimbangan', [
            'data' => $data, 'data1' => $data1, 'data2' => $data2,
            'protap1' => $protap1, 'protap2' => $protap2, 'protap3' => $protap3, 'bahanbaku' => $bahanbaku ?? [], 'produkantara' => $produkantara ?? []
        ]);
    }

    //detil penimbangan
    public function tampil_detiltimbangbahan(Request $req)
    {
        $pabrik = Auth::user()->pabrik;
        // dd($req);
        $induk = $req['induk'] ?? session()->get('induk1');
        $status = $req['status'] ?? session()->get('status1');
        $noloth = $req['noloth'] ?? session()->get('noloth');
        session([
            'induk1' => $induk,
            'status1' => $status,
            'noloth' => $noloth,
        ]);
        $data = detiltimbangbahan::all()->where('induk', $induk);
        // $data1 = timbangproduk::all()->where('pabrik', $pabrik);
        // $data2 = ruangtimbang::all()->where('pabrik', $pabrik);
        $bahanbaku = bahanbaku::all()->where('user_id', $pabrik);
        // $produkantara = produkantara::all()->where('user_id', $pabrik);
        // dd($produkantara);
        return view('catatan.dokumen.detil.detiltimbangbahan', [
            'data' => $data,
            'bahanbaku' => $bahanbaku,
            'status' => $status,
        ]);
    }

    public function tampil_detiltimbangproduk(Request $req)
    {
        $pabrik = Auth::user()->pabrik;
        $induk = $req['induk'] ?? session()->get('induk2');
        $status = $req['status'] ?? session()->get('status2');
        $noloth = $req['nobatch'] ?? session()->get('nobatch');
        session([
            'induk2' => $induk,
            'status2' => $status,
            'nobatch' => $noloth,
        ]);

        $data = detiltimbangproduk::all()->where('induk', $induk);
        // dd($data);
        // $data1 = timbangproduk::all()->where('pabrik', $pabrik);
        // $data2 = ruangtimbang::all()->where('pabrik', $pabrik);
        // $bahanbaku = bahanbaku::all()->where('user_id', $pabrik);
        $produkantara = produkantara::all()->where('user_id', $pabrik);
        // dd($produkantara);
        return view('catatan.dokumen.detil.detiltimbangproduk', [
            'data' => $data,
            'produkantara' => $produkantara,
            'status' => $req['status'],

        ]);
    }

    public function tampil_detiltimbangruang(Request $req)
    {
        $pabrik = Auth::user()->pabrik;
        $induk = $req['induk'] ?? session()->get('induk3');
        $status = $req['status'] ?? session()->get('status3');
        $bahan = $req['bahan'] ?? session()->get('bahan');
        session([
            'induk3' => $induk,
            'status3' => $status,
            'bahan' => $bahan,
        ]);

        $data = detiltimbanghasil::all()->where('induk', $induk);
        // $data1 = timbangproduk::all()->where('pabrik', $pabrik);
        // $data2 = ruangtimbang::all()->where('pabrik', $pabrik);
        $bahanbaku = bahanbaku::all()->where('user_id', $pabrik);
        // $produkantara = produkantara::all()->where('user_id', $pabrik);
        // dd($produkantara);
        return view('catatan.dokumen.detil.detiltimbanghasil', compact('data', 'bahanbaku', 'status'));
    }

    public function tambah_detiltimbangbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'tanggal' => $req['tanggal'],
            'nama_bahan' => $req['nama_bahan'],
            'nama_suplier' => Admin::bersih($req['nama_suplier']),
            'jumlah_bahan' => $req['jumlah_bahan'] . ' ' . $req['satuanj'],
            'hasil_penimbangan' => Admin::bersih_angka($req['hasil_penimbangan']) . ' ' . $req['satuanh'],
            'induk'  => session()->get('induk1'),
        ];

        // dd($hasil);
        $nomer = detiltimbangbahan::insertGetId($hasil);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah detil timbang bahan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detiltimbangbahan');
    }

    public function tambah_detiltimbangproduk(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'tanggal' => $req['tanggal'],
            'asal_produk' => Admin::bersih($req['asal_produk']),
            'nama_produk_antara' => Admin::bersih($req['nama']),
            'jumlah_produk' => $req['jumlah_produk'] . ' ' . $req['satuanj'],
            'hasil_penimbangan' => Admin::bersih_angka($req['hasil_timbang']) . ' ' . $req['satuanh'],
            'untuk_produk' => Admin::bersih($req['untuk_produk']),
            'induk'  => session()->get('induk2'),
        ];
        // dd($hasil);

        $nomer = detiltimbangproduk::insertGetId($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah detil timbang produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/detiltimbangproduk');
    }
    public function tambah_detiltimbanghasil(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'tanggal' => $req['tanggal'],
            'no_loth' => Admin::bersih_angka($req['no_loth']),
            'jumlah_permintaan' => $req['jumlah_permintaan'],
            'hasil_penimbangan' => Admin::bersih_angka($req['hasil_timbang']),
            'sisa_bahan' => $req['sisa_bahan'],
            'untuk_produk' => Admin::bersih($req['untuk_produk']),
            'induk'  => session()->get('induk3')
        ];

        $nomer = detiltimbanghasil::insertGetId($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah detil timbang hasil',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detiltimbangruang');
    }
    public function edit_detiltimbangbahan(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nama_bahan' => $req['nama_bahan'],
            'nama_suplier' => Admin::bersih($req['nama_suplier']),
            'jumlah_bahan' => $req['jumlah_bahan'] . ' ' . $req['satuanj'],
            'hasil_penimbangan' => $req['hasil_penimbangan'] . ' ' . $req['satuanh'],
        ];

        $nomer = detiltimbangbahan::where('id_detiltimbangbahan', $id)->update($hasil);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah detil timbang bahan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detiltimbangbahan');
    }
    public function edit_detiltimbangproduk(Request $req)
    {

        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'asal_produk' => Admin::bersih($req['asal_produk']),
            'nama_produk_antara' => Admin::bersih($req['nama']),
            'jumlah_produk' => $req['jumlah_produk'] . ' ' . $req['satuanj'],
            'hasil_penimbangan' => Admin::bersih_angka($req['hasil_timbang']) . ' ' . $req['satuanh'],
            'untuk_produk' => Admin::bersih($req['untuk_produk']),
        ];
        // dd($req);


        $nomer = detiltimbangproduk::where('id_detiltimbangproduk', $id)->update($hasil);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah detil timbang produk',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detiltimbangproduk');
    }
    public function edit_detiltimbanghasil(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        // dd($req);
        $hasil = [
            'no_loth' => Admin::bersih_angka($req['no_loth']),
            'jumlah_permintaan' => $req['jumlah_permintaan'],
            'hasil_penimbangan' => Admin::bersih_angka($req['hasil_penimbangan']),
            'sisa_bahan' => $req['sisa_bahan'],
            'untuk_produk' =>  Admin::bersih($req['untuk_produk']),
        ];
        $nomer = detiltimbanghasil::where('id_detiltimbanghasil', $id)->update($hasil);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah detil timbang hasil',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/detiltimbangruang');
    }
    //enddetilpenimbangan

    public function tambah_kartustokbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nama_bahan' => Admin::bersih($req['nama']),
            'tanggal' => $req['tanggal'],
            'id_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'nama_distributor' => Admin::bersih($req['nama_distributor']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = kartustokbahan::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'Kartu Stok Bahan Baku',
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "Kartu Stok Bahan Baku",
            'notif_link' => 'kartu-stok',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan kartu stok bahan baku',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/kartu-stok');
    }
    public function edit_kartustockbahan(Request $req)
    {
        kartustokbahan::where('id_kartustokbahan', $req['id'])
            ->update([
                'nama_bahan' => Admin::bersih($req['nama']),
                'tanggal' => $req['tanggal'],
                'id_batch' => Admin::bersih_angka($req['no_batch']),
                'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
                'nama_distributor' => Admin::bersih($req['nama_distributor']),
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "kartu stok bahan baku")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "kartu stok bahan",
        //     'notif_link' => 'kartu-stok',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan kartu stok bahan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/kartu-stok');
    }
    public function tambah_kartustokbahankemas(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nama_bahankemas' => Admin::bersih($req['nama']),
            'tanggal' => $req['tanggal'],
            'id_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'nama_distributor' => Admin::bersih($req['nama_distributor']),
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
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "kartu stok bahan kemas",
            'notif_link' => 'kartu-stok',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan kartu stok bahan kemas',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/kartu-stok');
    }
    public function edit_kartustockbahankemas(Request $req)
    {
        kartustokbahankemas::where('id_kartustokbahankemas', $req['id'])
            ->update([
                'nama_bahankemas' => Admin::bersih($req['nama']),
                'tanggal' => $req['tanggal'],
                'id_batch' => Admin::bersih_angka($req['no_batch']),
                'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
                'nama_distributor' => Admin::bersih($req['nama_distributor']),
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "kartu stok bahan kemas")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "kartu stok bahan kemas",
        //     'notif_link' => 'kartu-stok',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan kartu stok bahan kemas',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/kartu-stok');
    }
    public function tambah_kartustokprodukantara(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nama_produkantara' => Admin::bersih($req['nama']),
            'tanggal' => $req['tanggal'],
            'id_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'nama_distributor' => Admin::bersih($req['nama_distributor']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = kartustokprodukantara::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'kartu stok produk antara',
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "kartu stok produk antara",
            'notif_link' => 'kartu-stok',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);

        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan kartu stok produk antara',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/kartu-stok');
    }
    public function edit_kartustockprodukantara(Request $req)
    {
        kartustokprodukantara::where('id_kartustokprodukantara', $req['id'])
            ->update([
                'nama_produkantara' => Admin::bersih($req['nama']),
                'tanggal' => $req['tanggal'],
                'id_batch' => Admin::bersih_angka($req['no_batch']),
                'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
                'nama_distributor' => Admin::bersih($req['nama_distributor']),
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "kartu stok produk antara")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " menggubah laporan ",
        //     'notif_laporan' => "kartu stok produk antara",
        //     'notif_link' => 'kartu-stok',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan kartu stok antara',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/kartu-stok');
    }
    public function tambah_kartustokprodukjadi(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nama_produkjadi' => Admin::bersih($req['nama']),
            'tanggal' => $req['tanggal'],
            'id_batch' => Admin::bersih_angka($req['no_batch']),
            'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
            'nama_distributor' => Admin::bersih($req['nama_distributor']),
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
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "kartu stok produk jadi",
            'notif_link' => 'kartu-stok',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan kartu stok produk jadi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);

        return redirect('/kartu-stok');
    }
    public function edit_kartustockprodukjadi(Request $req)
    {
        kartustokprodukjadi::where('id_kartustokprodukjadi', $req['id'])
            ->update([
                'nama_produkjadi' => Admin::bersih($req['nama']),
                'tanggal' => $req['tanggal'],
                'id_batch' => Admin::bersih_angka($req['no_batch']),
                'jumlah' => $req['jumlah'] . ' ' . $req['satuan'],
                'nama_distributor' => Admin::bersih($req['nama_distributor']),
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "kartu stok produk jadi")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "kartu stok produk jadi",
        //     'notif_link' => 'kartu-stok',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan kartu stok produk jadi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/kartu-stok');
    }
    public function tampil_kartustok()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = kartustokbahan::all()->where('pabrik', $pabrik);
            $data1 = kartustokbahankemas::all()->where('pabrik', $pabrik);
            $data2 = kartustokprodukantara::all()->where('pabrik', $pabrik);
            $data3 = kartustokprodukjadi::all()->where('pabrik', $pabrik);
        } else {
            $data = kartustokbahan::all()->where('pabrik', $pabrik);
            $data1 = kartustokbahankemas::all()->where('pabrik', $pabrik);
            $data2 = kartustokprodukantara::all()->where('pabrik', $pabrik);
            $data3 = kartustokprodukjadi::all()->where('pabrik', $pabrik);
            $bahanbaku = bahanbaku::all()->where('user_id', $pabrik);
            $kemasan = kemasan::all()->where('user_id', $pabrik);
            $produkantara = produkantara::all()->where('user_id', $pabrik);
            $produkjadi = produk::all()->where('user_id', $pabrik);
        }
        return view('catatan.dokumen.kartustok', ['data' => $data, 'data1' => $data1, 'data2' => $data2, 'data3' => $data3, 'produkjadi' => $produkjadi ?? [], 'produkantara' => $produkantara ?? [], 'bahanbaku' => $bahanbaku ?? [], 'kemasan' => $kemasan ?? []]);
    }
    public function tambah_pemusnahanbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap_induk'],
            'kode_pemusnahan' => Admin::bersih_angka($req['kode_pemusnahan']),
            'tanggal_pemusnahan' => $req['tanggal'],
            'nama_bahanbaku' => Admin::bersih($req['nama_bahanbaku']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'asal_bahanbaku' => Admin::bersih($req['asal_bahanbaku']),
            'jumlah_bahanbaku' => $req['jumlah_bahanbaku'] . ' ' . $req['satuan'],
            'alasan_pemusnahan' => Admin::bersih($req['alasan_pemusnahan']),
            'cara_pemunsnahan' => Admin::bersih($req['cara_pemusnahan']),
            'nama_petugas' => Admin::bersih($req['petugas']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = pemusnahanbahanbaku::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pemusnahan bahan baku',
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pemusnahan bahan baku",
            'notif_link' => 'pemusnahan-produk',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pemusnahan bahan',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemusnahan-produk');
    }
    public function edit_pemusnahanbahan(Request $req)
    {
        // dd($req);
        pemusnahanbahanbaku::where('id_pemusnahanbahan', $req['id'])
            ->update([
                'protap' => $req['protap_induk'],
                'kode_pemusnahan' => Admin::bersih_angka($req['kode_pemusnahan']),
                'tanggal_pemusnahan' => $req['tanggal'],
                'nama_bahanbaku' => Admin::bersih($req['nama_bahanbaku']),
                'no_batch' => Admin::bersih_angka($req['no_batch']),
                'asal_bahanbaku' => Admin::bersih($req['asal_bahanbaku']),
                'jumlah_bahanbaku' => $req['jumlah_bahanbaku'] . ' ' . $req['satuan'],
                'alasan_pemusnahan' => Admin::bersih($req['alasan_pemusnahan']),
                'cara_pemunsnahan' => Admin::bersih($req['cara_pemusnahan']),
                'nama_petugas' => Admin::bersih($req['petugas']),
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "pemusnahan bahan baku")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "pemusnahan bahan",
        //     'notif_link' => 'pemusnahan-produk',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan pemusnahan bahan baku',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemusnahan-produk');
    }
    public function tambah_pemusnahanbahankemas(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap_induk'],
            'kode_pemusnahan' => Admin::bersih_angka($req['kode_pemusnahan']),
            'tanggal_pemusnahan' => $req['tanggal'],
            'nama_bahan_kemas' => Admin::bersih($req['nama_bahankemas']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'asal_bahankemas' => Admin::bersih($req['asal_bahankemas']),
            'jumlah_bahankemas' => $req['jumlah_bahankemas'] . ' ' . $req['satuan'],
            'alasan_pemusnahan' => Admin::bersih($req['alasan_pemusnahan']),
            'cara_pemunsnahan' => Admin::bersih($req['cara_pemusnahan']),
            'nama_petugas' => Admin::bersih($req['petugas']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = pemusnahanbahankema::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pemusnahan bahan kemas',
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pemusnahan bahan kemas",
            'notif_link' => 'pemusnahan-produk',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pemusnahan bahan kemas',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemusnahan-produk');
    }
    public function edit_pemusnahanbahankemas(Request $req)
    {
        pemusnahanbahankema::where('id_pemusnahanbahankemas', $req['id'])
            ->update([
                'protap' => $req['protap_induk'],
                'kode_pemusnahan' => Admin::bersih_angka($req['kode_pemusnahan']),
                'tanggal_pemusnahan' => $req['tanggal'],
                'nama_bahan_kemas' => Admin::bersih($req['nama_bahankemas']),
                'no_batch' => Admin::bersih_angka($req['no_batch']),
                'asal_bahankemas' => Admin::bersih($req['asal_bahankemas']),
                'jumlah_bahankemas' => $req['jumlah_bahankemas'] . ' ' . $req['satuan'],
                'alasan_pemusnahan' => Admin::bersih($req['alasan_pemusnahan']),
                'cara_pemunsnahan' => Admin::bersih($req['cara_pemusnahan']),
                'nama_petugas' => Admin::bersih($req['petugas']),
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "pemusnahan bahan kemas")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " menggubah laporan ",
        //     'notif_laporan' => "pemusnahan bahan kemas",
        //     'notif_link' => 'pemusnahan-produk',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menggubah laporan pemusnahan bahan kemas',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemusnahan-produk');
    }
    public function tambah_pemusnahanprodukantara(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap_induk'],
            'kode_pemusnahan' => Admin::bersih_angka($req['kode_pemusnahan']),
            'tanggal_pemusnahan' => $req['tanggal'],
            'nama_produkantara' => Admin::bersih($req['nama_produkantara']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'asal_produkantara' => Admin::bersih($req['asal_produkantara']),
            'jumlah_produkantara' => $req['jumlah_produkantara'] . ' ' . $req['satuan'],
            'alasan_pemusnahan' => Admin::bersih($req['alasan_pemusnahan']),
            'cara_pemunsnahan' => Admin::bersih($req['cara_pemusnahan']),
            'nama_petugas' => Admin::bersih($req['petugas']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = pemusnahanprodukantara::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pemusnahan produk antara',
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pemusnahan produk antara",
            'notif_link' => 'pemusnahan-produk',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pemusnahan produk antara',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemusnahan-produk');
    }
    public function edit_pemusnahanprodukantara(Request $req)
    {
        // dd($req);
        pemusnahanprodukantara::where('id_pemusnahanprodukantara', $req['id'])
            ->update([
                'protap' => $req['protap_induk'],
                'kode_pemusnahan' => Admin::bersih_angka($req['kode_pemusnahan']),
                'tanggal_pemusnahan' => $req['tanggal'],
                'nama_produkantara' => Admin::bersih($req['nama_produkantara']),
                'no_batch' => Admin::bersih_angka($req['no_batch']),
                'asal_produkantara' => Admin::bersih($req['asal_produkantara']),
                'jumlah_produkantara' => $req['jumlah_produkantara'] . ' ' . $req['satuan'],
                'alasan_pemusnahan' => Admin::bersih($req['alasan_pemusnahan']),
                'cara_pemunsnahan' => Admin::bersih($req['cara_pemusnahan']),
                'nama_petugas' => Admin::bersih($req['petugas']),
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "pemusnahan produk antara")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "pemusnahan produk antara",
        //     'notif_link' => 'pemusnahan-produk',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan pemusnahan produk antara',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemusnahan-produk');
    }
    public function tambah_pemusnahanprodukjadi(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap_induk'],
            'kode_pemusnahan' => Admin::bersih_angka($req['kode_pemusnahan']),
            'tanggal_pemusnahan' => $req['tanggal'],
            'nama_produkjadi' => Admin::bersih($req['nama']),
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'asal_produkjadi' => Admin::bersih($req['asal_produkantara']),
            'jumlah_produkjadi' => $req['jumlah_produkantara'] . ' ' . $req['satuan'],
            'alasan_pemusnahan' => Admin::bersih($req['alasan_pemusnahan']),
            'cara_pemunsnahan' => Admin::bersih($req['cara_pemusnahan']),
            'nama_petugas' => Admin::bersih($req['petugas']),
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];

        $nomer = pemusnahanprodukjadi::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pemusnahan produk jadi',
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pemusnahan produk jadi",
            'notif_link' => 'pemusnahan-produk',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pemusnahan produk jadi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemusnahan-produk');
    }
    public function edit_pemusnahanprodukjadi(Request $req)
    {
        // dd($req);
        pemusnahanprodukjadi::where('id_pemusnahanprodukjadi', $req['id'])
            ->update([
                'protap' => $req['protap_induk'],
                'kode_pemusnahan' => Admin::bersih($req['kode_pemusnahan']),
                'tanggal_pemusnahan' => $req['tanggal'],
                'nama_produkjadi' => Admin::bersih($req['nama']),
                'no_batch' => Admin::bersih_angka($req['no_batch']),
                'asal_produkjadi' => Admin::bersih($req['asal_produkantara']),
                'jumlah_produkjadi' => $req['jumlah_produkantara'] . ' ' . $req['satuan'],
                'alasan_pemusnahan' => Admin::bersih($req['alasan_pemusnahan']),
                'cara_pemunsnahan' => Admin::bersih($req['cara_pemusnahan']),
                'nama_petugas' => Admin::bersih($req['petugas']),
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "pemusnahan produk jadi")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "pemusnahan produk jadi",
        //     'notif_link' => 'pemusnahan-produk',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan pemusnahan produk jadi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemusnahan-produk');
    }
    public function tampil_pemusnahanproduk()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = pemusnahanbahanbaku::join('protaps', 'pemusnahanbahanbakus.protap', '=', 'protaps.protap_id')
                ->get(['pemusnahanbahanbakus.*', 'protaps.protap_nama', 'protap_id']);


            $data1 = pemusnahanbahankema::join('protaps', 'pemusnahanbahankemas.protap', '=', 'protaps.protap_id')
                ->get(['pemusnahanbahankemas.*', 'protaps.protap_nama', 'protap_id']);

            $data2 = pemusnahanprodukantara::join('protaps', 'pemusnahanprodukantaras.protap', '=', 'protaps.protap_id')
                ->get(['pemusnahanprodukantaras.*', 'protaps.protap_nama', 'protap_id']);


            $data3 = pemusnahanprodukjadi::join('protaps', 'pemusnahanprodukjadis.protap', '=', 'protaps.protap_id')
                ->get(['pemusnahanprodukjadis.*', 'protaps.protap_nama', 'protap_id']);
        } else {
            $data = pemusnahanbahanbaku::join('protaps', 'pemusnahanbahanbakus.protap', '=', 'protaps.protap_id')
                ->get(['pemusnahanbahanbakus.*', 'protaps.protap_nama', 'protap_id']);


            $data1 = pemusnahanbahankema::join('protaps', 'pemusnahanbahankemas.protap', '=', 'protaps.protap_id')
                ->get(['pemusnahanbahankemas.*', 'protaps.protap_nama', 'protap_id']);

            $data2 = pemusnahanprodukantara::join('protaps', 'pemusnahanprodukantaras.protap', '=', 'protaps.protap_id')
                ->get(['pemusnahanprodukantaras.*', 'protaps.protap_nama', 'protap_id']);


            $data3 = pemusnahanprodukjadi::join('protaps', 'pemusnahanprodukjadis.protap', '=', 'protaps.protap_id')
                ->get(['pemusnahanprodukjadis.*', 'protaps.protap_nama', 'protap_id']);

            $bahanbaku = bahanbaku::all()->where('user_id', $pabrik);
            $produkantara = produkantara::all()->where('user_id', $pabrik);
            $kemasan = kemasan::all()->where('user_id', $pabrik);
            $produkjadi = produk::all()->where('user_id', $pabrik);
        }


        $data_protapbb = protap::all()->where('protap_detil', 1)->where('protap_jenis', 15);
        $data_protapbk = protap::all()->where('protap_detil', 2)->where('protap_jenis', 15);
        $data_protappa = protap::all()->where('protap_detil', 3)->where('protap_jenis', 15);
        $data_protappj = protap::all()->where('protap_detil', 4)->where('protap_jenis', 15);

        return view('catatan.dokumen.pemusnahanproduk', [
            'data' => $data,
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'bahanbaku' => $bahanbaku ?? [],
            'produkantara' => $produkantara ?? [],
            'produkjadi' => $produkjadi ?? [],
            'kemasan' => $kemasan ?? [],
            'data_protapbb' => $data_protapbb,
            'data_protapbk' => $data_protapbk,
            'data_protappa' => $data_protappa,
            'data_protappj' => $data_protappj
        ]);
    }
    public function tambah_kalibrasialat(Request $req)
    {
        $file = $req->file('file');
        $exten = $file->getClientOriginalExtension();
        $nama = Admin::bersih($req['nama_alat']) . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten;
        $tujuan_upload = 'asset/kalibrasi_alat';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nama_alat' => Admin::bersih($req['nama_alat']),
            'nama_file' => $nama,
            'pabrik' => $pabrik,
            'user_id' => $id,
        ];
        $nomer = Kalibrasialat::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'Kalibrasi Alat',
            'laporan_batch' => "dummy",
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "kalibrasi alat",
            'notif_link' => 'kalibrasi-alat',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan kalibrasi alat',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/kalibrasi-alat');
    }
    public function edit_kalibrasialat(Request $req)
    {
        $tujuan_upload = 'asset/kalibrasi_alat';
        $nama = $req['filename'];
        $file = $req->file('file');
        $exten = $file->getClientOriginalExtension();
        $filedelete = $tujuan_upload . "/" . $nama;
        Storage::delete($filedelete);
        $file = $req->file('file');
        $namasimpan = Admin::bersih($req['nama_alat']) . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten;
        $file->move($tujuan_upload, $namasimpan);
        Kalibrasialat::where('kalibrasi_id', $req['id'])
            ->update([
                'nama_alat' => Admin::bersih($req['nama_alat']),
                'nama_file' => Admin::bersih($req['nama_alat']) . '_' . substr($req['tanggal'], 0, 10) . '.' . $exten,
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "Kalibrasi Alat")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "kalibrasi alat",
        //     'notif_link' => 'kalibrasi-alat',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan kalibrasi alat',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/kalibrasi-alat');
    }

    public function tampil_kalibrasialat()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = Kalibrasialat::all()->where('pabrik', $pabrik);
        } else {
            $data = Kalibrasialat::all()->where('pabrik', $pabrik);
        }
        return view('catatan.dokumen.kalibrasialat', ['data' => $data]);
    }
    public function tambah_pemeriksaanbahan(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap_induk'],
            'kode_spesifikasi' => $req['kode_spesifikasi'],
            'nama_bahanbaku' => $req['nama_bahanbaku'],
            'jenis_sediaan' => $req['jenis_sediaan'],
            'warna' => $req['warna'],
            'aroma' => $req['aroma'],
            'tekstur' => $req['tekstur'],
            'bobot' => $req['bobot'],
            'tanggal' => $req['tanggal'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];
        $nomer = Spesifikasibahanbaku::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'Pemeriksaan Bahan Baku',
            'laporan_batch' => Admin::bersih_angka($req['kode_spesifikasi']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "Pemeriksaan Bahan Baku",
            'notif_link' => 'pemeriksaan-bahan',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pemeriksaan bahan baku',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemeriksaan-bahan');
    }
    public function edit_pemeriksaanbahan(Request $req)
    {
        Spesifikasibahanbaku::where('id_spesifikasibahanbaku', $req['id'])
            ->update([
                'protap' => $req['protap_induk'],
                'kode_spesifikasi' => $req['kode_spesifikasi'],
                'nama_bahanbaku' => $req['nama_bahanbaku'],
                'jenis_sediaan' => $req['jenis_sediaan'],
                'warna' => Admin::bersih($req['warna']),
                'aroma' => Admin::bersih($req['aroma']),
                'tekstur' => Admin::bersih($req['tekstur']),
                'bobot' => $req['bobot'],
                'tanggal' => $req['tanggal'],
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "Pemeriksaan Bahan Baku")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "pemeriksaan bahan baku",
        //     'notif_link' => 'pemeriksaan-bahan',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan pemeriksaan bahan baku',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemeriksaan-bahan');
    }
    public function tambah_pemeriksaanbahankemas(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap_induk'],
            'kode_spesifikasi' => $req['kode_spesifikasi'],
            'nama_bahankemas' => $req['nama_bahankemas'],
            'jenis_bahankemas' => $req['jenis_bahankemas'],
            'warna' => $req['warna'],
            'ukuran' => $req['ukuran_bahankemas'],
            'bocorcacat' => $req['bocor_cacat'],
            'tanggal' => $req['tanggal'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];
        $nomer = Spesifikasibahankemas::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'Pemeriksaan Bahan Kemas',
            'laporan_batch' => Admin::bersih_angka($req['kode_spesifikasi']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "Pemeriksaan Bahan Kemas",
            'notif_link' => 'pemeriksaan-bahan',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pemeriksaan bahan kemas',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemeriksaan-bahan');
    }
    public function edit_pemeriksaanbahankemas(Request $req)
    {
        Spesifikasibahankemas::where('id_spesifikasibahankemas', $req['id'])
            ->update([
                'protap' => $req['protap_induk'],
                'kode_spesifikasi' => $req['kode_spesifikasi'],
                'nama_bahankemas' => $req['nama_bahankemas'],
                'jenis_bahankemas' => $req['jenis_bahankemas'],
                'warna' =>  Admin::bersih($req['warna']),
                'ukuran' =>  Admin::bersih($req['ukuran_bahankemas']),
                'bocorcacat' => Admin::bersih($req['bocor_cacat']),
                'tanggal' => $req['tanggal'],
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "Pemeriksaan Bahan Kemas")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "pemeriksaan bahan kemas",
        //     'notif_link' => 'pemeriksaan-bahan',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan pemeriksaan bahan kemas',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemeriksaan-bahan');
    }
    public function tambah_pemeriksaanprodukjadi(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'protap' => $req['protap_induk'],
            'kode_spesifikasi' => $req['kode_spesifikasi'],
            'nama_produkjadi' => $req['nama_produkjadi'],
            'kategori' => $req['kategori'],
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'warna' => $req['warna'],
            'aroma' => $req['aroma'],
            'bocorcacat' => $req['bocor_cacat'],
            'tanggal' => $req['tanggal'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];
        $nomer = Spesifikasiprodukjadi::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'Pemeriksaan Produk Jadi',
            'laporan_batch' => Admin::bersih_angka($req['kode_spesifikasi']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "Pemeriksaan Produk Jadi",
            'notif_link' => 'pemeriksaan-bahan',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pemeriksaan produk jadi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemeriksaan-bahan');
    }
    public function edit_pemeriksaanprodukjadi(Request $req)
    {
        Spesifikasiprodukjadi::where('id_spesifikasiprodukjadi', $req['id'])
            ->update([
                'protap' => $req['protap_induk'],
                'kode_spesifikasi' => $req['kode_spesifikasi'],
                'nama_produkjadi' => $req['nama_produkjadi'],
                'kategori' => $req['kategori'],
                'no_batch' => Admin::bersih_angka($req['no_batch']),
                'warna' => Admin::bersih($req['warna']),
                'aroma' => Admin::bersih($req['aroma']),
                'bocorcacat' => Admin::bersih($req['bocor_cacat']),
                'tanggal' => $req['tanggal'],
                'status' => 0
            ]);
        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        laporan::where('laporan_nomor', $req['id'])->where('laporan_nama', "Pemeriksaan Produk Jadi")->update([
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
        ]);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan ",
        //     'notif_laporan' => "pemeriksaan produk jadi",
        //     'notif_link' => 'pemeriksaan-bahan',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_2' => 0,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan pemeriksaan produk jadi',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pemeriksaan-bahan');
    }
    public function tampil_pemeriksaan()
    {
        $pabrik = Auth::user()->pabrik;
        if (Auth::user()->level == 2) {
            $data = spesifikasibahanbaku::join('protaps', 'spesifikasibahanbakus.protap', '=', 'protaps.protap_id')
                ->get(['spesifikasibahanbakus.*', 'protaps.protap_nama', 'protap_id']);

            $data1 = spesifikasibahankemas::join('protaps', 'spesifikasibahankemas.protap', '=', 'protaps.protap_id')
                ->get(['spesifikasibahankemas.*', 'protaps.protap_nama', 'protap_id']);

            $data2 = Spesifikasiprodukjadi::join('protaps', 'Spesifikasiprodukjadis.protap', '=', 'protaps.protap_id')
                ->get(['Spesifikasiprodukjadis.*', 'protaps.protap_nama', 'protap_id']);
        } else {
            $data = spesifikasibahanbaku::join('protaps', 'spesifikasibahanbakus.protap', '=', 'protaps.protap_id')
                ->get(['spesifikasibahanbakus.*', 'protaps.protap_nama', 'protap_id']);

            $data1 = spesifikasibahankemas::join('protaps', 'Spesifikasibahankemas.protap', '=', 'protaps.protap_id')
                ->get(['spesifikasibahankemas.*', 'protaps.protap_nama', 'protap_id']);

            $data2 = Spesifikasiprodukjadi::join('protaps', 'Spesifikasiprodukjadis.protap', '=', 'protaps.protap_id')
                ->get(['Spesifikasiprodukjadis.*', 'protaps.protap_nama', 'protap_id']);

            $bahanbaku = bahanbaku::all()->where('user_id', $pabrik);
            $kemasan = kemasan::all()->where('user_id', $pabrik);
            $produkjadi = produk::all()->where('user_id', $pabrik);
        }

        $data_protapbb = protap::all()->where('protap_detil', 1)->where('protap_jenis', 24);
        $data_protapbk = protap::all()->where('protap_detil', 2)->where('protap_jenis', 24);
        $data_protappj = protap::all()->where('protap_detil', 3)->where('protap_jenis', 24);


        return view('catatan.dokumen.pemeriksaanpengujian', [
            'data' => $data,
            'data1' => $data1,
            'data2' => $data2,
            'produkjadi' => $produkjadi ?? [],
            'bahanbaku' => $bahanbaku ?? [],
            'kemasan' => $kemasan ?? [],
            'data_protapbb' => $data_protapbb,
            'data_protapbk' => $data_protapbk,
            'data_protappj' => $data_protappj
        ]);
    }

    public function tambah_pengemasanbatchproduk(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_produk' => $req['kode_produk'],
            'nama_produk' => $req['nama_produk'],
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'protap' => $req['protap'],
            'besar_batch' => Admin::bersih_angka($req['besar_batch']),
            'bentuksediaan' => Admin::bersih_angka($req['bentuk_sediaan']),
            'kemasan' => $req['kemasan'],
            'mulai' => $req['mulai'],
            'selesai' => $req['selesai'],
            'pabrik' => $pabrik,
            'status' => 0,
            'user_id' => $id,
        ];
        $nomer = Pengemasanbatchproduk::insertGetId($hasil);

        date_default_timezone_set("Asia/Jakarta");
        $tgl = new \DateTime(Carbon::now()->toDateTimeString());
        $tgl = $tgl->format('Y-m-d');
        $laporan = [
            'laporan_nama' => 'pengemasan batch produk',
            'laporan_batch' => Admin::bersih_angka($req['no_batch']),
            'laporan_nomor' => $nomer,
            'laporan_diajukan' => Auth::user()->namadepan . ' ' . Auth::user()->namabelakang,
            'laporan_diterima' => "belum",
            'tgl_diajukan' => $tgl,
            'tgl_diterima' => $tgl,
            'pabrik_id'  =>  $pabrik,
            "user_id" => $id,
        ];

        laporan::insert($laporan);
        $notif = [
            'notif_isi' => Auth::user()->namadepan . " menambah laporan",
            'notif_laporan' => "pengemasan batch",
            'notif_link' => 'pengemasan-batch',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => Auth::user()->level,
            'notif_2' => $nomer,
            'notif_3' => 0,
            'notif_level' => 1,
            'status' => 0,
            'id_pabrik' => Auth::user()->pabrik,
        ];
        notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' menambah laporan pengemasan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pengemasan-batch');
    }
    public function edit_pengemasanbatchproduk(Request $req)
    {
        $id = $req['id'];
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'kode_produk' => $req['kode_produk'],
            'nama_produk' => $req['nama_produk'],
            'no_batch' => Admin::bersih_angka($req['no_batch']),
            'protap' => $req['protap'],
            'besar_batch' => Admin::bersih_angka($req['besar_batch']),
            'bentuksediaan' => Admin::bersih_angka($req['bentuk_sediaan']),
            'kemasan' => $req['kemasan'],
            'mulai' => $req['mulai'],
            'selesai' => $req['selesai'],
        ];
        $nomer = Pengemasanbatchproduk::where('id_pengemasanbatchproduk', $id)->update($hasil);
        // $notif = [
        //     'notif_isi' => Auth::user()->namadepan . " mengubah laporan",
        //     'notif_laporan' => "pengemasan batch",
        //     'notif_link' => 'pengemasan-batch',
        //     'notif_waktu' => date('Y-m-d H:i:s'),
        //     'notif_1' => Auth::user()->level,
        //     'notif_3' => 0,
        //     'notif_2' => $nomer,
        //     'notif_3' => 0,
        //     'notif_level' => 1,
        //     'status' => 0,
        //     'id_pabrik' => Auth::user()->pabrik,
        // ];
        // notif::insert($notif);
        $log = [
            'log_isi' => Auth::user()->namadepan . ' mengubah laporan pengemasan batch',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        log::insert($log);
        return redirect('/pengemasan-batch');
    }
    public function tampil_pengemasanbatch()
    {
        $pabrik = Auth::user()->pabrik;

        // $data = Pengemasanbatchproduk::all()->where('pabrik', $pabrik);
        // dd($data);
        $produk = produk::all()->where('user_id', Auth::user()->pabrik);
        $kemasan = kemasan::all()->where('user_id', Auth::user()->pabrik);
        $protap = protap::all()->where('user_id', Auth::user()->pabrik)->where('protap_jenis', 9);
        // dd($produk);
        $data1 = Pengemasanbatchproduk::join('protaps', 'pengemasanbatchproduks.protap', '=', 'protaps.protap_id')
            ->get(['pengemasanbatchproduks.*', 'protaps.protap_nama']);

        return view('catatan.dokumen.pengemasanbatch', [
            'kemasbatch' => $data1,
            'produk' => $produk ?? [],
            'kemasan' => $kemasan ?? [],
            'protaps' => $protap ?? []
        ]);
    }

    public function log()
    {
        // Posts::orderBy('created_at', 'desc')->get();
        // return view('layout.log', ['dataLog' => DB::select('select * from logs')]);
        return view('layout.log', ['dataLog' => Log::orderBy('log_id', 'desc')->get()]);
    }

    public function notif()
    {
        if (Auth::user()->level ==  2) {
            notif::where('id_pabrik', Auth::user()->pabrik)
                ->where('status', 0)->update(['status' => 1]);
            $data = notif::all()->where('id_pabrik', Auth::user()->pabrik)
                ->where('notif_level', 1);
        }
        if (Auth::user()->level ==  3) {
            notif::where('id_pabrik', Auth::user()->pabrik)->where('notif_3', 1)
                ->update(['notif_3' => 2]);
            $data = notif::all()->where('id_pabrik', Auth::user()->pabrik)
                ->where('notif_3', '=', 2)->where('notif_level', 1);
        }
        if (Auth::user()->level ==  4 || Auth::user()->level ==  1) {
            notif::where('id_pabrik', Auth::user()->pabrik)->where('notif_3', 1)
                ->update(['notif_3' => 2]);
            $data = notif::all()->where('id_pabrik', Auth::user()->pabrik)
                ->where('notif_3', '!=', 0)->where('notif_level', 2);
        }

        return view('layout.notif', compact('data'));
    }
}
