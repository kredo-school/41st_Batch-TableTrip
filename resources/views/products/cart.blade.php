@extends('layouts.app')

@section('content')
<div class="cart-page" style="background-color: #F9F7F2; min-height: 100vh; font-family: serif;">
    <div class="container py-4" style="max-width: 600px;">
        
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold" style="color: #4A4A4A; text-decoration: underline orange;">Shopping Cart</h2>
        </div>

        <h5 class="fw-bold mb-3">Your Basket</h5>

        {{-- 商品リスト部分（ループを想定） --}}
        @for ($i = 0; $i < 4; $i++)
        <div class="card mb-3 border-dark shadow-sm" style="border-radius: 5px;">
            <div class="row g-0 align-items-center">
                <div class="col-4 p-2 position-relative">
                    {{-- 左上のEasyリボン（一覧画面と共通） --}}
                    <div class="mini-triangle-ribbon"></div>
                    <span class="mini-ribbon-text">Easy</span>
                    <img src="{{ asset('images/journykit.png') }}" class="img-fluid rounded border" alt="Journey Kit">
                </div>
                <div class="col-8">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Journey Kit</h5>
                                <p class="text-muted small mb-2">Hokkaido | Kitchen Sapporo</p>
                            </div>
                            <p class="fw-bold mb-0">¥2,480-</p>
                        </div>
                        
                        {{-- 数量操作部分 --}}
                        <div class="d-flex justify-content-end align-items-center mt-2">
                            <div class="border border-dark d-flex align-items-center px-2 py-1" style="border-radius: 5px;">
                                <button class="btn btn-sm p-0 border-0">－</button>
                                <span class="mx-3 fw-bold">2</span>
                                <button class="btn btn-sm p-0 border-0">＋</button>
                            </div>
                            <button class="btn btn-sm text-danger ms-3">
                                <i class="bi bi-trash fs-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor

        <div class="mb-4">
            <a href="{{ route('products.index') }}" class="text-dark text-decoration-none small">[ Continue Shopping ]</a>
        </div>

        {{-- 合計金額セクション --}}
        <div class="card border-dark shadow-sm" style="background-color: #fff; border-radius: 5px;">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Order Summary</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Items : 8</span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span>Shipping : 2-3 days</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4 border-top pt-3">
                    <span class="h5 fw-bold">Total</span>
                    <span class="h4 fw-bold">¥9,920-</span>
                </div>
                <a href="{{ route('cart.confirm') }}" class="btn w-100 text-white py-3 fs-4" 
                style="background-color: #D96D55; border-radius: 5px; text-decoration: none; display: block; text-align: center; font-family: serif; font-weight: bold;">
                    Checkout
                </a>

                 {{-- 戻るボタン --}}
                <div class="text-center mt-4">
                    <a href="{{ route('products.index') }}" class="text-decoration-none text-muted display: block; text-align: center; font-family: serif;">
                        <i class="bi bi-arrow-left"></i> Back to Product List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection