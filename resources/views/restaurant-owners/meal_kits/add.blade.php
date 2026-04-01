@extends('layouts.owner')

@section('title', 'Add Meal Kit')

@section('content')
<div class="m-5">
    <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">
            <div class="mx-auto" style="max-width: 820px;">
                <h1 class="text-center mb-5 text-underline-accent">
                    Add Meal Kit
                </h1>
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('owner.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-5">
                        {{-- Left --}}
                        <div class="col-md-6">
                            <h2 class="mb-4">Basic Infomation</h2>

                            <div class="mb-4">
                                <label for="meal_kit_name" class="form-label">Meal Kit Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control form-transparent" placeholder="Enter meal kit name" autofocus>
                                 @error('name')
                                   <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror
                            </div>

                            <div class="mb-4">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="price" name="price" value="{{ old('price') }}" class="form-control form-transparent">
                                </div>
                                @error('price')
                                   <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror                        
                            </div>

                            <div class="mb-4">
                                <label for="serving" class="form-label">Serving</label>
                                <input name="serving" type="number" value="{{ old('serving') }}" class="form-control form-transparent" placeholder="1">
                                 @error('serving')
                                   <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror
                            </div>

                            <div class="mb-4">
                                <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                <input name="stock" type="number" value="{{ old('stock') }}" class="form-control form-transparent" placeholder="1">
                                @error('stock')
                                   <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror
                            </div>

                            <div class="mb-4">
                                <label for="category" class="form-label">Category</label>
                                <select id="category" name="category_id"class="form-select form-transparent">
                                     @foreach ($categories as $category)
                                       <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                   <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror
                            </div>

                            <div class="mb-5">
                                <label for="difficulty_level" class="form-label">Difficulty Level</label>
                                <select id="difficulty_level" name="difficulty_level" class="form-select form-transparent">
                                    <option value="easy" {{ old('difficulty_level') == 'easy' ? 'selected' : '' }}>Easy</option>
                                    <option value="medium" {{ old('difficulty_level') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="hard" {{ old('difficulty_level') == 'hard' ? 'selected' : '' }}>Hard</option>
                                </select>
                                 @error('difficulty_level')
                                   <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Upload Image</label>

                                <label for="main_image"
                                    class="border rounded-4 w-100 d-flex flex-column justify-content-center align-items-center text-secondary overflow-hidden position-relative"
                                    style="height: 120px; cursor: pointer;">

                                    <img id="main_image_preview"
                                        src="#"
                                        alt="Main image preview"
                                        class="w-100 h-100 d-none position-absolute top-0 start-0"
                                        style="object-fit: cover;">

                                    <div id="main_image_placeholder" class="text-center">
                                        <span style="font-size: 3rem; line-height: 1;">+</span>
                                        <span class="d-block">Main image (Thumbnail)</span>
                                    </div>
                                </label>

                                <input type="file" id="main_image" name="main_image" class="d-none" accept="image/*">

                                @error('main_image')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        {{-- Right --}}
                        <div class="col-md-6">
                            <h2 class="mb-4">Food Infomation</h2>

                            <div class="mb-4">
                                <label for="ingredients" class="form-label">Ingredients</label>
                                <textarea id="ingredients" name="ingredients" class="form-control mb-5 form-transparent" rows="4"
                                    placeholder="Enter ingredients(e.g Chicken,Poteto,Onion,Soy ...">{{ old('ingredients') }} </textarea>
                              @error('ingredients')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror                        
                            </div>

                           @php
                                $oldAllergens = old('allergens', []);
                            @endphp

                            <div class="mb-4">
                                <label class="form-label">Allergens</label>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="wheat" name="allergens[]" value="Wheat"
                                                {{ in_array('Wheat', $oldAllergens) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="wheat">Wheat</label>
                                        </div>

                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="milk" name="allergens[]" value="Milk"
                                                {{ in_array('Milk', $oldAllergens) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="milk">Milk</label>
                                        </div>

                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="shrimp" name="allergens[]" value="Shrimp"
                                                {{ in_array('Shrimp', $oldAllergens) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="shrimp">Shrimp</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="egg" name="allergens[]" value="Egg"
                                                {{ in_array('Egg', $oldAllergens) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="egg">Egg</label>
                                        </div>

                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="soy" name="allergens[]" value="Soy"
                                                {{ in_array('Soy', $oldAllergens) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="soy">Soy</label>
                                        </div>

                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="peanuts" name="allergens[]" value="Peanuts"
                                                {{ in_array('Peanuts', $oldAllergens) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="peanuts">Peanuts</label>
                                        </div>
                                    </div>
                                </div>

                                @error('allergens.*')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="d-flex align-items-center gap-2 mt-2">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" id="other_allergen_checkbox"
                                            {{ old('other_allergen') ? 'checked' : '' }}>
                                    </div>

                                    <input type="text"
                                        class="form-control form-transparent"
                                        name="other_allergen"
                                        placeholder="Other"
                                        value="{{ old('other_allergen') }}">
                                </div>

                                @error('other_allergen')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control form-transparent" rows="5"
                                    placeholder="Write Description.">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror      
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block invisible">Additional Image</label>

                                <label for="additional_images"
                                    class="border rounded-4 w-100 d-flex flex-column justify-content-center align-items-center text-secondary"
                                    style="height: 120px; cursor: pointer;">
                                    <span style="font-size: 3rem; line-height: 1;">+</span>
                                    <span>Additional Images (optional)</span>
                                </label>

                                <input type="file" id="additional_images" name="additional_images[]" class="d-none" multiple accept="image/*">

                                @error('additional_images.*')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             {{-- Additional Images Preview --}}
                            <div>
                                <div id="additional_images_preview" class="row g-2"></div>
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-5">
                        <a href="{{ route('owner.products') }}" class="btn btn-outline-orange px-5">Cancel</a>
                        <button type="submit" class="btn btn-orange px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection