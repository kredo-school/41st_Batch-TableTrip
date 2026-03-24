@extends('layouts.app')
@vite(['resources/css/product-list.css'])

@section('content')
<div style="background-color: #F9F7F2; min-height: 100vh;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold" style="color: #4A4A4A;">
                <i class="bi bi-heart-fill text-danger me-2"></i>My Favorites
            </h2>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($products as $product)
            <div class="col">
                <div class="card h-100 border-0 position-relative" style="background-color: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">

                    {{-- リボン --}}
                    @if($product->badge)
                        @php
                            $badgeColor = match($product->badge) {
                                'Easy'    => '#D97652',
                                'Special' => '#E8C43A',
                                'Kids OK' => '#3DBDB5',
                                default   => '#D97652',
                            };
                        @endphp
                        <div class="triangle-ribbon" style="border-color: {{ $badgeColor }} transparent transparent transparent;"></div>
                        <div class="ribbon-text" style="font-size: {{ $product->badge === 'Kids OK' ? '26px' : '36px' }};">{{ $product->badge }}</div>
                    @endif

                    {{-- お気に入り解除ボタン --}}
                    <form action="{{ route('favorites.toggle') }}" method="POST"
                          style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="border-0 bg-transparent p-0" style="cursor: pointer;">
                            <i class="bi bi-heart-fill" style="font-size: 1.4rem; color: #e74c3c;"></i>
                        </button>
                    </form>

                    <a href="{{ route('products.show', ['id' => $product->id]) }}" class="text-decoration-none text-dark">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                 alt="{{ $product->name }}" style="object-fit: cover; height: 190px; width: 100%;">
                        @else
                            <img src="https://via.placeholder.com/300x190?text=No+Image" class="card-img-top"
                                 alt="No Image" style="height: 190px; object-fit: cover;">
                        @endif
                    </a>

                    <div class="card-body px-3 pt-3 pb-3 text-start">
                        <a href="{{ route('products.show', ['id' => $product->id]) }}" class="text-decoration-none text-dark">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h5 class="fw-bold mb-0" style="font-family: serif; color: #333;">{{ $product->name }}</h5>
                                <span class="fw-bold text-nowrap ms-2" style="font-size: 0.95rem;">¥{{ number_format($product->price) }}-</span>
                            </div>
                            @if($product->tag)
                            <div class="mb-2">
                                <span class="border border-dark px-2 py-0" style="font-size: 0.75rem; border-radius: 3px;">{{ $product->tag }}</span>
                            </div>
                            @endif
                        </a>
                        <div class="d-flex align-items-center mt-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($product->rating))
                                    <span style="color: #F5A623;">★</span>
                                @else
                                    <span style="color: #ddd;">★</span>
                                @endif
                            @endfor
                            <span class="text-muted ms-1" style="font-size: 0.7rem;">{{ $product->rating }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="bi bi-heart" style="font-size: 3rem; color: #ccc;"></i>
                <p class="mt-3">No favorites yet.</p>
                <a href="{{ route('products.index') }}" class="btn btn-dark mt-2">Browse Products</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
