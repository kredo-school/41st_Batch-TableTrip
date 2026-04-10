@extends('admin.layouts.admin')

@section('title','Inquiry Detail')

@section('content')

<div class="order-wrapper inquiry-detail-wrapper">
    <h2 class="order-title">Inquiry Details</h2>

    <!-- TOP INFO -->
    <div class="inquiry-top-info">
        <div class="inquiry-left-info">
            <p><span>From :</span> <strong class="info-value">{{ $inquiry->name }}</strong></p>

            <p><span>Email :</span> <strong class="info-value">{{ $inquiry->email }}</strong></p>

            <p>
                <span>User ID :</span>
                <strong class="info-value">
                    {{ $matchedUser ? '#' . $matchedUser->id : 'Guest' }}
                </strong>
            </p>
        </div>

        <div class="inquiry-right-info">
            <p>
                <span>Inquiry ID :</span>
                <strong class="info-value">#{{ $inquiry->id }}</strong>
            </p>

            <p>
                <span>Status :</span>
                <strong class="info-value">
                    <span class="status-dot open"></span> Open
                </strong>
            </p>

            <p>
                <span>Received at :</span>
                <strong class="info-value">
                    {{ $inquiry->created_at->format('M d, Y - g:i A') }}
                </strong>
            </p>
        </div>
    </div>

    <!-- SUBJECT -->
    <div class="inquiry-subject-box">
        {{ $inquiry->subject }}
    </div>

    <!-- MESSAGE -->
    <div class="inquiry-message-box">
        {!! nl2br(e($inquiry->message)) !!}
    </div>

    <!-- BUTTON -->
    <div class="text-center mt-4">
        <button class="edit-btn reply-btn">Reply</button>
    </div>
</div>

<div class="text-center mt-5">
    <a href="{{ route('admin.inquiries.index') }}" class="back-link">
        Back to list
    </a>
</div>

@endsection