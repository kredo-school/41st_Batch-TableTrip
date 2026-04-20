@extends('layouts.app')
@section('title','Activity History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/history.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="history-container py-5 text-center">
    <h1 class="history-title mb-4">
        <i class="fa-solid fa-clock-history me-2"></i>Activity History
    </h1>

    <div class="main-selection-wrapper">
        <input type="radio" name="main-category" id="main-orders" checked>
        <input type="radio" name="main-category" id="main-reservations">

        <div class="main-tab-group mb-5">
            <label for="main-orders" class="main-category-label">Orders</label>
            <label for="main-reservations" class="main-category-label">Reservations</label>
        </div>

        {{-- ■ A. Orders  --}}
        <div class="section-orders">
            <h2 class="sub-title"><i class="fa-solid fa-bag-shopping me-2"></i>Order History</h2>
            <div class="table-wrapper">
                <table class="history-table"> 
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Restaurant</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Date</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($purchased ?? [] as $item)
                            <tr>
                                <td><strong>{{ $item->product->name ?? 'N/A' }}</strong></td>
                                <td>{{ $item->product->restaurant_name ?? 'N/A' }}</td>
                                <td>¥{{ number_format($item->price_at_purchased) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>¥{{ number_format($item->price_at_purchased * $item->quantity) }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->ordered_at)->format('d/m/y') }}</td>
                                <td>
                                    @if(in_array($item->meal_kit_id, $reviewedProductIds ?? []))
                                        <i class="fa-solid fa-comment-dots" style="color: #aaa;" title="Already reviewed"></i>
                                    @else
                                        <i class="fa-solid fa-comment-dots" style="color: #e2725b; cursor:pointer;"
                                           data-bs-toggle="modal"
                                           data-bs-target="#reviewModal"
                                           data-product-id="{{ $item->meal_kit_id }}"
                                           data-product-name="{{ $item->product->name ?? '' }}"></i>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="no-data">No purchase history yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn-back">
                    <i class="bi bi-bag me-2"></i>Continue Shopping
                </a>
            </div>
        </div>

        {{-- ■ B. Reservations  --}}
        <div class="section-reservations">
            <div class="sub-selection-wrapper">
                <input type="radio" name="history-tab" id="tab-upcoming" checked>
                <input type="radio" name="history-tab" id="tab-past">

                <div class="tab-labels-container">
                    <label for="tab-upcoming" class="tab-label">Upcoming</label>
                    <label for="tab-past" class="tab-label">Past Visits</label>
                </div>

                <hr class="separator-line">

                {{-- 1. Upcoming Table --}}
                <div class="content-upcoming">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Date / Time</th>
                                <th>Restaurant</th>
                                <th>People</th>
                                <th style="width: 160px;">Manage</th>
                            </tr>
                        </thead>
                        <tbody>         
                            @forelse($upcoming_reservations ?? [] as $res)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/y') }} 
                                        {{ \Carbon\Carbon::parse($res->reservation_time)->format('H:i') }}
                                    </td>
                                    <td><strong>{{ $res->restaurant->name ?? 'N/A' }}</strong></td>
                                    <td>{{ $res->number_of_people }}</td>
                                    <td>
                                        <div class="manage-action-group" style="display: flex; gap: 15px; justify-content: center; align-items: center;">
                                            <a href="{{ route('user.inquiry.create', ['restaurant_id' => $res->restaurant_id, 'reservation_id' => $res->id]) }}" class="btn-inquiry-icon" title="Contact"><i class="fa-solid fa-envelope"></i></a>
                                            <a href="{{ route('user.reservations.edit', $res->id) }}" class="btn-edit-icon" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('user.reservations.destroy', $res->id) }}" method="POST" style="margin: 0;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-cancel-icon" onclick="return confirm('Cancel?')" style="background:none; border:none; color:#999;"><i class="fa-solid fa-calendar-xmark"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="no-data-cell">No upcoming reservation yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- 2. Past Table --}}
                <div class="content-past">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Date / Time</th>
                                <th>Restaurant</th>
                                <th>Guest</th>
                                <th>Status</th>
                                <th>Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($past_reservations ?? [] as $res)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/y') }} {{ \Carbon\Carbon::parse($res->reservation_time)->format('H:i') }}</td>
                                    <td><strong>{{ $res->restaurant->name ?? 'N/A' }}</strong></td>
                                     <td>{{ $res->number_of_people }}</td>
                                    <td>Visited</td>
                                    <td><i class="fa-solid fa-comment-dots" style="color: #e2725b; cursor:pointer;"></i></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="no-data">No past visits found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <a href="{{ route('dashboard') }}" class="btn-dashboard-back">
            <i class="fa-solid fa-house me-2"></i>Back to Dashboard
        </a>
    </div>
</div>

{{-- Review Modal --}}
<div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="reviewForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <p class="text-muted small mb-3" id="reviewProductName"></p>

                    {{-- 星評価 --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Rating</label>
                        <div class="d-flex gap-2" id="modal-star-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="modal-star" data-value="{{ $i }}"
                                      style="font-size: 1.8rem; cursor: pointer; color: #ddd;">★</span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="modal-rating-input" value="">
                    </div>

                    {{-- コメント --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Comment</label>
                        <textarea name="comment" class="form-control" rows="3"
                                  placeholder="Share your experience..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white" style="background-color: #2c3e50;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // モーダルが開くとき、商品IDと名前をセット
    document.getElementById('reviewModal').addEventListener('show.bs.modal', function (e) {
        const icon = e.relatedTarget;
        const productId = icon.dataset.productId;
        const productName = icon.dataset.productName;

        document.getElementById('reviewForm').action = '/products/' + productId + '/reviews';
        document.getElementById('reviewProductName').textContent = productName;
        document.getElementById('modal-rating-input').value = '';

        document.querySelectorAll('.modal-star').forEach(s => s.style.color = '#ddd');
    });

    // 星クリック
    const modalStars = document.querySelectorAll('.modal-star');
    const modalRatingInput = document.getElementById('modal-rating-input');

    modalStars.forEach(star => {
        star.addEventListener('mouseover', () => {
            modalStars.forEach(s => s.style.color = s.dataset.value <= star.dataset.value ? '#F5A623' : '#ddd');
        });
        star.addEventListener('mouseout', () => {
            const val = modalRatingInput.value;
            modalStars.forEach(s => s.style.color = s.dataset.value <= val ? '#F5A623' : '#ddd');
        });
        star.addEventListener('click', () => {
            modalRatingInput.value = star.dataset.value;
            modalStars.forEach(s => s.style.color = s.dataset.value <= star.dataset.value ? '#F5A623' : '#ddd');
        });
    });
</script>
@endsection