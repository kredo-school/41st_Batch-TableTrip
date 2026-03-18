@extends('admin.layouts.admin') {{-- 親ファイルを指定 --}}

@section('title', 'Products List') {{-- タブに表示されるタイトル --}}

@section('content')
<div class="text-center">
    <h1 class="main-title mb-5 mt-4" style="font-family: 'Playfair Display', serif; font-size: 3.5rem; position: relative; display: inline-block;">
        Products
        <div style="position: absolute; bottom: -10px; left: 10%; width: 80%; height: 2px; background: linear-gradient(to right, transparent, #d1e7dd, transparent);"></div>
    </h1>

    <div class="card border-0 shadow-sm bg-white p-3 mx-auto" style="max-width: 1000px; border-radius: 10px;">
        <table class="table table-hover align-middle text-center mb-0" style="font-size: 0.9rem;">
            <thead class="text-secondary border-bottom">
                <tr>
                    <th class="fw-normal py-3">ID</th>
                    <th class="fw-normal py-3">Product</th>
                    <th class="fw-normal py-3">Restaurant</th>
                    <th class="fw-normal py-3">Prefecture</th>
                    <th class="fw-normal py-3">Allergens</th> 
                    <th class="fw-normal py-3">Status</th>
                    <th class="fw-normal py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-secondary">#{{ $product->id }}</td>
                    <td class="fw-bold">{{ $product->name }}</td>
                    <td>{{ $product->restaurant_name }}</td>
                    <td>{{ $product->location }}</td>
                    <td>
                        <span class="badge bg-light text-dark border-0 px-3 py-2" style="font-weight: normal;">
                            {{ $product->allergens }}
                        </span>
                    </td>
                    <td>
                        <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                            Approved
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-dark btn-sm px-3 py-1" style="font-size: 0.8rem; background-color: #2d3748;">View</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <ul class="pagination pagination-sm border-0">
            <li class="page-item active"><a class="page-link border-0 bg-transparent text-dark fw-bold" href="#">1</a></li>
            <li class="page-item"><a class="page-link border-0 bg-transparent text-secondary" href="#">2</a></li>
            <li class="page-item"><a class="page-link border-0 bg-transparent text-secondary" href="#">3</a></li>
            <li class="page-item"><a class="page-link border-0 bg-transparent text-secondary" href="#">4</a></li>
        </ul>
    </div>
</div>
@endsection