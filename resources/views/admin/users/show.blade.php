@extends('admin.layouts.admin')

@section('title','User Detail')

@section('content')

<div class="order-wrapper">
    <h2 class="order-title">User Details</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="order-content">

        <!-- LEFT -->
        <div class="user-card">

            <div class="user-top">
                <div class="user-icon">
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="User">
                    @else
                        👤
                    @endif
                </div>

                <div>
                    <p class="user-id">User ID #{{ $user->id }}</p>

                    <div class="badge-row">

                        <div class="status-line">
                            <span class="dot
                                @if(($user->status ?? 'active') === 'active') active-dot
                                @elseif(($user->status ?? 'active') === 'suspended') suspended-dot
                                @elseif(($user->status ?? 'active') === 'deactivated') deactivated-dot
                                @elseif(($user->status ?? 'active') === 'banned') banned-dot
                                @endif
                            "></span>

                            <span class="account-text">
                                {{ ucfirst($user->status ?? 'active') }}
                            </span>
                        </div>

                        <span class="order-status {{ strtolower($user->rank ?? 'bronze') }}">
                            {{ ucfirst($user->rank ?? 'bronze') }}
                        </span>

                    </div>
                </div>
            </div>

            <div class="info-row">
                <span class="label">Username</span>
                <span class="value">{{ $user->user_name ?? '-' }}</span>
            </div>

            <div class="info-row">
                <span class="label">First Name</span>
                <span class="value">{{ $user->first_name ?? '-' }}</span>
            </div>

            <div class="info-row">
                <span class="label">Last Name</span>
                <span class="value">{{ $user->last_name ?? '-' }}</span>
            </div>

            <div class="info-row">
                <span class="label">Email</span>
                <span class="value">{{ $user->email }}</span>
            </div>

            <div class="info-row">
                <span class="label">Phone Number</span>
                <span class="value">{{ $user->tel ?? '-' }}</span>
            </div>

            <div class="info-row">
                <span class="label">Address</span>
                <span class="value">{{ $user->postal_code ? '〒'.$user->postal_code.' ' : '' }}{{ $user->address ?? '-' }}</span>
            </div>

            <div class="info-row">
                <span class="label">Joined Date</span>
                <span class="value">{{ $user->created_at->format('Y-m-d') }}</span>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="reservation-card">
            <h4 class="reservation-title">User Activity</h4>

            <div class="reservation-info">
                <span class="label">Reservations</span>
                <span class="value">{{ $user->reservations->count() }}</span>
            </div>

            <div class="reservation-info">
                <span class="label">Reviews</span>
                <span class="value">{{ $user->reviews->count() }}</span>
            </div>

            <div class="reservation-info">
                <span class="label">Points</span>
                <span class="value">2,450</span>
            </div>

            <div class="reservation-info">
                <span class="label">Coupons</span>
                <span class="value">{{ $user->coupons->count() }}</span>
            </div>

            <div class="reservation-info">
                <span class="label">Stamp Rally</span>
                <span class="value">{{ $user->stamps_count }} / 47</span>
            </div>

            <div class="reservation-info">
                <span class="label">Moderated Reviews</span>
                <span class="value flagged-count">
                    {{ $user->reviews->whereIn('status', ['flagged', 'hidden'])->count() }}
                </span>
            </div>
        </div>
    </div>
    <!-- ⭐ ここに入れる -->
<div class="user-action-buttons text-center mt-4">

    @if(($user->status ?? 'active') === 'active')

        <form method="POST" action="{{ route('admin.users.updateStatus', $user->id) }}" style="display:inline;">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="suspended">
            <button onclick="return confirm('Suspend this user?')" class="action-btn suspended-btn">
                Suspend
            </button>
        </form>

        <form method="POST" action="{{ route('admin.users.updateStatus', $user->id) }}" style="display:inline;">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="banned">
            <button onclick="return confirm('Are you sure you want to ban this user?')" class="action-btn refunded-btn">
                Ban
            </button>
        </form>

    @elseif(($user->status ?? 'active') === 'suspended')

        <form method="POST" action="{{ route('admin.users.updateStatus', $user->id) }}" style="display:inline;">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="active">
                <button onclick="return confirm('Activate this user?')" class="action-btn activate-btn">
                    Activate
                </button>
        </form>

        <form method="POST" action="{{ route('admin.users.updateStatus', $user->id) }}" style="display:inline;">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="banned">
            <button onclick="return confirm('Are you sure?')" class="action-btn refunded-btn">
                Ban
            </button>
        </form>

    @elseif(($user->status ?? 'active') === 'banned')

        <form method="POST" action="{{ route('admin.users.updateStatus', $user->id) }}" style="display:inline;">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="active">
            <button class="action-btn activate-btn">Activate</button>
        </form>

    @endif

</div>
</div>
    <div class="text-center mt-4">
        <a href="{{ route('admin.users.index') }}" class="back-link">
            Back to list
        </a>
    </div>


@endsection