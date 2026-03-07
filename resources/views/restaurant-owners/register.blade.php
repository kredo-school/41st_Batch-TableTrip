@extends('layouts.app')

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
    <form action="">
        @csrf
        <div class="mb-3">
            <label for="restaurant_name" class="text-white">Restaurant Name</label>
            <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" autofocus>
        </div>
        <div class="mb-3">
            <label for="email" class="text-white">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="phone" class="text-white">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone">        
        </div>
       <div class="mb-3">
            <label for="country" class="text-white form-label">Country</label>
            <select class="form-select" id="country" name="country" style="border: none;">
                <option value="" selected disabled>Select Country</option>
                <option value="Japan">Japan</option>
                <option value="United States">United States</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Singapore">Singapore</option>
                <option value="Australia">Australia</option>
            </select>
        </div>

        <div class="row g-2 mb-3">
            <div class="col-12 col-md-6">
                <label for="postal_code" class="text-white form-label">Postal Code</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code">
            </div>

            <div class="col-12 col-md-6">
                <label for="state_region" class="text-white form-label">State / Region</label>
                <input type="text" class="form-control" id="state_region" name="state_region" >
            </div>
        </div>

        <div class="mb-3">
            <label for="city" class="text-white form-label">City</label>
            <input type="text" class="form-control" id="city" name="city">
        </div>
        <div class="mb-3">
            <label for="address_line" class="text-white form-label">Street Address</label>
            <input type="text" class="form-control" id="address_line" name="address_line">
        </div>
            <button type="submit" class="btn btn-navy w-100 w-md-auto px-4">Submit Request</button>
       
    </form>
  </div>

</div>
</div>

@endsection
