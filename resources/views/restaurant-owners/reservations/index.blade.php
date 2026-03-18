@extends('layouts.owner')

@section('title', 'Reservations')

@section('content')
<div class="mx-5 my-3">
    <div class="row mt-5">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">
         <form action="{{ route('owner.reservations') }}" method="get">
            <div class="row g-3 my-3">
                <div class="col-12 col-lg-5 mb-3">
                        <div class="input-group search-group">
                            <span class="input-group-text bg-white">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input type="text" id="nameSearch" name="nameSearch" value="{{ request('nameSearch') }}" class="form-control" placeholder="Search customer name" >
                        </div>
                   
                </div>
                <div class="col-12 col-lg-3 mb-3">
                     <input type="date" name="date" value="{{ request('date') }}" class="form-control date-input" oninput="this.form.submit()">
                </div>
                <div class="col-12 col-lg-3 mb-3">
                    <select id="statusFilter" name="status" class="form-select filter-select" style="border: none;" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="no-show" {{ request('status') == 'no-show' ? 'selected' : '' }}>No-show</option>
                    </select>
                </div>
                <div class="col-12 col-lg-1 mb-3">
                    <a href="{{ route('owner.reservations') }}" class="btn btn-outline-navy">
                        Reset
                    </a>
                </div>
            </div>
         </form>

            {{-- calendar / table area --}}
            <div class="row g-4 mb-5">
                <div class="col-12 col-xl-5">
                    <div class="card p-4 calendar-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button type="button" id="prevMonth" class="btn btn-sm btn-light calendar-nav-btn">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>

                            <h4 id="calendarTitle" class="mb-0 text-center flex-grow-1">February 2026</h4>

                            <button type="button" id="nextMonth" class="btn btn-sm btn-light calendar-nav-btn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>

                        <table class="table table-borderless text-center calendar-table mb-0">
                            <thead>
                                <tr>
                                    <th>Sun</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                </tr>
                            </thead>
                            <tbody >
                                {{-- JS --}}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12 col-xl-7">
                    <button class="btn btn-orange mb-3" data-bs-toggle="modal" data-bs-target="#addReservationModal">+ Add Reservation</button>
                    <div class="card p-4 reservation-card">
                        <div class="align-items-center mb-3">
                            <h3 class="mb-0 text-underline-accent">Reservations</h3>
                        </div>

                        <div class="table-responsive" style="font-family: 'Sen','sane-serif';">
                            <table class="table table-sm align-middle reservation-table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Guests</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reservations as $reservation)
                                        <tr>
                                            <td>
                                                <div>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }}</div>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}
                                                </small>
                                            </td>
                                            <td class="ps-3">{{ $reservation->full_name }}</td>
                                            <td class="ps-4">{{ $reservation->number_of_people }}</td>
                                            <td>{{ $reservation->phone }}</td>
                                            <td class="pe-3">
                                                @php
                                                    $statusClass = match($reservation->status) {
                                                        'pending' => 'bg-warning text-dark',
                                                        'confirmed' => 'bg-success',
                                                        'cancelled' => 'bg-danger',
                                                        'completed' => 'bg-primary',
                                                        'no-show' => 'bg-secondary',
                                                        default => 'bg-light text-dark',
                                                    };
                                                @endphp
                                                <span class="p-2 badge rounded-pill {{ $statusClass }}">
                                                    {{ $reservation->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                No reservations found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                           {{ $reservations->links('layouts.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
 @include('restaurant-owners.reservations.modals.add')
 @include('restaurant-owners.reservations.modals.edit')
@endsection
