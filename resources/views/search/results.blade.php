@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/results.css') }}">

<div class="container py-5 favorite-page">
    <div class="header-section text-center mb-4">
        <h2 class="page-title mb-2">Search Results</h2>
        <div class="title-line mx-auto"></div>
        
        @if(request('keyword'))
            <p class="text-muted results-count mt-3">
                Found <strong>{{ $restaurants->count() + $products->count() }}</strong> items for "<span class="fw-bold">{{ request('keyword') }}</span>"
            </p>
        @else
            <p class="text-muted results-count mt-3">Discover our collection</p>
        @endif
    </div>

    <div class="tabs-outside-wrapper d-flex justify-content-center mb-4">
        <ul class="nav nav-pills" id="searchTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="restaurants-tab" data-bs-toggle="pill" data-bs-target="#restaurants" type="button" role="tab">
                    Restaurants ({{ $restaurants->count() }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kits-tab" data-bs-toggle="pill" data-bs-target="#kits" type="button" role="tab">
                    Meal Kits ({{ $products->count() }})
                </button>
            </li>
        </ul>
    </div>

    <div class="main-framed-outer shadow-sm">
        <div class="tab-content" id="searchTabContent">
            
            <div class="tab-pane fade show active" id="restaurants" role="tabpanel">
                <div class="row g-4">
                    @forelse ($restaurants as $restaurant)
                        <div class="col-md-4 col-sm-6">
                            <div class="item-inner-frame h-100 p-4">
                                <h5 class="item-name mb-3">{{ $restaurant->name }}</h5>
                                <p class="text-muted small mb-4">{{ Str::limit($restaurant->description, 70) }}</p>
                                <div class="text-end mt-auto">
                                    <a href="{{ route('restaurant', ['id' => $restaurant->id]) }}" class="btn-action">
                                        Explore
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted empty-msg">No results found.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="tab-pane fade" id="kits" role="tabpanel">
                <div class="row g-4">
                    @forelse($products as $product)
                        <div class="col-md-4 col-sm-6">
                            <div class="item-inner-frame h-100 p-4">
                                <h5 class="item-name mb-2">{{ $product->name }}</h5>
                                <p class="price-label mb-4">¥{{ number_format($product->price) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="badge-outline">Meal Kit</span>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn-action">
                                        View Kit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted empty-msg">No meal kits available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 pt-4">
        @auth
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="fa-solid fa-house"></i> Back to Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-nav-footer">
                <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
            </a>
        @endauth
    </div>
</div>
@endsection