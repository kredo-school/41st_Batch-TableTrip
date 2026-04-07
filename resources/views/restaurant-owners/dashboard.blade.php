@extends('layouts.owner')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto my-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
       
        <div class="col-9">
            {{-- Stat Card --}}
            <div class="row g-3 mb-3">
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card stat-card position-relative">
                        <div class="card-body">
                            <i class="fa-regular fa-calendar stat-icon"></i>
                            <h5 class="card-title">Today's <br> Reservations</h5>
                            <h2 class="text-center">{{ $reservationCount }}</h2>
                       </div>
                   </div>
                </div>
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card stat-card position-relative">
                        <div class="card-body">
                            <i class="fa-solid fa-clipboard-list stat-icon"></i>
                            <h5 class="card-title">Pending <br> Orders</h5>
                            <h2 class="text-center">3</h2>
                       </div>
                   </div>
                </div>
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card stat-card position-relative">
                        <div class="card-body">
                           <i class="fa-regular fa-bell stat-icon"></i>
                            <h5 class="card-title">Unread <br> Notifications</h5>
                            <h2 class="text-center">3</h2>
                       </div>
                   </div>
                </div>
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card stat-card position-relative">
                        <div class="card-body">
                           <i class="fa-regular fa-calendar-plus stat-icon"></i>
                            <h5 class="card-title">New <br> Reservations</h5>
                            <h2 class="text-center">3</h2>
                       </div>
                   </div>
                </div>
            </div>

            {{-- Information cards --}}
            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-6">
                    <div class="card info-card">
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title text-center mt-3 mb-4 text-underline-accent">Upcoming Reservations</h3>       
                                <p class="text-end text-muted">{{  \Carbon\Carbon::today()->format('M d, Y') }}</p>
                                <table class="table align-middle table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Guests</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($todayReservations as $reservation)
                                        <tr onclick="window.location='{{ route('owner.reservations.show', $reservation->id) }}'">
                                            <td> {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</td>
                                            <td>{{ $reservation->number_of_people }}</td>
                                            <td>{{ $reservation->full_name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            <a href="{{ route('owner.reservations') }}" class="ms-auto pe-3 text-dark text-decoration-underline">View all</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card info-card">
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title text-center my-3 text-underline-accent">Latest Orders</h3>
                             <div class="table-wrap mb-3">
                                <table class="table table-borderless align-middle table-hover table-sm">
                                    <thead class="table-middle text-muted">
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Updated At</th>
                                                <th>Status</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendingOrder as $order)
                                            <tr onclick="window.location='{{ route('owner.orders.show', $order->id) }}'" style="cursor:pointer;">
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    @php
                                                    $statusClass = match($order->status){
                                                        'pending' => 'bg-warning',
                                                        'preparing' => 'bg-success',
                                                        'cancelled' => 'bg-danger',
                                                        'shipping' => 'bg-primary',
                                                        'delivered' => 'bg-secondary',
                                                        default => 'bg-light text-dark',
                                                    }
                                                    @endphp
                                                    <span class="badge bg-warning {{ $statusClass }}">{{ $order->status }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('owner.orders') }}" class="ms-auto pe-3 text-dark text-decoration-underline">View all</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-2 text-underline-accent">This Week Revenue </h3>
                             <p class="fs-3 text-center font-sen"> $12,800 <span class="text-danger ps-3">+12%</span> from last week</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-underline-accent">Top Selling</h3>
                             <p class="fs-3 text-center font-sen">Teriyaki Chicken <span class="text-danger ps-3">32</span>orders</p>
                        </div>
                    </div>
                </div>
            </div>
           
    </div>

</div>
@endsection