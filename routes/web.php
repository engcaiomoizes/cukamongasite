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

Route::get('/', function () {
    return view('home');
});

Route::get('/contato', function () {
    return view('contato');
});

Route::get('/controle', [ControleController::class, 'index']);
Route::post('/controle/login', [ControleController::class, 'store']);

Route::get('/{url}', function ($url) {
    return view('detalhes', ['url' => $url]);
});
