@extends('layouts.app')
@section('title','Reservation Lists')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container py-5">
    <div class="reservation-list-container">
        <h2 class="list-title mb-4">
            <i class="fa-regular fa-calendar-check"></i> Upcoming Reservations
        </h2>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle custom-table-style">
                <thead class="bg-light">
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Restaurant</th>
                        <th>Location</th>
                        <th>Map</th>
                        <th>Guests</th>
                        <th>Actions</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($upcoming_reservations as $reservation)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</td>
                            <td class="fw-bold">{{ $reservation->restaurant->name ?? 'N/A' }}</td>
                            <td>{{ $reservation->restaurant->location ?? 'N/A' }}</td>
                            <td><i class="fa-solid fa-location-pin text-orange"></i></td>
                            <td>{{ $reservation->number_of_people }}</td> 
                            <td class="edit-icons">
                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="text-decoration-none me-2">
                                    <i class="fa-regular fa-calendar-plus"></i>
                                </a>
                                {{--delete --}}
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0 border-0 text-danger" onclick="return confirm('Cancel this reservation?')">
                                        <i class="fa-regular fa-calendar-xmark"></i>
                                    </button>
                                </form>
                            </td>
                            <td><i class="fa-solid fa-link text-navy"></i></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No upcoming reservations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($past_reservations->isNotEmpty())
            <h3 class="mt-5 mb-3 text-muted">Past Reservations</h3>
            <div class="table-responsive opacity-75">
                <table class="table table-sm">
                </table>
            </div>
        @endif

        <div class="btn-container mt-4 text-center">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-navy">
                <i class="fa-solid fa-house me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
