<?php

namespace App\Http\Controllers;

use App\Models\{cp_bahan, cp_kemasan, cp_produk, PPbahanbakukeluar, PPbahanbakumasuk, PPkemasankeluar, PPkemasanmasuk, PPprodukjadikeluar, PPprodukjadimasuk, user};
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

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
        $data = cp_bahan::all();
        return DataTables::of($data)->editColumn('status', function ($data_siswa) {
            if ($data_siswa->status == 0) {
                return 'Diajukan';
            } elseif ($data_siswa->status == 1) {
                return 'Diterima';
            }
        })->addColumn('action', function ($data) {

            return '<form method="post" action="detilterimabb">
            ' . '<input type="hidden" name="_token" value="' . csrf_token() . '   " />' . '
            <input type="hidden" name="jenis" value=1 />
            <input type="hidden" name="induk"
                value=' . $data->cp_bahan_id . ' />
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>';
        })->rawColumns(['action'])->make();
    }

    public function cp_produk()
    {
        $data = cp_produk::all();
        return DataTables::of($data)->addColumn('action', function ($data) {

            return '<form method="post" action="detilterimabb">
            ' . '<input type="hidden" name="_token" value="' . csrf_token() . '   " />' . '
            <input type="hidden" name="jenis" value=2 />
            <input type="hidden" name="induk"
                value=' . $data->cp_bahan_id . ' />
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>';
        })->rawColumns(['action'])->make();
    }

    public function cp_kemasan()
    {
        $data = cp_kemasan::all();
        return DataTables::of($data)->addColumn('action', function ($data) {

            return '<form method="post" action="detilterimabb">
            ' . '<input type="hidden" name="_token" value="' . csrf_token() . '   " />' . '
            <input type="hidden" name="jenis" value=3 />
            <input type="hidden" name="induk"
                value=' . $data->cp_bahan_id . ' />
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>';
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
}