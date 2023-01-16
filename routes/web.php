<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix' => 'book', 'middleware' => 'auth'], function(){
	Route::get('/', [BookController::class, 'index'])->name('books.list');
	Route::get('/create', [BookController::class, 'create'])->name('books.create');
	Route::get('/edit/{id}', [BookController::class, 'edit'])->where(['id' => '[0-9]+'])->name('books.edit');
});


Route::post('/login', [UserController::class, 'login'])->name('login');


