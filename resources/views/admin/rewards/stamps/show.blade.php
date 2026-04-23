@extends('admin.layouts.admin')

@section('title','Stamp Details')

@section('content')

<div class="order-wrapper">
    <h2 class="order-title">Stamp Details</h2>

    <div class="order-content">

        <!-- LEFT -->
        <div class="user-card">
            <div class="user-top">
                <div class="user-icon">👤</div>
                <div>
                    <p class="user-id">User ID #{{ $user->id }}</p>
                    @php
                        $status = strtolower($user->status ?? 'active');
                    @endphp

                    <p class="user-status">
                        <span class="dot {{ $status }}"></span>
                        {{ ucfirst($status) }}
                    </p>
                    <h3 class="user-name">
                        {{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: ($user->user_name ?? '—') }}
                    </h3>
                </div>
            </div>

            <div class="info-row">
                <span class="label">Email :</span>
                <span class="value">{{ $user->email ?? '-' }}</span>
            </div>

            <div class="info-row">
                <span class="label">Rank :</span>
                <span class="value">
                    <span class="rank-badge {{ strtolower($user->rank ?? 'bronze') }}">
                        {{ ucfirst($user->rank ?? 'bronze') }}
                    </span>
                </span>
            </div>

            <div class="info-row">
                <span class="label">Stamp Progress :</span>
                <span class="value">{{ $user->stamps->count() }} / 47</span>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="reservation-card">
            <h4 class="reservation-title">Earned Prefectures :</h4>

            @forelse($user->stamps as $stamp)
                <div class="reservation-info">
                    <span class="label">{{ $stamp->prefecture }}</span>
                    <span class="value">
                        {{ $stamp->earned_at ? $stamp->earned_at->format('Y-m-d') : '-' }}
                    </span>
                </div>
            @empty
                <p class="text-muted">No stamps yet.</p>
            @endforelse
        </div>

    </div>
</div>
    <div class="text-center mt-4">
        <a href="{{ route('admin.rewards.stamps.index') }}" class="back-link">
            Back to list
        </a>
    </div>


@endsection