@extends('layouts.app')

@section('title', 'Login')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">

<div class="dashboard-container">
    <h2 class="welcome-text">Welcome, {{ Auth::user()->first_name }}!</h2>
    {{-- reservation --}}
    <div class="dashboard-grid">
        <section class="dashboard-card">
            <h3><i class="fa-regular fa-calendar-check"></i> Reservation</h3>
            <div class="card-content">
                <table class="table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Restaurants</th>
                            <th>Location</th>
                            <th>Map</th>
                            <th>Guests</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latest_reservations as $reservation)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('y-n-j') }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</td>
                                {{-- restaurant name --}}
                                <td>{{ $reservation->restaurant->name ?? 'N/A' }}</td>
                                {{-- location--}}
                                <td>{{ $reservation->restaurant->location ?? 'N/A' }}</td>
                                {{-- Map icon --}}
                                <td><i class="fa-solid fa-location-dot" style="color: #e2725b;"></i></td>
                                {{-- guests --}}
                                <td>{{ $reservation->number_of_guests }}</td>
                                <td class="edit-icons">
                                    <a href="{{ route('reservation.edit',$reservation->id) }}" class="">
                                        <i class="fa-regular fa-calender-check"></i>
                                    </a>
                                    <i class="fa-solid fa-user" style="margin-left:5px;"></i>
                                    <i class="fa-solid fa-rotate-left" style="margin-left:5px;"></i>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center; padding:20px;">No Reservations yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <a href="{{ route('reservations.index') }}" class="view-all">View All</a>
            </div>
        </section>
        {{-- cart part --}}
        <section class="dashboard-card cart-summary-card">
            <h3><i class="fa-solid fa-cart-shopping"></i>Cart</h3>
            <div class="card-content">
                <div class="item-grid">
                    @forelse ($cart_items->take(2) as $item)
                        <div class="cart-mini-item">
                            <div class="mini-img">
                                <img src="#" alt="" >
                            </div>
                            <div class="mini-info">
                                <p class="mini-name">{{ $item->product->name ?? 'Unknown' }}</p>
                                <p class="mini-price">{{ number_format($item->product->price ?? 0) }} (x{{ $item->quantity }})</p>
                            </div>
                        </div>
                    @empty
                        <p class="empty-msg">No items in cart</p>
                    @endforelse
                </div>
                @if($cart_items->isNotEmpty())
                    <div class="cart-total-brief">
                        <p>Total: <span>{{ number_format($totalPrice) }}</span></p>
                    </div>
                @endif
            </div>
            <div class="btn-container">
                <a href="{{ route('user.cart') }}" class="btn-back">View Cart</a>
            </div>
        </section>

        {{-- 3. Favorite --}}
        <section class="dashboard-card">
            <h3><i class="fa-solid fa-heart"></i> Favorite</h3>
            <div class="card-content">
                <div class="info-area">

                    <form action="{{ route('dashboard') }}" method="GET" id="fav-form">
                        <div class="selection-group">
                            <input type="radio" name="tab" id="show-restaurants" value="restaurants"
                                {{ request('tab', 'restaurants') == 'restaurants' ? 'checked' : '' }}
                                onchange="this.form.submit()">
                            <label for="show-restaurants">Restaurants</label>

                            <input type="radio" name="tab" id="show-products" value="products"
                                {{ request('tab') == 'products' ? 'checked' : '' }}
                                onchange="this.form.submit()">
                            <label for="show-products">Kits</label>
                        </div>
                    </form>
                    <hr>

                    <div class="row">
                        @if(request('tab', 'restaurants') == 'restaurants')
                            @forelse ($favoriterestaurants ?? [] as $restaurant)
                                <div class="col-12">
                                    <p>{{ $restaurant->name ?? $restaurant->restaurant_name }}</p>
                                </div>
                            @empty
                                <p class="text-muted">No favorite restaurants yet.</p>
                            @endforelse
                        @else
                            @forelse ($favoritekits ?? [] as $kit)
                                <div class="col-12">
                                    <p>{{ $kit->product->name ?? 'N/A' }}</p>
                                </div>
                            @empty
                                <p class="text-muted">No favorite kits yet.</p>
                            @endforelse
                        @endif
                    </div>
                </div>

                <div class="btn-container">
                    @if(request('tab', 'restaurants') == 'restaurants')
                        <a href="{{ route('favoriterestaurants') }}" class="btn-back">View All Restaurants</a>
                    @else
                        <a href="{{ route('favoritekits') }}" class="btn-back">View All Kits</a>
                    @endif
                </div>
            </div>
        </section>

        {{-- 4. Purchased --}}
        <section class="dashboard-card">
            <h3><i class="fa-solid fa-bag-shopping"></i> Purchased</h3>
            <div class="card-content">
            </div>
        </section>
    </div>
</div>
@endsection
