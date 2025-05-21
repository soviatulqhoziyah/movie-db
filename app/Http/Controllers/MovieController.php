<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    // Tampilkan daftar movie dengan pagination
    public function index()
    {
        $movies = Movie::with('category')->paginate(6);

        return view('homepage', [
            'movies'      => $movies,
            'currentPage' => $movies->currentPage(),
            'lastPage'    => $movies->lastPage(),
        ]);
    }

    // Form untuk buat movie baru
    public function create()
    {
        $categories = Category::all();
        return view('layouts.movie_form', compact('categories'));
    }

    // Simpan movie baru ke database
    public function store(Request $request)
    {
        // validasi input
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'synopsis'    => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'year'        => 'required|integer|min:1900|max:'.date('Y'),
            'actors'      => 'required|string',
            'cover_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload file cover_image ke storage/app/public/cover_images
        $path = $request->file('cover_image')->store('cover_images', 'public');
        $data['cover_image'] = '/storage/'.$path;

        // generate slug dari title
        $data['slug'] = Str::slug($data['title']);

        // simpan ke table movies
        Movie::create($data);

        return redirect()->route('homepage')
                         ->with('success', 'Movie berhasil disimpan!');
    }

    // Detail satu movie
    public function show($id)
    {
        $movie = Movie::with('category')->findOrFail($id);
        return view('layouts.movie_detail', compact('movie'));
    }
}