<?php

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
    return view('welcome');
});

// Auth::routes();
Auth::routes(['register' => false]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// user
Route::get('/user', [App\Http\Controllers\ExternalUserController::class, 'index']);
Route::get('/user/create', [App\Http\Controllers\ExternalUserController::class, 'create']);
Route::post('/user/store', [App\Http\Controllers\ExternalUserController::class, 'store']);
Route::get('/user/edit/{id}', [App\Http\Controllers\ExternalUserController::class, 'edit']);
Route::post('/user/update/{id}', [App\Http\Controllers\ExternalUserController::class, 'update']);
Route::get('/user/delete/{id}', [App\Http\Controllers\ExternalUserController::class, 'destroy']);
// end user
