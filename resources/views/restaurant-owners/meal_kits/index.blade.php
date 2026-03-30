@extends('layouts.owner')

@section('title', 'Meal Kits')

@section('content')
<div class="m-5">
    <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">

            {{-- Add Button --}}
            <div class="d-flex justify-content-end mb-4">
                <a href="#" class="btn btn-orange px-4 py-2">
                    +Add Meal Kit
                </a>
            </div>
          <form action="{{ route('owner.products') }}" method="get">
            <div class="row g-3 mb-5">
                <div class="col-12 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search meal kit">
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <select name="status" class="form-select  rounded" onchange="this.form.submit()">
                        <option value="">All Status</option>
                         <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="low_stock" {{ request('status') == 'low-stock' ? 'selected' : '' }}>Low Stock</option>
                        <option value="sold_out" {{ request('status') == 'sold-out' ? 'selected' : '' }}>Sold Out</option>
                        <option value="hide" {{ request('status') == 'hide' ? 'selected' : '' }}>Hide</option>
                    </select>
                </div>

                <div class="col-12 col-lg-3">
                    <select name="category_id" class="form-select  rounded" onchange="this.form.submit()">
                        <option value="">All Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-lg-2">
                    <a href="{{ route('owner.products') }}" class="btn btn-outline-navy">Reset</a>
                </div>

            </div>
         </form>

            {{-- table --}}
            <div class="card rounded-4 shadow-sm border-0 overflow-hidden">
                <div class="card-body p-0">
                    <table class="table align-middle mb-0 mx-3 text-center">
                        <thead>
                            <tr class="border-bottom">
                                <th class="ps-4 py-4">IMAGE</th>
                                <th class="py-4"></th>
                                <th class="py-4">PRICE</th>
                                <th class="py-4">STOCK</th>
                                <th class="py-4">STATUS</th>
                                <th class="py-4">UPDATED</th>
                                <th class="py-4 text-center"></th>
                            </tr>
                        </thead>

                        <tbody>
                        
                         @forelse ($products as $product)
                             
                            <tr>
                                <td class="ps-4" style="width: 140px;">
                                    <img src="{{ asset('/images/journykit.png') }}"
                                        alt="Bibimbap"
                                        class="img-fluid rounded-3">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>

                                 @php
                                    $status = match (true) {
                                        !$product->is_visible => 'Hide',
                                        $product->stock == 0 => 'Sold Out',
                                        $product->stock <= 5 => 'Low Stock',
                                        default => 'Active',
                                    };

                                    $statusClass = match ($status) {
                                        'Active' => 'bg-success',
                                        'Low Stock' => 'bg-warning text-dark',
                                        'Sold Out' => 'bg-danger',
                                        'Hide' => 'bg-secondary',
                                    };
                                @endphp

                               <td>
                                <span class="badge rounded-pill {{ $statusClass }}">
                                    {{ $status }}
                                </span>
                               </td>
                                <td>{{ $product->updated_at }}</td>

                                <td class="text-center">
                                    <a href="" class="btn"><i class="fa-regular fa-pen-to-square text-navy"></i>Edit</a>
                                   
                                    <form action="{{ route('owner.products.toggleVisibility', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')

                                        @if ($product->is_visible)
                                            <button class="btn">
                                                <i class="fa-regular fa-eye-slash text-secondary"></i> Hide
                                            </button>
                                        @else
                                            <button class="btn">
                                                <i class="fa-regular fa-eye"></i> Unhide
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>

                             @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        No products found.
                                    </td>
                                </tr>
                         @endforelse
                        </tbody>
                    </table>
                    {{ $products->links('layouts.pagination.custom') }}


                    <div class="d-flex justify-content-center align-items-center py-4">
                        <a href="#" class="text-decoration-none text-muted fs-5 me-4">&lt;</a>
                        <span class="fs-5">1</span>
                        <a href="#" class="text-decoration-none text-muted fs-5 ms-4">&gt;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('restaurant-owners.meal_kits.delete-modal')
</div>
@endsection