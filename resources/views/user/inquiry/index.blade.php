@extends('layouts.app')

@section('title', 'Support Chat')

@push('scripts')
    <script src="{{ asset('js/chat.js') }}" defer></script>
@endpush

@section('content')
<link rel="stylesheet" href="{{ asset('css/inquiry.css') }}">

<div class="chat-container">
    {{-- Header Section --}}
    <div class="chat-title">
        <a href="{{ route('user.inquiry.dashboard') }}" style="position:absolute; left:0; top: 10px; text-decoration:none; color:#666; font-size:0.9rem; font-family:'Sen', sans-serif;">
            <i class="fa-solid fa-chevron-left"></i> Back
        </a>
        Chat Details
    </div>

    {{-- Chat Messages Window --}}
    <div id="chat-window" class="chat-window">
        @foreach($messages as $msg)
            <div class="message-row {{ $msg->sender_type === 'User' ? 'me' : 'other' }}">
                <div class="message-content">
                    <div class="bubble">{{ $msg->message }}</div>
                    <span class="timestamp">{{ $msg->created_at->format('M d, H:i') }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Input Section --}}
    <div class="chat-input-area">
        @php
            $lastMessage = $messages->last();
            if ($lastMessage->sender_type === 'User') {
                $rId = $lastMessage->recipient_id;
                $rType = $lastMessage->recipient_type;
            } else {
                $rId = $lastMessage->sender_id;
                $rType = $lastMessage->sender_type;
            }
        @endphp

        <form action="/inquiry/send" method="POST">
            @csrf
            <input type="hidden" name="thread_id" value="{{ $thread_id }}">
            <input type="hidden" name="recipient_id" value="{{ $rId }}">
            <input type="hidden" name="recipient_type" value="{{ $rType }}">

            <textarea name="message" class="chat-textarea" placeholder="Type your reply..." required></textarea>
            <button type="submit" class="chat-submit-btn" style="width:100%;">Reply Message</button>
        </form>
    </div>
 {{-- Footer --}}
    <div class="btn-container">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-house"></i> Home
        </a>
    </div>
</div>

@push('scripts')
<script>
    // Auto scroll to bottom
    const win = document.getElementById('chat-window');
    win.scrollTop = win.scrollHeight;
</script>
@endpush
@endsection