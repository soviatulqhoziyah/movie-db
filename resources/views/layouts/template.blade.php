<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie DB</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .navbar{
            background: linear-gradient(to right, #010301, #0451eb, #010301);
        }
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link.disabled {
            color: #d4edda !important;
        }
        footer {
            background: linear-gradient(to right, #010301, #0451eb, #010301);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">Movie DB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('movie/create') ? 'active' : '' }}" href="/movie/create">Input Movie</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link disabled">{{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn nav-link text-white border-0 bg-transparent">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="/login">Login</a>
                        </li>
                    @endauth
                </ul>

                <form class="d-flex" role="search" action="{{ route('admin.movies.list') }}" method="GET">
                    <input class="form-control form-control-sm me-2" type="search" name="q" placeholder="Search..." value="{{ request('q') }}">
                    <button class="btn btn-outline-light btn-sm" type="submit">Search</button>
                </form>
                
            </div>
        </div>
    </nav>

    <main class="container my-4">
        @yield('content')
    </main>

    <footer class="text-white text-center py-3 mt-4">
        <small>&copy; {{ date('Y') }} by Soviatul Qhoziyah</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
