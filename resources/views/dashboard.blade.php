@extends('layouts.app')

@section('title', 'Login')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">

<div class="dashboard-container">
    <h2 class="welcome-text">Welcome, {{ Auth::user()->first_name }}!</h2>
    {{-- reservation --}}
    <div class="dashboard-grid">
        {{-- point illuslate --}}
        {{-- <section class="dashboard-card point-summary-card" style="background: linear-gradient(135deg, #fff5f2 0%, #ffffff 100%);">
            <h3><i class="fa-solid fa-star" style="color: #e2725b;"></i> My Points</h3>
            <div class="card-content" style="text-align: center; padding: 10px 0;">
                <p style="font-size: 2rem; font-weight: bold; color: #e2725b; margin: 0;">
                    {{ number_format($totalPoints) }} <span style="font-size: 1rem;">pts</span>
                </p>
                <small class="text-muted">Available to use for your next order</small>
            </div>
        </section> --}}
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
                </div> 
                <div class="btn-container">
                    <a href="{{ route('reservations.index') }}" class="btn-back">View All Reservations</a>
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
                <a href="/cart" class="btn-back">View Cart</a>
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
                        <a href="{{ route('favorite_restaurants') }}" class="btn-back">View All Restaurants</a>
                    @else
                        <a href="{{ route('favorite_kits') }}" class="btn-back">View All Kits</a>
                    @endif
                </div>
            </div>
        </section>

        {{-- 4. History(visited/purchased) --}}
        <section class="dashboard-card">
            <h3><i class="fa-solid fa-clock-rotate-left"></i> History</h3>
            <div class="card-content">
                <div class="info-area">
                    <form action="{{ route('dashboard') }}" method="GET" id="history-form">
                        <input type="hidden" name="tab" value="{{ request('tab', 'restaurants') }}">

                        <div class="selection-group">
                            <input type="radio" name="tab2" id="show-purchased" value="purchased"
                                {{ request('tab2', 'purchased') == 'purchased' ? 'checked' : '' }}
                                onchange="this.form.submit()">
                            <label for="show-purchased">Purchased</label>

                            <input type="radio" name="tab2" id="show-visited" value="visited"
                                {{ request('tab2') == 'visited' ? 'checked' : '' }}
                                onchange="this.form.submit()">
                            <label for="show-visited">Visits</label>
                        </div>
                    </form>
                    <hr>

                    <div class="row">
                        @if(request('tab2', 'purchased') == 'purchased')
                            {{-- purchased history--}}
                            @forelse ($purchased_items ?? [] as $item)
                                <div class="col-12">
                                    <p>
                                        {{ $item->product->name ?? 'Meal Kit' }}
                                        <small class="text-muted">x{{ $item->quantity }} ({{ $item->created_at }})</small>
                                    </p>
                                </div>
                            @empty
                                <p class="text-muted">No purchase history yet.</p>
                            @endforelse
                        @else
                            {{-- visited list --}}
                            @forelse ($past_reservations ?? [] as $past)
                                <div class="col-12">
                                    <p>
                                        {{ $past->restaurant->restaurant_name ?? 'N/A' }}
                                        <small class="text-muted">({{ $past->reservation_date }})</small>
                                    </p>
                                </div>
                            @empty
                                <p class="text-muted">No past visits yet.</p>
                            @endforelse
                        @endif
                    </div>
                </div>

                <div class="btn-container">
                    @if(request('tab2', 'purchased') == 'purchased')
                        <a href="{{ route('purchased.index') }}" class="btn-back">
                            View All Purchased Kits
                        </a>
                    @else
                        <a href="{{ route('reservations.index') }}" class="btn-back">
                            View All Past Visits
                        </a>
                    @endif
                </div>
            </div>
        </section>

    </div>
</div>
@endsection
