@extends('layouts.app')

<style>
  /* 三角形のリボン本体 */
    .triangle-ribbon {
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 180px 200px 0 0; /* 三角形のサイズ */
        border-color: #D97652 transparent transparent transparent; /* オレンジ色 */
        z-index: 1;
    }

    /* リボンの上の文字（Easyなど） */
    .ribbon-text {
        position: absolute;
        top: 24px;
        left: 12px;
        transform: rotate(-45deg); /* 文字を斜めに */
        transform-origin: center;
        color: white;
        font-weight: bold;
        font-size: 45px;
        z-index: 2;
        white-space: nowrap;
    }  
</style>


@section('content')
<div class="product-page" style="background-color: #F9F7F2; min-height: 100vh;">
    <div class="container py-5">
        {{-- タイトル部分 --}}
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold" style="color: #4A4A4A; text-decoration: underline orange;">Product list</h2>
        </div>

        {{-- カテゴリ選択（タブ風） --}}
        <div class="row mb-3 text-center">
            <div class="col-6 border py-3 bg-white">Meal Kits</div>
            <div class="col-6 border py-3 bg-white">Restaurants</div>
        </div>

        {{-- 商品グリッド --}}
        <div class="row row-cols-1 row-cols-md-3 g-4">
            {{-- 1つの商品カード --}}
            <div class="col">
                <div class="card h-100 shadow-sm border-0 position-relative">
                    {{-- 左上のリボン（Easyなど） --}}
                    <div class="triangle-ribbon"></div>
                    <div class="ribbon-text">Easy</div>
                    
                    <img src="{{ asset('images/journykit.png') }}" class="card-img-top" alt="Journey Kit">
                    
                    <div class="card-body">
                        <h5 class="card-title mb-1">Journey Kit</h5>
                        <div class="text-muted small mb-2">Hokkaido | Kitchen Sapporo</div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-warning">★★★★★ <small class="text-muted">(4.5)</small></span>
                            <button class="btn btn-link text-dark p-0"><i class="bi bi-cart-plus fs-4"></i></button>
                        </div>
                        <p class="fw-bold mt-2">¥2,480~</p>
                    </div>
                </div>
            </div>
            {{-- 商品カードここまで（これをコピーして増やす） --}}
        </div>
    </div>
</div>
@endsection