<?php

namespace App\Http\Controllers;

use App\Models\logadmin;
use App\Models\pabrik;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
// use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
use App\Models\notif;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Redirect;

use function PHPUnit\Framework\isNull;

class AuthController extends Controller
{

    public function bersih($string)
    {
        //$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z\-]/', '', $string); // Removes special chars.

    }


    public function showFormLogin()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
        }
        return view('auth.login');
        // $hhas =web
        // dd($hhas);
    }

    public function login(Request $request)
    {
        // dd(Admin::bersih($request->input('username')));
        $data = [
            'nama'     => $request->input('username'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);
        // dd(Auth::user());
        // echo Auth::user()->username;
        if (Auth::attempt($data)) { // true sekalian session field di users nanti bisa dipanggil via Auth
            // echo "Login Success";

            if (Auth::user()->level < 0) {
                Auth::logout();
                return  view('tunggu');
            } else {
                $log = [
                    'log_isi' => Auth::user()->namadepan . ' Login ke dalam sistem',
                    'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
                    'log_waktu' => date('Y-m-d H:i:s'),
                    'id_pabrik' => Auth::user()->pabrik
                ];
                DB::table('logs')->insert($log);

                $data = pabrik::all()->where('pabrik_id', Auth::user()->pabrik);
                foreach ($data as $row) {
                    session(['pabrik' => $row['nama']]);
                }
                session(['notif' => notif::all(), 'jumlah' => notif::all()->count()]);
                return redirect('/dashboard');
            }
        } else { // false

            //Login Fail
            return redirect('/login')->with('message', 'Username atau password salah');
        }
    }

    public function showFormRegister()
    {
        $data1 = user::all('nama');
        $data = pabrik::all();
        return view('auth.register', ['data' => $data, 'data1' => $data1]);
    }

    public function register(Request $request)
    {

        // dd(session()->get('pabrik'));
        $check_username = User::all()->where("nama", ucwords(strtolower($request->username)))->first();

        if ($check_username) {
            return redirect('/karyawan')->with('error', 'Username Telah Tersedia');
        }


        $user = new User;
        $user->nama = ucwords(strtolower($request->username));
        $user->namadepan = $request->namadepan;
        $user->namabelakang = $request->namabelakang;
        $user->pabrik = $request->search;
        $user->level = 3;
        $user->password = bcrypt($request->password);
        $simpan = $user->save();

        if ($simpan) {
            $log = [
                'log_isi' => session()->get('pabrik') . ' <b> Menambah ' . $request->namadepan . ' ' .  $request->namabelakang . ' </b> &nbsp sebagai Pelaksana baru',
                'log_pabrik' => session()->get('pabrik'),
                'log_waktu' => date('Y-m-d H:i:s'),
                'id_pabrik' => Auth::user()->pabrik
            ];
            logadmin::insert($log);

            return redirect('/karyawan')->with('success', 'Data Karyawan Berhasil Disimpan');
        } else {
            return redirect('/karyawan')->with('error', 'Data Karyawan Gagal Disimpan');
        }
        //END
    }

    public function logout()
    {
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Logout sistem',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        DB::table('logs')->insert($log);

        Auth::logout(); // menghapus session yang aktif
        return redirect('login');
    }

    public function tampil_ganti_password()
    {
        return view('auth.gantipassword');
    }

    public function ganti_password(Request $req)
    {
        if (Hash::check($req['lama'], Auth::user()->password)) {
            $id = Auth::user()->id;
            $user = User::all()->where("id", $id)->first()->update([
                'password' => Hash::make($req['baru']),
            ]);
        } else {
            return redirect('/gantipassword')->with('status', 'Kata sandi lama anda salah!');
        }
        $log = [
            'log_isi' => Auth::user()->namadepan . ' Mengganti password akun',
            'log_user' => Auth::user()->namadepan . Auth::user()->namabelakang,
            'log_waktu' => date('Y-m-d H:i:s'),
            'id_pabrik' => Auth::user()->pabrik
        ];
        DB::table('logs')->insert($log);

        return redirect('/dashboard')->with('success', 'Password berhasil diganti!');
    }

    public function reset_pass(Request $req)
    {
        if (isNull($req)) {
            return Redirect::back();
        }

        $id = $req['id'];
        // dd($id);
        // $ganti = User::all()->where('pabrik',$id)->where('level',1)->first();
        // dd($ganti);
        $user = User::all()->where("id", $id)->first()->update([
            'password' => Hash::make($req['baru']),
        ]);

        return redirect('/karyawan')->with('success', 'Password berhasil diganti!');
    }

    public function reset_passa(Request $req)
    {

        $id = $req['id'];
        // dd($id);
        // $ganti = User::all()->where('pabrik',$id)->where('level',1)->first();
        // dd($ganti);
        $user = User::all()->where("id", $id)->first()->update([
            'password' => Hash::make($req['baru']),
        ]);

        return redirect('/audit')->with('success', 'Password berhasil diganti!');
    }

    public function reset_passu(Request $req)
    {
        if (isNull($req)) {
            return Redirect::back();
        }
        $id = user::all()->where('pabrik', $req['id'])
            ->where('level', 1)->first()['id'];
        // dd($id);

        $user = User::all()->where("id", $id)->first()->update([
            'password' => Hash::make($req['baru']),
        ]);

        return redirect('/pabrik')->with('success', 'Password berhasil diganti!');
    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        //   dd($query);
        $filterResult = pabrik::select("nama")
            ->where("nama", "LIKE", "%{$query}%")
            ->get();
        $data =  json_decode($filterResult, true);
        //   dd( json_decode($data));
        $res = array();
        foreach ($data as $x => $x_value) {
            $i = 0;
            array_push($res, $x_value['nama']);
            $i++;
            // var_dump($x_value);
        }
        return ($res);
        // $json =response()->json($filterResult);
        // var_dump($json[]);
    }
}
