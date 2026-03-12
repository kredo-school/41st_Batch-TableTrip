@extends('layouts.app')

@section('title', 'Reservation Details')

@section('content')
<div class="container my-5 mx-auto">
    <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">
            <div class="row mb-3">
                <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 text-muted">
                    <p class="mb-0">Order / Order #1234</p>
                    <a href="#" class="text-decoration-none">| Back to Orders</a>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col">
                    <h1 class="text-underline-accent text-center">Order Details</h1>
                </div>
            </div>

            <div class="row bg-white rounded border-1 p-3 mb-4" style="font-family: 'Sen','sans-serif';">
                <div class="col">
                    <div class="row mb-4 border-bottom p-2">
                        <div class="col d-flex justify-content-between align-items-center">
                            <h2>Order Summary </h2>
                            <p class="text-muted">Apr 23,2025, 10:22AM</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center border-end p-2">
                            <h5 class="mb-3">Customer Info</h5>
                            <ul>
                                <li>Yuta Nakamura</li>
                                <li>yuta.n@email.com</li>
                                <li>090-1234-5678</li>
                            </ul>
                        </div>
                        <div class="col text-center border-end p-2">
                            <h5 class="mb-3">Shipping Address</h5>
                            <p>123 Maple Street, Apt 4B
                               San Francisco, CA 94103
                               United States</p>
                        </div>
                        <div class="col text-center p-2">
                            <h5 class="mb-3">Payment Info</h5>

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
            <div class="row bg-white border rounded overflow-hidden p-3" style="font-family: 'Sen','sans-serif';">

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

                    <div class="p-3">
                        <div class="mb-3">
                            <select class="form-select rounded">
                                <option selected>Pending</option>
                                <option>Preparing</option>
                                <option>Shipping</option>
                                <option>Delivered</option>
                                <option>Cancelled</option>
                            </select>
                        </div>

                        <div class="d-grid gap-3 ">
                            <button class="btn btn-navy mb-5">
                                Update Status
                            </button>

                            <button 
                                class="btn btn-outline-orange"
                                data-bs-toggle="modal"
                                data-bs-target="#cancelOrderModal">
                                Cancel Order
                            </button>
                        </div>
                    </div>
                </div>

            </div>
           
        </div>
    </div>
</div>

@include('restaurant-owners.orders.modals.cancel')
@endsection