@extends('layouts.app')

@section('title','Setting')

@section('content')
   <div class="container mx-auto my-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent mb-5">Setting</h1>

            <div class="col-12 col-lg-9">

                {{-- Change Password --}}
                <div class="mb-5 ">
                    <h3 class="mb-3">Change Password</h3>
                    <hr>

                    <form action="" method="POST" class="mt-4 w-50 mx-auto">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3" style="max-width: 560px;">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control form-transparent" id="current_password" name="current_password">
                        </div>

                        <div class="mb-3" style="max-width: 560px;">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control form-transparent" id="new_password" name="new_password">
                        </div>

                        <div class="mb-4" style="max-width: 560px;">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control form-transparent" id="new_password_confirmation" name="new_password_confirmation">
                        </div>

                        <div class="text-center" style="max-width: 560px;">
                            <button type="submit" class="btn btn-navy px-4">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Notification Setting --}}
                <div class="mb-5">
                    <h3 class="mb-3">Notification Setting</h3>
                    <hr>
                    <form action="" method="POST" class="mt-4 w-50">
                        @csrf
                        @method('PATCH')

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="1" id="new_order_notification" name="new_order_notification">
                            <label class="form-check-label" for="new_order_notification">
                                Email notifications for new order
                            </label>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" value="1" id="new_reservation_notification" name="new_reservation_notification">
                            <label class="form-check-label" for="new_reservation_notification">
                                Email notifications for new reservations
                            </label>
                        </div>
                    </form>
             
                </div>

                {{-- Delete Account --}}
                <div class="text-center mt-5">
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-orange px-4">
                            Delete Account
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
   </div>

    
@endsection