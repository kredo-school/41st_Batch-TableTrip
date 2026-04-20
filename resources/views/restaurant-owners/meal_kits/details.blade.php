@extends('layouts.owner')

@section('title','Meal Kit Details')

@section('content')
  <div class="m-5">
     <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent text-center mb-4">Meal Kit Details</h1>

            <div class="meal-kit-card position-relative border bg-white p-4 my-5">

                {{-- ribbon --}}
                <div class="difficulty-ribbon">
                    <span class="display-4 text-white">{{ $product->difficulty_level }}</span>
                </div>

                {{-- image --}}
                <div id="productCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        @forelse($images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->image_url) }}"
                                    class="img-fluid meal-kit-image mx-auto"
                                    alt="product image">
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="img-fluid meal-kit-image mx-auto"
                                    alt="product image">
                            </div>
                        @endforelse
                    </div>

                    @if($images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>

                {{-- body --}}
                <div class="px-2">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h2 class="meal-kit-title mb-1">{{ $product->name }}</h2>
                            <p class="meal-kit-subtitle mb-0">{{ $product->restaurant->prefecture }} | {{ $product->restaurant->restaurant_name }}</p>
                        </div>

                        <div class="text-end">
                            <div class="d-flex align-items-center gap-2 justify-content-end mb-1">
                                <span class="badge text-dark border rounded-pill px-2 py-1">Cool</span>
                                <div class="d-flex align-items-center gap-1 small">
                                    <i class="fa-solid fa-users"></i>
                                    <span>serving {{ $product->serving }}</span>
                                </div>
                            </div>
                            <div class="meal-kit-price">$ {{ $product->price }}</div>
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
                                {{ $product->description }}
                            </p>

                            <h5 class="section-title mb-1">Ingredients</h5>
                            <p class="small mb-1">
                                {{ $product->ingredient }}
                            </p>
                            <p class="small mb-0">
                                Allergens : {{ $product->allergens }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-3 d-flex justify-content-center">
                <a href="{{ route('owner.products') }}" class="btn btn-outline-navy mx-3">Back</a>
                <a href="{{ route('owner.products.edit',$product->id) }}" class="btn btn-navy mx-3">Edit</a>
            </div>


        </div>
     </div>
  </div>
    
@endsection