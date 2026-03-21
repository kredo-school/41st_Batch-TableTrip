@extends('layouts.app')

@section('title', 'Reservation Details')

@section('content')
<div class="my-5 mx-5">
    <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">
            <div class="row mb-3">
                <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 text-muted">
                    <p class="mb-0">Order / Order {{ $order->id }}</p>
                    <a href="{{ route('owner.orders') }}" class="text-decoration-none">| Back to Orders</a>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col">
                    <h1 class="text-underline-accent text-center">Order Details</h1>
                </div>
            </div>

            <div class="row bg-white rounded border-1 p-3 mb-4 font-sen">
                <div class="col">
                    <div class="row mb-4 border-bottom p-2">
                        <div class="col d-flex justify-content-between align-items-center">
                            <h2>Order Summary </h2>
                            <p class="text-muted">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col justify-items-center border-end p-2">
                            <h5 class="mb-3 text-underline-accent">Customer Info</h5>
                            <ul class="text-start">
                                <li class="mb-2"><i class="fa-regular fa-user"></i> {{ $order->user->last_name }} {{ $order->user->first_name }}</li>
                                <li class="mb-2"><i class="fa-regular fa-envelope"></i> {{ $order->user->email }}</li>
                                <li class="mb-2"><i class="fa-solid fa-phone"></i> {{ $order->user->tel }}</li>
                            </ul>
                        </div>
                        <div class="col text-center border-end p-2">
                            <h5 class="mb-3 text-underline-accent">Shipping Address</h5>
                            {{-- Shipping address に変える --}}
                            <p>{{ $order->user->address }}</p>
                        </div>
                        <div class="col text-center p-2">
                            <h5 class="mb-3 text-underline-accent">Payment Info</h5>

                            <p class="border border-2 rounded mb-2 w-75 mx-auto py-1 px-2 d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fa-regular fa-credit-card me-1"></i>
                                    <i class="fa-brands fa-cc-jcb"></i>
                                </span>
                                <span>*******2345</span>
                            </p>

                            <h5 class="mt-2">Total: $45.32</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg-white border rounded overflow-hidden p-3 font-sen">

                {{-- Left: Order --}}
                <div class="col-8 p-0 border-end">
                    <div class="px-3 py-2 border-bottom">
                        <h2 class="h4 mb-0">Order</h2>
                    </div>

                    <div class="p-3">
                        <table class="table align-middle mb-3">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0 fw-medium">Item Name</th>
                                    <th scope="col" class="border-0 fw-medium text-center">Quantity</th>
                                    <th scope="col" class="border-0 fw-medium text-end">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-0" style="width: 90px;">
                                        <img src="{{ asset('images/journykit.png') }}" alt="Journey Kit" class="img-fluid rounded" style="max-width: 72px;">
                                    </td>
                                    <td class="border-0">Bibimbap</td>
                                    <td class="border-0 text-center">1</td>
                                    <td class="border-0 text-end">$25.12</td>
                                </tr>

                                <tr>
                                    <td class="border-0" style="width: 90px;">
                                        <img src="{{ asset('images/journykit.png') }}" alt="Chicken Rice Bowl" class="img-fluid rounded" style="max-width: 72px;">
                                    </td>
                                    <td class="border-0">Chicken Rice Bowl</td>
                                    <td class="border-0 text-center">1</td>
                                    <td class="border-0 text-end">$18.20</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td class="py-2">Subtotal:</td>
                                    <td class="py-2 text-end">$43.32</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Shipping Fee</td>
                                    <td class="py-2 text-end">$0</td>
                                </tr>
                                <tr>
                                    <td class="py-2 fw-semibold">Total:</td>
                                    <td class="py-2 text-end fw-semibold">$43.32</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Right: Order Status --}}
                <div class="col-4 p-0">
                    <div class="px-3 py-2 border-bottom">
                        <h2 class="h4 mb-0">Order Status</h2>
                    </div>

                    <div class="p-3 mt-3">
                        <form action="{{ route('owner.orders.update', $order->id) }}" method="post">
                            @csrf
                            @method('patch')
                        <div class="my-3">
                        <select class="form-select rounded @error('status') is-invalid @enderror" name="status" id="status_{{ $order->id }}">
                            <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="preparing" {{ old('status', $order->status) == 'preparing' ? 'selected' : '' }}>Preparing</option>
                            <option value="shipping" {{ old('status', $order->status) == 'shipping' ? 'selected' : '' }}>Shipping</option>
                            <option value="delivered" {{ old('status',$order->status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                            @error('status')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-navy mb-5">
                                Update Status
                            </button>
                        </form>

                            <a href="{{ route('owner.orders') }}" class="btn btn-outline-navy mt-5">
                                Back
                            </a>
                        </div>
                    </div>
                </div>

            </div>
           
        </div>
    </div>
</div>

@include('restaurant-owners.orders.modals.cancel')
@endsection