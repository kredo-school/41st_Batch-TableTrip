@extends('layouts.app')

@section('title', 'Notification Detail')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="notification-container">
        <div class="notification-header">
            <h2><i class="bi bi-bell"></i> Notification Detail</h2>
        </div>

        <div class="notification-detail-box">
            <h1 class="detail-subject">{{ $notification->title }}</h1>
            <div class="text-muted small">
                <i class="fa-regular fa-clock"></i> {{ $notification->created_at->format('Y/m/d H:i') }}
            </div>
            <div class="detail-body">{{ $notification->message }}</div>
            <div class="detail-footer">
                <a href="{{ route('user.notifications.index') }}" class="btn-back">
                    <i class="fa-solid fa-chevron-left me-2"></i> Back to List
                </a>

                @if($notification->is_action_required && !$notification->is_completed && $notification->target_type === 'App\Models\Product' && $notification->target_id)
                    <a href="{{ route('products.reviews', $notification->target_id) }}" class="btn btn-sm text-white" style="background-color: #D96D55; border-radius: 6px;">
                        <i class="fa-solid fa-star me-1"></i> Write a Review
                    </a>
                @endif

                <form action="{{ route('user.notifications.destroy', $notification->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn-link">
                        <i class="fa-solid fa-trash-can me-1"></i> Delete this notification
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection