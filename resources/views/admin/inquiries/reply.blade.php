@extends('admin.layouts.admin')

@section('title','Reply to Inquiry')

@section('content')

<div class="order-wrapper inquiry-detail-wrapper">
    <h2 class="order-title">Reply to Inquiry</h2>

    <!-- TOP INFO -->
    <div class="inquiry-top-info">
        <div class="inquiry-left-info">
            <p>
                <span>To :</span>
                <strong class="info-value">{{ $inquiry->name }}</strong>
            </p>

            <p>
                <span>Email :</span>
                <strong class="info-value">{{ $inquiry->email }}</strong>
            </p>

            <p>
                <span>User ID :</span>
                <strong class="info-value">
                    {{ $matchedUser ? '#' . $matchedUser->id : 'Guest User' }}
                </strong>
            </p>
        </div>

        <div class="inquiry-right-info">
            <p>
                <span>Inquiry ID :</span>
                <strong class="info-value">#{{ $inquiry->id }}</strong>
            </p>

            <p>
                <span>Subject :</span>
                <strong class="info-value">{{ $replySubject }}</strong>
            </p>

            <p>
                <span>Received at :</span>
                <strong class="info-value">
                    {{ $inquiry->created_at->format('M d, Y - g:i A') }}
                </strong>
            </p>
        </div>
    </div>

    <form action="{{ route('admin.inquiries.sendReply', $inquiry->id) }}" method="POST" class="mt-4">
        @csrf

        <!-- SUBJECT -->
        <div class="inquiry-subject-box">
            {{ $replySubject }}
        </div>

        <!-- REPLY MESSAGE -->
        <div class="inquiry-message-box">
            <textarea
                name="reply_message"
                rows="8"
                class="reply-textarea"
                placeholder="Write your reply..."
                required>{{ old('reply_message') }}</textarea>

            <div class="quoted-message mt-4">
                <div class="quoted-divider">
                    ----------------------------------------
                </div>

                <p class="quoted-meta">
                    Original Inquiry · {{ $inquiry->created_at->format('M d, Y - g:i A') }}
                </p>

                <div class="quoted-body">
                    {!! nl2br(e($inquiry->message)) !!}
                </div>
            </div>
        </div>

        <div class="text-center mt-4 d-flex justify-content-center gap-3">
            <button type="submit" class="edit-btn reply-btn">
                Send
            </button>

            <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" class="back-link">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection