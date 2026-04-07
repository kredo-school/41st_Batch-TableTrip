@extends('admin.layouts.admin')

@section('title','Reservation Detail')

@section('content')

<div class="order-wrapper">
    <h2 class="order-title">Reservation Details</h2>

    <div class="order-content">

        <!-- LEFT -->
        <div class="user-card">

            <div class="user-top">
                <div class="user-icon">👤</div>
                <div>
                    <p class="user-id">User ID #{{ $reservation->user->id ?? '2001' }}</p>
                    <p class="user-status"><span class="dot"></span> Active</p>
                </div>
            </div>

            <p><span>User :</span> 
                {{ optional($reservation->user)->first_name }} 
                {{ optional($reservation->user)->last_name }}
            </p>
            <p><span>Membership Rank :</span> {{ optional($reservation->user)->rank }}</p>

            <p class="sub">
                {{ optional($reservation->user)->address }}<br>
                {{ optional($reservation->user)->postal_code }}
            </p>

            <p><span>Phone :</span> {{ optional($reservation->user)->tel }}</p>
            <p><span>Email :</span> {{ optional($reservation->user)->email }}</p>

        </div>


        <!-- RIGHT -->
        <div class="order-card">

            <p class="order-id">
                Reservation ID : <strong>#{{ $reservation->id }}</strong>
            </p>

            <p class="status-line">
                Status : 
                <span class="dot orange {{ $reservation->status }}"></span>
                {{ ucfirst($reservation->status ?? 'reserved') }}
            </p>

            <p class="date">
                {{ $reservation->reservation_date }}
            </p>

            <p>
                Time : {{ $reservation->reservation_time }}
            </p>

            <p>
                Number of People : {{ $reservation->number_of_people }}
            </p>

            <p>
                Restaurant : {{ $reservation->restaurant->name ?? '' }}
            </p>

            <div class="divider"></div>

        <div class="text-center mt-4">
            <button class="edit-btn">Edit</button>
        </div>
        </div> 
    </div>
</div>

<div class="text-center mt-5">
    <a href="{{ route('admin.reservations.index') }}" class="back-link">
    Back to list
    </a>
</div>

@endsection