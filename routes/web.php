<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',  [MovieController::class, 'index'] );

Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');