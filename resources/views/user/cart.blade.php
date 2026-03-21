@extends('layouts.app')
@section('title','Cart Lists')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="reservation-list-container">
    <h2 class="list-title">
        <i class="fa-solid fa-cart-shopping"></i>Cart lists
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
                    <th>Edit</th>
                </tr>
            </thead>
            
            <tbody>
                @forelse ($cart_items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                        <td>{{ $item->product->restaurant->name ?? 'N/A' }}</td>
                        <td>¥{{ number_format($item->product->price ?? 0) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>¥{{ number_format(($item->product->price ?? 0) * $item->quantity) }}</td>
                        <td class="edit-icons">
                            <a href="#"><i class="fa-regular fa-clock"></i></a>
                            
                            <form action="{{ route('user.cart_destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;">
                                    <i class="fa-regular fa-calendar-xmark" style="color: #4a6b8a;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">No items in cart yet</td>
                    </tr>
                @endforelse
                
                @if($cart_items->isNotEmpty())
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: bold; background-color: #f7f5f0;">Total</td>
                        <td colspan="2" style="font-weight: bold;">¥{{ number_format($totalPrice) }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    @if($cart_items->isNotEmpty())
        <div class="btn-container">
            <a href="{{ route('payment.index') }}" class="btn-back" style="background-color: #61c0a2; color: white; border: none;">
                Check Out
            </a>
        </div>
    @endif

    <div class="btn-container">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-house"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection