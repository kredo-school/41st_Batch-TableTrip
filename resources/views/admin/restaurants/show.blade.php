@extends('admin.layouts.admin')

@section('title','Restaurant Detail')

@section('content')

<div class="order-wrapper">
    <h2 class="order-title">Restaurant Details</h2>

    <div class="order-content">

        <!-- LEFT -->
        <div class="user-card">

            <div class="user-top">
                <div>
                    @if(strtolower($restaurant->approval_status) === 'approved')
                        <p class="user-id">Restaurant ID #{{ $restaurant->id }}</p>
                    @endif

                    <p class="user-status">
                        <span class="dot {{ strtolower($restaurant->approval_status) }}"></span>
                        {{ ucfirst($restaurant->approval_status) }}
                    </p>
                </div>
            </div>

            <p><span>Restaurant :</span> {{ $restaurant->restaurant_name ?? 'N/A' }}</p>
            <p><span>Category :</span> {{ $restaurant->category->name ?? 'N/A' }}</p>
            <p><span>Opening Hours :</span> {{ $restaurant->opening_hours ?? 'N/A' }}</p>
            <p><span>Reservation Limit :</span> {{ $restaurant->reservation_limit ?? 'N/A' }}</p>

        </div>

        <!-- RIGHT -->
        <div class="order-card restaurant-application-card">

            <p class="order-id">Application ID : <strong>#{{ $restaurant->id }}</strong></p>

            <p class="status-line">
                Status :
                <span class="dot {{ strtolower($restaurant->approval_status) }}"></span>
                {{ ucfirst($restaurant->approval_status) }}
            </p>

            <div class="divider"></div>

            <p><span>Restaurant Name :</span> {{ $restaurant->restaurant_name ?? 'N/A' }}</p>
            <p><span>Email :</span> {{ $restaurant->email ?? 'N/A' }}</p>
            <p><span>Phone Number :</span> {{ $restaurant->phone ?? 'N/A' }}</p>
            <p><span>Prefecture :</span> {{ $restaurant->prefecture ?? 'N/A' }}</p>
            <p><span>City :</span> {{ $restaurant->city ?? 'N/A' }}</p>
            <p><span>Address Line :</span> {{ $restaurant->address_line ?? 'N/A' }}</p>

        </div>
    </div>

    <div class="text-center mt-4 restaurant-action-buttons">
        @if(strtolower($restaurant->approval_status) === 'pending')
            <form action="{{ route('admin.restaurants.approve', $restaurant->id) }}" method="POST" class="d-inline-block">
                @csrf
                <button type="submit" class="action-btn approve-btn">Approve</button>
            </form>

            <form action="{{ route('admin.restaurants.reject', $restaurant->id) }}" method="POST" class="d-inline-block ms-2">
                @csrf
                <button type="submit" class="action-btn reject-btn">Reject</button>
            </form>
        @elseif(strtolower($restaurant->approval_status) === 'approved')
            <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="edit-btn text-decoration-none d-inline-block">
                Edit
            </a>

            <form action="{{ route('admin.restaurants.suspend', $restaurant->id) }}" method="POST" class="d-inline-block ms-2">
                @csrf
                <button type="submit" class="status-action-btn pending-btn">Suspend</button>
            </form>
        @endif
    </div>
</div>

<div class="text-center mt-5">
    <a href="{{ route('admin.restaurants.index') }}" class="back-link">
        Back to list
    </a>
</div>

@endsection