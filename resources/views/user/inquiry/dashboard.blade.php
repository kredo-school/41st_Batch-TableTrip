@extends('layouts.app')

@section('content')
{{-- Load the custom inquiry style --}}
<link rel="stylesheet" href="{{ asset('css/inquiry.css') }}">

<div class="container inquiry-outer-container">
    {{-- Main Title and Decorative Line --}}
    <h1 class="chat-title">Inquiry Support</h1>

    <div class="dashboard-grid">
        
        {{-- Left Section: Create New Inquiry --}}
        <div class="chat-input-area">
            <h3 class="form-subtitle">Start New Inquiry</h3>
            <form action="{{ route('user.inquiry.send') }}" method="POST">
                @csrf
                <div style="margin-bottom:20px;">
                    <label style="cursor:pointer;">
                        <input type="radio" name="target_type" value="admin" checked onclick="toggleRes(false)"> Admin
                    </label>
                    <label style="margin-left:20px; cursor:pointer;">
                        <input type="radio" name="target_type" value="restaurant" onclick="toggleRes(true)"> Restaurant
                    </label>
                </div>

                <div id="res-box" class="hidden">
                    <select name="recipient_id" class="chat-select">
                        <option value="" disabled selected>-- Select Restaurant --</option>
                        @foreach($restaurants as $res)
                            <option value="{{ $res->id }}">{{ $res->name }}</option>
                        @endforeach
                    </select>
                </div>

                <textarea name="message" class="chat-textarea" style="height:150px;" placeholder="Write your message here..." required></textarea>
                <button type="submit" class="chat-submit-btn" style="width:100%;">Start Chat</button>
            </form>
        </div>

        {{-- Right Section: Chat History --}}
        <div class="history-card">
            <h3 class="chat-title" style="font-size: 1.5rem; border:none;">History</h3>
            <div class="history-list">
                @forelse($threads as $thread)
                    <a href="{{ route('user.inquiry.show', $thread->thread_id) }}" class="thread-item">
                        <div class="thread-content">
                            <span class="thread-name">
                                {{ $thread->recipient_type === 'Admin' ? 'Support' : ($thread->recipient->name ?? 'Owner') }}
                            </span>
                            <span class="thread-preview">{{ $thread->message }}</span>
                        </div>
                        <span class="thread-date">{{ $thread->created_at->diffForHumans() }}</span>
                    </a>
                @empty
                    <p class="no-history">No conversation history found.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Footer Button Area --}}
    <div class="btn-container">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-house"></i> Back to Dashboard
        </a>
    </div>
</div>

<script>
/**
 * Toggle visibility of the restaurant selection box
 * @param {boolean} show - Whether to show the restaurant selector
 */
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