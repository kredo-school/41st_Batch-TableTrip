@extends('layouts.app')

@section('title', 'Favorite Restaurants')

@section('content')
<link rel="stylesheet" href="{{ asset('css/favorite.css') }}">

<div class="container py-5 d-flex flex-column align-items-center favorite-page">
    
    <h2 class="page-title mb-4">My Favorites</h2>

    <div class="favorite-content-wrapper">
        <div class="favorite-header-tabs">
            <div class="tab-item active"> Restaurants
            </div>
            <div class="tab-item" onclick="location.href='{{ route('user.favorite_kits') }}'">
                Kits
            </div>
        </div>

        <div class="favorite-list-body">
            @forelse($favorite_restaurants as $restaurant)
                <div class="purchase-item border-bottom">
                    <div class="item-info">
                        <div class="item-date">Added on: {{ $restaurant->pivot->created_at->format('d/m/y') }}</div>
                        <div class="item-status text-success">Open Now</div>

                        <div class="row align-items-center">
                            <div class="col-sm-7">
                                <div class="product-name fw-bold">{{ $restaurant->name }}</div>
                                <div class="restaurant-name text-muted small">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $restaurant->location ?? 'Location' }}
                                </div>
                            </div>
                            <div class="col-sm-5 item-details text-end">
                                <div class="fw-bold text-muted small mb-2">Category: {{ $restaurant->category ?? 'General' }}</div>
                                <div class="d-flex gap-3 justify-content-end">
                                    <i class="bi bi-trash3 fs-5 text-muted" style="cursor: pointer;" title="Remove"></i> 
                                    
                                    <a href="{{ route('restaurant', $restaurant->id) }}" class="text-dark">
                                        <i class="bi bi-box-arrow-up-right fs-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item-image d-none d-md-block ms-3">
                        <img src="{{ asset('storage/' . $restaurant->image) }}" 
                             onerror="this.src='{{ asset('images/sample_restaurant.jpg') }}'" 
                             alt="Restaurant" style="width: 100px; height: auto; border-radius: 4px;">
                    </div>
                </div>
            @empty
                <div class="no-data-message">
                    No favorite restaurants found.
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-5">
        <a href="{{ route('dashboard') }}" class="btn-back-custom">
            <i class="fa-solid fa-house"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection