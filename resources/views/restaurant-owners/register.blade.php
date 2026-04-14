@extends('layouts.owner')

@section('title', 'Restaurant Owner Registration')

@section('content')

<div class="container mx-auto my-5">
   <div class="row align-items-start g-4 gy-4">
    <div class="col-12 col-lg-5">

        <div class="my-4">
            <h1 class="mb-3">Expand Your Restaurant Beyond the Table</h1>
            <p>
                Join "Table Trip", a circular culinary platform. 
                Connect with fans through meal kits and drive them back to your physical tables.
            </p>
        </div>

        <div class="row g-3 my-3">

            <div class="col-12 col-sm-6">
                <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">New Revenue Stream</h5>
                    <i class="fa-solid fa-chart-line icon-lg"></i>
                </div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Brand Awareness</h5>
                    <i class="fa-solid fa-bullhorn icon-lg"></i>
                </div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Seamless Reservation</h5>
                    <i class="fa-regular fa-calendar-check icon-lg"></i>
                </div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="card  text-center">
                <div class="card-body">
                    <h5 class="card-title">Digital Integration</h5>
                    <i class="fa-solid fa-mobile-screen-button icon-lg"></i>
                </div>
                </div>
            </div>

        </div>
        <div class="my-5">
            <h5><i class="fa-solid fa-triangle-exclamation me-2"></i>Notice</h5>
            <p class="small text-muted">Your request will be reviewed by our team for quality assurance. We will get back to you with the results via email within 3 business days.</p>
        </div>
    </div>


  <div class="col-12 col-lg-6 ms-lg-auto" style="background-color:rgb(231, 207, 192); padding: 30px; border-radius: 10px;">
    <h1 class="text-white mb-4 text-center">Request an Account</h1>
    <form action="{{ route('owner.register.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="restaurant_name" class="text-white">Restaurant Name</label>
            <input type="text" class="form-control bg-white @error('restaurant_name') is-invalid @enderror" value="{{ old('restaurant_name') }}"  id="restaurant_name" name="restaurant_name" autofocus>
             @error('restaurant_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="text-white">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email">
             @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="text-white">Phone Number</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" id="phone" name="phone">  
             @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror      
        </div>
    
      <div class="row g-3 mb-3">

            <div class="col-md-6">
                <label for="prefecture" class="text-white form-label">Prefecture</label>
                <select class="form-select @error('prefecture') is-invalid @enderror" id="prefecture" name="prefecture" style="border: none;">
                    <option value="" selected disabled>Select Prefecture</option>
                    <option value="Hokkaido">Hokkaido</option>
                    <option value="Fukuoka">Fukuoka</option>
                    <option value="Akita">Akita</option>
                    <option value="Tokyo">Tokyo</option>
                    <option value="Osaka">Osaka</option>
                </select>

                 @error('prefecture')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>

            <div class="col-md-6">
                <label for="city" class="text-white form-label">City</label>
                <input type="text" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" id="city" name="city">
                 @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>

        </div>
        <div class="mb-3">
            <label for="address_line" class="text-white form-label">Address Line</label>
            <input type="text" class="form-control @error('address_line') is-invalid @enderror" value="{{ old('address_line') }}" id="address_line" name="address_line">
             @error('address_line')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="text-white form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
             @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="password_confirmation" class="text-white form-label">Password Confirm</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
             @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
            <button type="submit" class="btn btn-navy w-100 w-md-auto px-4">Submit Request</button>
       
    </form>


    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const successModal = new bootstrap.Modal(document.getElementById('registerSuccessModal'));
                successModal.show();
            });
        </script>
    @endif
    </div>
</div>
 @include('restaurant-owners.register_success_modal')
</div>
  
@endsection
