@extends('layouts.template')

@section('content')
<div class="container mt-4">
  <h2>Edit Movie</h2>
  <form action="{{ route('movies.update', $movie->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" class="form-control" value="{{ $movie->title }}" required>
    </div>
    <div class="mb-3">
      <label for="category_id" class="form-label">Category ID</label>
      <input type="number" name="category_id" class="form-control" value="{{ $movie->category_id }}" required>
    </div>
    <div class="mb-3">
      <label for="year" class="form-label">Year</label>
      <input type="number" name="year" class="form-control" value="{{ $movie->year }}" required>
    </div>
    <div class="mb-3">
      <label for="actors" class="form-label">Actors</label>
      <input type="text" name="actors" class="form-control" value="{{ $movie->actors }}" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('datamovie') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
