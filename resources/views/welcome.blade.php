@extends('layouts.app')

@section('title', 'Welcome to TableTrip')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endpush

@section('content')
<div class="welcome-container">
    
    <div class="hero-section">
        <div class="hero-overlay">
            <div class="container text-center">
                <h1 class="hero-title">Experience the Art of Dining</h1>
                <p class="hero-subtitle">Premium restaurant reservations & chef-curated meal kits delivered to your door.</p>
                <div class="hero-buttons mt-4">
                    <a href="{{ route('search') }}" class="btn-hero-primary">Book a Table</a>
                    <a href="{{ route('products.index') }}" class="btn-hero-secondary">Order Meal Kits</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="section-header d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="page-title m-0">Featured Restaurants</h2>
                <p class="text-muted small mt-2 m-0">Experience fine dining at your table</p>
            </div>
            <a href="{{ route('search') }}" class="view-all-link">Explore All →</a>
        </div> 

        <div class="row g-4 mb-5"> 
            @forelse ($featured_restaurants as $restaurant)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="custom-item-card">
                        <a href="{{ route('restaurant', $restaurant->id) }}" class="text-decoration-none text-dark">
                            <div class="img-wrapper">
                                <img src="{{ $restaurant->heroImage ? asset('storage/' . $restaurant->heroImage->image_url) : asset('images/no-image.jpg') }}" alt="{{ $restaurant->name }}">
                            </div>
                            <div class="card-content p-3">
                                <h5 class="item-title mb-1">{{ $restaurant->restaurant_name }}</h5>
                                <p class="text-muted small m-0"><i class="bi bi-geo-alt me-1"></i>{{ $restaurant->prefecture }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="no-data-box text-center p-5">No restaurants available yet.</div>
                </div>
            @endforelse
        </div>

        <div class="section-header d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="page-title m-0">Signature Meal Kits</h2>
                <p class="text-muted small mt-2 m-0">Chef-curated ingredients delivered</p>
            </div>
            <a href="{{ route('products.index') }}" class="view-all-link">View Collection →</a>
        </div> 

        <div class="row g-4">
            @forelse ($featured_products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="custom-item-card">
                        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                            <div class="img-wrapper">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-kit.jpg') }}" alt="{{ $product->name }}">
                            </div>
                            <div class="card-content p-3">
                                <h5 class="item-title mb-1">{{ $product->name }}</h5>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="price-text">¥{{ number_format($product->price) }}</span>
                                    <span class="badge-custom-kit">Kit</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="no-data-box text-center p-5">No meal kits available yet.</div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection