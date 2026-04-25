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
        <h3><i class="fa-regular fa-calendar-check"></i> Upcoming Reservations</h3>
        <div class="card-content">
            <table class="table-sm">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Restaurant</th>
                        <th>Guests</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Show only top 2 items --}}
                    @forelse ($latest_reservations->take(2) as $reservation)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</td>
                            <td>{{ $reservation->restaurant->restaurant_name ?? 'N/A' }}</td>
                            <td>{{ $reservation->number_of_people }}</td>
                            <td class="edit-icons">
                                <a href="{{ route('user.reservations.edit', $reservation->id) }}">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:20px;">No upcoming reservations yet.</td>
                        </tr>
                    @endforelse

                    {{-- Logic for remaining reservations --}}
                    @if($latest_reservations->count() > 2)
                        <tr>
                            <td colspan="5" style="text-align:center; color: #6c757d; font-size: 0.85rem; padding: 10px 0;">
                                + {{ $latest_reservations->count() - 2 }} other reservation(s)
                            </td>
                        </tr>
                    @endif
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
                @forelse (collect($cart)->take(2) as $id => $item)
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

                {{-- more than three carts --}}
                @if(count($cart ?? []) > 2)
                    <p class="text-muted small mt-2">+ {{ count($cart) - 2 }} others</p>
                @endif
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
                    @forelse ($favorite_kits->take(3) ?? [] as $kit)
                        <div class="col-12 d-flex justify-content-between align-items-center mb-2">
                            <p class="mb-0">{{ $kit->name ?? 'N/A' }}</p>
                        </div>
                    @empty
                        <p class="text-muted">No favorite kits yet.</p>
                    @endforelse

                    {{-- more than 4 favorites--}}
                    @if($favorite_kits->count() > 3)
                        <div class="col-12">
                            <p class="text-muted small">+ {{ $favorite_kits->count() - 3 }} others</p>
                        </div>
                    @endif
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
                            {{-- purchased history --}}
                            <div class="col-12">
                                @forelse ($purchased_items ?? [] as $item)
                                    <div class="mb-2">
                                        <p class="mb-0">
                                            <strong>{{ $item->product->name ?? 'Meal Kit' }}</strong>
                                            <small class="text-muted ms-2">x{{ $item->quantity }} ({{ $item->ordered_at ? $item->ordered_at->format('Y/m/d') : '-' }})</small>
                                        </p>
                                    </div>
                                @empty
                                    <p class="text-muted">No purchase history yet.</p>
                                @endforelse
                            </div>
                        @else
                            {{-- visited list (Table format) --}}
                            <div class="col-12">
                                <table class="table table-sm table-borderless align-middle">
                                    <thead class="text-muted small">
                                        <tr>
                                            <th>Date</th>
                                            <th>Restaurant</th>
                                            <th class="text-end">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($past_reservations ?? [] as $past)
                                            <tr>
                                                <td class="small text-nowrap">
                                                    {{ \Carbon\Carbon::parse($past->reservation_date)->format('M d, Y') }}
                                                </td>
                                                <td>
                                                    <div class="fw-bold" style="font-size: 0.85rem;">
                                                        {{ $past->restaurant->restaurant_name ?? 'N/A' }}
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    @if($past->status === 'completed')
                                                        <span class="badge rounded-pill bg-success-subtle text-success" style="font-size: 0.7rem;">Visited</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-light text-dark" style="font-size: 0.7rem;">{{ $past->status_label }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">No past visits yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
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
