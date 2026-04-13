@extends('layouts.owner')

@section('title','Review')

@section('content')
<div class="m-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
        <div class="col-12 col-lg-9">
            <div class="w-75 mx-auto">
                <h1 class="text-underline-accent mb-4 ">Reviews</h1>
            </div>
            @forelse($reviews as $review)
                {{-- Review Card : reply form --}}
                <div class="card border rounded-0 mb-4 shadow-sm w-75 mx-auto">
                    <div class="card-body p-4">
                        <h4 class="mb-4">{{ $review->comment_type === 'product' ? 'To Meal kit' : 'To Restaurant' }}</h4>

                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    @if (!empty($review->user->profile_picture))
                                        <img src="{{ asset('storage/'.$review->user->profile_picture) }}" alt="" class="review-icon rounded-circle">
                                    @else
                                       <i class="fa-solid fa-circle-user fs-1 text-dark"></i>
                                    @endif
                                </div>

                                <div>
                                    <strong>{{ $review->user->user_name }}</strong>
                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                        <div class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                @else
                                                    <i class="fa-regular fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="small">{{ $review->rating }}.0</span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-muted small">{{ $review->created_at->format('M d, Y') }}</div>
                        </div>

                        <div class="ps-1 pe-1 mb-4 font-sen">
                            {{ $review->comment }}
                        </div>
                        @if ($review->replies->isNotEmpty())
                           <div class="ps-2">
                                <div class="d-flex align-items-start gap-2">
                                    <i class="fa-solid fa-reply mt-1"></i>
                                    <div>
                                        <h5 class="mb-2">Restaurant reply:</h5>
                                        <p class="font-sen">
                                            {{ $review->replies->first()->comment }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                        @else
                            <form action="{{ route('owner.reviews.reply',$review->id) }}" method="POST">
                                @csrf
                                <div class="d-flex gap-2">
                                    <input type="text" name="comment" class="form-control" placeholder="Reply to this review">
                                    <button type="submit" class="btn btn-navy px-4">Send</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                 @empty
                    <div>
                           <p class="text-center text-muted mt-5 fs-3">No reviews yet.</p>
                    </div>
                @endforelse
             {{ $reviews->links('layouts.pagination.custom') }}
        </div>
    </div>
</div>
    
@endsection