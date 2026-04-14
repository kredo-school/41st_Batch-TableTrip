@extends('layouts.owner')

@section('title', 'Login')

@section('content')
<div class="container my-5" >

    <div class="mx-auto my-5 p-4" style="background-color:rgb(231, 207, 192); border-radius:10px; max-width:400px;">

        <h3 class="text-center mb-4 text-white">Restaurant Owner Login</h3>
       
            <form method="POST" action="{{ route('owner.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label text-white">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-white">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                     @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="text-center">
                     <button type="submit" class="btn btn-navy px-4 mb-2 w-50">Login</button>
                </div>
                <a href="{{ route('owner.register') }}" class="d-block text-center"> Create an account</a>
            </form>
       
    </div>
</div>
@endsection