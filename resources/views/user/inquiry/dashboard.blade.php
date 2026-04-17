@extends('layouts.app')

@section('content')
{{-- Load the custom inquiry style --}}
<link rel="stylesheet" href="{{ asset('css/inquiry.css') }}">

<div class="container inquiry-outer-container">
    {{-- Main Title and Decorative Line --}}
    <div class="chat-header">
        <h1 class="chat-title-main">Inquiry Support</h1>
    </div>

    <div class="dashboard-grid">
        
        {{-- Left Section: Create New Inquiry --}}
        <div class="chat-create-section">
            <h3 class="form-subtitle"><i class="fa-solid fa-pen-to-square me-2"></i>Start New Inquiry</h3>
            <form action="{{ route('user.inquiry.send') }}" method="POST" class="mt-4">
                @csrf
                <div class="target-selection mb-4">
                    <label class="radio-label">
                        <input type="radio" name="target_type" value="admin" checked onclick="toggleRes(false)"> 
                        <span class="ms-1">Admin</span>
                    </label>
                    <label class="radio-label ms-4">
                        <input type="radio" name="target_type" value="restaurant" onclick="toggleRes(true)"> 
                        <span class="ms-1">Restaurant</span>
                    </label>
                </div>

                <div id="res-box" class="hidden mb-3">
                    <select name="recipient_id" class="chat-select">
                        <option value="" disabled selected>-- Select Restaurant --</option>
                        @foreach($restaurants as $res)
                            <option value="{{ $res->id }}">{{ $res->restaurant_name }}</option>
                        @endforeach
                    </select>
                </div>

                <textarea name="message" class="chat-textarea" placeholder="Write your message here..." required></textarea>
                <button type="submit" class="chat-submit-btn">
                    <i class="fa-solid fa-paper-plane me-2"></i>Start Chat
                </button>
            </form>
        </div>

        {{-- Right Section: Chat History --}}
        <div class="history-section">
            <h3 class="form-subtitle mb-4"><i class="fa-solid fa-clock-rotate-left me-2"></i>Chat History</h3>
            
            <div class="thread-list">
                @forelse($threads as $thread)
                    <div class="thread-card">
                        {{-- Card Main Link --}}
                        <a href="{{ route('user.inquiry.index', $thread->thread_id) }}" class="thread-link">
                            @php
                                $isMeSender = ($thread->sender_id == Auth::id() && $thread->sender_type === 'User');
                                $partnerName = $isMeSender 
                                    ? ($thread->recipient_type === 'Admin' ? 'Support' : ($thread->recipient->restaurant_name ?? 'Restaurant'))
                                    : ($thread->sender_type === 'Admin' ? 'Support' : ($thread->sender->restaurant_name ?? 'Restaurant'));
                            @endphp
                            
                            <div class="thread-header">
                                <span class="partner-name">{{ $partnerName }}</span>
                                <span class="thread-date">{{ $thread->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <div class="thread-body">
                                @if($thread->subject !== 'Inquiry')
                                    <span class="subject-badge">{{ $thread->subject }}</span>
                                @endif
                                <p class="message-preview">{{ Str::limit($thread->message, 50) }}</p>
                            </div>
                        </a>

                        {{-- Hover Delete Button --}}
                        <form action="{{ route('user.inquiry.destroy', $thread->thread_id) }}" method="POST" class="delete-thread-form" onsubmit="return confirm('Delete this chat history?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-icon" title="Delete History">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="no-history-box text-center py-5">
                        <i class="fa-regular fa-comment-dots fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No conversation history found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Footer Button Area --}}
    <div class="btn-container mt-5 text-center">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-house me-1"></i> Back to Dashboard
        </a>
    </div>
</div>

<script>
function toggleRes(show) {
    const box = document.getElementById('res-box');
    const select = box.querySelector('select');
    if (show) {
        box.classList.remove('hidden');
        select.setAttribute('required', 'required');
    } else {
        box.classList.add('hidden');
        select.removeAttribute('required');
    }
}
</script>
@endsection