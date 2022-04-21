<?php

use App\Http\Controllers\{Admin, AuthController, pemilik, pjt, superadmin, protapController, auditor, dataPelaksana, PrintController};
use App\Http\Middleware\admin as MiddlewareAdmin;
use App\Models\protap;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your applicatpion. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/coba', 'catatan.dokumen.detailpenerimaanBB');

Route::get('/login', [AuthController::class, 'showFormLogin'])->name("login");
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/showregister', [AuthController::class, 'showFormRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/autocomplete-search', [AuthController::class, 'autocompleteSearch']);

Route::view('/template', 'print.template');

Route::get('/resetpass', function () {
    return view('auth.resetpass');
});
Route::get('/auto', function () {
    return view('catatan.dokumen.auto');
});

//print    
Route::post('/printpengolahanbatch', [PrintController::class, 'cetak_pengolahanbatch']);
Route::post('/printambilbahankemas', [PrintController::class, 'cetak_ambilbahankemas'])->name('ambilbahankemas');
Route::post('/printambilprodukjadi', [PrintController::class, 'cetak_ambilprodukjadi'])->name('ambilbprodukjadi');
Route::post('/printambilbahanbaku', [PrintController::class, 'cetak_ambilbahanbaku'])->name('ambilbahankemas');
Route::post('/printlatihhigisani', [PrintController::class, 'cetak_latihhigisani'])->name('latihhigisani');
Route::post('/printlatihcpkb', [PrintController::class, 'cetak_latihcpkb'])->name('latihcpkb');

Route::post('/printterimabahan', [PrintController::class, 'cetak_terimabahan'])->name('terimabahan');
Route::post('/printterimaproduk', [PrintController::class, 'cetak_terimaproduk'])->name('terimaproduk');
Route::post('/printterimakemasan', [PrintController::class, 'cetak_terimakemasan'])->name('terimakemasan');

Route::post('/printalatutama', [PrintController::class, 'cetak_alatutama'])->name('alatutama');
Route::post('/printdistribusiproduk', [PrintController::class, 'cetak_distribusiproduk'])->name('distribusiproduk');
Route::post('/printpenanganankeluhan', [PrintController::class, 'cetak_penanganankeluhan'])->name('penanganankeluhan');

Route::post('/printpenarikanproduk', [PrintController::class, 'cetak_penarikanproduk'])->name('penarikanproduk');

Route::post('/printpemusnahanbahan', [PrintController::class, 'cetak_pemusnahanbahan'])->name('pemusnahanbahan');
Route::post('/printpemusnahanbahankemas', [PrintController::class, 'cetak_pemusnahanbahankemas'])->name('pemusnahanbahankemas');
Route::post('/printpemusnahanprodukantara', [PrintController::class, 'cetak_pemusnahanprodukantara'])->name('pemusnahanprodukantara');
Route::post('/printpemusnahanprodukjadi', [PrintController::class, 'cetak_pemusnahanprodukjadi'])->name('pemusnahanprodukjadi');

Route::post('/printambilbahankemas', [PrintController::class, 'cetak_ambilbahankemas'])->name('ambilbahankemas');
Route::post('/printambilbahankemas', [PrintController::class, 'cetak_ambilbahankemas'])->name('ambilbahankemas');


// Route::get('/dummy', [PrintController::class, 'dummy']);

Route::group(['middleware' => 'auth'], function () {

    //admin
    Route::group(
        ['middleware' => 'admin'],
        function () {
            Route::get('/pabrik', [superadmin::class, 'tampil_pabrik']);
            Route::get('/audit', [superadmin::class, 'tampil_audit']);
            Route::get('/inspek', [superadmin::class, 'tampil_inspek']);
            Route::post('/register_pabrik', [superadmin::class, 'register']);
            Route::post('/register_audit', [superadmin::class, 'register_audit']);
            Route::post('/register_inspek', [superadmin::class, 'register_inspek']);
            Route::post('/input_aturan', [superadmin::class, 'input_aturan']);
        }
    );

    //pemilik
    Route::group(['middleware' => 'pemilik'], function () {
        Route::get('/aplicant', [pemilik::class, 'tampil_aplicant']);
        Route::post('/terima', [pemilik::class, 'terima']);
        Route::post('/tolak', [pemilik::class, 'tolak']);
        Route::post('/update_posisi', [pemilik::class, 'update_posisi']);
        Route::get('/karyawan', [pemilik::class, 'tampil_karyawan']);
        Route::post('/hapus_karyawan', [pemilik::class, 'hapus_karyawan']);
        Route::get('/bos_audit', [pemilik::class, 'list_request']);
        Route::post('/terima_request', [pemilik::class, 'terima_request']);
        Route::post('/ganti_struktur', [pemilik::class, 'ganti_struktur']);
    });




    //pjt
    Route::group(['middleware' => 'pjt'], function () {
        Route::get('/pjt_pengolahanbatch', [pjt::class, 'tampil_pengolahanbatch'])->name('pjt_pengolahanbatch');
        Route::post('/pjt_pengolahanbatch', [pjt::class, 'terima_batch']);

        Route::post('/input_coa', [Admin::class, 'tambah_coa']);
        Route::get('/coa', [Admin::class, 'tampil_coa'])->name('coa');
        Route::get('/hapus_coa/{id}', [Admin::class, 'hapus_coa']);

        Route::post('/input_dip', [Admin::class, 'tambah_dip']);
        Route::get('/dip', [Admin::class, 'tampil_dip'])->name('dip');
        Route::get('/hapus_dip/{id}', [Admin::class, 'hapus_dip']);

        Route::post('/input_perizinan', [Admin::class, 'tambah_perizinan']);
        Route::get('perizinan', [Admin::class, 'tampil_perizinan'])->name('perizinan');
        Route::get('/hapus_perizinan/{id}', [Admin::class, 'hapus_perizinan']);

        Route::post('/input_jabatan', [Admin::class, 'tambah_jabatan']);
        Route::get('/jabatan', [Admin::class, 'tampil_jabatan'])->name('jabatan');
        Route::get('/hapus_jabatan/{id}', [Admin::class, 'hapus_jabatan']);

        Route::post('/terimakartustokbahan', [pjt::class, 'terima_kartustok_bahanbaku'])->name('terima_kartustok_bahanbaku');

        Route::post('/terimaambilbahanbaku', [pjt::class, 'terima_ambilbahanbaku'])->name('terima_ambilbahanbaku');
        Route::post('/terimaambilbahankemas', [pjt::class, 'terima_ambilbahankemas'])->name('terima_ambilbahankemas');
        Route::post('/terimaambilprodukjadi', [pjt::class, 'terima_ambilprodukjadi'])->name('terima_ambilprodukjadi');
        Route::post('/terimaambilprodukantara', [pjt::class, 'terima_ambilprodukantara'])->name('terima_ambilprodukantara');

        Route::post('/terima_cpbahan', [pjt::class, 'terima_cp_bahan'])->name('terima_cp_bahan');
        Route::post('/terima_cpproduk', [pjt::class, 'terima_cp_produk'])->name('terima_cp_produk');
        Route::post('/terima_cpkemasan', [pjt::class, 'terima_cp_kemasan'])->name('terima_cp_kemasan');

        Route::post('/terimapelatihanhigisani', [pjt::class, 'terima_pelatihanhigisani'])->name('terima_pelatihanhigisani');
        Route::post('/terimapelatihancpkb', [pjt::class, 'terima_pelatihancpkb'])->name('terima_pelatihancpkb');

        Route::post('/terimapenimbanganbahan', [pjt::class, 'terima_penimbanganbahan'])->name('terima_penimbanganbahan');
        Route::post('/terimapenimbanganproduk', [pjt::class, 'terima_penimbanganproduk'])->name('terima_penimbanganproduk');
        Route::post('/terimapenimbanganruang', [pjt::class, 'terima_penimbanganruang'])->name('terima_penimbanganruang');
        Route::post('/terimapelulusanproduk', [pjt::class, 'terima_pelulusanproduk'])->name('terima_pelulusanproduk');

        Route::post('/terimaoperasialat', [pjt::class, 'terima_operasialat'])->name('terima_operasialat');
        Route::post('/terimadistribusiproduk', [pjt::class, 'terima_distribusiproduk'])->name('terima_distribusiproduk');

        Route::post('/terimapenanganankeluhan', [pjt::class, 'terima_penanganankeluhan'])->name('terima_penanganankeluhan');
        Route::post('/terimapenarikanproduk', [pjt::class, 'terima_penarikanproduk'])->name('terima_penarikanproduk');
        Route::post('/terimapemusnahanbahan', [pjt::class, 'terima_pemusnahanbahanbaku'])->name('terima_pemusnahanbahanbaku');
        Route::post('/terimapemusnahanbahankemas', [pjt::class, 'terima_pemusnahanbahankemas'])->name('terima_pemusnahanbahankemas');
        Route::post('/terimapemusnahanprodukantara', [pjt::class, 'terima_pemusnahanprodukantara'])->name('terima_pemusnahanprodukantara');
        Route::post('/terimapemusnahanprodukjadi', [pjt::class, 'terima_pemusnahanprodukjadi'])->name('terima_pemusnahanprodukjadi');
        Route::post('/terimakartustokbahan', [pjt::class, 'terima_stokbahanbaku'])->name('terima_stokbahanbaku');
        Route::post('/terimakartustokbahankemas', [pjt::class, 'terima_stokbahankemas'])->name('terima_stokbahankemas');
        Route::post('/terimakartustokprodukjadi', [pjt::class, 'terima_stokprodukjadi'])->name('terima_stokprodukjadi');
        Route::post('/terimapemeriksaanbahanbaku', [pjt::class, 'terima_pemeriksaanbahanbaku'])->name('terima_pemeriksaanbahanbaku');
        Route::post('/terimapemeriksaanbahankemas', [pjt::class, 'terima_pemeriksaanbahankemas'])->name('terima_pemeriksaanbahankemas');
        Route::post('/terimapemeriksaanprodukjadi', [pjt::class, 'terima_pemeriksaanprodukjadi'])->name('terima_pemeriksaanprodukjadi');

        Route::post('/terimabahanmasuk', [pjt::class, 'terima_bahanmasuk'])->name('terima_bahanmasuk');
        Route::post('/terimabahankeluar', [pjt::class, 'terima_bahankeluar'])->name('terima_bahankeluar');
        Route::post('/terimaprodukmasuk', [pjt::class, 'terima_produkmasuk'])->name('terima_produkmasuk');
        Route::post('/terimaprodukkeluar', [pjt::class, 'terima_produkkeluar'])->name('terima_produkkeluar');
        Route::post('/terimakemasanmasuk', [pjt::class, 'terima_kemasanmasuk'])->name('terima_kemasanmasuk');
        Route::post('/terimakemasankeluar', [pjt::class, 'terima_kemasankeluar'])->name('terima_kemasankeluar');



        Route::get('/setting', [Admin::class, 'tampil_setting'])->name("setting");
        Route::post('/input_produk', [Admin::class, 'tambah_produk']);
        Route::post('/input_produkantara', [Admin::class, 'tambah_produkantara']);
        Route::post('/input_kemasan', [Admin::class, 'tambah_kemasan']);
        Route::post('/input_bahanbaku', [Admin::class, 'tambah_bahanbaku']);
        Route::post('/input_produkantara', [Admin::class, 'tambah_produkantara']);
        Route::post('/input_company', [Admin::class, 'tambah_company']);

        Route::get('/hapus_kemasan/{id}', [Admin::class, 'hapus_kemasan']);
        Route::get('/hapus_bahanbaku/{id}', [Admin::class, 'hapus_bahanbaku']);
        Route::get('/hapus_produk/{id}', [Admin::class, 'hapus_produk']);

        Route::get('/laporan', [Admin::class, 'tampil_laporan'])->name('laporan');


        Route::get('/spek_bahan_baku', [pjt::class, 'tampil_bahan_baku'])->name("tampil_bahanbaku");
        Route::get('/spek_bahan_kemas', [pjt::class, 'tampil_bahan_kemas'])->name("tampil_bahankemas");
        Route::get('/spek_produk_antara', [pjt::class, 'tampil_produk_antara'])->name("tampil_produkantara");
        Route::get('/spek_produk_jadi', [pjt::class, 'tampil_produk_jadi'])->name("tampil_produkjadi");

        Route::post('/tambah_bahan_baku', [pjt::class, 'tambah_bahan_baku'])->name("tambah_bahanbaku");
        Route::post('/tambah_bahan_kemas', [pjt::class, 'tambah_bahan_kemas'])->name("tambah_bahankemas");
        Route::post('/tambah_produk_antara', [pjt::class, 'tambah_produk_antara'])->name("tambah_produkantara");
        Route::post('/tambah_produk_jadi', [pjt::class, 'tambah_produk_jadi'])->name("tambah_produkjadi");

        Route::get('/hapus_bahan_baku/{id}', [pjt::class, 'hapus_bahanbaku'])->name("hapus_bahanbaku");
        Route::get('/hapus_bahan_kemas/{id}', [pjt::class, 'hapus_bahankemas'])->name("hapus_bahankemas");
        Route::get('/hapus_produk_antara/{id}', [pjt::class, 'hapus_produkantara'])->name("hapus_produkantara");
        Route::get('/hapus_produk_jadi/{id}', [pjt::class, 'hapus_produkjadi'])->name("hapus_produkjadi");
    });


    //pelaksana
    Route::group(['middleware' => 'pelaksana'], function () {
        Route::post('/input_komposisi', [Admin::class, 'tambah_komposisi']);
        Route::post('/input_peralatan', [Admin::class, 'tambah_peralatan']);
        Route::post('/input_penimbangan', [Admin::class, 'tambah_penimbangan']);
        Route::post('/input_olah', [Admin::class, 'tambah_olah']);
        Route::post('/input_rekonsiliasi', [Admin::class, 'tambah_rekonsiliasi']);


        Route::get('/hapus_komposisi/{id}/{ke}', [Admin::class, 'hapus_komposisi']);
        Route::get('/hapus_peralatan/{id}/{ke}', [Admin::class, 'hapus_peralatan']);
        Route::get('/hapus_penimbangan/{id}/{ke}', [Admin::class, 'hapus_penimbangan']);
        Route::get('/hapus_olah/{id}/{ke}', [Admin::class, 'hapus_olah']);
        Route::post('/tambah_batch', [Admin::class, 'tambah_batch']);
        // Route::post('/detil_batch', [Admin::class, 'tampil_detilbatch']); 

        Route::post('/tambah_terimabahan', [Admin::class, 'tambah_terimabahan'])->name('tambah_terimabahan');
        Route::post('/tambah_terimaproduk', [Admin::class, 'tambah_terimaproduk'])->name('tambah_terimaproduk');
        Route::post('/tambah_terimakemasan', [Admin::class, 'tambah_terimakemasan'])->name('tambah_terimakemasan');

        Route::post('/tambah_penerimaanbbmasuk', [Admin::class, 'tambah_penerimaanbbmasuk'])->name('tambah_penerimaanBBmasuk');
        Route::post('/tambah_penerimaanbbkeluar', [Admin::class, 'tambah_penerimaanbbkeluar'])->name('tambah_penerimaanbbkeluar');
        Route::post('/tambah_penerimaanprdukmasuk', [Admin::class, 'tambah_penerimaanprdukmasuk'])->name('tambah_penerimaanprdukmasuk');
        Route::post('/tambah_penerimaanprodukkeluar', [Admin::class, 'tambah_penerimaanprodukkeluar'])->name('tambah_penerimaanprodukkeluar');
        Route::post('/tambah_penerimaakemasanmasuk', [Admin::class, 'tambah_penerimaakemasanmasuk'])->name('tambah_penerimaakemasanmasuk');
        Route::post('/tambah_penerimaankemasankeluar', [Admin::class, 'tambah_penerimaankemasankeluar'])->name('tambah_penerimaankemasankeluar');

        //higi dansani
        Route::get('/periksapersonil', [Admin::class, 'tampil_periksapersonil'])->name('periksapersonil');
        Route::post('/tambah_periksapersonil', [Admin::class, 'tambah_periksapersonil']);
        Route::get('/periksasanialat', [Admin::class, 'tampil_periksasanialat'])->name('periksasanialat');
        Route::post('/tambah_periksaalat', [Admin::class, 'tambah_periksaalat']);
        Route::get('/periksasaniruang', [Admin::class, 'tampil_periksasaniruang'])->name('periksasaniruang');
        Route::post('/tambah_periksaruang', [Admin::class, 'tambah_periksaruang']);


        //yusril
        Route::post('tambah_pelatihanhiginitas', [Admin::class, 'tambah_pelatihanhiginitas'])->name('tambah_pelatihanhiginitas');
        Route::post('tambah_pelatihancpkb', [Admin::class, 'tambah_pelatihancpkb'])->name('tambah_pelatihancpkb');
        Route::post('tambah_kartustokbahan', [Admin::class, 'tambah_kartustokbahan'])->name('tambah_kartustokbahan');
        Route::post('tambah_kartustokprodukantara', [Admin::class, 'tambah_kartustokprodukantara'])->name('tambah_kartustokprodukantara');
        Route::post('tambah_kartustokprodukjadi', [Admin::class, 'tambah_kartustokprodukantara'])->name('tambah_kartustokprodukantara');
        Route::post('tambah_kartustokbahankemas', [Admin::class, 'tambah_kartustokbahankemas'])->name('tambah_kartustokbahankemas');
        Route::post('tambah_penimbanganbahan', [Admin::class, 'tambah_penimbanganbahan'])->name('tambah_penimbanganbahan');
        Route::post('tambah_penimbanganprodukantara', [Admin::class, 'tambah_penimbanganprodukantara'])->name('tambah_penimbanganprodukantara');
        Route::post('tambah_ruangtimbang', [Admin::class, 'tambah_ruangtimbang'])->name('tambah_ruangtimbang');
        Route::post('tambah_contohbahan', [Admin::class, 'tambah_contohbahan'])->name('tambah_contohbahan');
        Route::post('tambah_contohproduk', [Admin::class, 'tambah_contohproduk'])->name('tambah_contohproduk');
        Route::post('tambah_contohkemasan', [Admin::class, 'tambah_contohkemasan'])->name('tambah_contohkemasan');
        Route::post('tambah_pelulusan', [Admin::class, 'tambah_pelulusan'])->name('tambah_pelulusan');
        Route::post('tambah_operasialat', [Admin::class, 'tambah_operasialat'])->name('tambah_operasialat');
        Route::post('tambah_pemusnahanbahan', [Admin::class, 'tambah_pemusnahanbahan'])->name('tambah_pemusnahanbahan');
        Route::post('tambah_pemusnahanbahankemas', [Admin::class, 'tambah_pemusnahanbahankemas'])->name('tambah_pemusnahanbahankemas');
        Route::post('tambah_pemusnahanprodukantara', [Admin::class, 'tambah_pemusnahanprodukantara'])->name('tambah_pemusnahanprodukantara');
        Route::post('tambah_pemusnahanprodukjadi', [Admin::class, 'tambah_pemusnahanprodukjadi'])->name('tambah_pemusnahanprodukjadi');
        Route::post('tambah_keluhan', [Admin::class, 'tambah_keluhan'])->name('tambah_keluhan');
        Route::post('tambah_penarikan', [Admin::class, 'tambah_penarikan'])->name('tambah_penarikan');
        Route::post('tambah_distribusi', [Admin::class, 'tambah_distribusi'])->name('tambah_distribusi');
        Route::post('tambah_kartustokbahan', [Admin::class, 'tambah_kartustokbahan'])->name('tambah_kartustokbahan');
        Route::post('tambah_kartustokbahankemas', [Admin::class, 'tambah_kartustokbahankemas'])->name('tambah_kartustokbahankemas');
        Route::post('tambah_kartustokprodukjadi', [Admin::class, 'tambah_kartustokprodukjadi'])->name('tambah_kartustokprodukjadi');
        Route::post('tambah_kalibrasialat', [Admin::class, 'tambah_kalibrasialat'])->name('tambah_kalibrasialat');
        Route::post('tambah_pemeriksaanbahan', [Admin::class, 'tambah_pemeriksaanbahan'])->name('tambah_pemeriksaanbahan');
        Route::post('tambah_pemeriksaanbahankemas', [Admin::class, 'tambah_pemeriksaanbahankemas'])->name('tambah_pemeriksaanbahankemas');
        Route::post('tambah_pemeriksaanprodukjadi', [Admin::class, 'tambah_pemeriksaanprodukjadi'])->name('tambah_pemeriksaanprodukjadi');
        Route::post('tambah_pengemasanbatchproduk', [Admin::class, 'tambah_pengemasanbatchproduk'])->name('tambah_pengemasanbatchproduk');
    });

    //auuditor
    Route::group(['middleware' => 'auditor'], function () {
        Route::get('/audit_pabrik', [Auditor::class, 'list_pabrik']);
        Route::post('/audit_dokumen', [Auditor::class, 'list_dokumen']);
        Route::post('/audit_batch', [Auditor::class, 'list_batch']);
        Route::get('/list_audit', [Auditor::class, 'list_request']);

        Route::post('tambah_request', [Auditor::class, 'tambah_request']);
    });

    Route::group(['middleware' => ['karyawan']], function () {
        //tampil catatan
        Route::get('/pengolahanbatch',  [Admin::class, 'tampil_pengolahanbatch'])->name('pengolahanbatch');
        Route::get('/detilterimabbid/{jen}/{induk}', [Admin::class, 'tampil_detilbbid']);
        Route::post('/detilterimabb', [Admin::class, 'tampil_detilbb'])->name('detilBB');
        Route::get('/detil_batch/{id}', [Admin::class, 'tampil_detilbatchid'])->name('detil_batch');
        Route::get('/penerimaanBB', [Admin::class, 'tampil_penerimaanbb'])->name('penerimaanBB');
        Route::get('program-dan-pelatihan-higiene-dan-sanitasi', [Admin::class, 'tampil_programpelatihanhigienitasdansanitasi'])->name('program-dan-pelatihan-higiene-dan-sanitasi');
        Route::get('pemusnahan-produk', [Admin::class, 'tampil_pemusnahanproduk'])->name('pemusnahan-produk');
        Route::get('penanganan-keluhan', [Admin::class, 'tampil_penanganankeluhan'])->name('penanganan-keluhan');
        Route::get('penarikan-produk', [Admin::class, 'tampil_penarikanproduk'])->name('penarikan-produk');
        Route::get('pendistribusian-produk', [Admin::class, 'tampil_distribusi'])->name('pendistribusian-produk');
        Route::get('pengoprasian-alat', [Admin::class, 'tampil_pengorasianalat'])->name('pengoprasian-alat');
        Route::get('pelulusan-produk', [Admin::class, 'tampil_pelulusanproduk'])->name('pelulusan-produk');
        Route::get('ambilcontoh', [Admin::class, 'tampil_pengambilancontoh'])->name('ambilcontoh');
        Route::get('penimbangan', [Admin::class, 'tampil_penimbangan'])->name('penimbangan');
        Route::get('kartu-stok', [Admin::class, 'tampil_kartustok'])->name('kartu-stok');
        Route::get('kartu-stok', [Admin::class, 'tampil_kartustok'])->name('kartu-stok');
        Route::get('kalibrasi-alat', [Admin::class, 'tampil_kalibrasialat'])->name('kalibrasi-alat');
        Route::get('pemeriksaan-bahan', [Admin::class, 'tampil_pemeriksaan'])->name('pemeriksaan-bahan');
        Route::get('pengemasan-batch', [Admin::class, 'tampil_pengemasanbatch'])->name('pengemasan-batch');

        //pprotap
        Route::post('/input_protap/{jenis}', [protapController::class, 'tambah_protap']);
        Route::get('/tampil_protap/{jenis}', [protapController::class, 'tampil_protap'])->name('tampil');
        Route::get('/hapus_protap/{id}/{jenis}', [protapController::class, 'hapus_protap']);

        Route::get('/ajukan_batch/{id}', [Admin::class, 'ajukan_batch']);
        Route::get('/list_ajukan_batch/{id}', [Admin::class, 'ajukan_batch']);
        Route::get('/tolak_batch/{id}', [Admin::class, 'tolak_batch']);
        Route::get('/terima_batch/{id}', [Admin::class, 'terima_batch']);
    });


    Route::get('/dashboard', [Admin::class, 'dashboard'])->name('dashboard');

    Route::get('/gantipassword', [AuthController::class, 'tampil_ganti_password']);
    Route::post('/gantipassword', [AuthController::class, 'ganti_password']);

    // Route::post('/input_catatbersih', [Admin::class, 'tambah_catatbersih']);

    // Route::get('/pengolahanbatch/{id}',  [Admin::class, 'tampil_pengolahanbatch'])->name('pengolahanbatch');

    Route::get('/index', function () {
        return redirect()->route('dashboard');
    })->name("home");

    Route::get('/', [AuthController::class, 'showFormLogin']);

    Route::get('/pembersihanruangan', function () {
        return view('catatan.dokumen.pembersihanruangan');
    });

    //datatables 
    Route::get('user', [dataPelaksana::class, 'user']);
    Route::get('cp_bahan', [dataPelaksana::class, 'cp_bahan']);
    Route::get('cp_produk', [dataPelaksana::class, 'cp_produk']);
    Route::get('cp_kemasan', [dataPelaksana::class, 'cp_kemasan']);
    Route::get('laporandata', [dataPelaksana::class, 'laporan']);

    Route::get('dummy', [dataPelaksana::class, 'dummy']);
});
