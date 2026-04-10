@extends('layouts.app')
@section('title','Activity History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/reservation.css') }}">

<div class="history-container py-5 text-center">
    <h1 class="history-title mb-4">
        <i class="fa-solid fa-clock-history me-2"></i>Activity History
    </h1>

    <div class="main-selection-wrapper">
        <input type="radio" name="main-category" id="main-orders" checked>
        <input type="radio" name="main-category" id="main-reservations">

        <div class="main-tab-group mb-5">
            <label for="main-orders" class="main-category-label">Orders</label>
            <label for="main-reservations" class="main-category-label">Reservations</label>
        </div>

        {{-- ■ A. Orders --}}
        <div class="section-orders">
            <h2 class="sub-title">Order History</h2>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchased ?? [] as $order)
                        <tr>
                            <td>{{ $order->ordered_at->format('d/m/y') }}</td>
                            <td><strong>{{ $order->meal_kit->name ?? 'Meal Kit' }}</strong></td>
                            <td>{{ $order->quantity }}</td>
                            <td>¥{{ number_format($order->total_price) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="no-data">No order history found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ■ B. Reservations  --}}
        <div class="section-reservations">
            <div class="sub-selection-wrapper">
                <input type="radio" name="history-tab" id="tab-upcoming" checked>
                <input type="radio" name="history-tab" id="tab-past">

                <div class="tab-labels-container">
                    <label for="tab-upcoming" class="tab-label">Upcoming</label>
                    <label for="tab-past" class="tab-label">Past Visits</label>
                </div>

                <hr class="separator-line">

                {{-- 1. Upcoming Table --}}
                <div class="content-upcoming">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Date / Time</th>
                                <th>Restaurant</th>
                                <th>People</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($upcoming_reservations ?? [] as $res)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/y') }} {{ \Carbon\Carbon::parse($res->reservation_time)->format('H:i') }}</td>
                                    <td><strong>{{ $res->restaurant->name }}</strong></td>
                                    <td>{{ $res->number_of_people }}</td>
                                    <td>
                                        <form action="#" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-delete-link" onclick="return confirm('Cancel?')">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="no-data">No upcoming reservations found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- 2. Past Table --}}
                <div class="content-past">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Date / Time</th>
                                <th>Restaurant</th>
                                <th>Status</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($past_reservations ?? [] as $res)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/y') }} {{ \Carbon\Carbon::parse($res->reservation_time)->format('H:i') }}</td>
                                    <td><strong>{{ $res->restaurant->name }}</strong></td>
                                    <td>Visited</td>
                                    <td><i class="fa-solid fa-comment-dots" style="color: #e2725b; cursor:pointer;"></i></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="no-data">No past visits found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <a href="{{ route('dashboard') }}" class="btn-dashboard-back">
            <i class="fa-solid fa-house me-2"></i>Back to Dashboard
        </a>
    </div>
</div>
@endsection
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
