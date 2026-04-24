@extends('layouts.app')

@section('title', 'Notifications')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="notification-container">
        {{-- Header --}}
        <div class="notification-header">
            <h2><i class="bi bi-bell"></i> Notifications</h2>
        </div>        
        
        {{-- Notifications List --}}
    <div class="notification-list-scroll">
        <div class="d-flex flex-column">
            @forelse($notifications as $notification)
                <div class="notification-wrapper position-relative mb-2">
                    @php
                        $notifLink = ($notification->is_action_required && $notification->target_type === 'App\Models\Product' && $notification->target_id)
                            ? route('products.reviews', $notification->target_id)
                            : route('user.notifications.show', $notification->id);
                    @endphp
                    <a href="{{ $notifLink }}" class="text-decoration-none">
                        <div class="notification-item {{ $notification->is_completed ? 'read' : 'unread' }}">
                            <div class="notification-content">
                                <div class="notification-title">
                                    {{ $notification->title }}
                                    @if(!$notification->is_completed)
                                        <span class="badge bg-danger rounded-circle p-1 ms-1" style="width: 8px; height: 8px; display: inline-block;"></span>
                                    @endif
                                </div>
                                <p class="notification-message text-muted">{{ $notification->message }}</p>
                            </div>
                            <div class="notification-meta">
                                {{ $notification->created_at->format('Y/m/d H:i') }}
                            </div>
                        </div>
                    </a>

                    <form action="{{ route('user.notifications.destroy', $notification->id) }}" method="POST" class="delete-form position-absolute" style="top: 10px; right: 10px; z-index: 10;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this notification?')">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div class="empty-state">
                    <p>No notifications yet.</p>
                </div>
            @endforelse
        </div>
    </div>
        {{-- Back to Dashboard Button --}}
        <div class="mt-5 pb-3 text-center">
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="fa-solid fa-house me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection