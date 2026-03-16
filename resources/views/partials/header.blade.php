<header class="border" style="background-color: #f2f2f2;">
            <div class="container-fluid py-2">
                <div class="d-flex align-items-center justify-content-between gap-3">

                    <!-- Left: Logo -->
                    <a href="/" class="d-flex align-items-center text-decoration-none gap-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="44" height="44" class="rounded-circle border">
                        <span class="fw-semibold text-dark">Table<span style="color: #d96b52;">Trip</span></span>
                    </a>

                    <!-- Center: Search (like your image) -->
                    <form class="flex-grow-1 d-flex justify-content-center align-items-center" role="search" action="/restaurants" method="GET">
                        <input type="text" name="q" placeholder="search" aria-label="search" class="form-control rounded-pill" style="max-width:520px; height:38px;">
                    </form>

                    <!-- Right: Icons + Dropdown -->

                    <div class="d-flex align-items-center gap-3">
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-outline-dark rounded-pill px-3" style="color:#243340; border-color:#243340;" >
                            Register
                            </a>

                            <a href="{{ route('login') }}" class="btn btn-dark rounded-pill px-3" style="background-color:#243340;">
                            Login
                            </a>
                        @endguest

                        @auth

                        @if (!request()->is('admin*'))

                        @else

                        {{-- 後でルート変更<form method="POST" action="{{ route('logout') }}">--}}
                        <form method="POST" action="#" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark rounded-pill px-3">
                        Logout
                        </button>
                        </form>
                        
                        @endif

                        @endauth
                    </div>
                </div>
            </div>
        </header>