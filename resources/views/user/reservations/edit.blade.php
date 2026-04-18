@extends('layouts.app')

@section('title', 'Edit Reservation - TableTrip')

@section('content')
<link rel="stylesheet" href="{{ asset('css/reservation.css') }}">

<div class="edit-container py-5">
    <div class="form-card mx-auto">
        <div class="card-header-custom text-center mb-4">
            <h1 class="edit-title">Edit Reservation</h1>
            <p class="restaurant-name text-muted">{{ $reservation->restaurant->restaurant_name }}</p>
        </div>

        <form action="{{ route('user.reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="reservation_date" class="form-label">Reservation Date</label>
                <input type="date" name="reservation_date" id="reservation_date" 
                       class="form-control @error('reservation_date') is-invalid @enderror" 
                       value="{{ old('reservation_date', $reservation->reservation_date->format('Y-m-d')) }}" required>
                @error('reservation_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="reservation_time" class="form-label">Reservation Time</label>
                <input type="time" name="reservation_time" id="reservation_time" 
                       class="form-control @error('reservation_time') is-invalid @enderror" 
                       value="{{ old('reservation_time', \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i')) }}" required>
                @error('reservation_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="number_of_people" class="form-label">Number of People</label>
                <input type="number" name="number_of_people" id="number_of_people" 
                       class="form-control @error('number_of_people') is-invalid @enderror" 
                       value="{{ old('number_of_people', $reservation->number_of_people) }}" min="1" required>
                @error('number_of_people')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="special_requests" class="form-label">Special Requests</label>
                <textarea name="special_requests" id="special_requests" 
                          class="form-control @error('special_requests') is-invalid @enderror" 
                          rows="4" placeholder="Any allergies or preferences?">{{ old('special_requests', $reservation->special_requests) }}</textarea>
                @error('special_requests')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-3">
                <button type="submit" class="btn btn-update">Update Now</button>
                <a href="{{ route('user.reservations.index') }}" class="btn btn-cancel">Keep Current Plan</a>
            </div>
        </form>
    </div>
</div>
@endsection