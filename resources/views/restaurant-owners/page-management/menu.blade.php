@extends('layouts.owner')

@section('title','Page Management')

@section('content')
<div class="m-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent mb-4">Page Management</h1>
            @include('restaurant-owners.page-management.tabs')
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Menu List</h3>
                <button type="button" class="btn btn-orange"
                    data-bs-toggle="modal" data-bs-target="#addMenuModal">
                    + Add Menu
                </button>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden p-3">
                <div class="table-responsive">
                    <table class="table align-middle mb-3 table-hover">
                        <thead>
                            <tr>
                                <th class="ps-4">Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($menus as $menu)
                                <tr>
                                    <td class="ps-4" style="width: 120px;">
                                        @if($menu->image)
                                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="menu-image rounded">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" alt="No image" class="menu-image rounded">
                                        @endif                                   
                                     </td>
                                    <td>{{ $menu->name }}</td>
                                    <td>${{ $menu->price }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn p-0 border-0 bg-transparent me-3"
                                            data-bs-toggle="modal" data-bs-target="#editMenuModal-{{ $menu->id }}">
                                            <i class="fa-regular fa-pen-to-square fs-4 text-dark"></i>
                                        </button>   
                                        <button type="button" class="btn p-0 border-0 bg-transparent"
                                        data-bs-toggle="modal" data-bs-target="#deleteMenuModal-{{ $menu->id }}">
                                        <i class="fa-regular fa-trash-can fs-4 text-danger"></i>
                                     </button>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $menus->links('layouts.pagination.custom') }}
                </div>
            </div>

        </div>
    </div>
    {{-- modals --}}
    @include('restaurant-owners.page-management.modals.add')
    @foreach ($menus as $menu)
        @include('restaurant-owners.page-management.modals.edit')
        @include('restaurant-owners.page-management.modals.delete')
    @endforeach
</div>    
@endsection