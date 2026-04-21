@extends('admin.layouts.admin')

@section('title','Inquiry Detail')

@section('content')

<div class="order-wrapper inquiry-detail-wrapper">
    <h2 class="order-title">Inquiry Thread</h2>

    @php
        $firstMessage = $messages->first();
    @endphp

    @if($firstMessage)
    <div class="inquiry-top-info">
        <div class="inquiry-left-info">
            <p>
                <span>Thread ID :</span>
                <strong class="info-value">{{ $firstMessage->thread_id }}</strong>
            </p>

            <p>
                <span>Subject :</span>
                <strong class="info-value">{{ $firstMessage->subject }}</strong>
            </p>

            <p>
                <span>Status :</span>
                <strong class="info-value">
                    <span class="status-dot {{ $firstMessage->status }}"></span>
                    {{ ucfirst($firstMessage->status) }}
                </strong>
            </p>
        </div>

        <div class="inquiry-right-info">
            <p>
                <span>Sender :</span>
                <strong class="info-value">
                    {{ ucfirst($firstMessage->sender_type) }} #{{ $firstMessage->sender_id }}
                </strong>
            </p>

            <p>
                <span>Recipient :</span>
                <strong class="info-value">
                    {{ $firstMessage->recipient_type ? ucfirst($firstMessage->recipient_type) : '-' }}
                    {{ $firstMessage->recipient_id ? '#' . $firstMessage->recipient_id : '' }}
                </strong>
            </p>

            <p>
                <span>Received at :</span>
                <strong class="info-value">
                    {{ $firstMessage->created_at->format('M d, Y - g:i A') }}
                </strong>
            </p>
        </div>
    </div>

    <div class="inquiry-subject-box">
        {{ $firstMessage->subject }}
    </div>
    @endif

    <div class="inquiry-message-box">
        @foreach($messages as $message)
            <div class="mb-3 p-3 border rounded">
                <p class="mb-1">
                    <strong>
                        {{ ucfirst($message->sender_type) }} #{{ $message->sender_id }}
                    </strong>
                </p>

                <p class="mb-1">{!! nl2br(e($message->message)) !!}</p>

                <small class="text-muted">
                    {{ $message->created_at->format('M d, Y - g:i A') }}
                </small>
            </div>
        @endforeach
    </div>

    @if($firstMessage)
    <div class="inquiry-action-buttons mt-4">
        <form action="{{ route('admin.inquiries.updateStatus', $firstMessage->thread_id) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="replied">
            <button type="submit" class="status-action-btn replied-btn">Mark as Replied</button>
        </form>

        <form action="{{ route('admin.inquiries.updateStatus', $firstMessage->thread_id) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="flagged">
            <button type="submit" class="status-action-btn flagged-btn">Mark as Flagged</button>
        </form>

        <form action="{{ route('admin.inquiries.updateStatus', $firstMessage->thread_id) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="pending">
            <button type="submit" class="status-action-btn open-btn">Restore to Pending</button>
        </form>
    </div>
    @endif
</div>

<div class="text-center mt-5">
    <a href="{{ route('admin.inquiries.index') }}" class="back-link">
        Back to list
    </a>
</div>

@endsection