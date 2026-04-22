@extends('admin.layouts.admin')

@section('title','Coupons')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Coupons</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="orders-table-wrapper">
            <table class="table table-sm align-middle orders-table text-center">

                <thead>
                    <tr>
                        <th><span class="th-label">ID</span></th>
                        <th><span class="th-label">User</span></th>
                        <th><span class="th-label">Coupon</span></th>
                        <th><span class="th-label">Status</span></th>
                        <th><span class="th-label">Expiry</span></th>
                        <th><span class="th-label">Issued</span></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($coupons as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>

                            <td>
                                {{ trim(($item->user->first_name ?? '') . ' ' . ($item->user->last_name ?? '')) }}
                            </td>

                            <td>
                                {{ $item->coupon->name ?? 'N/A' }}
                            </td>

                            <td>
                                <span class="order-status {{ $item->status }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $item->expires_at ? $item->expires_at->format('Y-m-d') : '-' }}
                            </td>

                            <td>
                                {{ $item->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection