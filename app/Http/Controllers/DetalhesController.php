<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Filmes;
use App\Models\Generos;
use App\Models\Comentarios;
use App\Models\Likes;
use Illuminate\Support\Facades\DB;
use Exception;

class DetalhesController extends Controller
{
    public function show($url) {
        $filme = DB::table('filmes')->where('urlamigavel', $url)->first();

        if ($filme) {
            $links = DB::table('links')->where('filme_id', $filme->id)->get();
            $generos = DB::table('filmes_has_generos')
                ->join('generos', 'filmes_has_generos.genero_id', '=', 'generos.id')
                ->where('filmes_has_generos.filme_id', '=', $filme->id)
                ->select('generos.titulo', 'generos.urlamigavel')->get();
            $pessoas = DB::table('pessoas')->join('filmes_has_pessoas', 'pessoas.id', '=', 'filmes_has_pessoas.pessoa_id')
                ->where('filmes_has_pessoas.filme_id', '=', $filme->id)
                ->select('pessoas.nome', 'pessoas.urlamigavel', 'pessoas.foto', 'filmes_has_pessoas.personagem', 'filmes_has_pessoas.funcao')
                ->get();
            $comentarios = DB::table('comentarios')
                ->join('users', 'comentarios.user_id', '=', 'users.id')
                ->join('likes', 'comentarios.id', '=', 'likes.comentario_id')
                ->where('comentarios.filme_id', $filme->id)
                ->selectRaw('users.name, users.avatar, comentarios.id, comentarios.user_id,
                    comentarios.comentario, comentarios.created_at, sum(case when likes.like = 1 then 1 else 0 end) as likes,
                    sum(case when likes.like = 0 then 1 else 0 end) as dislikes')
                ->groupBy('comentarios.id')
                ->get();
            $tags = explode(',', $filme->tags);
            $relacionados = array();
            foreach ($tags as $tag) {
                $result = DB::table('filmes')->where('tags', 'LIKE', '%' . $tag . '%')
                    ->where('id', '!=', $filme->id)
                    ->select('id', 'titulo', 'urlamigavel', 'foto', 'lancamento', 'tags')->get();
                foreach ($result as $rel) {
                    if (!in_array($rel, $relacionados)) {
                        array_push($relacionados, $rel);
                    }
                }
            }

            return view('detalhes', [
                'filme' => $filme,
                'links' => $links,
                'generos' => $generos,
                'pessoas' => $pessoas,
                'comentarios' => $comentarios,
                'relacionados' => $relacionados
            ]);
        } else {
            return view('welcome');
        }
    }

    public function comentar(Request $request) {
        $comentario = new Comentarios;

        $comentario->filme_id = $request->hddIdFilme;
        $comentario->user_id = $request->hddIdUser;
        $comentario->comentario = $request->comentario;

        try {
            $comentario->save();

            return redirect()->back()->with('success', 'Comentário postado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    public function like(Request $request) {
        $like = new Likes;

        $like->comentario_id = $request->comentario;
        $like->user_id = $request->user;

        try {
            $like->save();

            return "OK";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
