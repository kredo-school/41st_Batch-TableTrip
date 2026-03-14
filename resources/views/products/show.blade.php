@extends('layouts.app')

@section('content')
<div class="product-detail-page" style="background-color: #F9F7F2; min-height: 100vh; padding-top: 40px; padding-bottom: 60px;">
    <div class="container">
        {{-- メインカード --}}
        <div class="card border-0 shadow-sm mx-auto" style="max-width: 800px; border-radius: 20px; overflow: hidden; background-color: #fcfbf9;">
            
            {{-- 商品画像エリア --}}
            <div class="position-relative">
                <div class="triangle-ribbon" style="width: 150px; height: 150px; position: absolute; top: 0; left: 0; background: linear-gradient(135deg, #e67e22 50%, transparent 50%); z-index: 1;"></div>
                <div class="ribbon-text" style="position: absolute; top: 30px; left: 10px; transform: rotate(-45deg); color: white; font-weight: bold; font-size: 2rem; z-index: 2; font-family: serif;">Easy</div>
                <img src="{{ asset('images/journykit.png') }}" class="w-100" alt="Journey Kit" style="display: block;">
            </div>

            {{-- コンテンツエリア --}}
            <div class="card-body p-4 p-md-5">
                {{-- タイトル・タグ・価格行 --}}
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center flex-wrap">
                        <h1 class="display-5 fw-bold mb-0 me-3" style="font-family: serif; color: #333;">Journey Kit</h1>
                        <span class="border border-dark px-3 py-1 small" style="border-radius: 2px;">Cool</span>
                    </div>
                    <div class="d-flex align-items-center mt-2 mt-md-0">
                        <div class="me-3 text-center">
                            <i class="bi bi-people-fill fs-4"></i><i class="bi bi-chevron-down small"></i>
                            <p class="mb-0 small text-muted">2 Servings</p>
                        </div>
                        <span class="display-6 fw-bold">¥2,480-</span>
                    </div>
                </div>

                {{-- 場所・店舗 --}}
                <p class="h5 mb-4" style="color: #4A4A4A; font-family: serif;">Hokkaido | Kitchen Sapporo</p>

                {{-- レビュー --}}
                <div class="d-flex align-items-center mb-5">
                    <div class="text-warning fs-3 me-2">★★★★★</div>
                    <span class="fs-5 text-muted">5.0 (40)</span>
                </div>

                {{-- 詳細情報セクション --}}
                <div class="product-info" style="color: #333; line-height: 1.8;">
                    <div class="mb-4">
                        <h5 class="fw-bold border-bottom border-2 border-dark d-inline-block mb-3">Description</h5>
                        <p class="fst-italic">"Enjoy the authentic taste of Hokkaido right at your dining table. Made with fresh, local ingredients."</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-bold border-bottom border-2 border-dark d-inline-block mb-3">Ingredients</h5>
                        <p>Chicken leg, Potato, Carrot, Onion, Tomato paste, Garlic, Ginger, Original spice blend, Vegetable oil, Salt.</p>
                    </div>

                    <div class="mb-5">
                        <p><strong class="fw-bold">Allergens :</strong> Wheat, Soy, Chicken</p>
                    </div>
                </div>

                {{-- カートボタン（右下固定イメージ） --}}
                <div class="d-flex justify-content-end align-items-center mt-4">
                    <div class="text-center" style="cursor: pointer; color: #2c3e50;">
                        <i class="bi bi-cart-fill" style="font-size: 4rem; line-height: 1;"></i>
                        <p class="fw-bold mb-0" style="font-size: 1.1rem;">Add Cart</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 戻るボタン --}}
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left"></i> Back to Product List
            </a>
        </div>
    </div>
</div>
@endsection