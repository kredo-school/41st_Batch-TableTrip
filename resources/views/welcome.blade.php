@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/welcome.js') }}" defer></script>
@endpush

@section('content')
<div class="welcome-container py-5">
    <div class="container">
        {{-- Restaurants Section --}}
        <div class="section-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Restaurants</h2>
            <a href="#" class="view-all text-muted text-decoration-none small">All Restaurants →</a>
        </div>

        <div class="row g-4 mb-5"> 
            {{-- @forelse に変更 --}}
            @forelse ($featured_restaurants as $restaurant)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="item-card shadow-sm h-100">
                        <a href="#" class="text-decoration-none text-dark">
                            <div class="img-wrapper">
                                <img src="{{ $restaurant->image_url ?? asset('images/no-image.jpg') }}" alt="{{ $restaurant->name }}">
                            </div>
                            <div class="card-content p-3">
                                <h5 class="item-title m-0">{{ $restaurant->name }}</h5>
                                <p class="text-muted small m-0 mt-1">{{ $restaurant->location }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                {{-- no data --}}
                <div class="col-12">
                    <p class="text-muted py-4 border rounded text-center bg-white" style="font-family: 'Sen', sans-serif;">
                        No restaurants available yet.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Meal Kits (Products) Section --}}
        <div class="section-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Meal Kits</h2>
            <a href="{{ route('products.index') }}" class="view-all text-muted text-decoration-none small">All Meal Kits →</a>
        </div>

        <div class="row g-4">
            @forelse ($featured_products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="item-card shadow-sm h-100">
                        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                            <div class="img-wrapper">
                                <img src="{{ $product->image_url ?? asset('images/no-kit.jpg') }}" alt="{{ $product->name }}">
                            </div>
                            <div class="card-content p-3">
                                <h5 class="item-title m-0">{{ $product->name }}</h5>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="price">¥{{ number_format($product->price) }}</span>
                                    <span class="badge rounded-pill bg-light text-dark fw-normal border px-3">Kit</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                {{-- if no data --}}
                <div class="col-12">
                    <p class="text-muted py-4 border rounded text-center bg-white" style="font-family: 'Sen', sans-serif;">
                        No meal kits available yet.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection