@extends('layouts.app')

@section('title', 'Edit User Account')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="edit-wrapper">
    <div class="edit-card">
        <h2 class="edit-title">Edit User Account</h2>

        {{-- update form --}}
        <form action="{{ route('user.update') }}" class="edit-form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                {{-- Profile Picture --}}
                <div class="form-row">
                    <label>Profile Picture</label>
                    <div class="input-field profile-section">
                        <label for="profile_picture" class="profile-upload-label">
                            @if($user->profile_picture)
                                <img id="profile_picture_preview" src="{{ asset('storage/' . $user->profile_picture) }}" class="rounded-circle">
                            @else
                                <img id="profile_picture_preview" src="" style="display: none;" class="rounded-circle">
                                <svg id="default_svg" width="50" height="50" viewBox="0 0 64 64">
                                    <circle cx="32" cy="32" r="30" stroke="#4A4A4A" fill="none" />
                                    <path d="M32 32C37 32 41 28 41 23S37 14 32 14 23 18 23 23 27 32 32 32Z" stroke="#4A4A4A" fill="none"/>
                                    <path d="M50 50C50 44 45 40 32 40S14 44 14 50" stroke="#4A4A4A" fill="none"/>
                                </svg>
                            @endif
                        </label>
                        <input type="file" name="profile_picture" id="profile_picture" style="display:none;" accept="image/*">
                    </div>
                </div>

                {{-- Name fields --}}
                <div class="form-row">
                    <label>First Name</label>
                    <div class="input-field">
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <label>Last Name</label>
                    <div class="input-field">
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <label>User Name</label>
                    <div class="input-field">
                        <input type="text" name="user_name" class="form-control" value="{{ old('user_name', $user->user_name) }}" required>
                    </div>
                </div>

                {{-- Contact info --}}
                <div class="form-row">
                    <label>Tel</label>
                    <div class="input-field">
                        <input type="text" name="tel" class="form-control" value="{{ old('tel', $user->tel) }}">
                    </div>
                </div>

                <div class="form-row">
                    <label>Email Address</label>
                    <div class="input-field">
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                {{-- Address --}}
                <div class="form-row">
                    <label>Postal Code</label>
                    <div class="input-field">
                        <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $user->postal_code) }}">
                    </div>
                </div>

                <div class="form-row">
                    <label>Address & Country</label>
                    <div class="input-field">
                        <div class="address-row d-flex gap-2">
                            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                            <select name="country" class="form-select">
                                <option value="">Select Country</option>
                                @foreach(['Japan', 'USA', 'South Korea', 'China', 'Taiwan', 'UK'] as $country)
                                    <option value="{{ $country }}" {{ old('country', $user->country) == $country ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-row">
                    <label>New Password </label>
                    <div class="input-field">
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
            </div>

            {{-- button --}}
            <div class="d-flex justify-content-center gap-4 mt-5">
                <button type="submit" class="btn-update">Update Account</button>
        </form> {{-- Update --}}

        {{-- Delete --}}
        <form action="{{ route('user.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Delete Account</button>
        </form>
            </div>
    </div>
</div>
@endsection