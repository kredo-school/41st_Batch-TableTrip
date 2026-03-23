@extends('layouts.app')
@vite(['resources/css/product-list.css'])

@section('content')
<div style="background-color: #F9F7F2; min-height: 100vh;">

    {{-- 右上の浮遊カートボタン --}}
    <div class="floating-cart">
        <a href="{{ route('cart.index') }}" class="cart-link">
            <div class="cart-wrapper">
                <i class="bi bi-cart-fill fs-2"></i>
                <span class="cart-badge">{{ array_sum(array_column(session('cart', []), 'quantity')) }}</span>
            </div>
            <p class="cart-text">Items</p>
        </a>
    </div>

    <div class="container py-5" style="max-width: 480px;">
        <div class="card border-0 shadow-sm position-relative overflow-hidden" style="border-radius: 16px;">

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

            {{-- 商品画像 --}}
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="card-img-top"
                     alt="{{ $product->name }}"
                     style="height: 260px; object-fit: cover;">
            @else
                <img src="https://via.placeholder.com/480x260?text=No+Image"
                     class="card-img-top"
                     alt="No Image"
                     style="height: 260px; object-fit: cover;">
            @endif

            <div class="card-body px-4 pb-4">

                {{-- 商品名・タグ・価格 --}}
                <div class="d-flex align-items-center flex-wrap gap-2 mt-2">
                    <h4 class="fw-bold mb-0" style="font-family: serif; color: #333;">{{ $product->name }}</h4>
                    @if($product->tag)
                        <span class="border border-dark px-2 py-0 small" style="border-radius: 3px; font-size: 0.75rem;">{{ $product->tag }}</span>
                    @endif
                    <span class="fw-bold ms-auto" style="font-size: 1.1rem;">¥{{ number_format($product->price) }}-</span>
                </div>

                {{-- レストラン名・場所 --}}
                <p class="text-muted small mt-1 mb-2">{{ $product->location }} | {{ $product->restaurant_name }}</p>

                {{-- 星評価 --}}
                <div class="d-flex align-items-center gap-1 mb-3">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($product->rating))
                            <span class="text-warning" style="font-size: 1.3rem;">★</span>
                        @else
                            <span class="text-secondary" style="font-size: 1.3rem;">★</span>
                        @endif
                    @endfor
                    <span class="small text-muted ms-1">{{ $product->rating }} (40)</span>
                </div>

                <hr>

                {{-- Description --}}
                <h6 class="fw-bold mb-1">Description</h6>
                <p class="small text-muted mb-3">{{ $product->description }}</p>

                {{-- Ingredients --}}
                <h6 class="fw-bold mb-1">Ingredients</h6>
                <p class="small text-muted mb-1">{{ $product->ingredients }}</p>
                <p class="small text-muted mb-3"><span class="fw-semibold">Allergens:</span> {{ $product->allergens }}</p>

                {{-- Add Cart ボタン --}}
                <div class="d-flex justify-content-end mt-3">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="border-0 bg-transparent text-center" style="cursor: pointer;">
                            <i class="bi bi-cart-fill" style="font-size: 2.5rem; color: #2c3e50;"></i>
                            <p class="mb-0 fw-bold" style="font-size: 0.7rem;">Add Cart</p>
                        </button>
                    </form>
                </div>

            </div>
        </div>

        {{-- 戻るリンク --}}
        <div class="mt-3">
            <a href="{{ route('products.index') }}" class="text-muted small">← Back to list</a>
        </div>
    </div>
</div>
@endsection
