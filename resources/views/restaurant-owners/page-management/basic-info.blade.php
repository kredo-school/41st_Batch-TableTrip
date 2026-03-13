@extends('layouts.app')

@section('title','Page Management')

@section('content')
    <div class="container mx-auto my-5">
    <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent mb-4">Page Management</h1>
            @include('restaurant-owners.page-management.tabs')

            <form action="" method="POST">
             @csrf

                {{-- Restaurant Name --}}
                <div class="mb-3">
                    <label for="restaurant_name" class="form-label">Restaurant Name</label>
                    <input type="text" class="form-control" id="restaurant_name" name="restaurant_name"
                        value="Restaurant Sato">
                </div>

                {{-- Email / Phone --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="restaurant.sato@gmail.com">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="090-1234-5678">
                    </div>
                </div>

                {{-- Prefecture / City / Address --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="prefecture" class="form-label">Prefecture</label>
                        <select class="form-select rounded" id="prefecture" name="prefecture">
                            <option>Hokkaido</option>
                            <option selected>Tokyo</option>
                            <option>Osaka</option>
                            <option>Fukuoka</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="city" class="form-label rounded">City</label>
                        <select class="form-select rounded" id="city" name="city">
                            <option>Shibuya</option>
                            <option selected>Chiyoda</option>
                            <option>Shinjuku</option>
                            <option>Minato</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="address_line" class="form-label">Address Line</label>
                        <input type="text" class="form-control" id="address_line" name="address_line">
                    </div>
                </div>

                {{-- Opening Hours / Chef --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="opening_hours" class="form-label">Opening Hours</label>
                        <input type="text" class="form-control" id="opening_hours" name="opening_hours"
                            placeholder="11:00 AM - 10:00 PM">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="chef" class="form-label">Chef</label>
                        <input type="text" class="form-control" id="chef" name="chef"
                            placeholder="Optional">
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="6"
                        placeholder="ex) Experience authentic japanese ......"></textarea>
                </div>

                {{-- Category --}}
                <div class="mb-4">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select rounded" id="category" name="category">
                        <option>Korean</option>
                        <option selected>Japanese</option>
                        <option>Chinese</option>
                        <option>Italian</option>
                        <option>French</option>
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" name="action" value="draft" class="btn btn-outline-orange px-5">
                        Save Draft
                    </button>

                    <button type="submit" name="action" value="publish" class="btn btn-orange px-5">
                        Publish
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
    
@endsection