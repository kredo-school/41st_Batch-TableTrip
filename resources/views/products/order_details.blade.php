@extends('layouts.app')
@vite(['resources/css/product-list.css'])

@section('content')
<div style="background-color: #F9F7F2; min-height: 100vh; font-family: serif;">
    <div class="container py-5" style="max-width: 600px;">

        <h2 class="fw-bold text-center mb-5">Order Details</h2>

        <p class="text-muted text-center mb-4">Order #{{ $order['id'] }} &nbsp;·&nbsp; {{ $order['ordered_at'] }}</p>

        {{-- 商品一覧 --}}
        @php $total = 0; @endphp
        @foreach($order['items'] as $id => $item)
        @php
            $product = (object) $item['product'];
            $subtotal = $product->price * $item['quantity'];
            $total += $subtotal;
        @endphp
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
                        <img src="{{ asset('images/journykit.png') }}" class="img-fluid rounded border" alt="Item">
                    @endif
                </div>
                <div class="col-8">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold mb-1">{{ $product->name }}</h5>
                                <p class="text-muted small mb-1">{{ $product->location }} | {{ $product->restaurant_name }}</p>
                                @if(!empty($product->tag))
                                    @php
                                        $tagStyle = $product->tag === 'Flash Frozen'
                                            ? 'background-color:#dbeafe; color:#1d4ed8; border:1px solid #93c5fd;'
                                            : 'background-color:#e0f2fe; color:#0369a1; border:1px solid #7dd3fc;';
                                    @endphp
                                    <span style="font-size:0.7rem; border-radius:3px; padding:1px 6px; font-weight:600; {{ $tagStyle }}">
                                        {{ $product->tag === 'Flash Frozen' ? '❄ Flash Frozen' : '🧊 Cool' }}
                                    </span>
                                @endif
                            </div>
                            <div class="text-end">
                                <p class="fw-bold mb-0">¥{{ number_format($product->price) }}-</p>
                                <p class="text-muted small mb-0">× {{ $item['quantity'] }}</p>
                            </div>
                        </div>
                        <div class="text-end mt-1">
                            <span class="fw-bold small">Subtotal: ¥{{ number_format($subtotal) }}-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- 合計 --}}
        <div class="card border-dark shadow-sm mb-4" style="border-radius: 5px; background-color: #fff;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <span class="h5 fw-bold">Total</span>
                    <span class="h4 fw-bold">¥{{ number_format($total) }}-</span>
                </div>
            </div>
        </div>

        {{-- 配送先 --}}
        <div class="card border-dark shadow-sm mb-4" style="border-radius: 5px; background-color: #fff;">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Shipping Address</h5>
                @auth
                    <p class="small mb-1">Name: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                    <p class="small mb-1">Address: {{ Auth::user()->address ?? 'N/A' }}</p>
                    <p class="small mb-0">Phone: {{ Auth::user()->tel ?? 'N/A' }}</p>
                @else
                    <p class="small mb-0">Guest order</p>
                @endauth
            </div>
        </div>

        {{-- ボタン --}}
        <div class="d-flex gap-3 justify-content-center mt-4">
            <a href="{{ route('purchased.index') }}" class="btn text-white py-2 px-4 fw-bold" style="background-color: #2c3e50; border-radius: 5px; font-family: serif;">
                <i class="bi bi-clock-history me-2"></i>Purchase History
            </a>
            <a href="{{ route('products.index') }}" class="btn py-2 px-4 fw-bold" style="background-color: transparent; border: 1px solid #2c3e50; color: #2c3e50; border-radius: 5px; font-family: serif;">
                <i class="bi bi-bag me-2"></i>Continue Shopping
            </a>
        </div>

    </div>
</div>
@endsection
