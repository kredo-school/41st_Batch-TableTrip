@extends('admin.layouts.admin')

@section('title', 'Reviews')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Reviews</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="orders-table-wrapper">
            <table class="table align-middle orders-table text-center">
                <thead>
                    <tr>
                        <th style="width:90px;"><span class="th-label">Review ID</span></th>
                        <th style="width:180px;"><span class="th-label">User</span></th>
                        <th style="width:220px;"><span class="th-label">Restaurant</span></th>
                        <th style="width:140px;"><span class="th-label">Rating</span></th>
                        <th style="width:280px;"><span class="th-label">Comment</span></th>
                        <th style="width:140px;"><span class="th-label">Status</span></th>
                        <th style="width:120px;"><span class="th-label">Created</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr onclick="window.location='{{ route('admin.reviews.show', $review->id) }}'">
                            <td>#{{ $review->id }}</td>
                            <td>
                                {{ trim(($review->user->first_name ?? '') . ' ' . ($review->user->last_name ?? '')) ?: ($review->user->user_name ?? '—') }}
                            </td>
                            <td>{{ $review->restaurant->restaurant_name ?? $review->restaurant->name ?? '—' }}</td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        ⭐
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </td>
                            <td>
                                {{ \Illuminate\Support\Str::limit($review->comment, 40, '...') }}
                            </td>
                            <td>
                                <span class="order-status {{ strtolower($review->status) }}">
                                    {{ ucfirst($review->status) }}
                                </span>
                            </td>
                            <td>{{ $review->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted py-4">No reviews found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $reviews->links() }}
        </div>

    </div>
</div>

@endsection