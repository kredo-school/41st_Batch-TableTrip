@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div style="background-color: #F9F7F2; min-height: 100vh;">
<div class="container py-5" style="max-width: 680px;">

    {{-- 商品名 --}}
    <h4 class="fw-bold mb-1" style="font-family: serif; color: #333;">{{ $product->name }}</h4>
    <p class="text-muted small mb-3">{{ $product->location }} | {{ $product->restaurant_name }}</p>

    {{-- 平均評価 --}}
    <div class="d-flex align-items-center gap-2 mb-4">
        @for($i = 1; $i <= 5; $i++)
            <span style="font-size: 1.4rem; color: {{ $i <= round($avgRating) ? '#F5A623' : '#ddd' }};">★</span>
        @endfor
        <span class="fw-bold">{{ number_format($avgRating, 1) }}</span>
        <span class="text-muted small">({{ $reviews->count() }} reviews)</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- アラート --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- レビュー投稿フォーム --}}
    @auth
        @if($hasReviewed)
            <div class="alert alert-light border mb-4 text-center small">
                You have already submitted a review for this product.
            </div>
        @elseif($hasPurchased)
            <div class="card border-0 shadow-sm mb-5" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Write a Review</h6>
                    <form action="{{ route('products.reviews.store', $product->id) }}" method="POST">
                        @csrf

                        {{-- 星評価 --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Rating</label>
                            <div class="d-flex gap-2" id="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="star-btn" data-value="{{ $i }}"
                                          style="font-size: 1.8rem; cursor: pointer; color: #ddd;">★</span>
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
                            <button type="submit" class="btn text-white px-4"
                                    style="background-color: #2c3e50; border-radius: 8px;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-light border mb-4 text-center small">
                Only customers who purchased this product can write a review.
            </div>
        @endif
    @else
        <div class="alert alert-light border mb-4 text-center small">
            <a href="{{ route('login') }}" class="text-dark fw-bold">Login</a> to write a review.
        </div>
    @endauth

    {{-- レビュー一覧 --}}
    @forelse($reviews as $review)
    <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="d-flex align-items-center gap-2">
                    @if(!empty($review->user->profile_picture))
                        <img src="{{ asset('storage/' . $review->user->profile_picture) }}"
                             class="rounded-circle" style="width:36px; height:36px; object-fit:cover;">
                    @else
                        <i class="fa-solid fa-circle-user fs-4 text-secondary"></i>
                    @endif
                    <span class="fw-bold small">{{ $review->user->user_name ?? 'User' }}</span>
                </div>
                <span class="text-muted" style="font-size: 0.75rem;">{{ $review->created_at->format('M d, Y') }}</span>
            </div>

            {{-- 星 --}}
            <div class="mb-2">
                @for($i = 1; $i <= 5; $i++)
                    <span style="color: {{ $i <= $review->rating ? '#F5A623' : '#ddd' }};">★</span>
                @endfor
            </div>

            <p class="mb-0 small">{{ $review->comment }}</p>
        </div>
    </div>
    @empty
    <div class="text-center text-muted py-5">
        <p>No reviews yet. Be the first to review!</p>
    </div>
    @endforelse

    {{-- 戻るリンク --}}
    <div class="mt-4">
        <a href="{{ route('products.index') }}" class="text-muted small">← Back to list</a>
    </div>

</div>
</div>

<script>
    const stars = document.querySelectorAll('.star-btn');
    const ratingInput = document.getElementById('rating-input');

    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            stars.forEach(s => s.style.color = s.dataset.value <= star.dataset.value ? '#F5A623' : '#ddd');
        });
        star.addEventListener('mouseout', () => {
            const val = ratingInput.value;
            stars.forEach(s => s.style.color = s.dataset.value <= val ? '#F5A623' : '#ddd');
        });
        star.addEventListener('click', () => {
            ratingInput.value = star.dataset.value;
            stars.forEach(s => s.style.color = s.dataset.value <= star.dataset.value ? '#F5A623' : '#ddd');
        });
    });
</script>
@endsection
