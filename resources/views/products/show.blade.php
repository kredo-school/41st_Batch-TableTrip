@extends('layouts.app')
@vite(['resources/css/product-list.css'])

@section('content')
<div class="product-show-wrapper">

<div class="container py-5 product-show-container">
        <div class="card border-0 shadow-sm position-relative overflow-hidden product-show-card">

            {{-- リボン --}}
            @if($product->badge)
                @php
                    $badgeColor = match($product->badge) {
                        'Easy'    => '#D97652',
                        'Special' => '#E8C43A',
                        'Kids OK' => '#3DBDB5',
                        default   => '#D97652',
                    };
                @endphp
                <div class="triangle-ribbon" style="border-color: {{ $badgeColor }} transparent transparent transparent;"></div>
                <div class="ribbon-text" style="font-size: {{ $product->badge === 'Kids OK' ? '26px' : '36px' }};">{{ $product->badge }}</div>
            @endif

            {{-- 商品画像 --}}
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="card-img-top product-show-img"
                     alt="{{ $product->name }}">
            @else
                <img src="https://via.placeholder.com/480x260?text=No+Image"
                     class="card-img-top product-show-img"
                     alt="No Image">
            @endif

            <div class="card-body px-4 pb-4">

                {{-- 商品名・タグ・価格 --}}
                <div class="d-flex align-items-center flex-wrap gap-2 mt-2">
                    <h4 class="fw-bold mb-0 product-name">{{ $product->name }}</h4>
                    @if($product->tag)
                        @php
                            $tagClass = $product->tag === 'Flash Frozen' ? 'tag-flash-frozen' : 'tag-cool';
                        @endphp
                        <span class="product-tag {{ $tagClass }}">
                            {{ $product->tag === 'Flash Frozen' ? '❄ Flash Frozen' : '🧊 Cool' }}
                        </span>
                    @endif
                    <span class="fw-bold ms-auto product-price">¥{{ number_format($product->price) }}-</span>
                </div>

                {{-- レストラン名・場所 --}}
                <p class="text-muted small mt-1 mb-2">{{ $product->location }} | {{ $product->restaurant_name }}</p>

                {{-- 星評価 --}}
                <div class="d-flex align-items-center gap-1 mb-3">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="product-star" style="color: {{ $i <= round($avgRating) ? '#F5A623' : '#ddd' }};">★</span>
                    @endfor
                    <span class="small text-muted ms-1">{{ number_format($avgRating, 1) }} ({{ $reviews->count() }})</span>
                </div>

                <hr>

                {{-- Description --}}
                <h6 class="fw-bold mb-1">Description</h6>
                <p class="small text-muted mb-3">{{ $product->description }}</p>

                {{-- Ingredients --}}
                <h6 class="fw-bold mb-1">Ingredients</h6>
                <p class="small text-muted mb-1">{{ $product->ingredients }}</p>
                <p class="small text-muted mb-3"><span class="fw-semibold">Allergens:</span> {{ $product->allergens }}</p>

                {{-- Add Cart ボタン --}}
                <div class="d-flex justify-content-end mt-3">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="border-0 bg-transparent text-center">
                            <i class="bi bi-cart-fill product-cart-icon"></i>
                            <p class="mb-0 fw-bold product-cart-text">Add Cart</p>
                        </button>
                    </form>
                </div>

            </div>
        </div>

        {{-- 戻るリンク --}}
        <div class="mt-3">
            <a href="{{ route('products.index') }}" class="text-muted small">← Back to list</a>
        </div>

        {{-- レビューセクション --}}
        <div class="mt-4">
            <h5 class="fw-bold mb-3 section-title-serif">Reviews</h5>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- レビュー投稿フォーム --}}
            @auth
                @if($hasReviewed)
                    <div class="alert alert-light border text-center small mb-3">You have already submitted a review.</div>
                @elseif($hasPurchased)
                    <div class="card border-0 shadow-sm mb-4 product-review-card">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3">Write a Review</h6>
                            <form action="{{ route('products.reviews.store', $product->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold small">Rating</label>
                                    <div class="d-flex gap-2" id="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="star-btn" data-value="{{ $i }}">★</span>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" id="rating-input" value="">
                                    @error('rating')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold small">Comment</label>
                                    <textarea name="comment" class="form-control" rows="3"
                                              placeholder="Share your experience...">{{ old('comment') }}</textarea>
                                    @error('comment')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn text-white px-4 btn-dark-submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth

            {{-- レビュー一覧 --}}
            @forelse($reviews as $review)
                <div class="card border-0 shadow-sm mb-3 product-review-card">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex align-items-center gap-2">
                                @if(!empty($review->user->profile_picture))
                                    <img src="{{ asset('storage/' . $review->user->profile_picture) }}"
                                         class="rounded-circle user-avatar">
                                @else
                                    <i class="fa-solid fa-circle-user fs-5 text-secondary"></i>
                                @endif
                                <span class="fw-bold small">{{ $review->user->user_name ?? 'User' }}</span>
                            </div>
                            <span class="text-muted review-date">{{ $review->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="mb-1">
                            @for($i = 1; $i <= 5; $i++)
                                <span style="color: {{ $i <= $review->rating ? '#F5A623' : '#ddd' }};">★</span>
                            @endfor
                        </div>
                        <p class="mb-0 small">{{ $review->comment }}</p>
                    </div>
                </div>
            @empty
                <p class="text-muted small text-center py-3">No reviews yet.</p>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
    const stars = document.querySelectorAll('.star-btn');
    const ratingInput = document.getElementById('rating-input');
    if (stars.length) {
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
    }
</script>
@endpush
@endsection
