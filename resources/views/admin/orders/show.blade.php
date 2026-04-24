@extends('admin.layouts.admin')

@section('title','Order Detail')

@section('content')

<div class="order-wrapper">
    <h2 class="order-title">Order Details</h2>

    <div class="order-content">

        <!-- LEFT -->
        <div class="user-card">

            <div class="user-top">
                <div class="user-icon">👤</div>
                <div>
                    <p class="user-id">User ID #{{ $order->user->id ?? '2001' }}</p>
                    @php
                        $status = strtolower($order->user->status ?? 'active');
                    @endphp

                    <p class="user-status">
                        <span class="dot {{ $status }}"></span>
                        {{ ucfirst($status) }}
                    </p>
                </div>
            </div>

           <span class="detail-value">
                {{ trim(($order->user->first_name ?? '') . ' ' . ($order->user->last_name ?? '')) 
                    ?: ($order->user->user_name ?? '—') }}
            </span>

            <p>
                <span class="detail-label">Membership Rank :</span>
                <span class="detail-value">{{ $order->user->rank ?? 'N/A' }}</span>
            </p>

            <p>
                <span class="detail-label">Total Points :</span>
                <span class="detail-value">64pt</span>
            </p>

            <p>
                <span class="detail-label">Credit Card :</span>
                <span class="detail-value">xxxx-xxxx-0005</span>
            </p>

            <p class="section-title">Address :</p>
            <p class="sub detail-value">
                {{ $order->user->address }}<br>
                {{ $order->user->postal_code }}
            </p>

            <p class="section-title">Shipping Address :</p>
            <p class="sub detail-value">
                1-1-1 Umeda Kita-ku, Osaka<br>
                530-0001
            </p>

            <p>
                <span class="detail-label">Phone :</span>
                <span class="detail-value">{{ $order->user->tel }}</span>
            </p>

            <p>
                <span class="detail-label">Email :</span>
                <span class="detail-value">{{ $order->user->email }}</span>
            </p>

        </div>

        <div class="order-card">

            <div class="detail-row">
                <span class="detail-label">Order ID</span>
                <span class="detail-value">#{{ $order->id }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value">{{ ucfirst($order->status ?? 'pending') }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Date</span>
                <span class="detail-value">
                    {{ $order->created_at ? $order->created_at->format('d / m / Y') : '-' }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Restaurant</span>
                <span class="detail-value">
                    {{ $order->restaurant->restaurant_name ?? '-' }}
                </span>
            </div>

            <div class="divider"></div>

            <p class="items-title">📦 ITEMS</p>

            @forelse($order->items as $item)
                <div class="item-row">
                    <span>{{ $item->product->name ?? 'Item' }} × {{ $item->quantity ?? 1 }}</span>
                    <span>¥{{ number_format($item->price_at_purchased ?? 0) }}</span>
                </div>
            @empty
                <div class="item-row">
                    <span>No items yet</span>
                    <span>—</span>
                </div>
            @endforelse

            <div class="divider"></div>

            <div class="price-row">
                <span>Subtotal</span>
                <span>
                    ¥{{ number_format($order->items->sum(fn($item) => ($item->price_at_purchased ?? 0) * ($item->quantity ?? 1))) }}
                </span>
            </div>

            <div class="price-row">
                <span>Shipping</span>
                <span>¥440</span>
            </div>

            <div class="divider"></div>

            <div class="total">
                TOTAL : ¥{{ number_format($order->total_price ?? 0) }}
            </div>

            <p class="points">
                Earned Points : {{ floor(($order->total_price ?? 0) / 100) }}pt
            </p>

        </div>
    </div>
            @php
            $status = strtolower(trim($order->status ?? ''));
            @endphp

            <div class="text-center mt-4 order-action-buttons">
                @if($status === 'pending')
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        <input type="hidden" name="status" value="shipped">
                        <button type="submit" class="action-btn shipped-btn">Shipped</button>
                    </form>

                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        <input type="hidden" name="status" value="canceled">
                        <button type="submit" class="action-btn canceled-btn">Canceled</button>
                    </form>
                @elseif($status === 'shipped')
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        <input type="hidden" name="status" value="delivered">
                        <button type="submit" class="action-btn delivered-btn">Delivered</button>
                    </form>
                @elseif($status === 'delivered')
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        <input type="hidden" name="status" value="refunded">
                        <button type="submit" class="action-btn refunded-btn">Refunded</button>
                    </form>
                @endif
            </div>

</div>
<div class="text-center mt-5">
    <a href="{{ route('admin.orders.index') }}" class="back-link">
        Back to list
    </a>
</div>

@endsection