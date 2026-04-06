<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TableTrip') }} | @yield('title')</title>

         <!--Fontawesome-->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

        <!-- Bootstrap JS（必要な場合） -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
        <header class="border" style="background-color: #f2f2f2;">
            <div class="container-fluid py-2">
                <div class="d-flex align-items-center justify-content-between gap-3">

                    <!-- Left: Logo -->
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none gap-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="44" height="44" class="rounded-circle border">
                        <span class="fw-semibold text-dark">Table<span style="color: #d96b52;">Trip</span></span>
                    </a>

                    <!-- Center: Search (like your image) -->
                    <form class="flex-grow-1 d-flex justify-content-center align-items-center" role="search" action="/restaurants" method="GET">
                        <input type="text" name="q" placeholder="search" aria-label="search" class="form-control rounded-pill" style="max-width:520px; height:38px;">
                        <button type="submit" class="btn p-0 ms-3" aria-label="search button">
                            <i class="bi bi-search fs-5 text-dark"></i>
                        </button>
                    </form>

                        @auth
                        @if (Auth::user()->is_admin )  
                        {{-- Admin --}}
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                    <button type="submit" class="btn btn-outline-navy rounded-pill px-3">
                                        Logout
                                    </button>
                            </form>


      
                        @endif
                        @endauth
                </div>
            </div>
        </header>
    </body>
</html>

