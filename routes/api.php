<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
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

Route::group(['prefix' => 'book', 'middleware' => 'auth.session'], function(){
	Route::get('/', [BookController::class, 'all'])->name('books.all');
	Route::post('/create', [BookController::class, 'store'])->name('books.store');
	Route::put('/edit/{id}', [BookController::class, 'update'])->where(['id' => '[0-9]+'])->name('books.update');
	Route::delete('/{id}', [BookController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('books.destroy');
});