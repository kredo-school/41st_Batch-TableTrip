@extends('layouts.app')

@section('title', 'Login')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">

<div class="login-page-wrapper vh-100 d-flex flex-column align-items-center justify-content-center">
        {{-- title part --}}
        <div class="login-header-container text-center mb-5">
            <h1 class="login-title">Log in</h1>
            <div class="login-underline"></div>
        </div>

        {{-- form card --}}
    <div class="login-card">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="row mb-5 align-items-center">
                    <label for="email" class="form-label">Email</label>
                    <div class="col-sm-7">
                        <input type="email"name="email" id="email" class="login-input" value="{{ old('email') }}"required autofocus>
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-5 row align-items-center">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="login-input" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- bottom --}}
                <div class="row justify-content-end">
                    <div class="col-sm-7 text-center">
                        <button type="submit" class="btn-login-submit">Login</button>
                    {{-- forget password--}}
                        <div class="forget-password-container mt-4 d-flex align-items-center justify-content-center gap-3">
                            <span class="forget-text">Forgotten Password?</span>
                            <a href="{{ route('login') }}" class="btn-press">Press</a>
                        </div>
                    {{-- connect to register --}}
                        <div class="register-link-container d-flex align-items-center justify-content-center gap-3">
                            <span class="forget-text">Don't have an account?</span>
                            <a href="{{route('register.show')}}" class="btn-press">Register</a>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>

@endsection