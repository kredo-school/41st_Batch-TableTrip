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
                                <td>{{ $reservation->restaurant->restaurant_name ?? 'N/A' }}</td>
                                {{-- guests --}}
                                <td>{{ $reservation->number_of_people }}</td>
                                <td class="edit-icons">
                                    <a href="{{ route('user.reservations.edit',$reservation->id) }}" class="">
                                        <i class="fa-regular fa-calendar-check"></i>
                                    </a>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center; padding:20px;">No Reservations yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div> 
                <div class="btn-container">
                    <a href="{{ route('user.reservations.index') }}" class="btn-back">View All Reservations</a>
                </div>
        </section>

       {{-- cart part --}}
        <section class="dashboard-card cart-summary-card">
            <h3><i class="fa-solid fa-cart-shopping"></i>Cart</h3>
            <div class="card-content">
                <div class="item-grid">
                    @forelse (array_slice($cart ?? [], 0, 2) as $id => $item)
                        @php $product = (object) $item['product']; @endphp
                        <div class="cart-mini-item">
                            <div class="mini-info">
                                <p class="mini-name"><b>{{ $product->name ?? 'Unknown' }}</b></p>
                                <p class="mini-price">¥{{ number_format($product->price ?? 0) }} (x{{ $item['quantity'] }})</p>
                            </div>
                        </div>
                    @empty
                        <p class="empty-msg">No items in cart</p>
                    @endforelse
                </div>

                @if(count($cart ?? []) > 0)
                    <div class="cart-total-brief">
                        <p>Total: <span>¥{{ number_format($totalPrice) }}</span></p>
                    </div>
                @endif
            </div>
            <div class="btn-container">
                <a href="{{ route('cart.index') }}" class="btn-back">View Cart</a>
            </div>
        </section>

       {{-- 3. Favorite --}}
    <section class="dashboard-card">
        <h3><i class="fa-solid fa-heart"></i> Favorite Kits</h3>
        <div class="card-content">
            <div class="info-area">
                <div class="row">
                    @forelse ($favorite_kits ?? [] as $kit)
                        <div class="col-12 d-flex justify-content-between align-items-center mb-2">
                            <p class="mb-0">{{ $kit->name ?? 'N/A' }}</p>
                        </div>
                    @empty
                        <p class="text-muted">No favorite kits yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ route('user.favorite_kits') }}" class="btn-back">View All Kits</a>
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
                                        <small class="text-muted">x{{ $item->quantity }} ({{ $item->ordered_at }})</small>
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
                        <a href="{{ route('purchased.index') }}" class="btn-back">
                            View All Past Visits
                        </a>
                    @endif
                </div>
            </div>
        
        </section>

    </div>
</div>
@endsection
