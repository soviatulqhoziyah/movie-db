@extends('layouts.template')

@section('content')
<h2 class="mb-4">Detail Movie</h2>

<div class="card mb-4">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ $movie->cover_image }}" class="img-fluid rounded-start" alt="{{ $movie->title }}" style="object-fit: cover; width: 100%; height: 100%;">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h3 class="card-title">{{ $movie->title }}</h3>
                <p class="card-text">{{ $movie->synopsis }}</p>
                <p class="text-muted">Year: {{ $movie->year }}</p>
                <p class="text-muted">Category: {{ $movie->category->category_name ?? '-' }}</p>
                <p class="text-muted">Aktor: {{ $movie->actors }}</p>


                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection