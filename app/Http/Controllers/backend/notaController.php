<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class notaController extends Controller
{
    public function notabelumBayar($id){
      return view('admin.nota.index');
    }
}
