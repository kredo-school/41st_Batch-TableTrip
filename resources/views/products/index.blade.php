@extends('layouts.app')
@section('content')
@vite(['resources/css/product-list.css'])

<div class="product-page" style="background-color: #F9F7F2; min-height: 100vh;">
    

<div class="container py-5">
        {{-- タイトル部分 --}}
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold" style="color: #4A4A4A; text-decoration: underline orange;">Product list</h2>
        </div>

        {{-- カテゴリ選択（元のレイアウトを維持） --}}
        <div class="row mb-3 text-center position-relative mx-0">
            {{-- 左側：Meal Kitsタブ --}}
            <div class="{{ auth()->check() ? 'col-6' : 'col-12' }} border py-3 fw-bold d-flex align-items-center justify-content-center gap-2 p-0"
                 style="z-index: 1020; background-color: {{ request('tab') !== 'favorites' ? '#2c3e50' : '#fff' }};">
                <a href="{{ route('products.index') }}"
                   class="text-decoration-none flex-grow-1 py-2"
                   style="color: {{ request('tab') !== 'favorites' ? '#fff' : '#212529' }};">
                    Meal Kits
                </a>
                <span id="mealKitsBtn"
                      class="px-3 py-2 border-start"
                      style="cursor: pointer; color: {{ request('tab') !== 'favorites' ? '#fff' : '#212529' }};"
                      onclick="handleFilterToggle(event)">
                    <i class="bi bi-chevron-down"></i>
                </span>
            </div>
            
            {{-- 右側：Favorites --}}
            @auth
            <a href="{{ route('products.index', ['tab' => 'favorites']) }}"
               class="col-6 border py-3 text-decoration-none fw-bold d-flex align-items-center justify-content-center gap-2"
               style="z-index: 1020; background-color: {{ request('tab') === 'favorites' ? '#2c3e50' : '#fff' }}; color: {{ request('tab') === 'favorites' ? '#fff' : '#212529' }};">
                <i class="bi bi-heart{{ request('tab') === 'favorites' ? '-fill' : '' }}"></i> Favorites
            </a>
            @endauth

            {{-- --- ソートメニュー --- --}}
            <div id="customSearchMenu"
                 style="display: none; position: absolute; top: 100%; left: 0; width: 50%; z-index: 1010; padding: 0;">

                <form method="GET" action="{{ route('products.index') }}"
                      class="card card-body border shadow-lg text-start"
                      style="background-color: #F9F7F2; border-radius: 0 0 15px 15px; border-top: none;"
                      onclick="event.stopPropagation();">

                    <p class="small fw-bold text-muted mb-3 border-bottom pb-1">Search Details</p>

                    {{-- Sort --}}
                    <div class="mb-4">
                        <p class="fw-bold mb-1 small">Sort By</p>
                        <select name="sort" class="form-select form-select-sm">
                            <option value=""           {{ request('sort') == ''           ? 'selected' : '' }}>Newest</option>
                            <option value="price_asc"  {{ request('sort') == 'price_asc'  ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="rating"     {{ request('sort') == 'rating'     ? 'selected' : '' }}>Top Rated</option>
                        </select>
                    </div>

                    {{-- Price --}}
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <p class="fw-bold mb-0 small">Max Price</p>
                            <span class="small text-muted" id="priceLabel">¥{{ number_format(request('price_max', $priceMax)) }}</span>
                        </div>
                        <input type="range" class="form-range" name="price_max" id="priceRange"
                               min="0" max="{{ $priceMax }}" step="100"
                               value="{{ request('price_max', $priceMax) }}"
                               oninput="document.getElementById('priceLabel').textContent = '¥' + parseInt(this.value).toLocaleString()">
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
                                    <input class="form-check-input" type="checkbox"
                                           name="ratings[]" value="{{ $i }}" id="star{{$i}}"
                                           {{ in_array($i, request('ratings', [])) ? 'checked' : '' }}>
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
                                @foreach($locations as $loc)
                                    <div class="form-check small mb-1">
                                        <input class="form-check-input" type="checkbox"
                                               name="locations[]" value="{{ $loc }}" id="loc-{{ $loc }}"
                                               {{ in_array($loc, request('locations', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="loc-{{ $loc }}">{{ $loc }}</label>
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
                                @foreach($categories as $cat)
                                    <div class="form-check small mb-1">
                                        <input class="form-check-input" type="checkbox"
                                               name="categories[]" value="{{ $cat->id }}" id="cat-{{$cat->id}}"
                                               {{ in_array($cat->id, request('categories', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cat-{{$cat->id}}">{{ $cat->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary w-50 py-2">Reset</a>
                        <button type="submit" class="btn btn-sm btn-dark w-50 py-2">Apply</button>
                    </div>
                </form>
            </div>
        </div>

           {{-- 商品グリッド --}}
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
                @forelse($products as $product)
                <div class="col">
                    <div class="card h-100 border-0 position-relative" style="background-color: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">

                        {{-- リボン --}}
                        @if($product->badge)
                            @php
                                $badgeColor = match($product->badge) {
                                    'Easy'    => '#D97652',
                                    'Special' => '#E8C43A',
                                    'Kids OK' => '#3DBDB5',
                                    default   => '#D97652',
                                };
                            @endphp
                            <div class="triangle-ribbon" style="border-color: {{ $badgeColor }} transparent transparent transparent;"></div>
                            <div class="ribbon-text" style="font-size: {{ $product->badge === 'Kids OK' ? '26px' : '36px' }};">{{ $product->badge }}</div>
                        @endif

                        {{-- 商品画像（クリックで詳細へ） --}}
                        <a href="{{ route('products.show', ['id' => $product->id]) }}" class="text-decoration-none text-dark">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     class="card-img-top"
                                     alt="{{ $product->name }}"
                                     style="object-fit: cover; height: 190px; width: 100%;">
                            @else
                                <img src="https://via.placeholder.com/300x190?text=No+Image"
                                     class="card-img-top"
                                     alt="No Image"
                                     style="height: 190px; object-fit: cover;">
                            @endif
                        </a>

                        <div class="card-body px-3 pt-3 pb-3 text-start">
                            {{-- ハートボタン --}}
                            @auth
                            <form action="{{ route('favorite.toggle') }}" method="POST"
                                  style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="border-0 bg-transparent p-0" style="cursor: pointer;">
                                    @if(in_array($product->id, $favoriteIds))
                                        <i class="bi bi-heart-fill" style="font-size: 1.4rem; color: #e74c3c;"></i>
                                    @else
                                        <i class="bi bi-heart" style="font-size: 1.4rem; color: #e74c3c;"></i>
                                    @endif
                                </button>
                            </form>
                            @endauth

                            {{-- 商品名 + 価格（クリックで詳細へ） --}}
                            <a href="{{ route('products.show', ['id' => $product->id]) }}" class="text-decoration-none text-dark">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h5 class="fw-bold mb-0" style="font-family: serif; color: #333;">{{ $product->name }}</h5>
                                    <span class="fw-bold text-nowrap ms-2" style="font-size: 0.95rem; color: #333;">¥{{ number_format($product->price) }}-</span>
                                </div>

                                {{-- タグ --}}
                                @if($product->tag)
                                <div class="mb-2">
                                    @php
                                        $tagStyle = $product->tag === 'Flash Frozen'
                                            ? 'background-color:#dbeafe; color:#1d4ed8; border:1px solid #93c5fd;'
                                            : 'background-color:#e0f2fe; color:#0369a1; border:1px solid #7dd3fc;';
                                    @endphp
                                    <span style="font-size:0.72rem; border-radius:3px; padding:1px 7px; font-weight:600; {{ $tagStyle }}">
                                        {{ $product->tag === 'Flash Frozen' ? '❄ Flash Frozen' : '🧊 Cool' }}
                                    </span>
                                </div>
                                @endif
                            </a>

                            {{-- 星評価 + カート --}}
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div>
                                    <div class="mb-0" style="font-size: 1.1rem; line-height: 1;">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($product->rating))
                                                <span style="color: #F5A623;">★</span>
                                            @else
                                                <span style="color: #ddd;">★</span>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-muted" style="font-size: 0.7rem;">{{ $product->rating }} (40)</span>
                                </div>

                                {{-- カートボタン --}}
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="border-0 bg-transparent text-center" style="cursor: pointer;">
                                        <i class="bi bi-cart-fill" style="font-size: 1.6rem; color: #2c3e50;"></i>
                                        <p class="mb-0" style="font-size: 0.6rem; font-weight: bold; color: #2c3e50;">Add Cart</p>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-5">
                    <p>No products found.</p>
                </div>
                @endforelse
            </div>
        </div>

        @auth
        <div class="btn-back-container text-center my-5">
            <a href="{{ route('dashboard') }}" class="btn-back-custom">
                <i class="bi bi-house-door-fill me-2"></i>Back to Dashboard
            </a>
        </div>
        @endauth

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