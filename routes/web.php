<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [MovieController::class, 'index']);

Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/movie/create', [MovieController::class, 'create'])->name('movies.create');
Route::post('/movie', [MovieController::class, 'store'])->name('movies.store');
Route::get('/', [MovieController::class, 'index'])->name('homepage');