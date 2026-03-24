@extends('layouts.app')

@section('title', 'Purchased History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container py-5 d-flex flex-column align-items-center">
    
    
    <div class="card purchase-card p-4 shadow-sm">
        
        <div class="text-center mb-4">
            <h2 class="purchase-header">
                <i class="bi bi-bag-fill me-2"></i>Purchased
            </h2>
        </div>

        <div class="purchase-list-container">
            @forelse($purchased as $item)
                <div class="purchase-item">
                   
                        <div class="item-date">{{ \Carbon\Carbon::parse($item->ordered_at)->format('d/m/y') }}</div>
                        <div class="item-status">$shipsituation</div>
                        
                        <div class="row align-items-center">
                            <div class="col-sm-7">
                                <div class="product-name">$products</div>
                                <div class="restaurant-name">$restaurant</div>
                            </div>
                            <div class="col-sm-5 item-details">
                                <div>Quantity: {{ $item->quantity }}</div>
                                <div>Price: {{ number_format($item->price_at_purchased) }}円</div>
                                <div class="mt-2 d-flex gap-3">
                                    <i class="bi bi-chat-dots fs-5" style="cursor: pointer;"></i>
                                    <i class="bi bi-cart-plus fs-5" style="cursor: pointer;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                    <div class="item-image d-none d-md-block">
                        <img src="{{ asset('images/sample_kit.jpg') }}" alt="Product Image">
                    </div>
                </div>
            @empty
                <div class="p-5 text-center text-muted">
                    No purchase history found.
                </div>
            @endforelse
        </div>

       
        <div class="text-center mt-4">
            <button class="btn btn-review-history">Review History</button>
        </div>
        <div class="btn-container">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-house"></i> Back to Dashboard
        </a>
        </div>

    </div>

   
    
</div>
@endsection