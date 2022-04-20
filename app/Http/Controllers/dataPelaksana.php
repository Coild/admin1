<?php

namespace App\Http\Controllers;

use App\Models\{cp_bahan, cp_kemasan, cp_produk, laporan, PPbahanbakukeluar, PPbahanbakumasuk, PPkemasankeluar, PPkemasanmasuk, PPprodukjadikeluar, PPprodukjadimasuk, user};
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dataPelaksana extends Controller
{
    public function dummy()
    {

        return view('dummy');
    }

    public function user()
    {
        $user = User::all();
        return DataTables::of($user)->make();
    }

    public function cp_bahan()
    {
        if(Auth::user()->level==2) {
            $data = cp_bahan::all()->where('status',0);
        }else {
            $data = cp_bahan::all();
        }
        return DataTables::of($data)->editColumn('status', function ($data_siswa) {
            if ($data_siswa->status == 0) {
                return 'Diajukan';
            } elseif ($data_siswa->status == 1) {
                return 'Diterima';
            }
        })->addColumn('action', function ($data) {

            if(Auth::user()->level != 2)   {
                return '<form method="post" action="detilterimabb">
                ' . '<input type="hidden" name="_token" value="' . csrf_token() . '   " />' . '
                <input type="hidden" name="jenis" value=1 />
                <input type="hidden" name="induk"
                    value=' . $data->cp_bahan_id . ' />
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>';
            } else {
                return '<form method="post" action="terima_cpbahan">
            ' . '<input type="hidden" name="_token" value="' . csrf_token() . '   " />' . '
            <input type="hidden" name="jenis" value=1 />
            <input type="hidden" name="nobatch"
                value=' . $data->cp_bahan_id . ' />
            <button type="submit" class="btn btn-primary">Terima</button>
        </form>';
            }
            
        })->rawColumns(['action'])->make();
    }

    public function cp_produk()
    {
        if(Auth::user()->level==2) {
            $data = cp_produk::all()->where('status',0);
        }else {
            $data = cp_produk::all();
        }
        return DataTables::of($data)->addColumn('action', function ($data) {

            if(Auth::user()->level != 2)   {
                return '<form method="post" action="detilterimabb">
                ' . '<input type="hidden" name="_token" value="' . csrf_token() . '   " />' . '
                <input type="hidden" name="jenis" value=2 />
                <input type="hidden" name="induk"
                    value=' . $data->cp_produk_id . ' />
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>';
            } else {
                return '<form method="post" action="terima_cpproduk">
            ' . '<input type="hidden" name="_token" value="' . csrf_token() . '   " />' . '
            <input type="hidden" name="jenis" value=2 />
            <input type="hidden" name="nobatch"
                value=' . $data->cp_produk_id . ' />
            <button type="submit" class="btn btn-primary">Terima</button>
        </form>';
            }
        })->rawColumns(['action'])->make();
    }

    public function cp_kemasan()
    {
        if(Auth::user()->level==2) {
            $data = cp_kemasan::all()->where('status',0);
        }else {
            $data = cp_kemasan::all();
        }
        return DataTables::of($data)->editColumn('status', function ($data_siswa) {
            if ($data_siswa->status == 0) {
                return 'Diajukan';
            } elseif ($data_siswa->status == 1) {
                return 'Diterima';
            }
        })->addColumn('action', function ($data) {
            if(Auth::user()->level != 2)   {
                return '<form method="post" action="detilterimabb">
                ' . '<input type="hidden" name="_token" value="' . csrf_token() . '   " />' . '
                <input type="hidden" name="jenis" value=3 />
                <input type="hidden" name="induk"
                    value=' . $data->cp_kemasan_id . ' />
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>';
            } else {
                return '<form method="post" action="terima_cpkemasan">
            ' . '<input type="hidden" name="_token" value="' . csrf_token() . '   " />' . '
            <input type="hidden" name="jenis" value=1 />
            <input type="hidden" name="nobatch"
                value=' . $data->cp_kemasan_id . ' />
            <button type="submit" class="btn btn-primary">Terima</button>
        </form>';
            }
        })->rawColumns(['action'])->make();
    }

    public function cp_bahanmasuk(Request $req)
    {
        $data = PPbahanbakumasuk::all()->where('induk', $req['induk']);
        return DataTables::of($data)->addColumn('action', function ($data) {
            return '<button type="submit" class="btn btn-primary">Edit</button>';
        })->rawColumns(['action'])->make();
    }
    public function cp_bahankeluar(Request $req)
    {
        $data = PPbahanbakukeluar::all()->where('induk', $req['induk']);
        return DataTables::of($data)->addColumn('action', function ($data) {
            return '<button type="submit" class="btn btn-primary">Edit</button>';
        })->rawColumns(['action'])->make();
    }

    public function cp_produkmasuk(Request $req)
    {
        $data = PPprodukjadimasuk::all()->where('induk', $req['induk']);
        return DataTables::of($data)->addColumn('action', function ($data) {
            return '<button type="submit" class="btn btn-primary">Edit</button>';
        })->rawColumns(['action'])->make();
    }
    public function cp_produkkeluar(Request $req)
    {
        $data = PPprodukjadikeluar::all()->where('induk', $req['induk']);
        return DataTables::of($data)->addColumn('action', function ($data) {
            return '<button type="submit" class="btn btn-primary">Edit</button>';
        })->rawColumns(['action'])->make();
    }

    public function cp_kemasanmasuk(Request $req)
    {
        $data = PPkemasanmasuk::all()->where('induk', $req['induk']);
        return DataTables::of($data)->addColumn('action', function ($data) {
            return '<button type="submit" class="btn btn-primary">Edit</button>';
        })->rawColumns(['action'])->make();
    }
    public function cp_kemasankeluar(Request $req)
    {
        $data = PPkemasankeluar::all()->where('induk', $req['induk']);
        return DataTables::of($data)->addColumn('action', function ($data) {
            return '<button type="submit" class="btn btn-primary">Edit</button>';
        })->rawColumns(['action'])->make();
    }

    public function laporan (){
        $data = laporan::all()->where('laporan_diterima',"!=",'belum');
        // dd($data);
        return DataTables::of($data)->addColumn('action', function ($data) {
            if($data->laporan_nama=='pengolahan batch')
             $form = '<form method="post" action="/printpengolahanbatch">';
            elseif($data->laporan_nama=='penambahan contoh bahan baku')
            $form = '<form method="post" action="/printambilbahanbaku">';
            elseif($data->laporan_nama=='penambahan contoh produk')
            $form = '<form method="post" action="/printambilprodukjadi">';
            elseif($data->laporan_nama=='penambahan contoh kemasan')
            $form = '<form method="post" action="/printambilbahankemas">';
            elseif($data->laporan_nama=='penerimaan bahan')
            $form = '<form method="post" action="/printterimabahan">';
            elseif($data->laporan_nama=='penerimaan produk')
            $form = '<form method="post" action="/printterimaproduk">';
            elseif($data->laporan_nama=='penerimaan kemasan')
            $form = '<form method="post" action="/printterimakemasan">';
            elseif($data->laporan_nama=='pelatihan higiene dan sanitasi')
            $form = '<form method="post" action="/printlatihhigisani">';
            elseif($data->laporan_nama=='pelatihan cpkb')
            $form = '<form method="post" action="/printlatihcpkb">';
            elseif($data->laporan_nama=='pengoperasian alat')
            $form = '<form method="post" action="/printalatutama">';

            elseif($data->laporan_nama=='pelulusan produk jadi')
            $form = '<form method="post" action="/printpelulusanproduk">';

            elseif($data->laporan_nama=='distribusi produk')
            $form = '<form method="post" action="/printdistribusiproduk">';

            elseif($data->laporan_nama=='penanganan keluhan')
            $form = '<form method="post" action="/printpenanganankeluhan">';
            
            elseif($data->laporan_nama=='pelatihan cpkb')
            $form = '<form method="post" action="/printlatihcpkb">';
            elseif($data->laporan_nama=='pelatihan cpkb')
            $form = '<form method="post" action="/printlatihcpkb">';
            elseif($data->laporan_nama=='pelatihan cpkb')
            $form = '<form method="post" action="/printlatihcpkb">';
            elseif($data->laporan_nama=='pelatihan cpkb')
            $form = '<form method="post" action="/printlatihcpkb">';
            elseif($data->laporan_nama=='pelatihan cpkb')
            $form = '<form method="post" action="/printlatihcpkb">';
            else
            $form = '<form method="post" action="/printterimakemasan">';
            $isi= 
            '<input type="hidden" name="_token" value="' . csrf_token() . '   " />' .
            '
                <input type="hidden" name="nobatch" value='.$data->laporan_batch.' />'.
                '<input type="hidden" name="id" value='.$data->laporan_nomor.' />'.
                '<button type="submit" class="btn btn-primary">Buka</button>
            </form>';
            return $form.$isi;
        })->rawColumns(['action'])->make();
    }
}
