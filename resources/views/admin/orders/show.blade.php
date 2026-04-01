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

            <p><span>User :</span> {{ $order->user->name ?? 'Alex Farrara' }}</p>
            <p><span>Membership Rank :</span> {{ $order->user->rank }}</p>
            <p><span>Total Points :</span> 64pt</p>
            <p><span>Credit Card :</span> xxxx-xxxx-0005</p>

            <p class="section-title">Address :</p>
            <p class="sub">
                {{ $order->user->address }}<br>
                {{ $order->user->postal_code }}
            </p>

            <p class="section-title">Shipping Address :</p>
            <p class="sub">1-1-1 Umeda Kita-ku, Osaka<br>530-0001</p>

            <p><span>Phone :</span>  {{ $order->user->tel }}</p>
            <p><span>Email :</span> {{ $order->user->email }}</p>

        </div>


        <!-- RIGHT -->
        <div class="order-card">

            <p class="order-id">Order ID : <strong>#{{ $order->id }}</strong></p>

            <p class="status-line">
                Status : <span class="dot yellow"></span> Shipped
            </p>

            <p class="date">15 / 02 / 2026</p>

            <p class="restaurant">Restaurant : Bistro Lapin</p>

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

        <div class="text-center mt-4">
            <button class="edit-btn">Edit</button>
        </div>
    </div>
</div>

<div class="text-center mt-5">
    <a href="{{ route('admin.orders.index') }}" class="back-link">
    Back to list
    </a>
</div>

@endsection