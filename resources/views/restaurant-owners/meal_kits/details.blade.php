@extends('layouts.owner')

@section('title','Meal Kit Details')

@section('content')
  <div class="container mx-auto my-5">
     <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent text-center mb-4">Meal Kit Details</h1>

            <div class="meal-kit-card position-relative border bg-white p-4 my-5">

                {{-- ribbon --}}
                <div class="difficulty-ribbon">
                    <span>Easy</span>
                </div>

                {{-- image --}}
                <div class="text-center mb-3">
                    <img src="{{ asset('images/journykit.png') }}" alt="Journey Kit" class="img-fluid meal-kit-image mx-auto">
                </div>

                {{-- body --}}
                <div class="px-2">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h2 class="meal-kit-title mb-1">Journey Kit</h2>
                            <p class="meal-kit-subtitle mb-0">Hokkaido | Kitchen Sapporo</p>
                        </div>

                        <div class="text-end">
                            <div class="d-flex align-items-center gap-2 justify-content-end mb-1">
                                <span class="badge text-dark border rounded-pill px-2 py-1">Cool</span>
                                <div class="d-flex align-items-center gap-1 small">
                                    <i class="fa-solid fa-users"></i>
                                    <span>serving</span>
                                </div>
                            </div>
                            <div class="meal-kit-price">$ 20.5</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="text-warning fs-4 lh-1">
                            ★★★★★
                        </div>
                        <small>5.0 (40)</small>
                    </div>

                    <div class="row">
                        <div class="col-10">
                            <h5 class="section-title mb-1">Description</h5>
                            <p class="small mb-3">
                                "Enjoy the authentic taste of Hokkaido right at your dining
                                table. Made with fresh, local ingredients."
                            </p>

                            <h5 class="section-title mb-1">Ingredients</h5>
                            <p class="small mb-1">
                                Chicken leg, Potato, Carrot, Onion, Tomato paste, Garlic,
                                Ginger, Original spice blend, Vegetable oil, Salt.
                            </p>
                            <p class="small mb-0">
                                Allergens : Wheat, Soy, Chicken
                            </p>
                        </div>

                        <div class="col-2 d-flex flex-column justify-content-end align-items-center">
                            <button type="button" class="btn p-0 border-0 bg-transparent text-center">
                                <i class="fa-solid fa-cart-shopping fs-1 text-dark"></i>
                                <div class="small mt-1">Add Cart</div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-3 d-flex justify-content-center">
                <a href="" class="btn btn-outline-navy mx-3">Back</a>
                <a href="" class="btn btn-navy mx-3">Edit</a>
            </div>


        </div>
     </div>
  </div>
    
@endsection