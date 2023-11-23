<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\ControleController;
use App\Http\Controllers\DetalhesController;
use App\Http\Controllers\JogosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResultadosController;

Route::get('/', [ResultadosController::class, 'index']);

Route::post('/pesquisar', [ResultadosController::class, 'pesquisar']);

Route::get('/contato', function () {
    return view('contato');
});

Route::get('/controle', [ControleController::class, 'index'])->middleware('alreadyLoggedIn');
Route::post('/controle/login', [ControleController::class, 'login'])->name('controle-login');
Route::get('/controle/logout', [ControleController::class, 'logout']);

Route::get('/filmes', [ResultadosController::class, 'filmes']);
Route::get('/series', [ResultadosController::class, 'series']);
Route::get('/jogos', [ResultadosController::class, 'jogos']);

Route::get('/controle/get-filme', [ControleController::class, 'getFilme'])->middleware('controle');
Route::get('/controle/get-links', [ControleController::class, 'getLinks'])->middleware('controle');
Route::get('/controle/get-comments', [ControleController::class, 'getComments'])->middleware('controle');
Route::get('/controle/get-pessoas', [ControleController::class, 'getFilmePessoas'])->middleware('controle');

Route::get('/controle/{url}', [ControleController::class, 'dashboard'])->middleware('controle');
Route::get('/controle/form-filme-genero/{id}', [ControleController::class, 'form_filme_genero'])->middleware('controle');
Route::get('/controle/edit-filme/{id}', [ControleController::class, 'edit_filme'])->middleware('controle');

Route::post('/controle/store-filme', [ControleController::class, 'storeFilme'])->middleware('controle');
Route::post('/controle/store-genero', [ControleController::class, 'storeGenero'])->middleware('controle');
Route::post('/controle/store-pessoa', [ControleController::class, 'storePessoa'])->middleware('controle');
Route::post('/controle/store-usuario', [ControleController::class, 'storeUsuario'])->middleware('controle');
Route::post('/controle/store-filme-genero', [ControleController::class, 'storeFilmeGenero'])->middleware('controle');
Route::post('/controle/store-link', [ControleController::class, 'storeLink'])->middleware('controle');
Route::post('/controle/store-filme-pessoa', [ControleController::class, 'storeFilmePessoa'])->middleware('controle');
Route::post('/controle/excluir-link', [ControleController::class, 'deleteLink'])->middleware('controle');
Route::post('/controle/excluir-filme', [ControleController::class, 'deleteFilme'])->middleware('controle');
Route::post('/controle/update-filme', [ControleController::class, 'updateFilme'])->middleware('controle');

Route::post('/enviar-comentario', [DetalhesController::class, 'comentar']);
Route::post('/enviar-like', [DetalhesController::class, 'like']);
Route::post('/enviar-dislike', [DetalhesController::class, 'dislike']);

Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');
Route::get('logout', [LoginController::class, 'logout']);
Route::get('/testar', [LoginController::class, 'testar']);

Route::get('/game/{url}', [JogosController::class, 'show']);
Route::get('/{url}', [DetalhesController::class, 'show']);
