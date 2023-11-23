<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JogosController extends Controller
{
    public function show($url) {
        return view('jogosInfo');
    }
}
