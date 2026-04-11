@extends('layouts.owner')

@section('title', 'Dashboard')

@section('content')
<div class=" m-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
       
        <div class="col-9">
                <h1 class="text-underline-accent mb-4">Dashboard -{{ $restaurant->restaurant_name }}-</h1>
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
                            <h2 class="text-center">{{ $pendingOrders }}</h2>
                       </div>
                   </div>
                </div>
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card stat-card position-relative">
                        <div class="card-body">
                           <i class="fa-regular fa-bell stat-icon"></i>
                            <h5 class="card-title">Unread <br> Notifications</h5>
                            <h2 class="text-center">{{ $notificationCount }}</h2>
                       </div>
                   </div>
                </div>
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card stat-card position-relative">
                        <div class="card-body">
                           <i class="fa-regular fa-calendar-plus stat-icon"></i>
                            <h5 class="card-title">Pending <br> Reservations</h5>
                            <h2 class="text-center">{{ $pendingReservations }}</h2>
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
                                <table class="table align-middle table-hover text-center table-middle table-sm table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Guests</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @forelse ($todayReservations as $reservation)
                                        <tr onclick="window.location='{{ route('owner.reservations.show', $reservation->id) }}'">
                                            <td> {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</td>
                                            <td>{{ $reservation->number_of_people }}</td>
                                            <td>{{ $reservation->full_name }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">No reservations for today.</td>
                                        </tr>
                                        @endforelse
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
                             <div class="table-wrap mb-3 w-75">
                                <table class="table align-middle table-hover table-sm text-center table-borderless">
                                    <thead class="table-middle text-muted">
                                        <tr>
                                            <th>Order _id</th>
                                            <th>ordered at</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('M j, h:i ') }}</td>
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
                                         @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">No reservations for today.</td>
                                        </tr>
                                        @endforelse
                                    
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
                    <div class="card rounded-4 shadow-sm border-0 p-4 mb-4 revenue-card">
                        <h2 class="mb-3 text-underline-accent">Weekly Revenue</h2>
                        @if(collect($data)->sum() === 0)
                            <p class="text-muted text-center">No sales data available for this period.</p>
                        @else
                          <div class="chart-container">
                           <canvas id="revenueChart" data-labels='@json($labels)'data-values='@json($data)'></canvas>
                         </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex gap-4">
                        <div class="w-75">
                            <div class="card rounded-4 shadow-sm border-0 p-4 mb-4 revenue-card">
                                <h2 class="mb-3 text-underline-accent">Top Products</h2>
                                <div class="chart-container">
                                    <canvas id="topProductsChart" data-labels='@json($productLabels)' data-values='@json($productData)'></canvas>
                                </div>
                            </div>
                        </div>

                    <div class="w-25">
                        <div class="card p-3 text-center revenue-card border-0 shadow-sm rounded-4">
                            <h5 class="mb-4 text-underline-accent"><i class="fa-solid fa-crown text-warning"></i> TOP PRODUCT</h5>
                           @if ($topProduct && $topProduct->image)
                                <img src="{{ asset('storage/' . $topProduct->image) }}" 
                                    alt="{{ $topProduct->name }}" 
                                    class="img-fluid rounded mb-3 top-product-image">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light rounded mb-3 top-product-image">
                                    <span>No image available</span>
                                </div>
                            @endif
                           @if ($topProduct)
                                <h4>{{ $topProduct->name }}</h4>
                                <p>{{ $topProductCount }} orders</p>
                            @else
                                <h4>No top product yet</h4>
                                <p>Once orders come in, your best-selling item will appear here.</p>
                            @endif
                        </div>
                    </div>
                </div>
                   
                </div>
            </div>
           
    </div>

</div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/js/owner-dashboard.js')
@endpush