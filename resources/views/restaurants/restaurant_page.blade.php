@extends('layouts.app')

@section('title','Restaurant')



@section('content')
  {{-- Hero --}}
  <section class="container-fluid p-0">
      @if ($restaurant->heroImage)
          <img src="{{ asset('storage/'.$restaurant->heroImage->image_url) }}" alt="hero_image" class="img-fluid rounded hero-image w-100">
      @else
          <div class="bg-light border rounded d-flex align-items-center justify-content-center hero-image w-100" >
              <span class="text-muted">No Hero Image Uploaded</span>
          </div>
      @endif
  </section>

  <div class="container py-4">

    {{-- Title + Heart --}}
    <div class="d-flex align-items-center justify-content-between">
      <h1 class="mb-0">{{ $restaurant->restaurant_name }}</h1>
      @auth
      <form action="{{ route('restaurant.favorite', $restaurant->id) }}" method="post">
        @csrf
        @if ($isFavorite)
            <button class="btn p-0 border-0 bg-transparent" aria-label="unfavorite">
              <i class="fa-solid fa-heart fs-3 text-orange"></i>
            </button>
        @else
            <button class="btn p-0 border-0 bg-transparent" aria-label="favorite">
              <i class="fa-regular fa-heart fs-3 text-orange"></i>
            </button>     
        @endif
      </form>
      @endauth
    </div>

    {{-- Gallery 2 photos --}}
    <section class="row g-3 mt-2">
     
      <div class="col-12 col-md-6">
        @if ($restaurant->galleryImage1)
          <img src="{{ asset('storage/'.$restaurant->galleryImage1->image_url) }}" class="w-100 rounded sub-image" alt="Gallery Image 1">
        @else
          <div class="bg-light border rounded d-flex align-items-center justify-content-center sub-image w-100" >
            <span class="text-muted">No Gallery Image 1 Uploaded</span>
          </div>
        @endif
      </div>
      <div class="col-12 col-md-6">
        @if ($restaurant->galleryImage2)
          <img src="{{ asset('storage/'.$restaurant->galleryImage2->image_url) }}" class="w-100 rounded sub-image"  alt="Gallery Image 2">
        @else
          <div class="bg-light border rounded d-flex align-items-center justify-content-center sub-image w-100" >
            <span class="text-muted">No Gallery Image 2 Uploaded</span>
          </div>
        @endif
      </div>
    </section>

     {{-- Description --}}
    <section class="my-5">
      {{-- <h5 class="fw-bold">Authentic Japanese Flavors in the Heart of the City</h5> --}}
      <p class="mb-0" style="max-width: 900px;">
        {{ $restaurant->description }}
      </p>
    </section>

    {{-- Menu --}}
    <section class="mt-4">
      <h2 class="text-center my-5 text-underline-accent">Menu</h2>

      {{-- Bootstrap carousel --}}
      <div id="menuCarousel" class="carousel slide" data-bs-ride="false">
        <div class="carousel-inner">
           @forelse ($menus->chunk(4) as $chunkIndex => $menuChunk)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="row g-3 justify-content-center">
                        @foreach ($menuChunk as $menu)
                            <div class="col-6 col-md-3">
                                <div class="card border-0 bg-transparent">
                                    <img src="{{ asset('storage/' . $menu->image) }}"
                                        class="card-img-top rounded"
                                        style="height: 140px; object-fit: cover;"
                                        alt="{{ $menu->name }}">
                                    <div class="card-body px-0 pt-2">
                                        <div class="small fw-semibold">{{ $menu->name }}</div>
                                        <div class="small text-muted">${{ $menu->price }}</div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="col-12">
                                    <div class="no-data-box text-center p-5">No menus available yet.</div>
                                </div>                    
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

        @if($menus->count() > 4)
            <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
      </div>
    </section>


    {{-- Basic Info + Reservation --}}
    <section class="row g-4 mt-4">
      <div class="col-12 col-lg-6 p-3">
         <h4 class="section-title text-center p-3">Basic Information</h4>

        {{-- Info rows --}}
        <div class="info-block mt-3 small">

            {{-- Business Hours --}}
            <div class="info-row">
    
                <div class="info-left">
                    <i class="bi bi-clock me-2"></i>Business Hours
                </div>

                <div class="info-right">
                  <span>{{ $restaurant->opening_hours }}</span>
                </div>
         </div>
            {{-- Tel --}}
            <div class="info-row">
            <div class="info-left">
                <i class="bi bi-telephone me-2"></i><span>Tel</span>
            </div>
            <div class="info-right">
                {{ $restaurant->phone }}
            </div>
            </div>

            {{-- Mail --}}
            <div class="info-row">
            <div class="info-left">
                <i class="bi bi-envelope me-2"></i><span>Mail</span>
            </div>
            <div class="info-right">
                {{ $restaurant->email }}
            </div>
            </div>

            {{-- Website --}}
            <div class="info-row">
            <div class="info-left">
                <i class="bi bi-globe2 me-2"></i><span>Website</span>
            </div>
            <div class="info-right">
                <a href="https://www.restaurantsato.com" target="_blank" class="info-link">
                https://www.restaurantsato.com
                </a>

                <div class="mt-2 d-flex align-items-center gap-3">
                <i class="bi bi-instagram"></i>
                <span style="font-weight:600;">X</span>
                </div>
            </div>
            </div>

            {{-- Address --}}
            <div class="info-row">
            <div class="info-left">
                <i class="bi bi-geo-alt me-2"></i><span>Address</span>
            </div>
            <div class="info-right">
                {{ $restaurant->address_line }} {{ $restaurant->city }} {{ $restaurant->prefecture }}
            </div>
            </div>

       </div>

        {{-- Map --}}
        <div class="rounded overflow-hidden border mt-3" style="height:220px;">
          <iframe class="w-100 h-100 d-flex align-items-center justify-content-center text-muted small" src="https://www.google.com/maps?q={{ urlencode($restaurant->address_line . ' ' . $restaurant->city . ' ' . $restaurant->prefecture) }}&output=embed" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

     {{-- Reservation --}}
      <div class="col-12 col-lg-6 bg-white rounded p-3 border">
        <h4 class="text-center p-3 text-underline-accent">Reservation</h4>

        <form class="mt-3" id="reservationForm" action="{{ route('restaurant.reservation',$restaurant->id) }}" method="post">
         @csrf
          <div class="row g-2">
            <div class="col-6">
              <input type="date" name="reservation_date" id="reservation_date" value="{{ old('reservation_date') }}" class="form-control mb-3 @error('reservation_date') is-invalid @enderror" placeholder="Date">
              @error('reservation_date')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-6">
              <input type="time" name="reservation_time" id="reservation_time" value="{{ old('reservation_time') }}" class="form-control mb-3 @error('reservation_time') is-invalid @enderror" placeholder="Time">
              @error('reservation_time')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12">
              <input type="number" name="number_of_people" id="number_of_people" value="{{ old('number_of_people') }}" class="form-control mb-3 @error('number_of_people') is-invalid @enderror" placeholder="Number of Guests">
              @error('number_of_people')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12">
              <input type="text" name="full_name" id="full_name" value="{{ old('full_name',Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '') }}" class="form-control mb-3 @error('full_name') is-invalid @enderror" placeholder="Full Name">
              @error('full_name')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12">
              <input type="text" name="phone" id="phone" value="{{ old('phone',Auth::check() ? Auth::user()->tel : '') }}" class="form-control mb-3 @error('phone') is-invalid @enderror" placeholder="Phone Number">
              @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12">
              <input type="email" name="email" id="email" value="{{ old('email',Auth::check() ? Auth::user()->email : '') }}" class="form-control mb-3 @error('email') is-invalid @enderror" placeholder="Email Address">
              @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12">
              <textarea class="form-control" rows="3" name="special_requests" id="special_requests" placeholder="Special Requests">{{ old('special_requests') ?? '' }}</textarea>
            </div>
            <div class="col-12">
              <button type="button" class="btn btn-orange w-100" data-bs-toggle="modal" data-bs-target="#reservationConfirmModal">
                Confirm Reservation
              </button>
            </div>
          </div>
          @include('restaurants.modal.reservation-confirm-modal')
        </form>
      </div>
    </section>

    {{-- Meal Kit --}}
    <section class="mt-5">
    <h2 class="text-center meal-title">Meal Kit</h2>
    <div class="text-center mb-5">
      <span class="text-orange">Enjoy</span>  Our Dishes at Home
    </div>

    <div id="mealCarousel" class="carousel slide" data-bs-ride="false">

        <div class="carousel-inner">

        @forelse ($products->chunk(3) as $index => $productChunk)
              <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                  <div class="row g-4 justify-content-center">

                      @forelse ($productChunk as $product)
                          <div class="col-12 col-md-4">
                              <div class="card border-0 bg-transparent">
                                <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                  <img 
                                      src="{{ asset('storage/' . $product->image) }}"
                                      class="card-img-top"
                                      style="height:200px; object-fit:cover;"
                                      alt="{{ $product->name }}">

                                  <div class="card-body px-0 pt-2">
                                      <h5 class="meal-name">{{ $product->name }}</h5>
                                      <div class="meal-price">${{ $product->price }}</div>
                                  </div>
                                  </a>

                              </div>
                          </div>
                          @empty
                           <div class="col-12">
                              <div class="no-data-box text-center p-5">No meal kits available yet.</div>
                          </div>
                      @endforelse
                         
                  </div>
              </div>
          @endforeach
        </div>


         {{-- ← --}}
          @if($products->count() > 3)
          <button 
              class="carousel-control-prev"
              type="button"
              data-bs-target="#mealCarousel"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
          </button>

          {{-- → --}}
          <button 
              class="carousel-control-next"
              type="button"
              data-bs-target="#mealCarousel"
              data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
          </button>
          @endif

    </div>
    </section>

    {{-- Reviews --}}
      <section class="mt-5 mb-4">
        <h2 class="text-center my-5 text-underline-accent">Reviews</h2>

         {{-- レビュー投稿フォーム --}}
        @auth
            @if($hasVisited && !$hasReviewed)
                <div class="card border-0 shadow-sm mb-5" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Write a Review</h6>
                        <form action="{{ route('restaurant.reviews.store', $restaurant->id) }}" method="POST">
                            @csrf

                            {{-- 星評価 --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Rating</label>
                                <div class="d-flex gap-2" id="star-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="btn star-btn" data-value="{{ $i }}">
                                         <i class="fa-solid fa-star fs-3"></i></span>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating-input" value="">
                                @error('rating')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            {{-- コメント --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Comment</label>
                                <textarea name="comment" class="form-control" rows="3"
                                          placeholder="Share your experience..." style="border-radius: 8px;">{{ old('comment') }}</textarea>
                                @error('comment')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn text-white btn-orange px-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            {{-- @else
                <div class="alert alert-light border mb-4 text-center small">
                    Only customers who purchased this product can write a review.
                </div> --}}
            @endif
        @else
            <div class="alert alert-light border mb-4 text-center small">
                <a href="{{ route('login') }}" class="text-dark fw-bold">Login</a> to write a review.
            </div>
        @endauth

        <div class="d-grid gap-3">
            @foreach ($reviews as $review)
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        @if (optional($review->user->profile_picture))
                            <img src="{{ asset('storage/'.$review->user->profile_picture) }}" alt="" class="review-icon rounded-circle">
                        @else
                            <i class="fa-solid fa-circle-user fs-1 text-dark"></i>
                        @endif
                        <div class="flex-grow-1">
                            <div class="fw-semibold">{{ $review->user->user_name }}</div>
                            <div class="small text-warning">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fa-solid fa-star text-warning"></i>
                                    @else
                                        <i class="fa-regular fa-star text-warning"></i>
                                    @endif
                                @endfor
                                <span class="small text-dark">{{ $review->rating }}.0</span>
                            </div>
                            <div class=" mt-1">
                                {{ $review->comment }}
                            </div>
                        </div>
                        <div class="small text-muted">{{ $review->created_at->format('M d,Y') }}</div>
                    </div>
                    @if ($review->replies->isNotEmpty())
                        <div class="ps-2">
                            <div class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-reply mt-1"></i>
                                <div>
                                    <span class="mb-2 fw-light">Restaurant reply:</span>
                                    <p class="font-sen ms-3 text-muted">
                                        {{ $review->replies->first()->comment }}
                                    </p>
                                </div>
                            </div>
                        </div>
                      @endif
                </div>
            </div>
            @endforeach
        </div>
      </section>
  </div>
@endsection