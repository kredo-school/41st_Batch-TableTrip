@extends('layouts.owner')

@section('title','Orders')
    
@section('content')
<div class="mx-5 my-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
        <div class="col-12 col-lg-9 px-5">
           <form action="{{ route('owner.orders') }}" method="get">
            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-6">
                    <div class="input-group search-group">
                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" id="search" name="search" class="form-control" placeholder="Search (orderID/Customer name)">
                    </div>
                </div>
                 <div class="col-12 col-lg-6 mb-3">
                     <input name="date" type="date" id="dateFilter" class="form-control date-input">
                </div>
            </div>
          </form>
            <div class="row mb-3">
                <div class="col">
                    <div class="order-status-tabs d-flex align-items-center gap-3 mb-3 ms-3">
                        <a href="{{ route('owner.orders') }}"
                        class="status-link {{ request('status') == null || request('status') == 'all' ? 'active' : '' }}">
                            All
                        </a>

                        <span>|</span>
                        <a href=" {{ route('owner.orders', ['status' => 'pending']) }}"
                        class="status-link {{ request('status') == 'pending' ? 'active' : '' }}">
                            Pending
                        </a>

                        <span>|</span>
                        <a href="{{ route('owner.orders', ['status' => 'preparing']) }}"
                        class="status-link {{ request('status') == 'preparing' ? 'active' : '' }}">
                            Preparing
                        </a>

                        <span>|</span>
                        <a href="{{ route('owner.orders', ['status' => 'shipping']) }}"
                        class="status-link {{ request('status') == 'shipping' ? 'active' : '' }}">
                            Shipping
                        </a>

                        <span>|</span>
                        <a href="{{ route('owner.orders', ['status' => 'delivered']) }}"
                        class="status-link {{ request('status') == 'delivered' ? 'active' : '' }}">
                            Delivered
                        </a>

                        <span>|</span>
                        <a href="{{ route('owner.orders', ['status' => 'cancelled']) }}"
                        class="status-link {{ request('status') == 'cancelled' ? 'active' : '' }}">
                            Cancelled
                        </a>

                        <a href="{{ route('owner.orders') }}" class="btn btn-outline-dark ms-3">
                          Reset
                       </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col bg-white p-4 rounded">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr onclick="window.location='{{ route('owner.orders.show', $order->id) }}'" style="cursor:pointer;">
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>{{ $order->user->last_name}} {{ $order->user->first_name }}</td>
                                    <td class="ps-4">2</td>
                                    <td>{{ $order->total_price }}</td>
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
                                            <td colspan="7" class="text-center text-muted py-4">
                                                No orders found.
                                            </td>
                                        </tr>
                                 @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection