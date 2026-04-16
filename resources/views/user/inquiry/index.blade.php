@extends('layouts.app')

@section('title', 'Support Chat')

@section('content')
<link rel="stylesheet" href="{{ asset('css/inquiry.css') }}">

<div class="chat-container">
    <div class="chat-title" style="position: relative;">
        <a href="{{ route('user.inquiry.dashboard') }}" class="back-link">
            <i class="fa-solid fa-chevron-left"></i> Back
        </a>
        
        @php
            $firstMsg = $messages->first();
            $isMeSender = ($firstMsg->sender_id == Auth::id() && $firstMsg->sender_type === 'User');
            
            if ($isMeSender) {
                $displayName = ($firstMsg->recipient_type === 'Admin') ? 'Support' : ($firstMsg->recipient->restaurant_name ?? 'Restaurant');
            } else {
                $displayName = ($firstMsg->sender_type === 'Admin') ? 'Support' : ($firstMsg->recipient->restaurant_name ?? 'Restaurant');
            }
        @endphp
        
        <span class="display-name">{{ $displayName }}</span>
    </div>

    {{-- Chat Messages Window --}}
    <div id="chat-window" class="chat-window">
        @foreach($messages as $msg)
            <div class="message-row {{ ($msg->sender_id == Auth::id() && $msg->sender_type === 'User') ? 'me' : 'other' }}">
                <div class="message-content">
                    <div class="bubble">
                        {!! nl2br(e($msg->message)) !!}
                    </div>
                    <span class="timestamp">{{ $msg->created_at->format('H:i') }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Input Section --}}
    <div class="chat-input-area">
        @php
            $lastMessage = $messages->last();
            if ($lastMessage->sender_id == Auth::id() && $lastMessage->sender_type === 'User') {
                $rId = $lastMessage->recipient_id;
                $rType = $lastMessage->recipient_type;
            } else {
                $rId = $lastMessage->sender_id;
                $rType = $lastMessage->sender_type;
            }
        @endphp

        <form action="{{ route('user.inquiry.send') }}" method="POST">
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
            <i class="fa-solid fa-house"></i> Back to Dashboard
        </a>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const win = document.getElementById('chat-window');
        if (win) {
            win.scrollTop = win.scrollHeight;
        }
    });
</script>
@endpush
@endsection