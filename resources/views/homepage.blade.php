@extends('layouts.template')

@section('content')

<style>
    .card-text {
      display: -webkit-box;
      -webkit-line-clamp: 2; /* Jumlah baris */
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .card{
        border-radius: 10px
    }
    </style>

<h1 style="font-size : 45px">Popular Movies</h1>

<div class="row row-cols-1 row-cols-md-2 gx-4 gy-4">
    @foreach ($movies as $movie)
    <div class="col">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    @php
                        $cover = $movie->cover_image;
                    @endphp
                    @if (Str::startsWith($cover, ['http://', 'https://']))
                        <img src="{{ $cover }}" alt="{{ $movie->title }}" class="img-fluid" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                    @else
                        <img src="{{ asset('storage/' . $cover) }}" alt="{{ $movie->title }}" class="img-fluid" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                    @endif
                    {{-- <img src="{{ asset('storage/' . $movie->cover_image) }}" class="img-fluid " style="border-top-left-radius: 10px; border-bottom-left-radius: 10px" alt="..."
                    > --}}
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie['title'] }}</h5>
                        <p class="card-text">{{$movie['synopsis'] }} {{-- Str::words($movie->$synopsis,20)  --}}
                        </p>
                        <p class="card-text">Year : {{$movie['year'] }}</p>
                        <a href="/movie/{{ $movie->id }}/{{ $movie->slug }}" class="btn btn-success">Lihat Selanjutnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="d-flex justify-content-end mt-4">
    {{ $movies->links() }}
</div>
@endsection