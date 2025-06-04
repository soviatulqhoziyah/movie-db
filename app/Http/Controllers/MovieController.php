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
    public function indexadmin()
    {
        $movies = Movie::with('category')->paginate(6);

        return view('admin.data_movie', [
            'movies'      => $movies,
            'currentPage' => $movies->currentPage(),
            'lastPage'    => $movies->lastPage(),
        ]);
    }

    // Form untuk buat movie baru
    public function create()
{
    $categories = \App\Models\Category::take(5)->get(); // hanya ambil 5 kategori
    return view('movie_form', compact('categories'));
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
        return view('movie_detail', compact('movie'));
    }

    // public function data_movie()
    // {
    // $movies =Movie::orderBy('created_at', 'desc')->paginate(10);
    // return view('admin.data_movie', compact('movies'));
    // }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $categories = Category::all(); // untuk dropdown kategori
        return view('admin.movie_edit', compact('movie', 'categories'));
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        // Hapus cover image jika ada
        if ($movie->cover_image && file_exists(public_path('storage/' . $movie->cover_image))) {
            unlink(public_path('storage/' . $movie->cover_image));
        }

        $movie->delete();

        return redirect()->route('admin.movies.list')->with('success', 'Data movie berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1990|max:' . date('Y'),
            'actors' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $movie = Movie::findOrFail($id);

        // Update fields
        $movie->title = $request->title;
        $movie->synopsis = $request->synopsis;
        $movie->category_id = $request->category_id;
        $movie->year = $request->year;
        $movie->actors = $request->actors;

        //image

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Pindahkan file ke folder 'covers' supaya sama dengan method store
            $file->move(public_path('covers'), $filename);

            // Hapus gambar lama jika ada
            if ($movie->cover_image && file_exists(public_path($movie->cover_image))) {
                unlink(public_path($movie->cover_image));
            }

            // Simpan path relatif lengkap
            $movie->cover_image = 'covers/' . $filename;
        }

        $movie->save();

        return redirect()->route('admin.movies.list')->with('success', 'Movie berhasil diupdate.');
    }
    public function detail($id)
    {
        $movie = Movie::find($id);
        return view('admin.detail_movie', compact('movie'));
    }
}