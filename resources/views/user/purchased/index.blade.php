@extends('layouts.app')
@section('title','Activity History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/history.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

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

        {{-- ■ A. Orders  --}}
        <div class="section-orders">
            <h2 class="sub-title"><i class="fa-solid fa-bag-shopping me-2"></i>Order History</h2>
            <div class="table-wrapper">
                <table class="history-table"> 
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Restaurant</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Date</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($purchased ?? [] as $item)
                            <tr>
                                {{-- 1. Product --}}
                                <td><strong>{{ $item->product->name ?? 'N/A' }}</strong></td>
                                
                                {{-- 2. Restaurant --}}
                                <td>{{ $item->product->restaurant_name ?? 'N/A' }}</td>
                                
                                {{-- 3. Price --}}
                                <td>¥{{ number_format((int)$item->getRawOriginal('price_at_purchased')) }}</td>
                                
                                {{-- 4. Qty --}}
                                <td>{{ $item->quantity }}</td>
                                
                                {{-- 5. Subtotal  --}}
                                <td>¥{{ number_format((int)$item->getRawOriginal('price_at_purchased') * (int)$item->quantity) }}</td>
                                
                                {{-- 6. Date--}}
                                <td>{{ $item->ordered_at ? $item->ordered_at->format('d/m/y') : 'N/A' }}</td>
                                
                                {{-- 7. Review --}}
                                <td>
                                    @if(isset($item->product_id))
                                        <i class="fa-solid fa-comment-dots" style="color: #e2725b; cursor:pointer;"></i>
                                        <a href="{{ route('products.reviews', $item->product_id) }}">Reviews</a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="no-data">No purchase history yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn-back">
                    <i class="bi bi-bag me-2"></i>Continue Shopping
                </a>
            </div>
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
                                <th style="width: 160px;">Manage</th>
                            </tr>
                        </thead>
                        <tbody>         
                            @forelse($upcoming_reservations ?? [] as $res)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/y') }} 
                                        {{ \Carbon\Carbon::parse($res->reservation_time)->format('H:i') }}
                                    </td>
                                    <td><strong>{{ $res->restaurant->name ?? 'N/A' }}</strong></td>
                                    <td>{{ $res->number_of_people }}</td>
                                    <td>
                                        <div class="manage-action-group" style="display: flex; gap: 15px; justify-content: center; align-items: center;">
                                            <a href="{{ route('user.inquiry.create', ['restaurant_id' => $res->restaurant_id, 'reservation_id' => $res->id]) }}" class="btn-inquiry-icon" title="Contact"><i class="fa-solid fa-envelope"></i></a>
                                            <a href="{{ route('user.reservations.edit', $res->id) }}" class="btn-edit-icon" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('user.reservations.destroy', $res->id) }}" method="POST" style="margin: 0;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-cancel-icon" onclick="return confirm('Cancel?')" style="background:none; border:none; color:#999;"><i class="fa-solid fa-calendar-xmark"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="no-data-cell">No upcoming reservation yet</td></tr>
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
                                <th>Guest</th>
                                <th>Status</th>
                                <th>Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($past_reservations ?? [] as $res)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/y') }} {{ \Carbon\Carbon::parse($res->reservation_time)->format('H:i') }}</td>
                                    <td><strong>{{ $res->restaurant->restaurant_name ?? 'N/A' }}</strong></td>
                                    <td>{{ $res->number_of_people }}</td>
                                    <td>Visited</td>
                                    <td><i class="fa-solid fa-comment-dots" style="color: #e2725b; cursor:pointer;"></i><a href="{{ route('restaurant', $res->restaurant_id) }}">Reviews</a></td>
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