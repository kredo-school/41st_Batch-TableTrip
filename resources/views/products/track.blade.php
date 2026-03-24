@extends('layouts.app')

@section('content')
<div style="background-color: #F9F7F2; min-height: 100vh; font-family: serif;">
    <div class="container py-5" style="max-width: 600px;">

        <h2 class="fw-bold text-center mb-1">Track Your Order</h2>
        <p class="text-center text-muted small mb-5">Order #TRP-20260214-007</p>

        {{-- 商品カード --}}
        <div class="card mb-5 border-dark shadow-sm text-start" style="border-radius: 5px;">
            <div class="row g-0 align-items-center">
                <div class="col-4 p-2">
                    <img src="{{ asset('images/journykit.png') }}" class="img-fluid rounded border" alt="Item">
                </div>
                <div class="col-8 p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Journey Kit</h5>
                        <p class="text-muted small mb-0">Hokkaido | Kitchen Sapporo</p>
                    </div>
                    <p class="fw-bold mb-0">¥9,920-</p>
                </div>
            </div>
        </div>

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
                <p class="mb-1">Name: Taro Yamada</p>
                <p class="mb-1">Address: 1-2-3 Kita-ku, Sapporo-shi, Hokkaido, Japan 060-0000</p>
                <p class="mb-0">Phone: +81 80-1234-5678</p>
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
