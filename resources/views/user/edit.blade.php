@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="edit-wrapper">
        <div class="edit-card">
            <h2 class="edit-title">
                Edit User Account
            </h2>
            <form action="#" class="edit-form" method="POST">
                @csrf
                @method('POST')
            <div class="profile-icon">
                <img src="#" alt="profile">
            </div>
            <div class="form-grid">
                <label>First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="first name">

                <label>Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="last name">
                
                <label>User Name</label>
                <input type="text" name="user_name" id="user_name" placeholder="user name">>
                
                <label>Tel</label>
                <input type="number" name="tel" id="tel" placeholder="xx-xxxx-xxxx">
                
                <label>Email Address</label>
                <input type="email" name="email" id="tel" placeholder="xx-xxxx-xxxx">
                
            </div>

            </form>

        </div>
    </div>
@endsection