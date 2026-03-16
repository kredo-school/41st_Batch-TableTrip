@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="cart-list-container">
    <div class="list-title">
        <i class="fas fa-shopping-cart"></i> Cart
    </div>

    <div class="cart-main-wrapper">
        @php $totalSum = 0; @endphp
        
        @forelse ($cart_items as $item)
            @php 
                $itemPrice = $item->product->price ?? 0;
                $totalSum += $itemPrice * $item->quantity; 
            @endphp
            <div class="cart-item">
                <div class="item-info">
                    <div class="product-header">
                        <h2 class="product-name">{{ $item->product->name ?? 'Product Name' }}</h2>
                        <p class="restaurant-name">at {{ $item->product->restaurant->name ?? 'Restaurant' }}</p>
                    </div>

                    <div class="input-group">
                        <label>Quantity:</label>
                        <input type="number" class="qty-input" value="{{ $item->quantity }}" min="1">
                        <p class="price-display">
                            ¥ <span class="unit-price">{{ number_format($itemPrice) }}</span>
                        </p>
                    </div>

                    <div class="action-buttons">
                        <button class="btn-later">Buy Later</button>
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-icon">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="item-image">
                    @if($item->product->image)
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="product-image">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" alt="no-image">
                    @endif
                </div>
            </div>
        @empty
            <p style="text-align: center; padding: 50px;">Your cart is empty.</p>
        @endforelse

        @if($cart_items->count() > 0)
            <div class="cart-footer">
                <p class="total-text">Total Amount: <span class="currency">¥</span> <span id="total-sum">{{ number_format($totalSum) }}</span></p>
                <button class="btn-checkout">Proceed to Checkout</button>
            </div>
        @endif
    </div>

    <div class="btn-container">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-house"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection