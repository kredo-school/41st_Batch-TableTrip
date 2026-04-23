@extends('layouts.app')
@section('title','Activity History')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/history.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')

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
                        @forelse ($purchased ?? [] as $item)
                            <tr>
                                {{-- 1. Product --}}
                                <td>
                                    <strong>{{ optional($item->product)->name ?? 'N/A' }}</strong>
                                </td>

                                {{-- 2. Restaurant --}}
                                <td>
                                    {{ optional($item->product)->restaurant_name ?? 'N/A' }}
                                </td>

                                {{-- 3. Price --}}
                                <td>
                                    ¥{{ number_format((int) ($item->price_at_purchased ?? 0)) }}
                                </td>

                                {{-- 4. Qty --}}
                                <td>
                                    {{ $item->quantity ?? 0 }}
                                </td>

                                {{-- 5. Subtotal --}}
                                <td>
                                    ¥{{ number_format((int) ($item->price_at_purchased ?? 0) * (int) ($item->quantity ?? 0)) }}
                                </td>

                                {{-- 6. Date --}}
                                <td>
                                    {{ optional($item->ordered_at)->format('d/m/y') ?? 'N/A' }}
                                </td>

                                {{-- 7. Review --}}
                                <td>
                                    @php
                                        $productId = $item->product_id ?? null;
                                    @endphp

                                    @if($productId && in_array($productId, $reviewedProductIds ?? []))
                                        <i class="fa-solid fa-comment-dots icon-reviewed" title="Already reviewed"></i>
                                    @elseif($productId)
                                        <i class="fa-solid fa-comment-dots icon-review-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#reviewModal"
                                        data-product-id="{{ $productId }}"
                                        data-product-name="{{ optional($item->product)->name }}">
                                        </i>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="no-data text-center">
                                    No purchase history yet.
                                </td>
                            </tr>
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
                                <th class="th-manage">Manage</th>
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
                                        <div class="manage-action-group">
                                            <a href="{{ route('user.inquiry.create', ['restaurant_id' => $res->restaurant_id, 'reservation_id' => $res->id]) }}" class="btn-inquiry-icon" title="Contact"><i class="fa-solid fa-envelope"></i></a>
                                            <a href="{{ route('user.reservations.edit', $res->id) }}" class="btn-edit-icon" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('user.reservations.destroy', $res->id) }}" method="POST" class="manage-form">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-cancel-icon" onclick="return confirm('Cancel?')"><i class="fa-solid fa-calendar-xmark"></i></button>
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
                                    <td><strong>{{ $res->restaurant->restaurant_name ?? 'N/A' }}</strong></td>
                                    <td>{{ $res->number_of_people }}</td>
                                    <td>Visited</td>
                                    <td><i class="fa-solid fa-comment-dots icon-review-btn"></i><a href="{{ route('restaurant', $res->restaurant_id) }}">Reviews</a></td>
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
                                <span class="modal-star" data-value="{{ $i }}">★</span>
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
                    <button type="submit" class="btn text-white btn-modal-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/activity-history.js') }}"></script>
@endpush
@endsection
