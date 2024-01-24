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

//Cadastrar usuarios
Route::post('/cadastra-usuario', [UserController::class, 'formcontroller'])->name('cadastro');
// Listar resultados
Route::get('/resultados', [UserController::class, 'printtela'])->name('listagem.usuarios');
//Autenticação
Route::get('/authenticate', [UserController::class, 'authenticate'])->name('Autenticacao.usuarios');
//login
Route::get('/login', [UserController::class, 'login'])->name('login.usuarios');

