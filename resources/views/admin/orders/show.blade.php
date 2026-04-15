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
                    <p class="user-status"><span class="dot"></span> Active</p>
                </div>
            </div>

            <p>
                <span class="detail-label">User :</span>
                <span class="detail-value">{{ $order->user->name ?? 'Alex Farrara' }}</span>
            </p>

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

        <!-- RIGHT -->
        <div class="order-card">

            <p class="order-id">
                Order ID : <strong>#{{ $order->id }}</strong>
            </p>

            <p class="status-line">
                Status :
                <span class="dot
                    @if($order->status === 'pending') pending-dot
                    @elseif($order->status === 'shipped') yellow
                    @elseif($order->status === 'delivered') delivered-dot
                    @elseif($order->status === 'canceled') canceled-dot
                    @elseif($order->status === 'refunded') refunded-dot
                    @endif
                "></span>
                {{ ucfirst($order->status) }}
            </p>

            <p class="date">
                {{ $order->created_at ? $order->created_at->format('d / m / Y') : '15 / 02 / 2026' }}
            </p>

            <p class="restaurant">
                Restaurant :
                {{ $order->restaurant->restaurant_name ?? 'Bistro Lapin' }}
            </p>

            <div class="divider"></div>

            <p class="items-title">📦 ITEMS</p>

            <div class="item-row">
                <span>Journey kit A × 1</span>
                <span>¥3,000</span>
            </div>

            <div class="item-row">
                <span>Journey kit B × 1</span>
                <span>¥3,400</span>
            </div>

            <div class="divider"></div>

            <div class="price-row">
                <span>Subtotal</span>
                <span>¥6,400</span>
            </div>

            <div class="price-row">
                <span>Welcome coupon (10% off)</span>
                <span>▲¥640</span>
            </div>

            <div class="price-row">
                <span>Shipping</span>
                <span>¥440</span>
            </div>

            <div class="divider"></div>

            <div class="total">
                TOTAL : ¥6,200
            </div>

            <p class="points">Earned Points : 64pt</p>

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