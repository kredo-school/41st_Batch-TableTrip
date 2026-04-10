@extends('layouts.owner')

@section('title','Page Management')

@section('content')
<div class="m-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent mb-4">Page Management</h1>
            @include('restaurant-owners.page-management.tabs')

             {{-- Hero --}}
            <section class="container-fluid p-0">
                
                    <img src="{{ asset('images/no-image.png') }}" class="img-fluid rounded hero-image w-100" style="max-height:420px; object-fit:cover;" alt="hero">
               
            </section>

            <div class="container py-4">

                {{-- Title + Heart --}}
                <div class="d-flex align-items-center justify-content-between">
                <h1 class="mb-0">{{ $restaurant->restaurant_name }}</h1>
                <button class="btn p-0 border-0 bg-transparent" aria-label="favorite">
                    <i class="fa-regular fa-heart fs-3"></i>
                </button>
                </div>

                {{-- Gallery 2 photos --}}
                <section class="row g-3 mt-2">
                   
                <div class="col-12 col-md-6">
                     <img src="{{ asset('images/no-image.png') }}" class="img-fluid rounded sub-image w-100">
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('images/no-image.png') }}" class="img-fluid rounded sub-image w-100">
                </div>
                </section>

                {{-- Description --}}
                <section class="my-5">
                {{-- <h5 class="fw-bold">Authentic Japanese Flavors in the Heart of the City</h5> --}}
                <p class="mb-0 fs-5">
                    {{ $restaurant->description }}
                </p>
                </section>

                {{-- Menu --}}
                <section class="mt-4">
                <h2 class="text-center my-5 text-underline-accent">Menu</h2>

               {{-- Bootstrap carousel --}}
                    <div id="menuCarousel" class="carousel slide" data-bs-ride="false">
                        
                        <div class="carousel-inner">
                            @foreach ($menus->chunk(4) as $chunkIndex => $menuChunk)
                                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                    <div class="row g-3 justify-content-center">
                                        @foreach ($menuChunk as $menu)
                                            <div class="col-6 col-md-3">
                                                <div class="card border-0 bg-transparent">
                                                    <img src="{{ asset('storage/' . $menu->image) }}"
                                                        class="card-img-top rounded"
                                                        style="height: 140px; object-fit: cover;"
                                                        alt="{{ $menu->name }}">
                                                    <div class="card-body px-0 pt-2">
                                                        <div class="small fw-semibold">{{ $menu->name }}</div>
                                                        <div class="small text-muted">${{ $menu->price }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($menus->count() > 4)
                            <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                </section>

            

                {{-- Basic Info + Reservation --}}
                <section class="row g-4 mt-4">
                <div class="col-12 col-lg-6 p-3">
                    <h4 class="section-title text-center p-3">Basic Information</h4>

                    {{-- Info rows --}}
                    <div class="info-block mt-3 small">

                        {{-- Business Hours --}}
                        <div class="info-row">
                
                            <div class="info-left">
                                <i class="bi bi-clock me-2"></i>Business Hours
                            </div>

                            <div class="info-right">

                                <div class="d-flex gap-4">
                                    <span>{{ $restaurant->opening_hours }}</span>
                                </div>

                                {{-- <div class="d-flex gap-4">
                                    <span>Dinner</span>
                                    <span>17:30-22:00</span>
                                </div> --}}

                                {{-- <div class="d-flex gap-4">
                                    <span>Closed</span>
                                    <span>Monday</span>
                                </div> --}}

                            </div>
                    </div>
                        {{-- Tel --}}
                        <div class="info-row">
                        <div class="info-left">
                            <i class="bi bi-telephone me-2"></i><span>Tel</span>
                        </div>
                        <div class="info-right">
                            {{ $restaurant->phone }}
                        </div>
                        </div>

                        {{-- Mail --}}
                        <div class="info-row">
                        <div class="info-left">
                            <i class="bi bi-envelope me-2"></i><span>Mail</span>
                        </div>
                        <div class="info-right">
                            {{ $restaurant->email }}
                        </div>
                        </div>

                        {{-- Website --}}
                        <div class="info-row">
                        <div class="info-left">
                            <i class="bi bi-globe2 me-2"></i><span>Website</span>
                        </div>
                        <div class="info-right">
                            <a href="https://www.restaurantsato.com" target="_blank" class="info-link">
                            https://www.restaurantsato.com
                            </a>

                            <div class="mt-2 d-flex align-items-center gap-3">
                            <i class="bi bi-instagram"></i>
                            <span style="font-weight:600;">X</span>
                            </div>
                        </div>
                        </div>

                        {{-- Address --}}
                        <div class="info-row">
                        <div class="info-left">
                            <i class="bi bi-geo-alt me-2"></i><span>Address</span>
                        </div>
                        <div class="info-right">
                            {{ $restaurant->address_line }} {{ $restaurant->city }} {{ $restaurant->prefecture }}
                        </div>
                        </div>

                </div>

                    {{-- Map --}}
                    <div class="rounded overflow-hidden border mt-3" style="height:220px;">
                        <iframe class="w-100 h-100 d-flex align-items-center justify-content-center text-muted small" src="https://www.google.com/maps?q={{ urlencode($restaurant->address_line . ' ' . $restaurant->city . ' ' . $restaurant->prefecture) }}&output=embed" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>

                {{-- Reservation --}}
                <div class="col-12 col-lg-6 bg-white rounded p-3 border">
                    <h4 class="text-center p-3 text-underline-accent">Reservation</h4>

                    <form class="mt-3" action="" method="post">
                    @csrf
                    <div class="row g-2">
                        <div class="col-6">
                        <input type="date" class="form-control mb-3" placeholder="Date">
                        </div>
                        <div class="col-6">
                        <input type="time" class="form-control mb-3" placeholder="Time">
                        </div>
                        <div class="col-12">
                        <input type="number" class="form-control mb-3" placeholder="Number of Guests">
                        </div>
                        <div class="col-12">
                        <input type="text" class="form-control mb-3" placeholder="Full Name">
                        </div>
                        <div class="col-12">
                        <input type="text" class="form-control mb-3" placeholder="Phone Number">
                        </div>
                        <div class="col-12">
                        <input type="email" class="form-control mb-3 " placeholder="Email Address">
                        </div>
                        <div class="col-12">
                        <textarea class="form-control" rows="3" placeholder="Special Requests"></textarea>
                        </div>
                        <div class="col-12">
                        <button type="button" class="btn btn-orange w-100" data-bs-toggle="modal" data-bs-target="#reservationConfirmModal">
                            Review Reservation
                        </button>
                        </div>
                    </div>
                    @include('restaurants.modal.reservation-confirm-modal')
                    </form>
                </div>
                </section>

                {{-- Meal Kit --}}
               <section class="mt-5">
                <h2 class="text-center meal-title">Meal Kit</h2>
                <div class="text-center mb-5">
                    <span class="text-orange">Enjoy</span> Our Dishes at Home
                </div>

                <div id="mealCarousel" class="carousel slide" data-bs-ride="false">

                    <div class="carousel-inner">

                        @foreach ($products->chunk(3) as $index => $productChunk)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="row g-4 justify-content-center">

                                    @foreach ($productChunk as $product)
                                        <div class="col-12 col-md-4">
                                            <div class="card border-0 bg-transparent">
                                                <img 
                                                    src="{{ asset('storage/' . $product->image) }}"
                                                    class="card-img-top"
                                                    style="height:200px; object-fit:cover;"
                                                    alt="{{ $product->name }}">

                                                <div class="card-body px-0 pt-2">
                                                    <h5 class="meal-name">{{ $product->name }}</h5>
                                                    <div class="meal-price">${{ $product->price }}</div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endforeach

                    </div>

                        {{-- ← --}}
                        @if($products->count() > 3)
                        <button 
                            class="carousel-control-prev"
                            type="button"
                            data-bs-target="#mealCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        {{-- → --}}
                        <button 
                            class="carousel-control-next"
                            type="button"
                            data-bs-target="#mealCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                        @endif

                    </div>
                </section>

                {{-- Reviews --}}
                <section class="mt-5 mb-4">
                <h2 class="text-center my-5" style="text-decoration: underline; text-underline-offset: 6px; text-decoration-color:#D96B52;">Reviews</h2>

                <div class="d-grid gap-3">
                    @for($i=0; $i<2; $i++)
                    <div class="card">
                        <div class="card-body">
                        <div class="d-flex align-items-start gap-3">
                            <i class="bi bi-person-circle fs-2"></i>
                            <div class="flex-grow-1">
                            <div class="fw-semibold">Delicious Restaurant</div>
                            <div class="small text-warning">★★★★★</div>
                            <div class="small text-muted mt-1">
                                The sushi was incredibly fresh and beautifully presented...
                            </div>
                            </div>
                            <div class="small text-muted">Apr 12, 2026</div>
                        </div>
                        </div>
                    </div>
                    @endfor
                </div>
                </section>

            </div>
        </div>
    </div>
</div>    
@endsection