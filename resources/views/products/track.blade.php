@extends('layouts.app')
@vite(['resources/css/product-list.css'])

@section('content')
<div class="track-wrapper">
    <div class="container py-5 track-container">

        <h2 class="fw-bold text-center mb-1">Track Your Order</h2>
        <p class="text-center text-muted small mb-5">Order #{{ $orderId }}</p>

        {{-- 商品カード --}}
        @foreach($cart as $item)
        @php $product = is_array($item['product']) ? (object)$item['product'] : $item['product']; @endphp
        <div class="card mb-3 border-dark shadow-sm text-start track-card">
            <div class="row g-0 align-items-center">
                <div class="col-4 p-2">
                    @if(!empty($product->image))
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded border" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/journykit.png') }}" class="img-fluid rounded border" alt="Item">
                    @endif
                </div>
                <div class="col-8 p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $product->name ?? 'N/A' }}</h5>
                        <p class="text-muted small mb-0">{{ $product->location ?? '' }}{{ !empty($product->restaurant_name) ? ' | ' . $product->restaurant_name : '' }}</p>
                        <p class="text-muted small mb-0">Qty: {{ $item['quantity'] }}</p>
                    </div>
                    <p class="fw-bold mb-0">¥{{ number_format(($product->price ?? 0) * $item['quantity']) }}-</p>
                </div>
            </div>
        </div>
        @endforeach

        {{-- ステータスタイムライン --}}
        <div class="card border-dark shadow-sm p-4 mb-4 track-card">
            <h5 class="fw-bold mb-4">Delivery Status</h5>

            <div class="position-relative">

                {{-- 縦線 --}}
                <div class="track-line-bg"></div>
                <div id="progress-line" class="track-line-progress"></div>

                {{-- STEP 1: Order Placed --}}
                <div class="d-flex align-items-start mb-4 position-relative track-step">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 step-circle step-completed">
                        <i class="bi bi-check-lg text-white fw-bold"></i>
                    </div>
                    <div class="ms-3">
                        <p class="fw-bold mb-0">Order Placed</p>
                        <p class="text-muted small mb-0">2026/03/24 10:00</p>
                    </div>
                </div>

                {{-- STEP 2: 発送 (Shipped) --}}
                <div class="d-flex align-items-start mb-4 position-relative track-step">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 step-circle step-shipped"
                         id="step-shipped">
                        <i class="bi bi-box-seam text-white"></i>
                    </div>
                    <div class="ms-3">
                        <p class="fw-bold mb-0">Shipped <span class="badge ms-1 badge-shipped">In Transit</span></p>
                        <p class="text-muted small mb-0">Est. 2026/03/25</p>
                        <p class="small mb-0 track-shipped-text">Your order has been shipped!</p>
                    </div>
                </div>

                {{-- STEP 3: 到着 (Delivered) --}}
                <div class="d-flex align-items-start position-relative track-step">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 step-circle step-pending"
                         id="step-delivered">
                        <i class="bi bi-house-door step-pending-icon"></i>
                    </div>
                    <div class="ms-3">
                        <p class="fw-bold mb-0 text-muted">Delivered <span class="badge ms-1 bg-secondary badge-small">Pending</span></p>
                        <p class="text-muted small mb-0">Est. 2026/03/26 - 28</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- 配送先 --}}
        <div class="card border-dark shadow-sm p-4 mb-5 track-card">
            <h5 class="fw-bold mb-3">Shipping to</h5>
            <div class="ps-2 small text-muted">
                <p class="mb-1">Name: {{ $user->first_name }} {{ $user->last_name }}</p>
                <p class="mb-1">Address: {{ $user->address }}{{ $user->postal_code ? ', ' . $user->postal_code : '' }}{{ $user->country ? ', ' . $user->country : '' }}</p>
                <p class="mb-0">Phone: {{ $user->tel ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- 戻るボタン --}}
        <div class="text-center">
            <a href="{{ route('products.index') }}"
               class="btn text-white px-5 py-3 fw-bold btn-back-to-products">
                Back to Products
            </a>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('dashboard') }}" class="btn-dashboard-back">
                <i class="fa-solid fa-house me-2"></i>Back to Dashboard
            </a>
        </div>

    </div>
</div>

@push('scripts')
<script src="{{ asset('js/product-track.js') }}"></script>
@endpush
@endsection
