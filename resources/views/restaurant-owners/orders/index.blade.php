@extends('layouts.app')

@section('title','Orders')
    
@section('content')
<div class="container mx-auto my-5">
    <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">

            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-6">
                    <div class="input-group search-group">
                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" id="nameSearch" class="form-control" placeholder="Search (orderID/Customer name)">
                    </div>
                </div>
                 <div class="col-12 col-lg-6 mb-3">
                     <input type="date" id="dateFilter" class="form-control date-input">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="order-status-tabs d-flex align-items-center gap-3 mb-3 ms-3">
                        {{-- {{ route('orders.index') }} --}}
                        <a href=""
                        class="status-link {{ request('status') == null || request('status') == 'all' ? 'active' : '' }}">
                            All
                        </a>

                        <span>|</span>
                         {{-- {{ route('orders.index', ['status' => 'pending']) }} --}}
                        <a href=""
                        class="status-link {{ request('status') == 'pending' ? 'active' : '' }}">
                            Pending
                        </a>

                        <span>|</span>
                        {{-- {{ route('orders.index', ['status' => 'preparing']) }} --}}
                        <a href=""
                        class="status-link {{ request('status') == 'preparing' ? 'active' : '' }}">
                            Preparing
                        </a>

                        <span>|</span>
                        {{-- {{ route('orders.index', ['status' => 'shipping']) }} --}}
                        <a href=""
                        class="status-link {{ request('status') == 'shipping' ? 'active' : '' }}">
                            Shipping
                        </a>

                        <span>|</span>
                       {{-- {{ route('orders.index', ['status' => 'delivered']) }} --}}
                        <a href=""
                        class="status-link {{ request('status') == 'delivered' ? 'active' : '' }}">
                            Delivered
                        </a>

                        <span>|</span>
                           {{-- {{ route('orders.index', ['status' => 'cancelled']) }} --}}
                        <a href=""
                        class="status-link {{ request('status') == 'cancelled' ? 'active' : '' }}">
                            Cancelled
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
                            {{-- {{ route('orders.show', $order->id) }} --}}
                            <tr onclick="window.location='#'" style="cursor:pointer;">
                                <td>#1234</td>
                                <td>Apr 23,2025</td>
                                <td>Yuna Nakamura</td>
                                <td class="ps-4">2</td>
                                <td>$21.5</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                        </tbody>
                        <tbody>
                            {{-- {{ route('orders.show', $order->id) }} --}}
                            <tr onclick="window.location='#'" style="cursor:pointer;">
                                <td>#1234</td>
                                <td>Apr 23,2025</td>
                                <td>Yuna Nakamura</td>
                                <td class="ps-4">2</td>
                                <td>$21.5</td>
                                <td><span class="badge bg-success">Shipped</span></td>
                            </tr>
                        </tbody>
                        <tbody>
                            {{-- {{ route('orders.show', $order->id) }} --}}
                            <tr onclick="window.location='#'" style="cursor:pointer;">
                                <td>#1234</td>
                                <td>Apr 23,2025</td>
                                <td>Yuna Nakamura</td>
                                <td class="ps-4">2</td>
                                <td>$21.5</td>
                                <td><span class="badge bg-primary">Delivered</span></td>
                            </tr>
                        </tbody>
                        <tbody>
                            {{-- {{ route('orders.show', $order->id) }} --}}
                            <tr onclick="window.location='#'" style="cursor:pointer;">
                                <td>#1234</td>
                                <td>Apr 23,2025</td>
                                <td>Yuna Nakamura</td>
                                <td class="ps-4">2</td>
                                <td>$21.5</td>
                                <td><span class="badge bg-secondary">Canceled</span></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection