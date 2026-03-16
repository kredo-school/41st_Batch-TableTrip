@extends('layouts.app')

@section('title','Page Management')

@section('content')
<div class="container my-5 mx-auto">
    <div class="row">
        @include('restaurant-owners.sidebar')
        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent mb-4">Page Management</h1>
            @include('restaurant-owners.page-management.tabs')

             {{-- Hero --}}
            <section class="container-fluid p-0">
                <img src="{{ asset('images/restaurant-hero.png') }}" class="w-100" style="max-height:420px; object-fit:cover;" alt="hero">
            </section>

            <div class="container py-4">

                {{-- Title + Heart --}}
                <div class="d-flex align-items-center justify-content-between">
                <h1 class="mb-0">Restaurant Sato</h1>
                <button class="btn p-0 border-0 bg-transparent" aria-label="favorite">
                    <i class="fa-regular fa-heart fs-3"></i>
                </button>
                </div>

                {{-- Gallery 2 photos --}}
                <section class="row g-3 mt-2">
                <div class="col-12 col-md-6">
                    <img src="{{ asset('images/sample1.png') }}" class="w-100 rounded" style="height:200px; object-fit:cover;" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('images/sample2.png') }}" class="w-100 rounded" style="height:200px; object-fit:cover;" alt="">
                </div>
                </section>

                {{-- Description --}}
                <section class="my-5">
                <h5 class="fw-bold">Authentic Japanese Flavors in the Heart of the City</h5>
                <p class="text-muted mb-0" style="max-width: 900px;">
                    Experience carefully crafted Japanese dishes made with fresh, seasonal ingredients...
                </p>
                </section>

                {{-- Menu --}}
                <section class="mt-4">
                <h2 class="text-center my-5" style="text-decoration: underline; text-underline-offset: 6px; text-decoration-color:#D96B52;">Menu</h2>

                {{-- Bootstrap carousel --}}
                <div id="menuCarousel" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-inner">

                    {{-- 1枚目 --}}
                    <div class="carousel-item active">
                        <div class="row g-3 justify-content-center">
                        @for($i=0; $i<4; $i++)
                            <div class="col-6 col-md-3">
                            <div class="card border-0 bg-transparent">
                                <img src="{{ asset('images/menu1.png') }}" class="card-img-top rounded" style="height:140px; object-fit:cover;" alt="">
                                <div class="card-body px-0 pt-2">
                                <div class="small fw-semibold">Signature Salmon Nigiri</div>
                                <div class="small text-muted">$9</div>
                                </div>
                            </div>
                            </div>
                        @endfor
                        </div>
                    </div>

                    {{-- 2枚目（必要なら追加） --}}
                    <div class="carousel-item">
                        <div class="row g-3 justify-content-center">
                        @for($i=0; $i<4; $i++)
                            <div class="col-6 col-md-3">
                            <div class="card border-0 bg-transparent">
                                <img src="{{ asset('images/menu2.png') }}" class="card-img-top rounded" style="height:140px; object-fit:cover;" alt="">
                                <div class="card-body px-0 pt-2">
                                <div class="small fw-semibold">Assorted Sushi Plate</div>
                                <div class="small text-muted">$25</div>
                                </div>
                            </div>
                            </div>
                        @endfor
                        </div>
                    </div>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                    </button>
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
                                    <span>Lunch</span>
                                    <span>11:30-15:00</span>
                                </div>

                                <div class="d-flex gap-4">
                                    <span>Dinner</span>
                                    <span>17:30-22:00</span>
                                </div>

                                <div class="d-flex gap-4">
                                    <span>Closed</span>
                                    <span>Monday</span>
                                </div>

                            </div>
                    </div>
                        {{-- Tel --}}
                        <div class="info-row">
                        <div class="info-left">
                            <i class="bi bi-telephone me-2"></i><span>Tel</span>
                        </div>
                        <div class="info-right">
                            0120-1234-5678
                        </div>
                        </div>

                        {{-- Mail --}}
                        <div class="info-row">
                        <div class="info-left">
                            <i class="bi bi-envelope me-2"></i><span>Mail</span>
                        </div>
                        <div class="info-right">
                            info@email.com
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
                            3-14-8 Jingumae, Shibuya-ku, Tokyo 150-0001, Japan
                        </div>
                        </div>

                </div>

                    {{-- Map --}}
                    <div class="rounded overflow-hidden border mt-3" style="height:220px;">
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted small">Map here</div>
                    </div>
                </div>

                {{-- Reservation --}}
                <div class="col-12 col-lg-6 bg-white rounded p-3 border">
                    <h4 class="text-center p-3" style="text-decoration: underline; text-underline-offset: 6px; text-decoration-color:#D96B52;">Reservation</h4>

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
                <div class="text-center meal-subtitle mb-5">Enjoy Our Dishes at Home</div>

                <div id="mealCarousel" class="carousel slide" data-bs-ride="false">

                    <div class="carousel-inner">

                    {{-- 1ページ --}}
                    <div class="carousel-item active">
                        <div class="row g-4 justify-content-center">

                        @for($i=0; $i<3; $i++)
                        <div class="col-12 col-md-4">
                            <div class="card border-0 bg-transparent">

                            <img 
                                src="{{ asset('images/kit1.png') }}"
                                class="card-img-top"
                                style="height:200px; object-fit:cover;"
                            >

                            <div class="card-body px-0 pt-2">
                                <h5 class="meal-name">Teriyaki Chicken</h5>
                                <div class="meal-price">$25</div>
                            </div>

                            </div>
                        </div>
                        @endfor

                        </div>
                    </div>


                    {{-- 2ページ（必要なら） --}}
                    <div class="carousel-item">
                        <div class="row g-4 justify-content-center">

                        @for($i=0; $i<3; $i++)
                        <div class="col-12 col-md-4">
                            <div class="card border-0 bg-transparent">

                            <img 
                                src="{{ asset('images/kit2.png') }}"
                                class="card-img-top"
                                style="height:200px; object-fit:cover;"
                            >

                            <div class="card-body px-0 pt-2">
                                <h5 class="meal-name">Chicken Rice Bowl</h5>
                                <div class="meal-price">$30</div>
                            </div>

                            </div>
                        </div>
                        @endfor

                        </div>
                    </div>

                    </div>


                    {{-- ← --}}
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