@extends('admin.layouts.admin')

@section('title', 'Point History')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Point History</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table align-middle orders-table text-center point-history-table">
            <thead>
                <tr>
                    <th class="col-id"><span class="th-label">ID</span></th>
                    <th class="col-user"><span class="th-label">User</span></th>
                    <th class="col-points"><span class="th-label">Points</span></th>
                    <th class="col-type"><span class="th-label">Type</span></th>
                    <th class="col-description"><span class="th-label">Description</span></th>
                    <th class="col-date"><span class="th-label">Date</span></th>
                </tr>
            </thead>
            <tbody>
                @forelse($pointHistories as $history)
                    <tr>
                        <td>#{{ $history->id }}</td>
                        <td>
                            {{ $history->user->first_name ?? 'Guest' }}
                            {{ $history->user->last_name ?? '' }}
                        </td>
                        <td>{{ $history->points }}</td>
                        <td>
                            <span class="order-status {{ strtolower($history->type) }}">
                                {{ ucfirst($history->type) }}
                            </span>
                        </td>
                        <td>{{ $history->description }}</td>
                        <td>{{ $history->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No point history found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if ($pointHistories->hasPages())
    <ul class="pagination justify-content-center mt-4">
        @for ($i = 1; $i <= $pointHistories->lastPage(); $i++)
            <li class="page-item {{ $pointHistories->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $pointHistories->url($i) }}">
                    {{ $i }}
                </a>
            </li>
        @endfor
    </ul>
@endif


@endsection