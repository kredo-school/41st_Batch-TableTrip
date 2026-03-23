@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <div class="container d-flex justify-content-center align-items-center vh-100 p-3">
        <div class="card custom-card p-5 shadow-sm" style="max-width: 500px; width: 100%;">
            
            <div class="text-center mb-5">
                <h2 class="custom-header h4 text-uppercase">
                    Create New Account
                </h2>
            </div>

            <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                @csrf 

                {{-- Profile Picture Section --}}
                <div class="row mb-4 align-items-center">
                    <div class="col-sm-4 text-start">
                        <label class="form-label text-nowrap">Profile Picture</label>
                    </div>
                    <div class="col-sm-8 text-center text-sm-start">
                        <label for="profile_picture" class="profile-upload-label">
                            {{-- Image for preview --}}
                            <img id="profile_picture_preview" src="#" alt="Preview" class="profile-preview-img">

                            {{-- Default SVG Icon --}}
                            <svg id="default_svg" width="60" height="60" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="profile-default-svg">
                                <path d="M32 32C37.5228 32 42 27.5228 42 22C42 16.4772 37.5228 12 32 12C26.4772 12 22 16.4772 22 22C22 27.5228 26.4772 32 32 32Z" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M52 52C52 46.4772 47.5228 42 42 42H22C16.4772 42 12 46.4772 12 52" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="32" cy="32" r="31" stroke="#4A4A4A" stroke-width="2"/>
                            </svg>
                        </label>

                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="d-none">
                        <div id="file-name" class="file-name-text">Tap icon to upload</div>
                    </div>
                </div>

                {{-- Validation Errors --}}
                @if($errors->any())
                    <div class="alert alert-danger p-2 small mb-4" style="border-radius: 0; border: 1px solid #dc3545;">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Input Fields --}}
                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="first_name" class="form-label">First Name</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="First name" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="last_name" class="form-label">Last Name</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last name" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="user_name" class="form-label">User Name</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="user_name" id="user_name" class="form-control" value="{{ old('user_name') }}" placeholder="User name" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="tel" class="form-label">Tel</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="tel" name="tel" id="tel" class="form-control" value="{{ old('tel') }}" placeholder="Phone number" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="email" class="form-label">Email Address</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="example@domain.com" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="postal_code" class="form-label">Postal Code</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code') }}" placeholder="Postal code">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="address" class="form-label">Address</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" placeholder="Street address">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="country" class="form-label">Country</label>
                    </div>
                    <div class="col-sm-8">
                        <select name="country" id="country" class="form-select text-muted" required>
                            <option value="" class="text-muted">Select country</option>
                            @foreach(['Japan', 'USA', 'South Korea', 'China', 'Taiwan', 'Singapore', 'Thailand', 'Malaysia', 'Indonesia', 'France', 'Germany', 'Netherlands', 'Spain', 'Hungary', 'Iran', 'India', 'Norway', 'Mexico', 'Switzerland', 'Australia', 'UK', 'Brazil', 'Argentina', 'Uruguay', 'Morocco', 'Italy', 'Ireland'] as $country)
                                <option value="{{ $country }}" {{ old('country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="password" class="form-label">Password</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="password" name="password" id="password" class="form-control" placeholder="**********" required>
                    </div>
                </div>

                <div class="row mb-5 align-items-center">
                    <div class="col-sm-4">
                        <label for="password_confirmation" class="form-label">Confirm</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="**********" required>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url()->previous() }}" class="btn btn-custom btn-back">Back</a>
                    <button type="submit" class="btn btn-custom btn-register">Register</button>
                </div>
            </form>
        </div>
    </div>

    @section('scripts')
        <script src="{{ asset('js/profile.js') }}"></script> 
    @endsection
@endsection