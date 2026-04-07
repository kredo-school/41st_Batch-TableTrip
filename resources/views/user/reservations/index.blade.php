@extends('layouts.app')
@section('title','Reservation Lists')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="history-container py-5 text-center">
    {{-- Title --}}
    <h1 class="history-title mb-4">
        <i class="fa-solid fa-calendar-check me-2"></i>Reservation lists
    </h1>

    <div class="selection-group-container">
        <div class="selection-group">
            {{-- 切り替え用ラジオボタン --}}
            <input type="radio" name="history-tab" id="tab-upcoming" checked>
            <label for="tab-upcoming" class="tab-label">Upcoming</label>

            <input type="radio" name="history-tab" id="tab-past">
            <label for="tab-past" class="tab-label">Past Visits</label>

            <hr class="my-4">

            {{-- 1. Upcoming Table --}}
            <div class="content-upcoming">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Date / Time</th>
                            <th>Restaurant</th>
                            <th>People</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($upcoming_reservations as $res)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/y') }} {{ $res->reservation_time }}</td>
                                <td><strong>{{ $res->restaurant->name }}</strong></td>
                                <td>{{ $res->number_of_people }}</td>
                                <td class="text-primary">Confirmed</td>
                                <td>
                                    <form action="#" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-link-delete" onclick="return confirm('Cancel this reservation?')">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-5 text-muted">No upcoming reservations yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 2. Past Table --}}
            <div class="content-past">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Restaurant</th>
                            <th>Status</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($past_visits as $visit)
                            <tr class="past-row">
                                <td>{{ \Carbon\Carbon::parse($visit->reservation_date)->format('d/m/y') }}</td>
                                <td>{{ $visit->restaurant->name }}</td>
                                <td>Visited</td>
                                <td><i class="bi bi-chat-dots fs-5" title="Write a review"></i></td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-5 text-muted">No past visits found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Back to Dashboard --}}
    <div class="mt-5">
        <a href="{{ route('dashboard') }}" class="btn-back-custom">
            <i class="fa-solid fa-house me-2"></i>Back to Dashboard
        </a>
    </div>
</div>
@endsection