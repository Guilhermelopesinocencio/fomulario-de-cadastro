<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', [EventController::class, 'Index']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome/{id}', function ($id){
    return view('product', ['id' => $id]);
});

Route::get('/users', [UserController::class, 'index']);

Route::get('/login', function () {return view('login'); })->name('login');

Route::get('/cadastre-se', function () {return view('cadastre-se');})->name('cadastre-se');

