@extends('layouts.app')
@section('title', 'Purchase History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="reservation-list-container">
    <h2 class="list-title">
        <i class="fa-solid fa-bag-shopping me-2"></i>Purchase History
    </h2>

    <div class="table-wrapper">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Restaurant</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchased as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                        <td>{{ $item->product->restaurant_name ?? 'N/A' }}</td>
                        <td>¥{{ number_format($item->price_at_purchased) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>¥{{ number_format($item->price_at_purchased * $item->quantity) }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->ordered_at)->format('Y/m/d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:20px;">No purchase history yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="btn-container">
        <a href="{{ route('products.index') }}" class="btn-back">
            <i class="bi bi-bag me-2"></i>Continue Shopping
        </a>
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-house"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection
