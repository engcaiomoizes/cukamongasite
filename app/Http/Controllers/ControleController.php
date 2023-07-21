<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Controle;

class ControleController extends Controller
{
    public function index() {
        $users = Controle::all();

        return view('controle', ['users' => $users]);
    }

    public function store(Request $request) {
        $user = new Controle;

        $user->login = $request->login;
        $user->senha = $request->senha;
        $user->nome = "Caio Moizés";

        $user->save();

        return redirect('/controle')->with('msg', 'Usuário cadastrado com sucesso!');
    }
}
