<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class paketController extends Controller
{
    public function index()
    {
        return view('backend.paket.index');
    }

    public function add(){
        return view('backend.paket.add');
    }
}
