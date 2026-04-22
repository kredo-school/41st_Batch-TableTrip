@extends('admin.layouts.admin')

@section('title','Reservation Detail')

@section('content')

<div class="order-wrapper">
    <h2 class="order-title">Reservation Details</h2>

    <div class="user-card reservation-user-card">
        <!-- LEFT -->
        <div class="reservation-user-left">
            <div class="user-icon">👤</div>

            <div class="reservation-user-meta">
                <p class="user-id">
                    <span class="user-label">User ID</span>
                    <span class="user-value">#{{ $reservation->user->id ?? 'Guest' }}</span>
                </p>

                <p class="user-active">
                    <span class="active-dot"></span>
                    <span class="user-value">Active</span>
                </p>

                <p class="user-name">
                    <span class="user-value">
                        {{ $reservation->user->name ?? $reservation->full_name ?? 'Guest User' }}
                    </span>
                </p>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="reservation-user-right">
            <p>
                <span class="user-label">Email:</span>
                <span class="user-value">
                    {{ $reservation->email ?? $reservation->user->email ?? 'N/A' }}
                </span>
            </p>

            <p>
                <span class="user-label">Phone:</span>
                <span class="user-value">
                    {{ $reservation->phone ?? 'N/A' }}
                </span>
            </p>
        </div>
    </div>
        <!-- RIGHT -->
        <div class="order-info-card">
            <h4 class="section-title">Reservation Info</h4>

            <div class="info-grid">
                <div>
                    <span class="info-label">Reservation ID</span>
                    <p>#{{ $reservation->id }}</p>
                </div>

                <div>
                    <span class="info-label">Restaurant</span>
                    <p>{{ $reservation->restaurant->restaurant_name ?? 'Unknown Restaurant' }}</p>
                </div>

                <div>
                    <span class="info-label">Reservation Date</span>
                    <p>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }}</p>
                </div>

                <div>
                    <span class="info-label">Reservation Time</span>
                    <p>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('M d, Y') }}</p>
                </div>

                <div>
                    <span class="info-label">Reserved At</span>
                    <p>{{ $reservation->reserved_at ?? 'N/A' }}</p>
                </div>

                <div>
                    <span class="info-label">Number of People</span>
                    <p>{{ $reservation->number_of_people }}</p>
                </div>

                <div>
                    <span class="info-label">Status</span>
                    <p>{{ ucfirst($reservation->status) }}</p>
                </div>

                <div>
                    <span class="info-label">Visited At</span>
                    <p>{{ $reservation->visited_at ?? 'Not visited yet' }}</p>
                </div>

                <div style="grid-column: 1 / -1;">
                    <span class="info-label">Special Requests</span>
                    <p>{{ $reservation->special_requests ?? 'None' }}</p>
                </div>
            </div>
        </div>
        <div class="inquiry-action-buttons mt-4">
            <form action="{{ route('admin.reservations.updateStatus', $reservation->id) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="pending">
                <button class="status-action-btn pending-btn">Pending</button>
            </form>

            <form action="{{ route('admin.reservations.updateStatus', $reservation->id) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="confirmed">
                <button class="status-action-btn replied-btn">Confirmed</button>
            </form>

            <form action="{{ route('admin.reservations.updateStatus', $reservation->id) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="visited">
                <button class="status-action-btn open-btn">Visited</button>
            </form>

            <form action="{{ route('admin.reservations.updateStatus', $reservation->id) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="cancelled">
                <button class="status-action-btn flagged-btn">Cancelled</button>
            </form>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('admin.reservations.index') }}" class="back-link">
            Back to list
        </a>
    </div>
</div>

@endsection