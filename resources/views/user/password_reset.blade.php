@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<link rel="stylesheet" href="{{ asset('css/forget.css') }}">

<div class="login-page-wrapper vh-100 d-flex flex-column align-items-center justify-content-center">
    
    {{-- Title with Single Underline --}}
    <div class="login-header-container text-center mb-5">
        <h1 class="login-title">Reset Password</h1>
        <div class="login-underline"></div>
    </div>

    {{-- Form Card --}}
    <div class="login-card">
        
        {{-- Success Message Display --}}
        @if (session('status'))
            <div class="alert-success-custom">
                {{ session('status') }}
            </div>
        @endif

        <p class="instruction-text text-center">
            Enter your email address and we'll send you a link to reset your password.
        </p>

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            {{-- Email Input --}}
            <div class="row mb-5 align-items-center">
                <label for="email" class="login-label col-sm-4">Email Address</label>
                <div class="col-sm-8">
                    <input type="email" name="email" id="email" class="login-input" value="{{ old('email') }}" required autofocus>
                </div>
                @error('email')
                    <div class="text-danger small mt-2 ps-3">{{ $message }}</div>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex justify-content-end align-items-center gap-3">
                <a href="{{ route('login') }}" class="back-link">
                    Back to Login
                </a>
                <button type="submit" class="btn-login-submit">
                    Send Link
                </button>
            </div>

        </form>
    </div>
</div>
@endsection