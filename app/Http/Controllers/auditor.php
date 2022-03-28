<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class auditor extends Controller
{
    public function list_pabrik () {
        return view('auditor.listpabrik');
    }

    public function list_dokumen () {
        return view('auditor.listdokumen');
    }

    public function list_request () {
        return view('auditor.request');
    }
}
