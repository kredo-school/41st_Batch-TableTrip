@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="edit-wrapper">
    <div class="edit-card">
        <h2 class="edit-title">Edit User Account</h2>

        <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" id="update-form">
            @csrf
            @method('PUT')

           {{-- Profile Picture Section --}}

           <div class="row mb-4 align-items-center">
                <div class="col-sm-4">
                    <label class="form-label text-nowrap">Profile Picture</label>
                </div>

                <div class="col-sm-8 text-center text-sm-start">
                    <label for="profile_picture" class="profile-upload-label">

                        @if(isset($user) && $user->profile_picture)
                            <img id="profile_picture_preview"
                                src="{{ asset('storage/' . $user->profile_picture) }}"
                                alt="Profile"
                                class="profile-preview-img"
                                style="display: inline-block;">

                            <svg id="default_svg" style="display: none;" width="60" height="60"></svg>

                        @else
                            <img id="profile_picture_preview"
                                src="#"
                                alt="Preview"
                                class="profile-preview-img"
                                style="display: none;">

                            <svg id="default_svg"
                                width="60" height="60"
                                viewBox="0 0 64 64"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                class="profile-default-svg">

                                <path d="M32 32C37.5228 32 42 27.5228 42 22C42 16.4772 37.5228 12 32 12C26.4772 12 22 16.4772 22 22C22 27.5228 26.4772 32 32 32Z"
                                    stroke="#4A4A4A" stroke-width="2"/>

                                <path d="M52 52C52 46.4772 47.5228 42 42 42H22C16.4772 42 12 46.4772 12 52"
                                    stroke="#4A4A4A" stroke-width="2"/>

                                <circle cx="32" cy="32" r="31"
                                    stroke="#4A4A4A" stroke-width="2"/>
                            </svg>
                        @endif

                    </label>

                    <input type="file"
                        name="profile_picture"
                        id="profile_picture"
                        accept="image/*"
                        class="d-none">


                    <div id="file-name" class="file-name-text">
                        Tap icon to upload
                    </div>
                </div>
            </div>

            @section('scripts')
                <script src="{{ asset('js/profile.js') }}"></script>
            @endsection

            <div class="form-container">
                <div class="form-row">
                    <label>First Name</label>
                    <div class="input-field">
                        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <label>Last Name</label>
                    <div class="input-field">
                        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <label>User Name</label>
                    <div class="input-field">
                        <input type="text" name="user_name" value="{{ old('user_name', $user->user_name) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <label>Tel</label>
                    <div class="input-field">
                        <input type="text" name="tel" value="{{ old('tel', $user->tel) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <label>Email Address</label>
                    <div class="input-field">
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <label>Postal Code</label>
                    <div class="input-field">
                        <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <label for="country">Country</label>
                    <div class="input-field">
                        <select name="country" id="country" required>
                            <option value="">Select country</option>
                            @foreach(['Japan', 'USA', 'South Korea', 'China', 'Taiwan', 'Singapore', 'Thailand', 'Malaysia', 'Indonesia', 'France', 'Germany', 'Netherlands', 'Spain', 'Hungary', 'Iran', 'India', 'Norway', 'Mexico', 'Switzerland', 'Australia', 'UK', 'Brazil', 'Argentina', 'Uruguay', 'Morocco', 'Italy', 'Ireland'] as $country)
                                <option value="{{ $country }}" {{ old('country', $user->country) == $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <label>Address</label>
                    <div class="input-field">
                        <input type="text" name="address" value="{{ old('address', $user->address) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <label>Password</label>
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Leave blank to keep current">
                    </div>
                </div>
            </div>

                <div class="edit-actions-container">
                    <button type="submit" class="btn-update">Update</button>
                    <button type="button" class="btn-delete" onclick="event.preventDefault(); if(confirm('Are you sure?')) document.getElementById('delete-form').submit();">Delete</button>
                    <a href="{{ route('dashboard') }}" class="btn-back">
                        <i class="fa-solid fa-house"></i> Back to Dashboard
                    </a>
                </div>
        </form>

        <form id="delete-form" action="{{ route('user.destroy') }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/profile.js') }}"></script> 
@endpush
@endsection