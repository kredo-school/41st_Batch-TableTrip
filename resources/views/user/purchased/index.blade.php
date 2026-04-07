@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="history-container py-5">
    <h1 class="history-title">
        <i class="bi bi-bag-check me-2"></i>Purchase History
    </h1>

    <table class="history-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Product</th>
                <th>Restaurant</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($purchased as $item)
                <tr>
                    <td>{{ $item->ordered_at->format('Y/m/d') }}</td>
                    <td>{{ $item->meal_kit->name ?? 'N/A' }}</td>
                    <td>{{ $item->meal_kit->restaurant->name ?? 'Restaurant' }}</td>
                    <td>{{ number_format($item->meal_kit->price ?? 0) }}円</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->total_price) }}円</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-5">No purchase history yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="btn-back-container">
        <a href="{{ route('dashboard') }}" class="btn-back-custom">
            <i class="bi bi-house-door-fill me-2"></i>Back to Dashboard
        </a>
    </div>
</div>
@endsection