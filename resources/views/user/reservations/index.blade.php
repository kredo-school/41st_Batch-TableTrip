@extends('layouts.app')
@section('title', 'Upcoming Reservations')

@section('content')
<link rel="stylesheet" href="{{ asset('css/reservation.css') }}">

<div class="history-container py-5 text-center">
    <h1 class="history-title mb-4">Upcoming Reservations</h1>

    <div class="main-selection-wrapper">
        <div class="section-reservations">
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Date / Time</th>
                        <th>Restaurant</th>
                        <th>People</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($upcoming_reservations ?? [] as $res)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/y') }} 
                                {{ \Carbon\Carbon::parse($res->reservation_time)->format('H:i') }}
                            </td>
                            <td><strong>{{ $res->restaurant->restaurant_name }}</strong></td>
                            <td>{{ $res->number_of_people }}</td>
                            <td>
                                <form action="{{ route('reservation.destroy', $res->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-link" onclick="return confirm('Cancel?')">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="no-data-cell">
                                No upcoming reservation yet
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">
        <a href="{{ route('dashboard') }}" class="btn-dashboard-back">
            <i class="fa-solid fa-house me-2"></i>Back to Dashboard
        </a>
    </div>
</div>
@endsection