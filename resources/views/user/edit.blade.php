@extends('layouts.app')
@section('title', 'Edit User Account')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="edit-wrapper">
    <div class="edit-card">
        <h2 class="edit-title">Edit User Account</h2>

        {{-- Update Form --}}
        <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" id="update-form">
            @csrf
            @method('PUT')

            <div class="form-grid">
                {{-- Profile Picture--}}
                <div class="form-row">
                    <label>Profile Picture</label>
                    <div class="input-field profile-section">
                        <label for="profile_picture" class="profile-upload-label">
                            <svg id="default_svg" class="upload-icon" width="50" height="50" viewBox="0 0 64 64">
                                <circle cx="32" cy="32" r="30" stroke="#4A4A4A" fill="none" />
                                <path d="M32 32C37 32 41 28 41 23S37 14 32 14 23 18 23 23 27 32 32 32Z" stroke="#4A4A4A" fill="none"/>
                                <path d="M50 50C50 44 45 40 32 40S14 44 14 50" stroke="#4A4A4A" fill="none"/>
                            </svg>
                            <span class="upload-status">Done!</span>
                            <input type="file" name="profile_picture" id="profile_picture" class="hidden-input" accept="image/*" required>
                        </label>
                    </div>
                </div>

                {{-- Edit Information --}}
                <div class="form-row">
                    <label>First Name</label>
                    <div class="input-field"><input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required></div>
                </div>
                <div class="form-row">
                    <label>Last Name</label>
                    <div class="input-field"><input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required></div>
                </div>
                <div class="form-row">
                    <label>User Name</label>
                    <div class="input-field"><input type="text" name="user_name" class="form-control" value="{{ old('user_name', $user->user_name) }}" required></div>
                </div>
                <div class="form-row">
                    <label>Tel</label>
                    <div class="input-field"><input type="text" name="tel" class="form-control" value="{{ old('tel', $user->tel) }}" required></div>
                </div>
                <div class="form-row">
                    <label>Email Address</label>
                    <div class="input-field"><input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required></div>
                </div>
                <div class="form-row">
                    <label>Postal Code</label>
                    <div class="input-field"><input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $user->postal_code) }}" required></div>
                </div>

                {{-- Address --}}
                <div class="form-row">
                    <label for="address">Address</label>
                    <div class="input-field">
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $user->address) }}" required>
                    </div>
                </div>

                {{-- Country --}}
                <div class="form-row">
                    <label for="country">Country</label>
                    <div class="input-field">
                        <select name="country" id="country" class="form-select" required>
                            <option value="">Select country</option>
                            @foreach(['Japan', 'USA', 'South Korea', 'China', 'Taiwan', 'Singapore', 'Thailand', 'Malaysia', 'Indonesia', 'France', 'Germany', 'Netherlands', 'Spain', 'Hungary', 'Iran', 'India', 'Norway', 'Mexico', 'Switzerland', 'Australia', 'UK', 'Brazil', 'Argentina', 'Uruguay', 'Morocco', 'Italy', 'Ireland'] as $country)
                                <option value="{{ $country }}" {{ old('country', $user->country) == $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <label>New Password</label>
                    <div class="input-field"><input type="password" name="password" class="form-control" placeholder="Leave blank to keep current"></div>
                </div>
            </div>
        </form>

        {{-- Button Area --}}
        <div class="edit-actions-container">
            <button type="submit" form="update-form" class="btn-update">Update Account</button>

            <form action="{{ route('user.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete your account?');" class="m-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Delete Account</button>
            </form>

            <a href="{{ route('dashboard') }}" class="btn-back" onclick="return confirm('Any unsaved changes will be lost. Are you sure you want to return to the dashboard?');">
                <i class="fa-solid fa-house"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
