@extends('layouts.app')

@section('title', 'Favorite Kits')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container py-5 d-flex flex-column align-items-center">
    <div class="card purchase-card p-4 shadow-sm">
        <h2 class="mb">My Favorites</h2>
        <div class="selection-group mb-4">
            <input type="radio" name="fav-tab" id="go-restaurants" onchange="location.href='{{ route('favoriterestaurants') }}'">
            <label for="go-restaurants">Restaurants</label>

            <input type="radio" name="fav-tab" id="stay-kits" checked>
            <label for="stay-kits">Kits</label>
        </div>
        <hr>

        <div class="purchase-list-container">
            @forelse($favorite_kits as $kit)
                <div class="purchase-item">
                    <div class="item-info">
                        <div class="item-date">Added on: {{ $kit->pivot->created_at->format('d/m/y') }}</div>
                        <div class="item-status">Available</div> 
                        
                        <div class="row align-items-center">
                            <div class="col-sm-7">
                                
                                <div class="product-name">{{ $kit->product->name ?? 'Meal Kit Name' }}</div>
                                <div class="restaurant-name">$restaurant</div>
                            </div>
                            <div class="col-sm-5 item-details">
                                <div class="fw-bold text-danger">{{ number_format($kit->product->price ?? 0) }}円</div>
                                <div class="mt-2 d-flex gap-3">
                                    <i class="bi bi-trash3 fs-5 text-muted" style="cursor: pointer;"></i> 
                                    <i class="bi bi-cart-plus fs-5 text-success" style="cursor: pointer;"></i> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item-image d-none d-md-block">
                        <img src="{{ asset('storage/' . ($kit->product->image_path ?? '')) }}" onerror="this.src='{{ asset('images/sample_kit.jpg') }}'" alt="Product">
                    </div>
                </div>
            @empty
                <p class="text-center p-5 text-muted">No favorite kits found.</p>
            @endforelse
        </div>
    </div>

    <div class="btn-container">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-house"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection