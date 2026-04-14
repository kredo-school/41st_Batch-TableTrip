@extends('admin.layouts.admin')

@section('title','Restaurants')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Restaurants</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="orders-table-wrapper">
            <table class="table table-sm align-middle orders-table text-center restaurants-table">
                <thead>
                <tr>
                    <th class="col-id"><span class="th-label">ID</span></th>
                    <th class="col-name"><span class="th-label">Restaurant Name</span></th>
                    <th class="col-email"><span class="th-label">Email</span></th>
                    <th class="col-prefecture"><span class="th-label">Prefecture</span></th>
                    <th class="col-status"><span class="th-label">Status</span></th>
                    <th class="col-date"><span class="th-label">Date</span></th>
                </tr>
                </thead>

                <tbody>
                    @foreach($restaurants as $restaurant)
                    <tr onclick="window.location='{{ route('admin.restaurants.show', $restaurant->id) }}'">
                        <td>#{{ $restaurant->id }}</td>
                        <td>{{ $restaurant->restaurant_name }}</td>
                        <td>{{ $restaurant->email }}</td>
                        <td>{{ $restaurant->prefecture }}</td>
                        <td>
                            <span class="order-status {{ strtolower($restaurant->approval_status) }}">
                                {{ ucfirst($restaurant->approval_status) }}
                            </span>
                        </td>
                        <td>
                            {{ $restaurant->created_at ? $restaurant->created_at->format('Y-m-d') : '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $restaurants->links() }}
</div>

<div class="text-center mt-3">
    <a href="{{ route('admin.dashboard') }}" class="admin-home-link">
        Home
    </a>
</div>

@endsection