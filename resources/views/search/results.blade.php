@extends('layouts.app')

@section('title', 'Login')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">

<div class="container py-5">

    {{-- restaurant results --}}
    <div class="mb-4">
        @if(request('keyword'))
            <h2 class="fw-light" style="font-family: 'Playfair Display', serif;">
                Results for "<span class="fw-bold">{{ request('keyword') }}</span>"
            </h2>
            <p class="text-muted small">
                {{ $restaurants->count() + $products->count() }} items found.
            </p>
        @else
            <h2 class="fw-light" style="font-family: 'Playfair Display', serif;">All Items</h2>
        @endif
    </div>
    <h3 class="mt-5 mb-3" style="font-family: 'Playfair Display', serif; border-bottom: 1px solid #ddd;">Restaurants</h3>
    <div class="row">
        @forelse($restaurants as $restaurant)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 0;">
                    <div class="card-body">
                        <h5 class="card-title" style="font-family: 'Sen', sans-serif; font-weight: bold;">{{ $restaurant->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($restaurant->description, 50) }}</p>
                        <a href="{{ route('restaurant', ['id' => $restaurant->id]) }}" class="btn btn-outline-dark btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="ps-3">No restaurants found.</p>
        @endforelse
    </div>
    {{-- mealkits results --}}
    <h3 class="mt-5 mb-3" style="font-family: 'Playfair Display', serif; border-bottom: 1px solid #ddd;">Meal Kits</h3>
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 0;">
                    <div class="card-body">
                        <h5 class="card-title" style="font-family: 'Sen', sans-serif; font-weight: bold;">{{ $product->name }}</h5>
                        <p class="card-text text-muted">¥{{ number_format($product->price) }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-dark btn-sm">View Kit</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="ps-3">No meal kits found.</p>
        @endforelse
    </div>
</div>
@endsection
