@extends('layouts.owner')

@section('title', 'Add Meal Kit')

@section('content')
<div class="container my-5">
    <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">
            <div class="mx-auto" style="max-width: 820px;">
                <h1 class="text-center mb-5" style="text-decoration: underline; text-underline-offset: 10px; text-decoration-color: #D96B52;">
                    Add Meal Kit
                </h1>

                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-5">
                        {{-- Left --}}
                        <div class="col-md-6">
                            <h2 class="mb-4">Basic Infomation</h2>

                            <div class="mb-4">
                                <label for="meal_kit_name" class="form-label">Meal Kit Name</label>
                                <input type="text" id="meal_kit_name" name="meal_kit_name" class="form-control form-transparent" placeholder="Enter meal kit name">
                            </div>

                            <div class="mb-4">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="price" name="price" class="form-control form-transparent">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="serving" class="form-label">Serving</label>
                                <select id="serving" name="serving" class="form-select form-transparent">
                                    <option selected>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                <select id="stock_quantity" name="stock_quantity" class="form-select form-transparent">
                                    <option selected>1</option>
                                    <option>2</option>
                                    <option>5</option>
                                    <option>10</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="category" class="form-label">Category</label>
                                <select id="category" name="category" class="form-select form-transparent">
                                    <option selected>Select category</option>
                                    <option>Korean</option>
                                    <option>Japanese</option>
                                    <option>Chinese</option>
                                </select>
                            </div>

                            <div class="mb-5">
                                <label for="difficulty_level" class="form-label">Difficulty Level</label>
                                <select id="difficulty_level" name="difficulty_level" class="form-select form-transparent">
                                    <option selected>Easy</option>
                                    <option>Medium</option>
                                    <option>Hard</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Upload Image</label>
                                <label for="main_image" class="border rounded-4 w-100 d-flex flex-column justify-content-center align-items-center text-secondary"
                                    style="height: 120px; cursor: pointer;">
                                    <span style="font-size: 3rem; line-height: 1;">+</span>
                                    <span>Main image（Thumbnail）</span>
                                </label>
                                <input type="file" id="main_image" name="main_image" class="d-none">
                            </div>
                        </div>

                        {{-- Right --}}
                        <div class="col-md-6">
                            <h2 class="mb-4">Food Infomation</h2>

                            <div class="mb-4">
                                <label for="ingredients" class="form-label">Ingredients</label>
                                <textarea id="ingredients" name="ingredients" class="form-control mb-5 form-transparent" rows="4"
                                    placeholder="Enter ingredients
                                                (e.g
                                                Chicken,Poteto,Onion,Soy ...">
                                </textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Allergens</label>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="wheat" name="allergens[]" value="Wheat">
                                            <label class="form-check-label" for="wheat">Wheat</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="milk" name="allergens[]" value="Milk">
                                            <label class="form-check-label" for="milk">Milk</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="shirimp" name="allergens[]" value="Shirimp">
                                            <label class="form-check-label" for="shirimp">Shirimp</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="egg" name="allergens[]" value="Egg">
                                            <label class="form-check-label" for="egg">Egg</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="soy" name="allergens[]" value="Soy">
                                            <label class="form-check-label" for="soy">Soy</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="penuts" name="allergens[]" value="Penuts">
                                            <label class="form-check-label" for="penuts">Penuts</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-2 mt-2">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" id="other_allergen">
                                    </div>
                                    <input type="text" class="form-control form-transparent" name="other_allergen" placeholder="Other">
                                </div>
                            </div>

                            <div class="mb-5">
                                <label for="expiration_description" class="form-label">Expiratioin Description</label>
                                <textarea id="expiration_description" name="expiration_description" class="form-control form-transparent" rows="5"
                                    placeholder="Arrives within 3days after shipping."></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block invisible">Additional Image</label>
                                <label for="additional_images" class="border rounded-4 w-100 d-flex flex-column justify-content-center align-items-center text-secondary"
                                    style="height: 120px; cursor: pointer;">
                                    <span style="font-size: 3rem; line-height: 1;">+</span>
                                    <span>Additional Images（optional）</span>
                                </label>
                                <input type="file" id="additional_images" name="additional_images[]" class="d-none" multiple>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-5">
                        <a href="#" class="btn btn-outline-orange px-5">Cancel</a>
                        <button type="submit" class="btn btn-orange px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection