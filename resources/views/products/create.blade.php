@extends('layouts.app') {{-- もし共通レイアウトを使うなら。使わない場合はこの行を消して通常のHTMLタグで囲んでください --}}

@section('content')
<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 600px; border-radius: 15px;">
        <div class="card-body p-5">
            <h2 class="text-center mb-4" style="font-family: serif;">Register New Product</h2>

            {{-- フォームの開始 --}}
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf {{-- CSRF保護：これがないとエラーになります --}}

                {{-- 商品名 --}}
                <div class="mb-3">
                    <label class="form-label text-secondary">Product Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" placeholder="Journey Kit: Kyoto">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 価格 --}}
                <div class="mb-3">
                    <label class="form-label text-secondary">Price (JPY)</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', 0) }}" required>
                </div>

                {{-- レストラン名 --}}
                <div class="mb-3">
                    <label class="form-label text-secondary">Restaurant Name</label>
                    <input type="text" name="restaurant_name" class="form-control @error('restaurant_name') is-invalid @enderror" 
                           value="{{ old('restaurant_name') }}">
                    @error('restaurant_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 都道府県 --}}
                <div class="mb-3">
                    <label class="form-label text-secondary">Prefecture</label>
                    <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" 
                           value="{{ old('location') }}" placeholder="Kyoto, Japan">
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 原材料 --}}
                <div class="mb-3">
                    <label class="form-label text-secondary">Ingredients</label>
                    <textarea name="ingredients" class="form-control" rows="2" placeholder="Rice, Seafood, Soy sauce, etc.">{{ old('ingredients') }}</textarea>
                </div>

                {{-- アレルギー --}}
                <div class="mb-3">
                    <label class="form-label text-secondary">Allergens</label>
                    <input type="text" name="allergens" class="form-control" value="{{ old('allergens') }}" placeholder="Shrimp, Egg, etc.">
                </div>

                {{-- 説明文 --}}
                <div class="mb-4">
                    <label class="form-label text-secondary">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <input type="hidden" name="category_id" value="1">

                {{-- バッジ選択（リボン） --}}
                <div class="mb-3">
                    <label class="form-label text-secondary">Badge (Ribbon)</label>
                    <select name="badge" class="form-select">
                        <option value="">-- None --</option>
                        <option value="Easy"    {{ old('badge') == 'Easy'    ? 'selected' : '' }}>Easy</option>
                        <option value="Special" {{ old('badge') == 'Special' ? 'selected' : '' }}>Special</option>
                        <option value="Kids OK" {{ old('badge') == 'Kids OK' ? 'selected' : '' }}>Kids OK</option>
                    </select>
                </div>

                {{-- タグ選択（四角バッジ） --}}
                <div class="mb-3">
                    <label class="form-label text-secondary">Tag</label>
                    <select name="tag" class="form-select">
                        <option value="">-- None --</option>
                        <option value="Cool"         {{ old('tag') == 'Cool'         ? 'selected' : '' }}>Cool</option>
                        <option value="Flash Frozen" {{ old('tag') == 'Flash Frozen' ? 'selected' : '' }}>Flash Frozen</option>
                    </select>
                </div>

                {{-- 画像選択ボタンを追加 --}}
                <div class="mb-3">
                    <label class="form-label text-secondary">Product Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                {{-- 登録ボタン --}}
                <button type="submit" class="btn btn-dark w-100 py-3 rounded-pill">
                    Register Product
                </button>
            </form>
        </div>
    </div>
</div>
@endsection