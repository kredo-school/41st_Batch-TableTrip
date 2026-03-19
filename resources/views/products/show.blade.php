@extends('layouts.admin') {{-- 親ファイルを指定 --}}

@section('active_products', 'active-menu') {{-- サイドバーを光らせるための設定 --}}

@section('content') {{-- 親の @yield('content') の中に入る部分 --}}
    <h1 class="display-4 my-5" style="font-family: serif;">Products</h1>

    <div class="bg-white shadow-sm rounded p-4">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Restaurant</th>
                    <th>Allergens</th> 
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#{{ $product->id }}</td>
                    <td class="fw-bold">{{ $product->name }}</td>
                    <td>{{ $product->restaurant_name }}</td>
                    <td><span class="badge bg-light text-dark">{{ $product->allergens }}</span></td>
                    <td><span class="badge bg-success bg-opacity-10 text-success">Approved</span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection