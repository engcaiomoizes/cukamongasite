<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Filmes;
use Illuminate\Support\Facades\DB;

class ResultadosController extends Controller
{
    public function index() {
        if (app('request')->input('s')) {
            $resultados = DB::table('filmes')
                ->where('titulo', 'LIKE', '%' . app('request')->input('s') . '%')
                ->orWhere('tags', 'LIKE', '%' . app('request')->input('s') . '%')
                ->get();
            return view('home', ['resultados' => $resultados]);
        } else {
            return view('home');
        }
    }

    public function pesquisar(Request $request) {
        return redirect('/?s=' . $request->pesquisa);
    }

    public function filmes() {
        $filmes = DB::table('filmes')->where('serie', '=', 0)->get();

        return view('resultados', ['main_title' => 'Filmes', 'filmes' => $filmes]);
    }

    public function series() {
        $series = DB::table('filmes')->where('serie', '=', 1)->get();

        return view('resultados', ['main_title' => 'Séries', 'filmes' => $series]);
    }

    public function jogos() {
        $jogos = DB::table('jogos')->get();

        return view('resultados', ['main_title' => 'Jogos', 'filmes' => $jogos]);
    }
}
