@extends('admin.layouts.admin')

@section('title','Orders')

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
                    <tr onclick="window.location='{{ route('admin.reservations.show', $reservation->id) }}'">
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

@if ($reservations->hasPages())
    <ul class="pagination justify-content-center mt-4">
        @for ($i = 1; $i <= $reservations->lastPage(); $i++)
            <li class="page-item {{ $reservations->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $reservations->url($i) }}">
                    {{ $i }}
                </a>
            </li>
        @endfor
    </ul>
@endif

<div class="text-center mt-3">
    <a href="{{ route('admin.dashboard') }}" class="admin-home-link">
        Home
    </a>
</div>
@endsection