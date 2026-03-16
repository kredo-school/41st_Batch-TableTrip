@extends('layouts.app')
@section('content')
@vite(['resources/css/product-list.css'])

<div class="product-page" style="background-color: #F9F7F2; min-height: 100vh;">
    

        {{-- 右上の浮遊カートボタン --}}
        <div class="floating-cart">
            <a href="{{ route('cart.index') }}" class="cart-link">
                <div class="cart-wrapper">
                    <i class="bi bi-cart-fill fs-2"></i>
                    <span class="cart-badge">1</span> {{-- 商品数を表示するバッジ --}}
                </div>
                <p class="cart-text">Items</p>
            </a>
        </div>

        <div class="container py-5">
        {{-- タイトル部分 --}}
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold" style="color: #4A4A4A; text-decoration: underline orange;">Product list</h2>
        </div>

        {{-- カテゴリ選択（元のレイアウトを維持） --}}
        <div class="row mb-3 text-center position-relative mx-0">
            {{-- 左側：Meal Kitsボタン --}}
            <div class="col-6 border py-3 bg-white fw-bold" 
                 id="mealKitsBtn"
                 style="cursor: pointer; z-index: 1020;" 
                 onclick="handleFilterToggle(event)">
                Meal Kits <i class="bi bi-chevron-down ms-1"></i>
            </div>
            
            {{-- 右側：Restaurants --}}
            <div class="col-6 border py-3 bg-white" style="z-index: 1020;">
                Restaurants
            </div>

            {{-- --- ソートメニュー --- --}}
            <div id="customSearchMenu" 
                 style="display: none; position: absolute; top: 100%; left: 0; width: 50%; z-index: 1010; padding: 0;">
                
                <div class="card card-body border shadow-lg text-start" 
                     style="background-color: #F9F7F2; border-radius: 0 0 15px 15px; border-top: none;"
                     onclick="event.stopPropagation();">
                    
                    <p class="small fw-bold text-muted mb-3 border-bottom pb-1">Search Details</p>

                    {{-- Price (常に表示) --}}
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <p class="fw-bold mb-0 small">Price</p>
                            <span class="small text-muted" style="font-size: 0.7rem;">$0-100</span>
                        </div>
                        <input type="range" class="form-range" id="priceRange">
                    </div>

                    {{-- Review Section --}}
                    <div class="mb-3">
                        <p class="fw-bold mb-0 small d-flex justify-content-between align-items-center border-bottom pb-1" 
                           style="cursor: pointer;" onclick="toggleAccordion('acc-review', 'icon-review')">
                            Review <i class="bi bi-chevron-down small text-muted" id="icon-review"></i>
                        </p>
                        <div id="acc-review" style="display: none;" class="pt-2">
                            @for ($i = 5; $i >= 1; $i--)
                                <div class="form-check small mb-1">
                                    <input class="form-check-input" type="checkbox" id="star{{$i}}">
                                    <label class="form-check-label text-warning" for="star{{$i}}">
                                        {{ str_repeat('★', $i) }}
                                    </label>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- Location Section --}}
                    <div class="mb-3">
                        <p class="fw-bold mb-0 small d-flex justify-content-between align-items-center border-bottom pb-1" 
                        style="cursor: pointer;" onclick="toggleAccordion('acc-location', 'icon-location')">
                            Location <i class="bi bi-chevron-down small text-muted" id="icon-location"></i>
                        </p>
                        <div id="acc-location" style="display: none;" class="pt-2">
                            <div style="max-height: 200px; overflow-y: auto; overflow-x: hidden;" class="pe-2 custom-scrollbar">
                                <div class="form-check small mb-1">
                                    <input class="form-check-input" type="checkbox" id="loc-all">
                                    <label class="form-check-label fw-bold" for="loc-all">Select All</label>
                                </div>
                                
                                {{-- 47都道府県の配列 --}}
                                @php
                                    $prefectures = [
                                        'Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima',
                                        'Ibaraki', 'Tochigi', 'Gunma', 'Saitama', 'Chiba', 'Tokyo', 'Kanagawa',
                                        'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu',
                                        'Shizuoka', 'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara',
                                        'Wakayama', 'Tottori', 'Shimane', 'Okayama', 'Hiroshima', 'Yamaguchi',
                                        'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki',
                                        'Kumamoto', 'Oita', 'Miyazaki', 'Kagoshima', 'Okinawa'
                                    ];
                                @endphp

                                {{-- ループで一気に生成 --}}
                                @foreach($prefectures as $pref)
                                    <div class="form-check small mb-1">
                                        <input class="form-check-input" type="checkbox" id="loc-{{ $pref }}" name="locations[]" value="{{ $pref }}">
                                        <label class="form-check-label" for="loc-{{ $pref }}">{{ $pref }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Categories Section --}}
                    <div class="mb-3">
                        <p class="fw-bold mb-0 small d-flex justify-content-between align-items-center border-bottom pb-1" 
                           style="cursor: pointer;" onclick="toggleAccordion('acc-categories', 'icon-categories')">
                            Categories <i class="bi bi-chevron-down small text-muted" id="icon-categories"></i>
                        </p>
                        <div id="acc-categories" style="display: none;" class="pt-2">
                            <div style="max-height: 150px; overflow-y: auto;" class="pe-2">
                                @foreach(['Chinese', 'Italian', 'French', 'Ethnic', 'Japanese'] as $cat)
                                    <div class="form-check small mb-1">
                                        <input class="form-check-input" type="checkbox" id="cat-{{$cat}}">
                                        <label class="form-check-label" for="cat-{{$cat}}">{{$cat}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Sale Items Section --}}
                    <div class="mb-3">
                        <p class="fw-bold mb-0 small d-flex justify-content-between align-items-center border-bottom pb-1" 
                           style="cursor: pointer;" onclick="toggleAccordion('acc-sale', 'icon-sale')">
                            Sale Items <i class="bi bi-chevron-down small text-muted" id="icon-sale"></i>
                        </p>
                        <div id="acc-sale" style="display: none;" class="pt-2 ps-2">
                             <div class="form-check small mb-1">
                                <input class="form-check-input" type="checkbox" id="sale-only">
                                <label class="form-check-label" for="sale-only">On Sale Only</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-sm btn-dark w-100 py-2" onclick="handleFilterToggle(event)">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>
        </div>

           {{-- 商品グリッド --}}
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
                <div class="col">
                    <a href="{{ route('products.show', ['id' => 1]) }}" class="text-decoration-none text-dark d-block h-100">
                    <div class="card h-100 shadow-sm border-0 position-relative">
                        <div class="triangle-ribbon"></div>
                        <div class="ribbon-text">Easy</div>
                        <img src="{{ asset('images/journykit.png') }}" class="card-img-top" alt="Journey Kit">
                        {{-- テキスト内容 --}}
                <div class="card-body pt-3 text-start">
                    <h4 class="fw-bold mb-2" style="font-family: serif; color: #333;">Journey Kit</h4>
                    
                    {{-- タグ (Cool) --}}
                    <div class="mb-2">
                        <span class="border border-dark px-3 py-1 small" style="border-radius: 2px;">Cool</span>
                    </div>

                    {{-- 星評価とカート --}}
                    <div class="d-flex justify-content-between align-items-end mt-3">
                        <div>
                            <div class="text-warning mb-1" style="font-size: 1.5rem;">
                                ★★★★★
                            </div>
                            <span class="small text-muted">5.0 (40)</span>
                        </div>
                        
                        {{-- カートボタン --}}
                        <div class="text-center" style="cursor: pointer; margin-bottom: -30px;">
                            <i class="bi bi-cart-fill fs-2" style="color: #2c3e50;"></i>
                            <p class="mb-0" style="font-size: 0.7rem; font-weight: bold;">Add Cart</p>
                        </div>
                    </div>
                    
                    {{-- 価格 (デザインに合わせて追加) --}}
                    <p class="mt-2 mb-0 fw-bold h5">¥2,480~</p>
                </div>
            </div>
        </a>
    </div>




    {{-- 2つ目の商品（ダミー） --}}
        <div class="col">
            <div class="card h-100 shadow-sm border-0 position-relative p-3" style="background-color: #fcfbf9; border-radius: 15px;">
                <div class="position-relative">
                    <img src="https://via.placeholder.com/300x200?text=Product+2" class="card-img-top" alt="Sample" style="border-radius: 10px;">
                </div>
                <div class="card-body pt-3 text-start">
                    <h4 class="fw-bold mb-2" style="font-family: serif; color: #333;">Traditional Pasta</h4>
                    <div class="mb-2">
                        <span class="border border-dark px-3 py-1 small" style="border-radius: 2px;">Flash Flozen</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-3">
                        <div>
                            <div class="text-warning mb-1" style="font-size: 1.5rem;">★★★★☆</div>
                            <span class="small text-muted">4.2 (15)</span>
                        </div>
                        <div class="text-center" style="cursor: pointer; margin-bottom: -30px;">
                            <i class="bi bi-cart-fill fs-2" style="color: #2c3e50;"></i>
                            <p class="mb-0" style="font-size: 0.7rem; font-weight: bold;">Add Cart</p>
                        </div>
                    </div>
                    <p class="mt-2 mb-0 fw-bold h5">¥1,850~</p>
                </div>
            </div>
        </div>

        {{-- 3つ目の商品（ダミー） --}}
        <div class="col">
            <div class="card h-100 shadow-sm border-0 position-relative p-3" style="background-color: #fcfbf9; border-radius: 15px;">
                <div class="position-relative">
                    <img src="https://via.placeholder.com/300x200?text=Product+3" class="card-img-top" alt="Sample" style="border-radius: 10px;">
                </div>
                <div class="card-body pt-3 text-start">
                    <h4 class="fw-bold mb-2" style="font-family: serif; color: #333;">Spicy Curry Kit</h4>
                    <div class="mb-2">
                        <span class="border border-dark px-3 py-1 small" style="border-radius: 2px;">Cool</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-3">
                        <div>
                            <div class="text-warning mb-1" style="font-size: 1.5rem;">★★★★★</div>
                            <span class="small text-muted">4.8 (22)</span>
                        </div>
                        <div class="text-center" style="cursor: pointer; margin-bottom: -30px;">
                            <i class="bi bi-cart-fill fs-2" style="color: #2c3e50;"></i>
                            <p class="mb-0" style="font-size: 0.7rem; font-weight: bold;">Add Cart</p>
                        </div>
                    </div>
                    <p class="mt-2 mb-0 fw-bold h5">¥2,100~</p>
                </div>
            </div>
        </div>

        {{-- 4つ目の商品（ここから2行目） --}}
        <div class="col">
            <div class="card h-100 shadow-sm border-0 position-relative p-3" style="background-color: #fcfbf9; border-radius: 15px;">
                <div class="position-relative">
                    <img src="https://via.placeholder.com/300x200?text=Product+4" class="card-img-top" alt="Sample" style="border-radius: 10px;">
                </div>
                <div class="card-body pt-3 text-start">
                    <h4 class="fw-bold mb-2" style="font-family: serif; color: #333;">Green Salad Mix</h4>
                    <div class="mb-2">
                        <span class="border border-dark px-3 py-1 small" style="border-radius: 2px;">Flash Frozen</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-3">
                        <div>
                            <div class="text-warning mb-1" style="font-size: 1.5rem;">★★★☆☆</div>
                            <span class="small text-muted">3.5 (8)</span>
                        </div>
                        <div class="text-center" style="cursor: pointer; margin-bottom: -30px;">
                            <i class="bi bi-cart-fill fs-2" style="color: #2c3e50;"></i>
                            <p class="mb-0" style="font-size: 0.7rem; font-weight: bold;">Add Cart</p>
                        </div>
                    </div>
                    <p class="mt-2 mb-0 fw-bold h5">¥1,200~</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // メニュー全体の開閉
    function handleFilterToggle(e) {
        e.preventDefault();
        e.stopPropagation();
        const menu = document.getElementById('customSearchMenu');
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    }

    // 各項目（アコーディオン）の開閉
    function toggleAccordion(contentId, iconId) {
        const content = document.getElementById(contentId);
        const icon = document.getElementById(iconId);

        if (content.style.display === 'none') {
            content.style.display = 'block';
            icon.classList.replace('bi-chevron-down', 'bi-chevron-up');
        } else {
            content.style.display = 'none';
            icon.classList.replace('bi-chevron-up', 'bi-chevron-down');
        }
    }

    // 外側クリックで閉じる
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('customSearchMenu');
        const btn = document.getElementById('mealKitsBtn');
        if (menu && menu.style.display === 'block' && !menu.contains(e.target) && !btn.contains(e.target)) {
            menu.style.display = 'none';
        }
    });
</script>
@endsection