@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
<link rel="stylesheet" href="{{ asset('css/results.css') }}">


<div class="container py-5 favorite-page">

    <div class="mb-5 text-center">
        @if(request('keyword'))
            <h2 class="page-title mb-3">
                Results for "<span class="fw-bold">{{ request('keyword') }}</span>"
            </h2>
            <p class="text-muted">
                <strong>{{ $restaurants->count() + $products->count() }}</strong> items found.
            </p>
        @else
            <h2 class="page-title mb-3">All Items</h2>
        @endif
    </div>

    {{-- Restaurants Section --}}
    <div class="section-container mb-5">
        <h3 class="section-subtitle mb-4">Restaurants</h3>
        <div class="row g-4">
            @forelse($restaurants as $restaurant)
                <div class="col-md-4 col-sm-6">
                    <div class="custom-item-card h-100 shadow-sm">
                        <div class="card-content p-4">
                            <h5 class="item-title mb-2">{{ $restaurant->name }}</h5>
                            <p class="text-muted small mb-4">{{ Str::limit($restaurant->description, 60) }}</p>
                            <div class="text-end mt-auto">
                                <a href="{{ route('restaurant', ['id' => $restaurant->id]) }}" class="btn-back-custom px-3 py-1" style="font-size: 0.8rem; border-radius: 8px;">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted italic">No restaurants found matching your criteria.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Meal Kits Section --}}
    <div class="section-container">
        <h3 class="section-subtitle mb-4">Meal Kits</h3>
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-md-4 col-sm-6">
                    <div class="custom-item-card h-100 shadow-sm border-top-accent">
                        <div class="card-content p-4">
                            <h5 class="item-title mb-1">{{ $product->name }}</h5>
                            <p class="price-text mb-4">¥{{ number_format($product->price) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="badge-custom-kit">Kit</span>
                                <a href="{{ route('products.show', $product->id) }}" class="btn-back-custom px-3 py-1" style="font-size: 0.8rem; border-radius: 8px;">
                                    View Kit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted italic">No meal kits found matching your criteria.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection