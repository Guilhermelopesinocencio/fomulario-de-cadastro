<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Listar resultados
Route::get('/resultados', [UserController::class, 'index'])->name('listagem.usuarios');

//login
Route::get('/login', [UserController::class, 'authenticate'])->name('Autenticacao.usuarios');

/*
Route::get('/api/user', function() {

})->middleware('auth.basic.one');
*/
