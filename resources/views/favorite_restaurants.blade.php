@extends('layouts.app')

@section('title', 'Login')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <div class="container py-5">
        <h2 class="mb">My Favorites</h2>
        <div class="selection-group mb-4">
            <input type="radio" name="fav-tab" id="go-restaurants" checked>
            <label for="go-restaurants">Restaurants</label>

            <input type="radio" name="fav-tab" id="stay-kits" onchange="location.href='{{ route('favorite_kits') }}'">
            <label for="stay-kits">Kits</label>
        </div>
        <hr>
        <div class="restaurant-grid">
            @forelse($favorite_restaurants as $favorite)
                <div class="restaurant-card">
                    <div class="restaurant-image-wrapper">
                        <div class="restaurant-badge restaurant">
                            {{-- {{ $favorite->genre->name ?? 'Genre' }} --}}
                        </div>
                        @if($restaurant->image)
                            <img src="#" alt="{{ $restaurant->name }}">
                        @else
                            <div class="no-image-placeholder">
                                <i class="fa-solid fa-utensils"></i>
                            </div>
                        @endif
                    </div>
                    <div class="restaurant-info">
                        {{-- name --}}
                        <h3 class="restaurant-name">{{$restaurant->name}}</h3>
                        {{-- location --}}
                        <div class="location-box">
                            <span class="restaurant-tag">
                                <i class="fa-solid fa-location-dot"></i>{{ $restaurant->location ?? 'Location' }}
                            </span>
                        </div>
                        {{-- rating --}}
                       <div class="product-rating">
                            @php $rating = $restaurant->rating ?? 5; @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $i <= $rating ? 'filled' : 'empty' }}"></i>
                            @endfor
                            <span class="rating-num">{{ number_format($rating, 1) }}</span>
                        </div>

                        <div class="restaurant-footer">
                            <a href="#" class="view-detail-btn">
                                <i class="fa-solid fa-magnifying-glass"></i> View Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No favorite restaurants found.</p>
                </div>
        </div>
        @endforelse
        <div class="btn-container">
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="fa-solid fa-house"></i> Back to Dashboard
            </a>
        </div>
    </div>
@endsection