<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [MovieController::class, 'index']);

Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/movie/create', [MovieController::class,'create'])->middleware('auth');
Route::post('/movie', [MovieController::class, 'store'])->name('movies.store');
Route::get('/', [MovieController::class, 'index'])->name('homepage');

Route::get('/login', [AuthController::class,'formLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');