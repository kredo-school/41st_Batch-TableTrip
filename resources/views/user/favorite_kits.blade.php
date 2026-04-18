@extends('layouts.app')

@section('title', 'Favorite Kits')

@section('content')
<link rel="stylesheet" href="{{ asset('css/favorite.css') }}">

<div class="container py-5 d-flex flex-column align-items-center favorite-page">
    
    <h2 class="page-title mb-4">My Favorites</h2>

    <div class="favorite-content-wrapper">
        <div class="favorite-header-tabs">
            <div class="tab-item {{ request()->routeIs('user.favorite_restaurants') ? 'active' : '' }}" 
                 onclick="location.href='{{ route('user.favorite_restaurants') }}'">
                Restaurants
            </div>
            <div class="tab-item active"> Kits
            </div>
        </div>

        <div class="favorite-list-body">
            @forelse($favorite_kits as $kit)
                <div class="purchase-item border-bottom">
                    <div class="item-info">
                        <div class="item-date">Added on: {{ $kit->created_at->format('d/m/y') }}</div>
                        <div class="item-status text-success">Available</div>

                        <div class="row align-items-center">
                            <div class="col-sm-7">
                                <div class="product-name fw-bold">{{ $kit->product->name ?? 'Meal Kit Name' }}</div>
                                <div class="restaurant-name text-muted small">{{ $kit->product->restaurant_name ?? '' }}</div>
                            </div>
                            <div class="col-sm-5 item-details text-end">
                                <div class="fw-bold text-danger">{{ number_format($kit->product->price ?? 0) }}円</div>
                                <div class="mt-2 d-flex gap-3 justify-content-end">
                                    <form action="{{ route('favorite.toggle') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $kit->product_id }}">
                                        <button type="submit" class="btn p-0 border-0 bg-transparent">
                                            <i class="bi bi-trash3 fs-5 text-muted"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $kit->product_id }}">
                                        <button type="submit" class="btn p-0 border-0 bg-transparent">
                                            <i class="bi bi-cart-plus fs-5 text-success"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-image d-none d-md-block ms-3">
                        <img src="{{ asset('storage/' . ($kit->product->image ?? '')) }}" 
                             onerror="this.src='{{ asset('images/journykit.png') }}'" 
                             alt="Product" style="width: 100px; height: auto; border-radius: 4px;">
                    </div>
                </div>
            @empty
                <div class="no-data-message">
                    No favorite kits found.
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