@extends('layouts.owner')

@section('title','Page Management')

@section('content')
    <div class="m-5">
    <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent mb-4">Page Management</h1>
            @include('restaurant-owners.page-management.tabs')

                 @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <form action="{{ route('owner.page-management.updateBasicInfo') }}" method="POST">
             @csrf
             @method('PATCH')

                {{-- Restaurant Name --}}
                <div class="mb-3">
                    <label for="restaurant_name" class="form-label">Restaurant Name</label>
                    <input type="text" class="form-control form-transparent @error('restaurant_name') is-invalid @enderror" id="restaurant_name" name="restaurant_name"
                        value="{{ old('restaurant_name', $restaurant->restaurant_name) }}">
                    @error('restaurant_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email / Phone --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-transparent @error('email') is-invalid @enderror" id="email" name="email"
                            value="{{ old('email', $restaurant->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control form-transparent @error('phone') is-invalid @enderror" id="phone" name="phone"
                            value="{{ old('phone', $restaurant->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Prefecture / City / Address --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="prefecture" class="form-label">Prefecture</label>
                        <input type="text" class="form-control form-transparent @error('prefecture') is-invalid @enderror" id="prefecture" name="prefecture" value="{{ old('prefecture', $restaurant->prefecture) }}">
                        @error('prefecture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control form-transparent @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $restaurant->city) }}">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="address_line" class="form-label">Address Line</label>
                        <input type="text" class="form-control form-transparent @error('address_line') is-invalid @enderror" id="address_line" name="address_line" value="{{ old('address_line', $restaurant->address_line) }}">
                        @error('address_line')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Opening Hours / Chef --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="opening_hours" class="form-label">Opening Hours</label>
                        <input type="text" class="form-control form-transparent @error('opening_hours') is-invalid @enderror" id="opening_hours" name="opening_hours"
                            placeholder="11:00 AM - 10:00 PM" value="{{ old('opening_hours',$restaurant->opening_hours) }}">
                        @error('opening_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="chef" class="form-label">Chef</label>
                        <input type="text" class="form-control form-transparent" id="chef" name="chef"
                            placeholder="Optional">
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control form-transparent @error('description') is-invalid @enderror" id="description" name="description" rows="6"
                        placeholder="ex) Experience authentic japanese ......">{{ old('description', $restaurant->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="mb-4">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select rounded form-transparent" id="category_id" name="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $restaurant->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
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