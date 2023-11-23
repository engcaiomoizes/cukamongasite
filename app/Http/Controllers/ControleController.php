<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Controle;
use App\Models\Filmes;
use App\Models\Generos;
use App\Models\FilmesHasGeneros;
use App\Models\FilmesHasPessoas;
use App\Models\Links;
use App\Models\Pessoas;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ControleController extends Controller
{
    public function index() {
        return view('admin.controle');
    }

    public function dashboard($url) {
        $data = array();
        if (Session::has('loginId')) {
            $data = Controle::where('id', '=', Session::get('loginId'))->first();
        }

        $users = Controle::all();
        $filmes = DB::table('filmes')->where('serie', false)->get();
        $series = DB::table('filmes')->where('serie', true)->get();
        $generos = Generos::all();
        $pessoas = Pessoas::all();

        return view(
            'admin.dashboard',
            [
                'url' => $url,
                'users' => $users,
                'filmes' => $filmes,
                'series' => $series,
                'generos' => $generos,
                'pessoas' => $pessoas,
                'data' => $data
            ]
        );
    }

    public function edit_filme($id) {
        if (!isset($id)) {
            return redirect()->back();
        }

        $data = array();
        if (Session::has('loginId')) {
            $data = Controle::where('id', '=', Session::get('loginId'))->first();
        }

        $filme = Filmes::where('id', '=', $id)->first();

        if ($filme) {
            return view(
                'admin.dashboard',
                [
                    'url' => 'edit-filme',
                    'id' => $id,
                    'data' => $data,
                    'filme' => $filme,
                ]
                );
        } else {
            return redirect('/controle/filmes')->with('fail', 'Filme não encontrado!');
        }
    }

    public function form_filme_genero($id) {
        if (!isset($id)) {
            return redirect()->back();
        }

        $data = array();
        if (Session::has('loginId')) {
            $data = Controle::where('id', '=', Session::get('loginId'))->first();
        }

        $generos = Generos::all();
        $filme = DB::table('filmes')->where('id', $id)->first();

        if ($filme) {
            return view(
                'admin.dashboard',
                [
                    'url' => 'form-filme-genero',
                    'id' => $id,
                    'data' => $data,
                    'generos' => $generos,
                    'filme' => $filme,
                ]
            );
        } else {
            return redirect('/controle/filmes')->with('fail', 'Filme não encontrado.');
        }
    }

    private function gerarURL(string $str) {
        $urlamigavel = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/Ç/"),explode(" ","a A e E i I o O u U n N c C"),$str);
        $urlamigavel = preg_replace(array("/(ª)/"), explode(" ", "a"), $urlamigavel);
        $urlamigavel = preg_replace('/[-!@#$%¨&*><:;.,°º\)\}\]]+/' , '' , trim($urlamigavel));
        $urlamigavel = preg_replace('/[ \/\(\{\[]+/' , '-' , trim($urlamigavel));
        $urlamigavel = strtolower($urlamigavel);
        return $urlamigavel;
    }

    public function storeFilme(Request $request) {
        $filme = new Filmes;

        $filme->titulo = $request->titulo;
        $filme->tags = $request->tags;
        $filme->titulo_original = $request->titulo_original;
        $filme->titulo_traduzido = $request->titulo_traduzido;
        $filme->lancamento = $request->lancamento;
        $filme->imdb = $request->imdb;
        $filme->rotten_tomatoes = $request->rotten_tomatoes;
        $filme->formato = $request->formato;
        $filme->qualidade = $request->qualidade;
        $filme->idioma = $request->idioma;
        $filme->legenda = $request->legenda;
        $filme->tamanho = $request->tamanho;
        $filme->duracao = $request->duracao;
        $filme->qualidade_video = $request->qualidade_video;
        $filme->qualidade_audio = $request->qualidade_audio;
        $filme->servidor = $request->servidor;
        $filme->sinopse = $request->sinopse;
        $filme->resumo = $request->resumo;
        $filme->observacoes = $request->observacoes;
        $filme->serie = $request->serie;

        $urlamigavel = $this->gerarURL($request->titulo);
        $filme->urlamigavel = $urlamigavel;

        // Upload Foto
        if ($request->hasfile('foto') && $request->file('foto')->isValid()) {
            $extension = $request->foto->extension();
            $imageName = $urlamigavel . "." . $extension;
            $request->foto->move(public_path('img'), $imageName);
            $filme->foto = $imageName;

            $filme->save();

            if ($request->serie == 0)
                return redirect('/controle/filmes')->with('success', 'Filme cadastrado com sucesso!');
            else
                return redirect('/controle/series')->with('success', 'Série cadastrada com sucesso!');
        } else {
            if ($request->serie == 0)
                return redirect('/controle/form-filme')->with('fail', 'Importe uma imagem para o filme.');
            else
                return redirect('/controle/form-serie')->with('fail', 'Importe uma imagem para a série.');
        }
    }

    public function storeGenero(Request $request) {
        $genero = new Generos;

        $genero->titulo = $request->titulo;
        $genero->urlamigavel = $this->gerarURL($request->titulo);

        try {
            $genero->save();
            return redirect('/controle/generos')->with('success', 'Gênero cadastrado com sucesso!');
        } catch (Exception $e) {
            return redirect('/controle/generos')->with('fail', $e->getMessage());
        }
    }

    public function storeUsuario(Request $request) {
        $usuario = new Controle;

        $usuario->login = $request->login;
        $usuario->senha = $request->senha;
        $usuario->nome = $request->nome;

        if ($request->hasfile('foto') && $request->file('foto')->isValid()) {
            $extension = $request->foto->extension();
            $imageName = $this->gerarURL($request->login) . "." . $extension;
            $request->foto->move(public_path('img/users'), $imageName);
            $usuario->foto = $imageName;
        }

        try {
            $usuario->save();
            return redirect('/controle/usuarios')->with('success', 'Usuário cadastrado com sucesso!');
        } catch (Exception $e) {
            return redirect('/controle/usuarios')->with('fail', $e->getMessage());
        }
    }

    public function storeFilmeGenero(Request $request) {
        $filme_genero = new FilmesHasGeneros;

        $verifica = DB::table('filmes')->where('id', '=', $request->filme)->where('serie', '=', 0)->first();

        $filme_genero->filme_id = $request->filme;
        $filme_genero->genero_id = $request->genero;

        try {
            $filme_genero->save();
            if ($verifica)
                return redirect('/controle/filmes')->with('success', 'Gênero cadastrado com sucesso!');
            else
                return redirect('/controle/series')->with('success', 'Gênero cadastrado com sucesso!');
        } catch (Exception $e) {
            if ($verifica)
                return redirect('/controle/filmes')->with('fail', $e->getMessage());
            else
                return redirect('/controle/series')->with('fail', $e->getMessage());
        }
    }

    public function storeFilmePessoa(Request $request) {
        $filme_pessoa = new FilmesHasPessoas;

        $verifica = DB::table('filmes')->where('id', '=', $request->filme)->where('serie', '=', 0)->first();

        $filme_pessoa->filme_id = $request->filme;
        $filme_pessoa->pessoa_id = $request->pessoa;
        $filme_pessoa->personagem = $request->personagem;
        $filme_pessoa->funcao = $request->funcao;

        try {
            $filme_pessoa->save();
            if ($verifica)
                return redirect('/controle/filmes')->with('success', 'Pessoa cadastrada com sucesso!');
            else
                return redirect('/controle/series')->with('success', 'Pessoa cadastrada com sucesso!');
        } catch (Exception $e) {
            if ($verifica)
                return redirect('/controle/filmes')->with('fail', $e->getMessage());
            else
                return redirect('/controle/series')->with('fail', $e->getMessage());
        }
    }

    public function login(Request $request) {
        $request->validate([
            'login' => 'required|string',
            'senha' => 'required|min:5|max:25'
        ]);
        $user = Controle::where('login', '=', $request->login)->first();
        if ($user) {
            //if (Hash::check($request->senha, $user->senha)) {
            if ($request->senha == $user->senha) {
                $request->session()->put('loginId', $user->id);
                return redirect('/controle/dashboard');
            } else {
                return back()->with('fail', 'A senha está incorreta.');
            }
        } else {
            return back()->with('fail', 'Este usuário não está cadastrado.');
        }
    }

    public function logout() {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('controle');
        }
    }

    public function getFilme(Request $request) {
        if (!$request->id)
            return null;
        
        $filme = DB::table('filmes')->where('id', '=', $request->id)->first();

        return $filme;
    }

    public function getLinks(Request $request) {
        if (!$request->id)
            return null;
        
        $links = DB::table('links')->where('filme_id', '=', $request->id)->get();

        return $links;
    }

    public function getComments(Request $request) {
        if (!$request->id)
            return null;
        
        $comments = DB::table('comentarios')->join('users', 'comentarios.user_id', '=', 'users.id')
            ->where('comentarios.filme_id', '=', $request->id)
            ->select('users.name', 'users.avatar', 'comentarios.comentario', 'comentarios.created_at')
            ->get();

        return $comments;
    }

    public function getFilmePessoas(Request $request) {
        if (!$request->id)
            return null;
        
        $pessoas = DB::table('pessoas')->join('filmes_has_pessoas', 'pessoas.id', '=', 'filmes_has_pessoas.pessoa_id')
            ->where('filmes_has_pessoas.filme_id', '=', $request->id)
            ->select('pessoas.nome', 'pessoas.foto', 'filmes_has_pessoas.personagem', 'filmes_has_pessoas.funcao')
            ->get();
        
        return $pessoas;
    }

    public function storeLink(Request $request) {
        $link = new Links;

        $verifica = DB::table('filmes')->where('id', '=', $request->hddFilme)->where('serie', '=', 0)->first();

        $link->filme_id = $request->hddFilme;
        $link->idioma = $request->idioma;
        $link->resolucao = $request->resolucao;
        $link->formato = $request->formato;
        $link->qualidade = $request->qualidade;
        $link->tamanho = $request->tamanho;
        $link->descricao = $request->descricao;
        $link->link = $request->link;
        $link->link_legenda = $request->link_legenda;

        try {
            $link->save();
            if ($verifica)
                return redirect('/controle/filmes')->with('success', 'Link cadastrado com sucesso!');
            else
                return redirect('/controle/series')->with('success', 'Link cadastrado com sucesso!');
        } catch (Exception $e) {
            if ($verifica)
                return redirect('/controle/filmes')->with('fail', $e->getMessage());
            else
                return redirect('/controle/series')->with('fail', $e->getMessage());
        }
    }

    public function storePessoa(Request $request) {
        $pessoa = new Pessoas;

        $pessoa->nome = $request->nome;
        $urlamigavel = $this->gerarURL($request->nome);
        $pessoa->urlamigavel = $urlamigavel;

        if ($request->hasfile('foto') && $request->file('foto')->isValid()) {
            $extension = $request->foto->extension();
            $imageName = $urlamigavel . "." . $extension;
            $request->foto->move(public_path('img/pessoas'), $imageName);
            $pessoa->foto = $imageName;
        } else {
            $pessoa->foto = "pessoa.png";
        }

        try {
            $pessoa->save();

            return redirect('/controle/pessoas')->with('success', 'Pessoa cadastrada com sucesso!');
        } catch (Exception $e) {
            return redirect('/controle/pessoas')->with('fail', $e->getMessage());
        }
    }

    public function deleteLink(Request $request) {
        $verifica = DB::table('filmes')->where('id', '=', $request->id)->where('serie', '=', 0)->first();
        try {
            $res = Links::where('id', '=', $request->id)->delete();
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function deleteFilme(Request $request) {
        $foto = DB::table('filmes')->select('foto')->where('id', '=', $request->id)->first();
        $verifica = DB::table('filmes')->where('id', '=', $request->id)->where('serie', '=', 0)->first();
        try {
            $res = Filmes::where('id', '=', $request->id)->delete();
            if (File::exists('img/' . $foto->foto)) {
                File::delete('img/' . $foto->foto);
            }
            if ($verifica)
                return redirect('/controle/filmes')->with('success', 'Filme deletado com sucesso!');
            else
                return redirect('/controle/series')->with('success', 'Série deletada com sucesso!');
        } catch (Exception $e) {
            if ($verifica)
                return redirect('/controle/filmes')->with('fail', $e->getMessage());
            else
                return redirect('/controle/series')->with('fail', $e->getMessage());
        }
    }

    public function updateFilme(Request $request) {
        $filme = Filmes::find($request->id);

        $filme->titulo = $request->titulo;
        $filme->tags = $request->tags;
        $filme->titulo_original = $request->titulo_original;
        $filme->titulo_traduzido = $request->titulo_traduzido;
        $filme->lancamento = $request->lancamento;
        $filme->imdb = $request->imdb;
        $filme->rotten_tomatoes = $request->rotten_tomatoes;
        $filme->formato = $request->formato;
        $filme->qualidade = $request->qualidade;
        $filme->idioma = $request->idioma;
        $filme->legenda = $request->legenda;
        $filme->tamanho = $request->tamanho;
        $filme->duracao = $request->duracao;
        $filme->qualidade_video = $request->qualidade_video;
        $filme->qualidade_audio = $request->qualidade_audio;
        $filme->servidor = $request->servidor;
        $filme->sinopse = $request->sinopse;
        $filme->resumo = $request->resumo;
        $filme->observacoes = $request->observacoes;
        $filme->serie = $request->serie;

        $urlamigavel = $this->gerarURL($request->titulo);
        $filme->urlamigavel = $urlamigavel;

        try {
            if ($request->hasfile('foto') && $request->file('foto')->isValid()) {
                if (File::exists('img/' . $filme->hddOldFoto)) {
                    File::delete('img/' . $filme->hddOldFoto);
                }

                $extension = $request->foto->extension();
                $imageName = $urlamigavel . "." . $extension;
                $request->foto->move(public_path('img'), $imageName);
                $filme->foto = $imageName;

                $filme->save();

                if ($filme->serie == 0)
                    return redirect('/controle/filmes')->with('success', 'Filme editado com sucesso!');
                else
                    return redirect('/controle/series')->with('success', 'Série editada com sucesso!');
            } else {
                if ($filme->serie == 0)
                    return redirect('/controle/filmes')->with('fail', 'Falha ao fazer o upload da foto.');
                else
                    return redirect('/controle/series')->with('fail', 'Falha ao fazer o upload da foto.');
            }
        } catch (Exception $e) {
            if ($filme->serie == 0)
                return redirect('/controle/filmes')->with('fail', $e->getMessage());
            else
                return redirect('/controle/series')->with('fail', $e->getMessage());
        }
    }
}
