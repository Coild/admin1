<?php

namespace App\Http\Controllers;

use App\Models\audit;
use App\Models\log as ModelsLog;
use App\Models\pabrik;
use Illuminate\Http\Request;
use App\Models\logadmin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

use function PHPUnit\Framework\isNull;

class pemilik extends Controller
{
    public function tampil_aplicant()
    {
        $pabrik = Auth::user()->pabrik;
        $data = user::all()->where('pabrik', $pabrik)
            ->where('level', -1);
        return view("pemilik.aplicant", ['data' => $data]);
    }

    public function tolak(Request $req)
    {
        $post = user::all()->where('id',  $req->id)->each->delete();
        return redirect('/aplicant');
    }

    public function terima(Request $req)
    {

        // dd($req->id);
        $pabrik = Auth::user()->pabrik;

        user::all()->where("id", $req->id)->first()->update([
            'level' => 3,
        ]);
        $data = user::all()->where('pabrik', $pabrik)
            ->where('level', -1);

        return view("pemilik.aplicant", ['data' => $data]);
    }

    public function tampil_karyawan()
    {
        $pabrik = Auth::user()->pabrik;
        $data = user::all()->where('pabrik', $pabrik)
            ->where('level', '>=', 2);
        //YANG DIUBAH
        // return view("pemilik.karyawan", ['data' => $data ]);
        return view("pemilik.karyawan", ['data' => $data, 'data1' => pabrik::all()]);
        //END
    }

    public function hapus_karyawan(Request $req)
    {
        // dd($req->id);
        if (isNull($req['_token'])) {
            return Redirect::back();
        }
        $post = user::all()->where('id',  $req->id)->each->delete();
        $pabrik = Auth::user()->pabrik;
        $data = user::all()->where('pabrik', $pabrik)
            ->where('level', '>=', 2);

        if ($req->level == 2) {
            $in = 'penanggung jawab teknis';
        } elseif ($req->level == 3) {
            $in = 'Pelaksana';
        }

        if ($post) {
            $log = [
                'log_isi' => session()->get('pabrik') . ' <b> Menghapus ' . $req->namadepan . ' ' .  $req->namabelakang . ' </b> &nbsp dari ' . $in,
                'log_pabrik' => session()->get('pabrik'),
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            logadmin::insert($log);

            return redirect('/karyawan')->with('success', 'Berhasil dihapus!');
        } else {
            return redirect('/karyawan')->with('error', 'Gagal dihapus!');
        }


        // return view("pemilik.karyawan", ['data' => $data]);
    }

    public function update_posisi(Request $req)
    {
        $user = user::all()->where("id", $req->id)->first()->update([
            'level' => $req->posisi
        ]);
        // dd($user);
        $pabrik = Auth::user()->pabrik;
        $data = user::all()->where('pabrik', $pabrik)
            ->where('level', '>=', 2);
        // dd($data);

        if ($req->posisi == 2) {
            $in = 'penanggung jawab teknis';
        } elseif ($req->posisi == 3) {
            $in = 'Pelaksana';
        }

        $log = [
            'log_isi' => session()->get('pabrik') . ' <b> Mengubah jabatan ' . $req->nama . ' </b> &nbsp menjadi ' . $in,
            'log_pabrik' => session()->get('pabrik'),
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        logadmin::insert($log);

        return view("pemilik.karyawan", ['data' => $data]);
    }

    public function ganti_struktur(Request $req)
    {
        $file = $req->file('upload');
        $nama = $file->getClientOriginalName();
        $tujuan_upload = 'asset/struktur/';
        $file->move($tujuan_upload, $nama);
        $id = Auth::user()->pabrik;
        // dd($id);
        $user = pabrik::all()->where("pabrik_id", $id)->first()->update([
            'struktur' => $nama,
        ]);
        // // user::deleted()
        return redirect('/dashboard');
    }

    public function list_request()
    {
        $data = audit::all()->where('audit_pabrik', Auth::user()->pabrik);
        // dd($data);
        return view('pemilik.request', ['data' => $data]);
    }

    public function terima_request(Request $req)
    {
        // dd($req);
        $user = audit::all()->where("audit_pabrik", $req->pabrik)

            ->where("audit_laporan", $req->laporan)
            ->where("audit_id", $req->no)->first()->update([
                'audit_status' => 1
            ]);
        return redirect('bos_audit');
    }

    public function hapus_request(Request $req)
    {
        // dd($req);
        // $user = audit::all()->where("audit_pabrik", $req->pabrik)
        //     ->where("nobatch", $req->nobatch)
        //     ->where("audit_laporan", $req->laporan)->each->delete();
        // dd($req);
        $user = audit::all()->where("audit_id", $req->auditId)->each->delete();
        return redirect('bos_audit')->with('success', 'Data Berhasil Dihapus!');
    }

    public function log()
    {
        // dd('halo');
        // Posts::orderBy('created_at', 'desc')->get();
        // return view('layout.log', ['dataLog' => DB::select('select * from logs')]);
        // dd(Log::all()->where('id_pabrik', Auth::user()->pabrik));
        return view('layout.logadmin', ['dataLog' => ModelsLog::all()->where('id_pabrik', Auth::user()->pabrik)]); //all()->where('id_pabrik', Auth::user()->pabrik)]);
    }
}
