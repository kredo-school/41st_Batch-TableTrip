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
                        {{-- 2つの列を統合した管理用ヘッダー --}}
                        <th style="width: 160px;">Manage</th>
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
                                <div class="manage-action-group" style="display: flex; gap: 15px; justify-content: center; align-items: center;">
                                    {{-- Contact (Inquiry) --}}
                                    <a href="{{ route('user.inquiry.create', ['restaurant_id' => $res->restaurant_id, 'reservation_id' => $res->id]) }}" 
                                       class="btn-inquiry-icon" title="Contact Restaurant" style="color: #e2725b; text-decoration: none; font-size: 1.1rem;">
                                        <i class="fa-solid fa-envelope"></i>
                                    </a>

                                    {{-- Cancel (Action) --}}
                                    <form action="{{ route('reservation.destroy', $res->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cancel-icon" 
                                                onclick="return confirm('Cancel this reservation?')" 
                                                style="background: none; border: none; color: #999; cursor: pointer; font-size: 1.1rem;" title="Cancel Reservation">
                                            <i class="fa-solid fa-calendar-xmark"></i>
                                        </button>
                                    </form>
                                </div>
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