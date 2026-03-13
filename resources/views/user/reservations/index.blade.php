@extends('layouts.app')
@section('title','Reservation Lists')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="reservation-list-container">
    <h2 class="list-title">
        <i class="fa-regular fa-calender-check"></i>Reservation lists
    </h2>
    <div class="table-wrapper">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Restaurant</th>
                    <th>Location</th>
                    <th>Map</th>
                    <th>Guests</th>
                    <th>Edit</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation )
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('y-n-j') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</td>
                        <td>{{ $reservation->restaurant->name ?? 'N/A' }}</td>
                        <td>{{ $reservation->restaurant->location ?? 'N/A' }}</td>
                        <td><i class="fa-solid fa-location-pin" style="color: #e2725b;"></i></td>
                        <td>{{ $reservation->number_of_guests }}</td>
                        <td class="edit-icons">
                            <a href="{{ route('reservations.edit', $reservation->id) }}"><i class="fa-regular fa-calendar-plus"></i></a>
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-regular fa-calendar-xmark"></i>
                        </td>
                        <td><i class="fa-solid fa-link"></i></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style ="text-align-center">No Reservations yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
   <div class="btn-container">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-house"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection