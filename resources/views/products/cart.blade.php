@extends('layouts.app')
@vite(['resources/css/product-list.css'])

@section('content')
<div class="cart-page" style="background-color: #F9F7F2; min-height: 100vh; font-family: serif;">
    <div class="container py-4" style="max-width: 600px;">

        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold" style="color: #4A4A4A; text-decoration: underline orange;">Shopping Cart</h2>
        </div>

        <h5 class="fw-bold mb-3">Your Basket</h5>

        @forelse($cart as $id => $item)
        @php $product = (object) $item['product']; @endphp
        <div class="card mb-3 border-dark shadow-sm" style="border-radius: 5px;">
            <div class="row g-0 align-items-center">
                <div class="col-4 p-2 position-relative">
                    @if(!empty($product->badge))
                        @php
                            $badgeColor = match($product->badge) {
                                'Easy'    => '#D97652',
                                'Special' => '#E8C43A',
                                'Kids OK' => '#3DBDB5',
                                default   => '#D97652',
                            };
                        @endphp
                        <div class="mini-triangle-ribbon" style="border-top-color: {{ $badgeColor }};"></div>
                        <span class="mini-ribbon-text" style="font-size: {{ $product->badge === 'Kids OK' ? '0.5rem' : '0.65rem' }};">{{ $product->badge }}</span>
                    @endif
                    @if(!empty($product->image))
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded border" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/150?text=No+Image" class="img-fluid rounded border" alt="No Image">
                    @endif
                </div>
                <div class="col-8">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title fw-bold mb-1">{{ $product->name }}</h5>
                                <p class="text-muted small mb-2">{{ $product->location }} | {{ $product->restaurant_name }}</p>
                            </div>
                            <p class="fw-bold mb-0">¥{{ number_format($product->price) }}-</p>
                        </div>

                        {{-- 数量操作 --}}
                        <div class="d-flex justify-content-end align-items-center mt-2">
                            <div class="border border-dark d-flex align-items-center px-2 py-1" style="border-radius: 5px;">
                                <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                    <button class="btn btn-sm p-0 border-0">－</button>
                                </form>
                                <span class="mx-3 fw-bold">{{ $item['quantity'] }}</span>
                                <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                    <button class="btn btn-sm p-0 border-0">＋</button>
                                </form>
                            </div>
                            <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <button class="btn btn-sm text-danger ms-3 border-0 bg-transparent">
                                    <i class="bi bi-trash fs-5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5">
            <p>Your cart is empty.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back to Products</a>
                <a href="{{ route('dashboard') }}" class="btn" style="background-color: transparent; border: 1px solid #000; color: #000; text-decoration: none;">
                    <i class="bi bi-house-door-fill me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
        @endforelse

        @if(count($cart) > 0)
        <div class="mb-4">
            <a href="{{ route('products.index') }}" class="text-dark text-decoration-none small">[ Continue Shopping ]</a>
        </div>

        {{-- 合計金額 --}}
        @php
            $total = array_sum(array_map(fn($i) => $i['product']['price'] * $i['quantity'], $cart));
            $totalQty = array_sum(array_column($cart, 'quantity'));
        @endphp
        <div class="card border-dark shadow-sm" style="background-color: #fff; border-radius: 5px;">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Order Summary</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Items : {{ $totalQty }}</span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span>Shipping : 2-3 days</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4 border-top pt-3">
                    <span class="h5 fw-bold">Total</span>
                    <span class="h4 fw-bold">¥{{ number_format($total) }}-</span>
                </div>
                <a href="{{ route('cart.confirm') }}" class="btn w-100 text-white py-3 fs-4"
                   style="background-color: #D96D55; border-radius: 5px; text-decoration: none; display: block; text-align: center; font-family: serif; font-weight: bold;">
                    Checkout
                </a>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('products.index') }}" class="btn" style="background-color: transparent; border: 1px solid #000; color: #000; text-decoration: none;">
                        <i class="bi bi-arrow-left me-2"></i>Back to Product List
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn" style="background-color: transparent; border: 1px solid #000; color: #000; text-decoration: none;">
                        <i class="bi bi-house-door-fill me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
