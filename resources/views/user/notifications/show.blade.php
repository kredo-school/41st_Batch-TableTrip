@extends('layouts.app')

@section('title', 'Notification Detail')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <style>
        /* 詳細画面専用の追加スタイル */
        .notification-detail-box {
            padding: 20px;
        }
        
        .detail-subject {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
            border-left: 4px solid #e2725b;
            padding-left: 15px;
        }

        .detail-body {
            font-family: 'Sen', sans-serif;
            font-size: 1rem;
            line-height: 1.8;
            color: #444;
            background: #fffcfb;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #eee;
            white-space: pre-wrap;
            margin-top: 20px;
        }

        .detail-footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .delete-btn-link {
            color: #dc3545;
            text-decoration: none;
            font-size: 0.9rem;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }
        
        .delete-btn-link:hover {
            text-decoration: underline;
        }
    </style>
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