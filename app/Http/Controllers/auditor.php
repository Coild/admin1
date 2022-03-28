<?php

namespace App\Http\Controllers;

use App\Models\{User,Pabrik,laporan};
use Illuminate\Http\Request;

class auditor extends Controller
{
    public function list_pabrik () {

        $data = pabrik::all();

        // dd($data);
        return view('auditor.listpabrik',['pabrik'=>$data]);
    }

    public function list_dokumen ($id) {
        $data = laporan::all()->where('laporan_batch',$id);
        return view('auditor.listdokumen',['data'=>$data]);
    }

    public function list_batch ($id) {
        // dd($id);
        $data = laporan::all()->where('pabrik_id',$id);
        return view('auditor.listbatch' ,  ['data' => $data]);
    }

    public function list_request () {
        return view('auditor.request');
    }

    public function ajukan_request () {
        return view('auditor.request');
    }
}
