@extends('layouts.app')

@section('title', 'Favorite Restaurants')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container py-5 d-flex flex-column align-items-center">
    <div class="card purchase-card p-4 shadow-sm">
        <h2 class="mb">My Favorites</h2>

        <div class="selection-group mb-4">
            <input type="radio" name="fav-tab" id="go-restaurants" checked>
            <label for="go-restaurants">Restaurants</label>

            <input type="radio" name="fav-tab" id="stay-kits" onchange="location.href='{{ route('favoritekits') }}'">
            <label for="stay-kits">Kits</label>
        </div>
        <hr>

        <div class="purchase-list-container">
            @forelse($favorite_restaurants as $restaurant)
                <div class="purchase-item">
                    <div class="item-info">
                        <div class="item-date">Added on: {{ $restaurant->pivot->created_at->format('d/m/y') }}</div>
                        <div class="item-status text-success">Open Now</div> 
                        
                        <div class="row align-items-center">
                            <div class="col-sm-7">
                                <div class="product-name">{{ $restaurant->name }}</div>
                                <div class="restaurant-name">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $restaurant->location ?? 'Location' }}
                                </div>
                            </div>
                            <div class="col-sm-5 item-details">
                                <div class="fw-bold text-muted small">Category: {{ $restaurant->category ?? 'General' }}</div>
                                <div class="mt-2 d-flex gap-3">
                                    <i class="bi bi-trash3 fs-5 text-muted" style="cursor: pointer;" title="Remove"></i> 
                                    <a href="{{ route('restaurant', $restaurant->id) }}" class="text-dark">
                                        <i class="bi bi-box-arrow-up-right fs-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item-image d-none d-md-block">
                        <img src="{{ asset('storage/' . $restaurant->image) }}" onerror="this.src='{{ asset('images/sample_restaurant.jpg') }}'" alt="Restaurant">
                    </div>
                </div>
            @empty
                <p class="text-center p-5 text-muted">No favorite restaurants found.</p>
            @endforelse
        </div>
    </div>


    <div class="btn-container mt-4">
        <a href="{{ route('dashboard') }}" class="btn-back" style="text-decoration: none;">
            <i class="fa-solid fa-house me-2"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection