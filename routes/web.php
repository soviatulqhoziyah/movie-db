<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleAdmin;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Tanpa Login)
|--------------------------------------------------------------------------
*/
Route::get('/admin/movies', [MovieController::class, 'indexadmin'])->name('admin.movies.list');
// Halaman homepage menampilkan daftar movie
Route::get('/', [MovieController::class, 'index'])->name('homepage');

// Detail movie untuk user (bukan admin)
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

// Halaman login & proses login
Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Harus Login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

    // Halaman list movie versi admin
 

    // Halaman detail movie (admin)
    Route::get('/movies/{id}/detail', [MovieController::class, 'detail'])->name('detail');

    // Halaman form edit movie (admin)
    Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movie.edit')->middleware('auth', RoleAdmin::class);

    // Halaman form tambah movie baru
    Route::get('/movie/create', [MovieController::class, 'create'])->name('movies.create');

    // Proses simpan movie baru
    Route::post('/movie', [MovieController::class, 'store'])->name('movies.store');

    // Proses update movie
    Route::put('/movies/{id}', [MovieController::class, 'update'])->name('movie.update')->middleware('auth', RoleAdmin::class);;

    // Hapus movie
    Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movie.destroy');

    Route::get('/movie', [MovieController::class, 'index'])->name('movie.index');

});
