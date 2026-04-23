@extends('admin.layouts.admin')

@section('title', 'Review Detail')

@section('content')

<div class="order-wrapper review-detail-wrapper">
    <h2 class="order-title">Review Details</h2>

    <div class="order-content review-detail-content">

        <!-- LEFT -->
        <div class="user-card review-user-card">
            <div class="user-top">
                <div class="user-icon">👤</div>
                <div>
                    <p class="user-id">User ID #{{ $review->user->id ?? '—' }}</p>
                    <p class="user-status"><span class="dot"></span> Active</p>
                    <h3 class="user-name review-user-name">
                        {{ trim(($review->user->first_name ?? '') . ' ' . ($review->user->last_name ?? '')) ?: ($review->user->user_name ?? '—') }}
                    </h3>
                </div>
            </div>

            <div class="info-group">
                <p>
                    <strong class="review-side-label">Email:</strong>
                    <span class="review-side-value">{{ $review->user->email ?? '—' }}</span>
                </p>
                <p>
                    <strong class="review-side-label">Restaurant:</strong>
                    <span class="review-side-value">{{ $review->restaurant->restaurant_name ?? $review->restaurant->name ?? '—' }}</span>
                </p>
                <p>
                    <strong class="review-side-label">Posted:</strong>
                    <span class="review-side-value">{{ $review->created_at->format('F d, Y') }}</span>
                </p>
                @php
                    $status = strtolower(trim($review->status ?? ''));

                    $statusClass = match ($status) {
                        'hidden' => 'status-hidden',
                        'flagged' => 'status-flagged',
                        'visible' => 'status-visible',
                        default => 'status-visible',
                    };

                    $statusLabel = match ($status) {
                        'hidden' => 'Hidden',
                        'flagged' => 'Flagged',
                        'visible' => 'Visible',
                        default => 'Visible',
                    };
                @endphp

                <p>
                    <strong class="review-side-label">Status:</strong>
                    <span class="status-badge {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </p>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="order-card review-main-card">
            <div class="review-top-block">
                <p class="review-detail-line">
                    <span class="review-detail-label-inline">Review ID :</span>
                    <span class="review-detail-id-inline">#{{ $review->id }}</span>
                </p>

                <p class="review-detail-line">
                    <span class="review-detail-label-inline">Rating :</span>
                    <span class="review-stars-inline">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                ⭐
                            @else
                                ☆
                            @endif
                        @endfor
                    </span>
                </p>

            </div>

            <div class="review-comment-section">
                <p class="review-detail-label review-comment-label">Comment :</p>
                <div class="review-comment-box">
                    <p class="review-comment-text">
                        {{ $review->comment ?? 'No comment provided.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    <div class="review-action-buttons mt-4">

        @if($status !== 'visible')
        <form action="{{ route('admin.reviews.updateStatus', $review->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="visible">
            <button type="submit" class="status-action-btn visible-btn">Approve</button>
        </form>
        @endif

        @if($status !== 'hidden')
        <form action="{{ route('admin.reviews.updateStatus', $review->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="hidden">
            <button type="submit" class="status-action-btn hidden-btn">Hide</button>
        </form>
        @endif

        @if($status !== 'flagged')
        <form action="{{ route('admin.reviews.updateStatus', $review->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="flagged">
            <button type="submit" class="status-action-btn flagged-btn">Flag</button>
        </form>
        @endif

        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST"
            onsubmit="return confirm('Delete this review?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="status-action-btn delete-btn">Delete</button>
        </form>

    </div>
</div>
<div class="text-center mt-5">
    <a href="{{ route('admin.reviews.index') }}" class="back-link">
    Back to list
    </a>
</div>

@endsection