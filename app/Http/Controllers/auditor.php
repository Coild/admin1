<?php

namespace App\Http\Controllers;

use App\Models\{audit, User, pabrik, laporan, notif};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class auditor extends Controller
{
    public function list_pabrik()
    {

        $data = pabrik::all();

        // dd($data);
        return view('auditor.listpabrik', ['pabrik' => $data]);
    }

    public function list_dokumen(Request $req)
    {
        $data = laporan::all()->where('pabrik_id', $req['pabrik'])->where('laporan_terima', '!=', 'belum');
        return view('auditor.listdokumen', ['data' => $data]);
    }

    public function list_batch(Request $req)
    {
        // dd($id);
        $data = laporan::all()->where('pabrik_id', $req['pabrik']);
        return view('auditor.listbatch',  ['data' => $data]);
    }

    public function tambah_request(Request $req)
    {
        $id = Auth::user()->id;
        $pabrik = Auth::user()->pabrik;
        $hasil = [
            'nobatch' => $req['nobatch'],
            'audit_laporan' => $req['nama'],
            'audit_pabrik' => $req['pabrik'],
            'nama_audit' => Auth::user()->nama,
            'audit_status' => 0,
        ];

        // dd($hasil);
        audit::insert($hasil);
        $notif = [
            'notif_isi' => Auth::user()->namadepan." meminta audit laporan ".$req['nama'],
            'notif_laporan' => $req['nama'],
            'notif_link' => 'list_audit',
            'notif_waktu' => date('Y-m-d H:i:s'),
            'notif_1' => $req['asal'] ?? 0,
            'notif_2' => Auth::user()->level,
            'notif_3' => 1,
            'notif_level' => 2,
            'status' => 0,
            'id_pabrik'=> $req['pabrik'],
        ];
        notif::insert($notif);
        return redirect('/list_audit');
    }

    public function list_request()
    {
        $data = audit::all()->where('nama_audit', Auth::user()->nama);
        return view('auditor.request', ['data' => $data]);
    }

    public function ajukan_request()
    {
        return view('auditor.request');
    }
}
