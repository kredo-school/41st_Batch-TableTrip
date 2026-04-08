@extends('admin.layouts.admin')

@section('title','Orders')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Orders</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="orders-table-wrapper">
            <table class="table table-sm align-middle orders-table text-center">
                <thead>
                <tr>
                <th style="width:90px;"><span class="th-label">Order ID</span></th>
                <th style="width:180px;"><span class="th-label">User</span></th>
                <th style="width:110px;"><span class="th-label">Total</span></th>
                <th style="width:120px;"><span class="th-label">Status</span></th>
                <th style="width:120px;"><span class="th-label">Date</span></th>
                </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                    <tr onclick="window.location='{{ route('admin.orders.show', $order->id) }}'">
                        <td>#{{ $order->id }}</td>

                        <td>
                            {{ $order->user->name ?? 'Guest' }}
                        </td>

                        <td>
                            ¥{{ number_format($order->total_price) }}
                        </td>

                        <td>
                            <span class="order-status {{ strtolower($order->status) }}">
                                {{ $order->status }}
                            </span>
                        </td>

                        <td>
                            {{ $order->created_at->format('Y-m-d') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $orders->links() }}
</div>
<div class="text-center mt-3">
    <a href="{{ route('admin.dashboard') }}" class="admin-home-link">
        Home
    </a>
</div>
@endsection