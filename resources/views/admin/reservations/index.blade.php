@extends('admin.layouts.admin')

@section('title','Reservations')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Reservations</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="orders-table-wrapper">
            <table class="table table-sm align-middle orders-table text-center">
                <thead>
                <tr>
                <th style="width:90px;"><span class="th-label">Reservation ID</span></th>
                <th style="width:180px;"><span class="th-label">Name</span></th>
                <th style="width:110px;"><span class="th-label">Guests</span></th>
                <th style="width:120px;"><span class="th-label">Status</span></th>
                <th style="width:120px;"><span class="th-label">Date</span></th>
                </tr>
                </thead>

                <tbody>
                    @foreach($reservations as $reservation)
                    <tr class="clickable-row" data-id="{{ $reservation->id }}" data-type="reservations">
                        <td>#{{ $reservation->id }}</td>

                        <td>
                            {{ $reservation->full_name }}
                        </td>

                        <td>
                            {{ $reservation->number_of_people }}
                        </td>

                        <td>
                            <span class="order-status {{ strtolower($reservation->status) }}">
                                {{ $reservation->status }}
                            </span>
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $reservations->links() }}
</div>
<div class="text-center mt-3">
    <a href="{{ route('admin.dashboard') }}" class="admin-home-link">
        Home
    </a>
</div>
@endsection