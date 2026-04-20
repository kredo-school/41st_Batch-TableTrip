@extends('layouts.app')

@section('content')
<div style="background-color: #F9F7F2; min-height: 100vh; font-family: serif;">
    <div class="container py-5" style="max-width: 600px;">

        <h2 class="fw-bold text-center mb-1">Track Your Order</h2>
        <p class="text-center text-muted small mb-5">Order #{{ $orderId }}</p>

        {{-- 商品カード --}}
        @foreach($cart as $item)
        @php $product = is_array($item['product']) ? (object)$item['product'] : $item['product']; @endphp
        <div class="card mb-3 border-dark shadow-sm text-start" style="border-radius: 5px;">
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
        <div class="card border-dark shadow-sm p-4 mb-4" style="border-radius: 5px;">
            <h5 class="fw-bold mb-4">Delivery Status</h5>

            <div class="position-relative">

                {{-- 縦線 --}}
                <div style="position: absolute; left: 19px; top: 24px; bottom: 24px; width: 3px; background-color: #dee2e6; z-index: 0;"></div>
                <div id="progress-line" style="position: absolute; left: 19px; top: 24px; width: 3px; background-color: #4bb543; z-index: 1; transition: height 0.8s ease;"></div>

                {{-- STEP 1: Order Placed --}}
                <div class="d-flex align-items-start mb-4 position-relative" style="z-index: 2;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width: 40px; height: 40px; background-color: #4bb543; border: 3px solid #4bb543;">
                        <i class="bi bi-check-lg text-white fw-bold"></i>
                    </div>
                    <div class="ms-3">
                        <p class="fw-bold mb-0">Order Placed</p>
                        <p class="text-muted small mb-0">2026/03/24 10:00</p>
                    </div>
                </div>

                {{-- STEP 2: 発送 (Shipped) --}}
                <div class="d-flex align-items-start mb-4 position-relative" style="z-index: 2;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                         id="step-shipped"
                         style="width: 40px; height: 40px; background-color: #D96D55; border: 3px solid #D96D55;">
                        <i class="bi bi-box-seam text-white"></i>
                    </div>
                    <div class="ms-3">
                        <p class="fw-bold mb-0">Shipped <span class="badge ms-1" style="background-color: #D96D55; font-size: 0.7rem;">In Transit</span></p>
                        <p class="text-muted small mb-0">Est. 2026/03/25</p>
                        <p class="small mb-0" style="color: #D96D55;">Your order has been shipped!</p>
                    </div>
                </div>

                {{-- STEP 3: 到着 (Delivered) --}}
                <div class="d-flex align-items-start position-relative" style="z-index: 2;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                         id="step-delivered"
                         style="width: 40px; height: 40px; background-color: #fff; border: 3px solid #dee2e6;">
                        <i class="bi bi-house-door" style="color: #aaa;"></i>
                    </div>
                    <div class="ms-3">
                        <p class="fw-bold mb-0 text-muted">Delivered <span class="badge ms-1 bg-secondary" style="font-size: 0.7rem;">Pending</span></p>
                        <p class="text-muted small mb-0">Est. 2026/03/26 - 28</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- 配送先 --}}
        <div class="card border-dark shadow-sm p-4 mb-5" style="border-radius: 5px;">
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
               class="btn text-white px-5 py-3 fw-bold"
               style="background-color: #2c3e50; border-radius: 5px; font-family: serif;">
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

<script>
    // ページ読み込み時に進捗ラインをアニメーション
    window.addEventListener('load', function () {
        const line = document.getElementById('progress-line');
        // Order Placed → Shipped の間だけ緑ラインを引く（1ステップ分 ≒ 96px）
        line.style.height = '96px';
    });
</script>
@endsection
