<?php

namespace Database\Seeders;

use App\Models\pabrik;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $hasil = [
            'nama' => 'Semeloto',
            'alamat' => 'Belum',
            'no_hp' => 'Belum',
            'logo' => 'logo.png',
            'struktur' => 'logo.png'
        ];
        pabrik::insert($hasil);

        $user = new User;
        $user->nama = ucwords(strtolower("super"));
        $user->namadepan = "super";
        $user->namabelakang = "admin";
        $user->level = 0;
        $user->pabrik = 0;
        $user->password = bcrypt("@Semeloto123");
        $user->save();

        $user = new User;
        $user->nama = ucwords(strtolower("semeloto"));
        $user->namadepan = "semeloto";
        $user->namabelakang = "indonesia";
        $user->level = 1;
        $user->pabrik = 1;
        $user->password = bcrypt("@Semeloto123");
        $user->save();

        $user = new User;
        $user->nama = ucwords(strtolower("pjtsemeloto"));
        $user->namadepan = "pjt";
        $user->namabelakang = "semeloto";
        $user->level = 2;
        $user->pabrik = 1;
        $user->password = bcrypt("@Semeloto123");
        $user->save();

        $user = new User;
        $user->nama = ucwords(strtolower("pegawaisemeloto"));
        $user->namadepan = "pegawai";
        $user->namabelakang = "semeloto";
        $user->level = 3;
        $user->pabrik = 1;
        $user->password = bcrypt("@Semeloto123");
        $user->save();

        $user = new User;
        $user->nama = ucwords(strtolower("auditor"));
        $user->namadepan = "pegawai";
        $user->namabelakang = "audit";
        $user->level = 4;
        $user->pabrik = 0;
        $user->password = bcrypt("@Semeloto123");
        $user->save();
    }
}
