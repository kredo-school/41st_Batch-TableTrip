@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="edit-wrapper">
        <div class="edit-card">
            <h2 class="edit-title">
                Edit User Account
            </h2>
            <form action="{{ route('mypage.edit') }}" class="edit-form" method="POST">
                @csrf
                @method('PUT')
                <div class="profile-icon">
                    <img src="#" alt="profile">
                </div>
                <div class="form-grid">
                    <label>First Name</label>
                    <input type="text" name="first_name" id="first_name" placeholder="first name">

                    <label>Last Name</label>
                    <input type="text" name="last_name" id="last_name" placeholder="last name">
                    
                    <label>User Name</label>
                    <input type="text" name="user_name" id="user_name" placeholder="user name">
                    
                    <label>Tel</label>
                    <input type="number" name="tel" id="tel" placeholder="xx-xxxx-xxxx">
                    
                    <label>Email Address</label>
                    <input type="email" name="email" id="email" placeholder="xx-xxxx-xxxx">
                    <label>Postal Code</label>
                    <input type="text" name="postal_code">

                    <label>Address</label>
                    <div class="address-row">
                        <input type="text" name="address">
                        <select name="country">
                            <option>Japan</option>
                            <option>USA</option>
                            <option>South Korea</option>
                            <option>China</option>
                            <option>Taiwan</option>
                            <option>Singapore</option>
                            <option>Thailand</option>
                            <option>Malaysia</option>
                            <option>Indonesia</option>
                            <option>France</option>
                            <option>Deutchland</option>
                            <option>Nederland</option>
                            <option>Spain</option>
                            <option>Hungary</option>
                            <option>Iran</option>
                            <option>Indo</option>
                            <option>Norway</option>
                            <option>Mexico</option>
                            <option>Switzerland</option>
                            <option>Australia</option>
                            <option>Austlia</option>
                            <option>United Kingdom</option>
                            <option>Brasil</option>
                            <option>Arzentina</option>
                            <option>Urgway</option>
                            <option>Morocco</option>
                            <option>Italy</option>
                            <option>Ireland</option>
                        </select>
                    </div>

                    <label>Password</label>
                    <input type="password" name="password">

                </div>
            {{-- update --}}
                <div class="button-area">
                    <button type="submit" class="btn-update">Update</button>
                </div>
            </form>
            {{-- delete --}}
            <form action="{{ route('mypage.destroy') }}" method="POST"class="button-area" onsubmit="return confirm('Are you sure you want to delete your account?');">
                 @csrf
                 @method('DELETE')
                 <button type="submit" class="btn-delete">Delete Account</button>
            </form>

        </div>
    </div>
@endsection