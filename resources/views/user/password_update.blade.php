@extends('layouts.app')
@section('title','Update Password')

@section('content')
<link rel="stylesheet" href="{{ asset('css/forget.css') }}">

<div class="login-page-wrapper vh-100 d-flex flex-column align-items-center justify-content-center">
{{-- title with single underline --}}
    <div class="login-header-container text-center mb-5">
        <h1 class="login-title">New Password</h1>
        <div class="login-underline"></div>
    </div>

    {{-- form card --}}
    <div class="login-card">
        <p class="instruction-text text-center">
            Please enter your new password to secure your account.
        </p>

        <form action="{{ route('password.update')}}" method="POST">
            @csrf
            {{-- Token from Controller --}}
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email Input (Read-only for security and UX) --}}
            <div class="row mb-4 align-items-center">
                <label for="email" class="login-label col-sm-4">Email Address</label>
                <div class="col-sm-8">
                    <input type="email" name="email" id="email" class="login-input" value="{{ $email ?? old('email') }}" required readonly>
                </div>
                @error('email')
                    <div class="text-danger small mt-2 ps-3">{{ $message }}</div>
                @enderror
            </div>

           {{-- New Password --}}
            <div class="row mb-4 align-items-center">
                <label for="password" class="login-label col-sm-4">New Password</label>
                <div class="col-sm-8">
                    <input type="password" name="password" id="password" class="login-input" required>
                </div>
            </div>

            {{-- Confirm Password --}}
            <div class="row mb-4 align-items-center">
                <label for="password_confirmation" class="login-label col-sm-4">Confirm Password</label>
                <div class="col-sm-8">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="login-input" required>
                </div>
            </div>

            {{-- update button --}}
            <div class="text-end">
                <button type="submit" class="btn-login-submit">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection