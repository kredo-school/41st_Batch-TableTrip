@extends('layouts.app')

@section('content')
<div class="confirm-page" style="background-color: #F9F7F2; min-height: 100vh; font-family: serif;">
    <div class="container py-5" style="max-width: 600px;">
        
        <h2 class="text-center mb-5 fw-bold">Confirm your order</h2>

        {{-- 商品リスト（カート画面より少しシンプルに） --}}
        @for ($i = 0; $i < 3; $i++)
        <div class="card mb-3 border-dark shadow-sm" style="border-radius: 5px;">
            <div class="row g-0 align-items-center">
                <div class="col-4 p-2 position-relative">
                    <div class="mini-triangle-ribbon"></div>
                    <span class="mini-ribbon-text">Easy</span>
                    <img src="{{ asset('images/journykit.png') }}" class="img-fluid rounded border" alt="Item">
                </div>
                <div class="col-8">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="fw-bold mb-1">Journey Kit</h5>
                                <p class="text-muted small mb-0">Hokkaido | Kitchen Sapporo</p>
                            </div>
                            <p class="fw-bold mb-0">¥2,480-</p>
                        </div>
                        <div class="text-end mt-2">
                            <span class="border border-dark px-3 py-1" style="border-radius: 5px;">－ 2 ＋</span>
                            <i class="bi bi-trash text-danger ms-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor

        <div class="text-center my-5">
            <h3 class="fw-bold">Total amount : ¥7,440-</h3>
        </div>

        <hr class="border-dark">

        {{-- 配送先情報 --}}
        <div class="mb-3 mt-3 position-relative">
            <h5 class="fw-bold mb-3">Shipping Address</h5>
            <div class="ps-3 small">
                <p class="mb-1">Name : Taro Yamada</p>
                <p class="mb-1">Address : 1-2-3 Kita-ku, Sapporo-shi, Hokkaido, Japan 060-0000</p>
                <p class="mb-1">Phone : +81 80-1234-5678</p>
            </div>
            <a href="#" class="text-dark position-absolute bottom-0 end-0 p-2" style="font-size: 1.2rem;">
                <i class="bi bi-pencil-square"></i>
            </a>
        </div>

        <hr class="border-dark">

        {{-- 支払い方法 --}}
        <div class="mb-3 mt-3 position-relative">
            <h5 class="fw-bold mb-3">Payment Method</h5>
            <div class="ps-3 small">
                <p class="mb-1">Payment : VISA **** **** 9012</p>
                <p class="mb-1">Expiry Date : 2030/05/28</p>
                <p class="mb-1">Cardholder: TARO YAMADA</p>
            </div>
            <a href="#" class="text-dark position-absolute bottom-0 end-0 p-2" style="font-size: 1.2rem;">
                <i class="bi bi-pencil-square"></i>
            </a>
        </div>

        <hr class="border-dark">

        {{-- 確定ボタン --}}
        <div class="text-center mt-5">
            <a href="{{ route('cart.thanks') }}" class="btn text-white px-5 py-3 fs-3 mb-3" 
            style="background-color: #D96D55; border-radius: 5px; min-width: 300px; font-family: serif; font-weight: bold; text-decoration: none; display: inline-block;">
                Place your order
            </a>
            <br>
            <a href="{{ route('cart.index') }}" class="text-dark text-decoration-none text-muted display: block; text-align: center; font-family: serif;">
                <i class="bi bi-arrow-left"></i> Back to Cart </a>
        </div>

    </div>
</div>
@endsection

