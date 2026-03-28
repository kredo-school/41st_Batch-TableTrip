@extends('layouts.owner')

@section('title', 'Edit Meal Kit')

@section('content')
<div class="m-5">
    <div class="row mt-5">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">
            <div class="mx-auto" style="max-width: 820px;">
                <h1 class="text-center mb-5 text-underline-accent">
                    Edit Meal Kit
                </h1>

                <form action="{{ route('owner.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row g-5">

                        {{-- LEFT --}}
                        <div class="col-md-6">
                            <h2 class="mb-4">Basic Information</h2>

                            {{-- Name --}}
                            <div class="mb-4">
                                <label class="form-label">Meal Kit Name</label>
                                <input type="text" name="name"
                                    class="form-control form-transparent @error('name') is-invalid @enderror"
                                    value="{{ old('name', $product->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Price --}}
                            <div class="mb-4">
                                <label class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" name="price"
                                        class="form-control form-transparent @error('price') is-invalid @enderror"
                                        value="{{ old('price', $product->price) }}">
                                </div>
                                @error('price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Serving --}}
                            <div class="mb-4">
                                <label class="form-label">Serving</label>
                                <input type="number" name="serving"
                                    class="form-control form-transparent @error('serving') is-invalid @enderror"
                                    value="{{ old('serving', $product->serving) }}">
                                @error('serving')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Stock --}}
                            <div class="mb-4">
                                <label class="form-label">Stock</label>
                                <input type="number" name="stock"
                                    class="form-control form-transparent @error('stock') is-invalid @enderror"
                                    value="{{ old('stock', $product->stock) }}">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="mb-4">
                                <label class="form-label">Category</label>
                                <select name="category_id"
                                    class="form-select form-transparent @error('category_id') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Difficulty --}}
                            <div class="mb-5">
                                <label class="form-label">Difficulty Level</label>
                                <select name="difficulty_level"
                                    class="form-select form-transparent @error('difficulty_level') is-invalid @enderror">
                                    @foreach(['easy','medium','hard'] as $level)
                                        <option value="{{ $level }}"
                                            {{ old('difficulty_level', $product->difficulty_level) == $level ? 'selected' : '' }}>
                                            {{ ucfirst($level) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('difficulty_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Main Image --}}
                            <div class="mb-3">
                                <label class="form-label">Upload Image</label>

                                <label for="main_image"
                                    class="border rounded-4 w-100 d-flex justify-content-center align-items-center text-secondary overflow-hidden"
                                    style="height: 120px; cursor: pointer;">

                                    <img id="main_image_preview"
                                        src="{{ $product->image ? asset('storage/'.$product->image) : '' }}"
                                        class="w-100 h-100 {{ $product->image ? '' : 'd-none' }}"
                                        style="object-fit: cover;">

                                    <span id="main_image_placeholder"
                                        class="{{ $product->image ? 'd-none' : '' }}">
                                        + Main Image
                                    </span>
                                </label>

                                <input type="file" id="main_image" name="main_image" class="d-none">

                                @error('main_image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- RIGHT --}}
                        <div class="col-md-6">
                            <h2 class="mb-4">Food Information</h2>

                            {{-- Ingredients --}}
                            <div class="mb-4">
                                <label class="form-label">Ingredients</label>
                                <textarea name="ingredients"
                                    class="form-control form-transparent @error('ingredients') is-invalid @enderror"
                                    rows="4">{{ old('ingredients', $product->ingredients) }}</textarea>
                                @error('ingredients')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Allergens --}}
                            @php
                                $selected = old('allergens', explode(', ', $product->allergens ?? ''));
                            @endphp

                            <div class="mb-5">
                                <label class="form-label">Allergens</label>

                                <div class="row">
                                    <div class="col-6">
                                        @foreach(['Wheat','Milk','Shrimp'] as $a)
                                            <div class="form-check mb-2">
                                                <input type="checkbox" name="allergens[]" value="{{ $a }}"
                                                    class="form-check-input"
                                                    {{ in_array($a, $selected) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $a }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-6">
                                        @foreach(['Egg','Soy','Peanuts'] as $a)
                                            <div class="form-check mb-2">
                                                <input type="checkbox" name="allergens[]" value="{{ $a }}"
                                                    class="form-check-input"
                                                    {{ in_array($a, $selected) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $a }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                @error('allergens')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                <div class="mt-2">
                                    <input type="text" name="other_allergen"
                                        class="form-control form-transparent"
                                        placeholder="Other"
                                        value="{{ old('other_allergen') }}">
                                </div>
                            </div>

                             <div class="mb-5">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control form-transparent mb-5" rows="5"
                                    placeholder="Write Description.">{{ old('description',$product->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror      
                            </div>

                            {{-- Additional Images --}}
                            <div class="mb-3">
                                <label class="form-label">Additional Images</label>

                                @if($product->images->isNotEmpty())
                                    <div class="row g-2 mb-3">
                                        @foreach($product->images as $image)
                                            @if($image->display_order > 1)
                                                <div class="col-4 col-md-3 position-relative" id="image-{{ $image->id }}">
                                                    <img src="{{ asset('storage/' . $image->image_url) }}"
                                                        alt="Additional image"
                                                        class="w-100 rounded additional-image">

                                                    <button type="button"
                                                        class="btn btn-danger rounded-circle position-absolute top-0 end-0 d-flex align-items-center justify-content-center delete-image-btn"
                                                        style="width: 28px; height: 28px;"
                                                        data-id="{{ $image->id }}"
                                                        data-url="{{ route('owner.products.images.destroy', $image->id) }}"
                                                        style="width: 28px; height: 28px;">
                                                        ×
                                                    </button>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                                <label for="additional_images"
                                    class="border rounded-4 w-100 d-flex justify-content-center align-items-center text-secondary"
                                    style="height: 120px; cursor: pointer;">
                                    + Add Images
                                </label>

                                <input type="file" id="additional_images"
                                    name="additional_images[]"
                                    class="d-none"
                                    multiple
                                    accept="image/*">

                                <div id="additional_images_preview" class="row g-2 mt-2"></div>

                                @error('additional_images')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                @error('additional_images.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-5">
                        <a href="{{ route('owner.products') }}" class="btn btn-outline-navy px-5">Cancel</a>
                        <button type="submit" class="btn btn-navy px-5">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection