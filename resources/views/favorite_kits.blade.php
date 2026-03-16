@extends('layouts.app')

@section('title', 'Login')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <div class="container py-5">
        <h2 class="mb">My Favorites</h2>
        <div class="selection-group mb-4">
            <input type="radio" name="fav-tab" id="go-restaurants" onchange="location.href='{{ route('favorite_restaurants') }}'">
            <label for="go-restaurants">Restaurants</label>

            <input type="radio" name="fav-tab" id="stay-kits" checked>
            <label for="stay-kits">Kits</label>
        </div>
        <hr>
        <div class="row mt-4">
           @forelse ($favorite_kits as $favorite)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-img-top-container">
                        @if($favorite->product && $favorite->product->image)
                            <img src="#" class="card-img-top" alt="{{ $favorite->product->name }}" style="max-height: 100%; object-fit: cover;">
                        @else
                            <i class="fa-solid fa-utensils fa-3x" style="color: #dee2e6;"></i>
                        @endif
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $favorite->product->name ?? 'Unknown Kit' }}</h5>
                        <p class="card-text text-muted">
                            {{ number_format($favorite->product->price ?? 0) }}
                        </p>
                    </div>

                    <div class="card-footer bg-white border-top-0 pb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                            <form action="#" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0">
                                    <i class="fa-solid fa-heart fa-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No favorite kits added yet.</p>
                
            </div>
        @endforelse
            <div class="btn-container">
                <a href="{{ route('dashboard') }}" class="btn-back">
                    <i class="fa-solid fa-house"></i> Back to Dashboard
                </a>
            </div>
        </div>

    </div>
@endsection