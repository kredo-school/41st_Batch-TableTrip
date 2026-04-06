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
    <body class="d-flex flex-column min-vh-100"
      data-modal-id="{{ session('open_modal') }}">
        <header class="border bg-header">
            <div class="container-fluid py-2">
                <div class="d-flex align-items-center justify-content-between gap-3">

                    <!-- Left: Logo -->
                    <a href="/" class="d-flex align-items-center text-decoration-none gap-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="rounded-circle border header-logo">
                        <span class="fw-semibold text-dark">Table<span class="text-orange">Trip</span></span>
                    </a>
                    
                    <!-- Right: Icons + Dropdown -->

                    <div class="d-flex align-items-center gap-3">
                      @guest
                          <a href="{{ route('owner.register') }}" class="btn btn-outline-navy px-3">
                             Register
                          </a>

                            <a href="{{ route('owner.login') }}" class="btn btn-navy px-3">
                                Login
                            </a>
                      @endguest

                      @auth
                      
                        {{-- Admin --}}
                           <a href="/notifications" class="text-dark fs-4" aria-label="notifications">
                             <i class="bi bi-bell"></i>
                            </a>

                             <form method="POST" action="{{ route('owner.logout') }}" class="m-0">
                                 @csrf
                                    <button type="submit" class="btn btn-navy px-3">
                                        Logout
                                    </button>
                              </form>
                        @endauth
                    </div>
                </div>
            </div>
        </header>
        <main class="flex-grow-1">
            @yield('content')
        </main>
       
        <footer class="mt-auto bg-navy">
            <div class="container p-5 ">
                <div class="row g-4 align-items-center">

                    <!-- Left: links -->
                    <div class="col-12 col-md-7">
                        <div class="d-flex flex-wrap gap-5">
                            <a href="/" class="text-white text-decoration-none fs-5">Home</a>
                            <a href="/company" class="text-white text-decoration-none fs-5">Company</a>
                            <a href="/faq" class="text-white text-decoration-none fs-5">FAQ</a>
                            <a href="/privacy-policy" class="text-white text-decoration-none fs-5">Privacy Policy</a>
                            <a href="/contact" class="text-white text-decoration-none fs-5">Contact us</a>
                        </div>

                        <div class="mt-4 footer-border"></div>

                        <div class="text-white-50 small mt-3">
                            © {{ date('Y') }} TableTrip. All rights reserved.
                        </div>
                    </div>

                    <!-- Right: partner CTA -->
                    <div class="col-12 col-md-5 text-md-center text-center">
                        <p class="text-white-50 mb-2">
                            Restaurant owners & partners
                        </p>

                        <a href="{{ route('owner.register') }}" class="btn btn-light rounded-pill px-5 py-2 fw-semibold">
                            Partner with us
                        </a>

                        <p class="text-white-50 mt-3">
                            List your restaurant & sell meal kits
                        </p>
                    </div>

                </div>
            </div>

        </footer>

     @stack('scripts')
    </body>
</html>
