@extends('layouts.app')

@section('content')
<div class="confirm-page" style="background-color: #F9F7F2; min-height: 100vh; font-family: serif;">
    <div class="container py-5" style="max-width: 600px;">

        <h2 class="text-center mb-5 fw-bold">Confirm your order</h2>

        @forelse($cart as $id => $item)
        @php $product = (object) $item['product']; @endphp
        <div class="card mb-3 border-dark shadow-sm" style="border-radius: 5px;">
            <div class="row g-0 align-items-center">
                <div class="col-4 p-2 position-relative">
                    @if(!empty($product->badge))
                        @php
                            $badgeColor = match($product->badge) {
                                'Easy'    => '#D97652',
                                'Special' => '#E8C43A',
                                'Kids OK' => '#3DBDB5',
                                default   => '#D97652',
                            };
                        @endphp
                        <div class="mini-triangle-ribbon" style="border-top-color: {{ $badgeColor }};"></div>
                        <span class="mini-ribbon-text" style="font-size: {{ $product->badge === 'Kids OK' ? '0.5rem' : '0.65rem' }};">{{ $product->badge }}</span>
                    @endif
                    @if(!empty($product->image))
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded border" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/150?text=No+Image" class="img-fluid rounded border" alt="No Image">
                    @endif
                </div>
                <div class="col-8">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="fw-bold mb-1">{{ $product->name }}</h5>
                                <p class="text-muted small mb-0">{{ $product->location }} | {{ $product->restaurant_name }}</p>
                            </div>
                            <p class="fw-bold mb-0">¥{{ number_format($product->price) }}-</p>
                        </div>

                        {{-- 数量操作 --}}
                        <div class="d-flex justify-content-end align-items-center mt-2">
                            <div class="border border-dark d-flex align-items-center px-2 py-1" style="border-radius: 5px;">
                                <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                    <input type="hidden" name="redirect" value="confirm">
                                    <button class="btn btn-sm p-0 border-0">－</button>
                                </form>
                                <span class="mx-3 fw-bold">{{ $item['quantity'] }}</span>
                                <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                    <input type="hidden" name="redirect" value="confirm">
                                    <button class="btn btn-sm p-0 border-0">＋</button>
                                </form>
                            </div>
                            <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <input type="hidden" name="redirect" value="confirm">
                                <button class="btn btn-sm text-danger ms-3 border-0 bg-transparent">
                                    <i class="bi bi-trash fs-5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5">
            <p>Your cart is empty.</p>
            <a href="{{ route('products.index') }}" class="btn btn-dark">Back to Products</a>
        </div>
        @endforelse

        @if(count($cart) > 0)
        <div class="text-center my-5">
            <h3 class="fw-bold">Total amount : ¥{{ number_format($total) }}-</h3>
        </div>

        <hr class="border-dark">

        {{-- 配送先情報 --}}
        <div class="mb-3 mt-3 position-relative">
            <h5 class="fw-bold mb-3">Shipping Address</h5>
            <div class="ps-3 small">
                <p class="mb-1">Name : {{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</p>
                <p class="mb-1">Address : {{ $user->address ?? 'Not set' }}</p>
                <p class="mb-1">Phone : {{ $user->tel ?? 'Not set' }}</p>
            </div>
            <a href="{{ route('user.edit') }}?from=confirm" class="text-dark position-absolute bottom-0 end-0 p-2" style="font-size: 1.2rem;">
                <i class="bi bi-pencil-square"></i>
            </a>
        </div>

        <hr class="border-dark">

        {{-- 支払い方法 --}}
        <div class="mb-3 mt-3 position-relative">
            <h5 class="fw-bold mb-3">Payment Method</h5>
            <div class="ps-3 small">
                @if($paymentMethod)
                    <p class="mb-1">Payment : {{ $paymentMethod->brand }} **** **** {{ $paymentMethod->last4 }}</p>
                    <p class="mb-1">Expiry Date : {{ $paymentMethod->exp_year }}/{{ str_pad($paymentMethod->exp_month, 2, '0', STR_PAD_LEFT) }}</p>
                @else
                    <p class="mb-1 text-muted">No payment method registered.</p>
                @endif
            </div>
            <a href="{{ route('user.payment_method.index') }}?from=confirm" class="text-dark position-absolute bottom-0 end-0 p-2" style="font-size: 1.2rem;">
                <i class="bi bi-pencil-square"></i>
            </a>
        </div>

        <hr class="border-dark">

        {{-- 確定ボタン --}}
        <div class="text-center mt-5">
            <a href="{{ route('cart.thanks') }}" class="btn text-white px-5 py-3 fs-3 mb-3"
            style="background-color: #D96D55; border-radius: 5px; min-width: 300px; font-family: serif; font-weight: bold; text-decoration: none; display: inline-block;">
                Place your order
            </a>
            <br>
            <a href="{{ route('cart.index') }}" class="text-dark text-decoration-none text-muted">
                <i class="bi bi-arrow-left"></i> Back to Cart
            </a>
        </div>
        @endif

    </div>
</div>
@endsection
