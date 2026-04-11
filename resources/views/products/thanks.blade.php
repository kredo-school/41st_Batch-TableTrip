@extends('layouts.app')
@vite(['resources/css/product-list.css'])

@section('content')
<div class="thanks-page" style="background-color: #F9F7F2; min-height: 100vh; font-family: serif;">
    <div class="container py-5 text-center" style="max-width: 600px;">

        <h1 class="display-5 fw-bold mb-3">Order Confirmed!</h1>
        <p class="fs-5 mb-5">Your taste journey is about to begin</p>

        <div class="success-animation mb-4" style="display: flex; justify-content: center;">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" style="width: 100px; height: 100px; display: block;">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" stroke="#4bb543" stroke-width="2"
                    style="stroke-dasharray: 166; stroke-dashoffset: 166; animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;" />
                <path class="checkmark__check" fill="none" stroke="#4bb543" stroke-width="3" d="M14.1 27.2l7.1 7.2 16.7-16.8" stroke-linecap="round" stroke-linejoin="round"
                    style="stroke-dasharray: 48; stroke-dashoffset: 48; animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;" />
            </svg>
        </div>

        <style>
            @keyframes stroke { to { stroke-dashoffset: 0; } }
        </style>

        <p class="text-muted mb-5">Order #{{ $orderId }}</p>

        {{-- 購入商品一覧 --}}
        @foreach($cart as $id => $item)
        @php $product = (object) $item['product']; @endphp
        <div class="card mb-3 border-dark shadow-sm text-start" style="border-radius: 5px;">
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
                        <img src="{{ asset('images/journykit.png') }}" class="img-fluid rounded border" alt="Item">
                    @endif
                </div>
                <div class="col-8 p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $product->name }}</h5>
                        <p class="text-muted small mb-0">{{ $product->location }} | {{ $product->restaurant_name }}</p>
                        <p class="text-muted small mb-0">Qty: {{ $item['quantity'] }}</p>
                    </div>
                    <p class="fw-bold mb-0">¥{{ number_format($product->price * $item['quantity']) }}-</p>
                </div>
            </div>
        </div>
        @endforeach

        <hr class="border-dark my-4">

        {{-- お届け予定 --}}
        <div class="text-start mb-4">
            <h5 class="fw-bold mb-2">Estimated Delivery <i class="bi bi-chevron-down small"></i></h5>
            <div class="ps-2">
                <p class="mb-1">Ready to pack!</p>
                <p class="mb-0">{{ now()->addDays(2)->format('M d') }} - {{ now()->addDays(4)->format('M d, Y') }}</p>
            </div>
        </div>

        <hr class="border-dark my-4">

        {{-- 配送先 --}}
        <div class="text-start mb-5">
            <h5 class="fw-bold mb-2">Shipping to</h5>
            <div class="ps-2 small">
                @auth
                    <p class="mb-1">Name: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                    <p class="mb-1">Address: {{ Auth::user()->address ?? 'N/A' }}</p>
                    <p class="mb-1">Phone: {{ Auth::user()->tel ?? 'N/A' }}</p>
                @else
                    <p class="mb-1">Guest order</p>
                @endauth
            </div>
        </div>

        {{-- 下部ボタン --}}
        <div class="d-flex justify-content-between gap-3">
            <a href="{{ route('cart.track') }}" class="btn text-white w-50 py-3 fw-bold" style="background-color: #D96D55; border-radius: 5px; font-family: serif;">
                Track Your Order
            </a>
            <a href="{{ route('cart.order_details') }}" class="btn text-white w-50 py-3 fw-bold" style="background-color: #2c3e50; border-radius: 5px; font-family: serif;">
                View Order Details
            </a>
        </div>

    </div>
</div>
@endsection
