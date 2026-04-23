@extends('admin.layouts.admin')

@section('title','Product Detail')

@section('content')

<div class="order-wrapper">
    <h2 class="order-title">Product Details</h2>

    <div class="order-content">

        <!-- LEFT -->
        <div class="user-card">

            <div class="user-top">
                {{-- @if ($product->image)
                    <div class="mb-3 text-center">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}"
                        alt="product image"
                        style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 10px;">
                    </div>
                @endif --}}
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <p class="user-id mb-0">Product ID #{{ $product->id }}</p>

                        <span class="order-status {{ $product->is_visible ? 'delivered' : 'refunded' }}">
                            <span class="dot" style="background: {{ $product->is_visible ? '#6ecf7f' : '#D96B52' }};"></span>
                            {{ $product->is_visible ? 'Visible' : 'Hidden' }}
                        </span>
                    </div>

                    <h3 class="user-name mt-2">{{ $product->name ?? 'No Product Name' }}</h3>
                </div>
            </div>

            <div class="user-info-list mt-4">
                <div class="info-row">
                    <span class="info-label">Category</span>
                    <span class="info-value">{{ optional($product->category)->name ?? '-' }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Price</span>
                    <span class="info-value">¥{{ number_format($product->price ?? 0) }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Stock</span>
                    <span class="info-value">{{ $product->stock ?? 0 }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Serving</span>
                    <span class="info-value">{{ $product->serving ?? '-' }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Difficulty</span>
                    <span class="info-value">{{ $product->difficulty_level ?? '-' }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Rating</span>
                    <span class="info-value">{{ $product->rating ?? '-' }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Badge</span>
                    <span class="info-value">{{ $product->badge ?? '-' }}</span>
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="order-card">
            <h4 class="order-info-title">Product Information</h4>

            <div class="order-info-list">
                <div class="info-row">
                    <span class="info-label">Restaurant Name</span>
                    <span class="info-value">
                        {{ $product->restaurant_name ?? optional($product->restaurant)->restaurant_name ?? '-' }}
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Location</span>
                    <span class="info-value">{{ $product->location ?? '-' }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Ingredients</span>
                    <span class="info-value">{{ $product->ingredients ?? '-' }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Allergens</span>
                    <span class="info-value">{{ $product->allergens ?? '-' }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Description</span>
                    <span class="info-value">{{ $product->description ?? '-' }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Created At</span>
                    <span class="info-value">
                        {{ $product->created_at ? $product->created_at->format('Y-m-d') : '-' }}
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Updated At</span>
                    <span class="info-value">
                        {{ $product->updated_at ? $product->updated_at->format('Y-m-d') : '-' }}
                    </span>
                </div>
            </div>
        </div>
    
        <div class="user-action-buttons text-center mt-4 d-flex justify-content-center gap-3">

            <!-- Show / Hide -->
            <form action="{{ route('admin.products.toggleVisibility', $product->id) }}" method="POST">
                @csrf
                @if($product->is_visible)
                    <button type="submit" class="action-btn refunded-btn">Hide</button>
                @else
                    <button type="submit" class="action-btn delivered-btn">Show</button>
                @endif
            </form>

            <!-- Delete -->
            <form action="{{ route('admin.products.destroy', $product->id) }}"
                method="POST"
                class="delete-form">
                @csrf
                @method('DELETE')

                <button type="submit" class="action-btn canceled-btn">
                    Delete
                </button>
            </form>

        </div>

    </div>
</div>
    <div class="text-center mt-4">
        <a href="{{ route('admin.products.index') }}" class="admin-home-link">
            Back to List
        </a>
    </div>

@endsection