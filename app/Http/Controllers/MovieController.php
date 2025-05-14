<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('category')->paginate(6); // 6 film per halaman

        return view('homepage', [
            'movies' => $movies,
            'currentPage' => $movies->currentPage(),
            'lastPage' => $movies->lastPage(),
        ]);
    }
    public function show($id)
    {
    $movie = Movie::with('category')->findOrFail($id);
    return view('layouts.movie_detail', compact('movie'));
    }



}