@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/inquiry.css') }}">

<div class="container inquiry-outer-container">
    <div class="chat-header">
        <h1 class="chat-title-main">Inquiry Support</h1>
        <p class="chat-subtitle">We are here to help you</p>
    </div>

    <div class="dashboard-grid">
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

        <div class="history-section">
            <h3 class="form-subtitle mb-4"><i class="fa-solid fa-clock-rotate-left me-2"></i>Chat History</h3>
            
            <div class="thread-list">
                @forelse($threads as $thread)
                    <div class="thread-card">
                        <div class="active-indicator"></div>

                        <a href="{{ route('user.inquiry.index', $thread->thread_id) }}" class="thread-link">
                            @php
                                $isMeSender = ($thread->sender_id == Auth::id() && $thread->sender_type === 'User');
                                $isPartnerAdmin = $isMeSender ? ($thread->recipient_type === 'Admin') : ($thread->sender_type === 'Admin');
                                
                                $partnerName = $isMeSender 
                                    ? ($isPartnerAdmin ? 'Support' : ($thread->recipient->restaurant_name ?? 'Restaurant'))
                                    : ($isPartnerAdmin ? 'Support' : ($thread->sender->restaurant_name ?? 'Restaurant'));
                                
                                $avatarChar = mb_substr($partnerName, 0, 1);
                                $typeClass = $isPartnerAdmin ? 'type-admin' : 'type-res';
                            @endphp

                            <div class="thread-avatar {{ $typeClass }}">
                                {{ $avatarChar }}
                            </div>

                            <div class="thread-content">
                                <div class="thread-header-row">
                                    <span class="partner-name">{{ $partnerName }}</span>
                                    <span class="thread-date">{{ $thread->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="thread-body-row">
                                    <p class="message-preview">{{ Str::limit($thread->message, 45) }}</p>
                                </div>
                            </div>
                        </a>
                        
                        <form action="{{ route('user.inquiry.destroy', $thread->thread_id) }}" method="POST" class="delete-thread-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-icon" onclick="return confirm('Delete this chat history?');">
                                <i class="fa-solid fa-xmark"></i>
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

    {{-- footer --}}
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