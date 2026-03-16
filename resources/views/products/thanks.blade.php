@extends('layouts.app')

@section('content')
<div class="thanks-page" style="background-color: #F9F7F2; min-height: 100vh; font-family: serif;">
    <div class="container py-5 text-center" style="max-width: 600px;">
        
        <h1 class="display-5 fw-bold mb-3">Order Confirmed!</h1>
        <p class="fs-5 mb-5">Your taste journey is about to begin</p>

        {{-- アニメーション付きチェックマーク（自己完結版） --}}
        <div class="success-animation mb-4" style="display: flex; justify-content: center;">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" style="width: 100px; height: 100px; display: block;">
                {{-- 外側の円 --}}
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" stroke="#4bb543" stroke-width="2" 
                    style="stroke-dasharray: 166; stroke-dashoffset: 166; animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;" />
                
                {{-- 中のチェック --}}
                <path class="checkmark__check" fill="none" stroke="#4bb543" stroke-width="3" d="M14.1 27.2l7.1 7.2 16.7-16.8" stroke-linecap="round" stroke-linejoin="round"
                    style="stroke-dasharray: 48; stroke-dashoffset: 48; animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;" />
            </svg>
        </div>

        <style>
            /* アニメーションの定義を直接書く */
            @keyframes stroke {
                to {
                    stroke-dashoffset: 0;
                }
            }
        </style>

        <p class="text-muted mb-5">Order #TRP-20260214-007</p>

        {{-- 商品の簡易表示 --}}
        <div class="card mb-5 border-dark shadow-sm text-start" style="border-radius: 5px;">
            <div class="row g-0 align-items-center">
                <div class="col-4 p-2 position-relative">
                    <div class="mini-triangle-ribbon"></div>
                    <span class="mini-ribbon-text">Easy</span>
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

        <hr class="border-dark my-4">

        {{-- お届け予定 --}}
        <div class="text-start mb-4">
            <h5 class="fw-bold mb-2">Estimated Delivery <i class="bi bi-chevron-down small"></i></h5>
            <div class="ps-2">
                <p class="mb-1">Ready to pack!</p>
                <p class="mb-0">May 26-28, 2026</p>
            </div>
        </div>

        <hr class="border-dark my-4">

        {{-- 配送先 --}}
        <div class="text-start mb-5">
            <h5 class="fw-bold mb-2">Shipping to</h5>
            <div class="ps-2 small">
                <p class="mb-1">Name: Taro Yamada</p>
                <p class="mb-1">Address : 1-2-3 Kita-ku, Sapporo-shi, Hokkaido, Japan 060-0000</p>
                <p class="mb-1">Phone: +81 80-1234-5678</p>
            </div>
        </div>

        {{-- 下部ボタン --}}
        <div class="d-flex justify-content-between gap-3">
            <button class="btn text-white w-50 py-3 fw-bold" style="background-color: #D96D55; border-radius: 5px; font-family: serif;">
                Track Your Order
            </button>
            <button class="btn text-white w-50 py-3 fw-bold" style="background-color: #2c3e50; border-radius: 5px; font-family: serif;">
                View Order Details
            </button>
        </div>

    </div>
</div>
@endsection