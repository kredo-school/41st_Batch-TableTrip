@extends('admin.layouts.admin')

@section('title','Products')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Products</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="orders-table-wrapper">
            <table class="table table-sm align-middle orders-table text-center">
                <thead>
                    <tr>
                        <th><span class="th-label">ID</span></th>
                        <th><span class="th-label">Product</span></th>
                        <th><span class="th-label">Restaurant</span></th>
                        <th><span class="th-label">Price</span></th>
                        <th><span class="th-label">Stock</span></th>
                        <th><span class="th-label">Status</span></th>
                        <th><span class="th-label">Date</span></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr onclick="window.location='{{ route('admin.products.show',$product->id) }}'">
                        <td>#{{ $product->id }}</td>

                        <td>{{ $product->name }}</td>

                        <td>{{ $product->restaurant_name }}</td>

                        <td>¥{{ number_format($product->price) }}</td>

                        <td>{{ $product->stock }}</td>

                        <td>
                            <span class="order-status {{ $product->is_visible ? 'delivered' : 'refunded' }}">
                                {{ $product->is_visible ? 'Visible' : 'Hidden' }}
                            </span>
                        </td>

                        <td>{{ $product->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@if ($products->hasPages())
    <ul class="pagination justify-content-center mt-4">
        @for ($i = 1; $i <= $products->lastPage(); $i++)
            <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $products->url($i) }}">
                    {{ $i }}
                </a>
            </li>
        @endfor
    </ul>
@endif

<div class="text-center mt-3">
    <a href="{{ route('admin.dashboard') }}" class="admin-home-link">
        Home
    </a>
</div>

@endsection