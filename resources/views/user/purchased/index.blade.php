@extends('layouts.app')
@section('title','History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/reservation.css') }}">

<div class="history-container py-5 text-center">
    <h1 class="history-title mb-4">
        <i class="fa-solid fa-clock-history me-2"></i>Activity History
    </h1>

    {{--：Orders vs Reservations --}}
    <div class="main-selection-wrapper">
        <input type="radio" name="main-category" id="main-orders" checked>
        <input type="radio" name="main-category" id="main-reservations">

        <div class="main-tab-group mb-5">
            <label for="main-orders" class="main-category-label">Orders</label>
            <label for="main-reservations" class="main-category-label">Reservations</label>
        </div>

        {{-- --- A. Orders  --- --}}
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
                        <tr><td colspan="4" class="py-5 text-muted">No order history found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- --- B. Reservations  --- --}}
        <div class="section-reservations">
            <div class="sub-selection-wrapper">
                <input type="radio" name="history-tab" id="tab-upcoming" checked>
                <input type="radio" name="history-tab" id="tab-past">

                <div class="tab-labels-container">
                    <label for="tab-upcoming" class="tab-label">Upcoming</label>
                    <label for="tab-past" class="tab-label">Past Visits</label>
                </div>

                <hr class="my-4">

                {{-- 1. Upcoming Table --}}
                <div class="content-upcoming">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Date / Time</th>
                                <th>Restaurant</th>
                                <th>People</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($upcoming_reservations ?? [] as $res)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/y') }} {{ $res->reservation_time }}</td>
                                    <td><strong>{{ $res->restaurant->name }}</strong></td>
                                    <td>{{ $res->number_of_people }}</td>
                                    <td class="text-primary">Confirmed</td>
                                    <td>
                                        <form action="#" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-link-delete" onclick="return confirm('Cancel?')">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="py-5 text-muted">No upcoming reservations found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- 2. Past Table --}}
                <div class="content-past">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Restaurant</th>
                                <th>Status</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($past_reservations ?? [] as $res)
                                <tr class="past-row">
                                    <td>{{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/y') }}</td>
                                    <td>{{ $res->restaurant->name }}</td>
                                    <td>Visited</td>
                                    <td><i class="fa-solid fa-comment-dots fs-5" style="color: #e2725b; cursor:pointer;"></i></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="py-5 text-muted">No past visits found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <a href="{{ route('dashboard') }}" class="btn-back-custom">
            <i class="fa-solid fa-house me-2"></i>Back to Dashboard
        </a>
    </div>
</div>
@endsection