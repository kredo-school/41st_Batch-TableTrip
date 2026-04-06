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
        <div class="d-flex flex-column">
            @forelse($notifications as $notification)
                <div class="notification-item {{ $notification->is_completed ? 'read' : 'unread' }}">
                    <div class="notification-content">
                        <div class="notification-title">
                            {{ $notification->title }}
                            @if(!$notification->is_completed)
                                <span class="badge bg-danger rounded-circle p-1 ms-1" style="width: 8px; height: 8px; display: inline-block;"></span>
                            @endif
                        </div>
                        <p class="notification-message">{{ $notification->message }}</p>
                    </div>
                    {{-- meta (date) --}}
                    <div class="notification-meta">
                        {{ $notification->created_at->format('Y/m/d H:i') }}
                    </div>
                </div> 
            @empty
                <div class="empty-state">
                    <p>No notifications yet.</p>
                </div>
            @endforelse
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