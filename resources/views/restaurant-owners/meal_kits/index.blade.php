@extends('layouts.app')

@section('title', 'Meal Kits')

@section('content')
<div class="container my-5">
    <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">

            {{-- Add Button --}}
            <div class="d-flex justify-content-end mb-4">
                <a href="#" class="btn btn-orange px-4 py-2">
                    +Add Meal Kit
                </a>
            </div>

            <div class="row g-3 mb-5">

                <div class="col12 col-lg-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search meal kit">
                    </div>
                </div>

                <div class="col12 col-lg-3">
                    <select class="form-select">
                        <option>Status</option>
                    </select>
                </div>

                <div class="col12 col-lg-3">
                    <select class="form-select">
                        <option>Draft</option>
                    </select>
                </div>

                <div class="col12 col-lg-3">
                    <select class="form-select">
                        <option>All Category</option>
                    </select>
                </div>

            </div>

            {{-- table --}}
            <div class="card rounded-4 shadow-sm border-0 overflow-hidden">
                <div class="card-body p-0">
                    <table class="table align-middle mb-0">
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
                            <tr>
                                <td class="ps-4" style="width: 140px;">
                                    <img src="https://via.placeholder.com/100x75"
                                        alt="Bibimbap"
                                        class="img-fluid rounded-3">
                                </td>
                                <td>Bibimbap</td>
                                <td>$25</td>
                                <td>35</td>
                                <td>
                                    <span class="badge rounded-pill text-bg-success px-3 py-2">
                                        Active
                                    </span>
                                </td>
                                <td>Apr 23,2023</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm border-0" type="button" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Details</a></li>
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Hide</a></li>
                                            <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <img src="https://via.placeholder.com/100x75"
                                        alt="Teriyaki Chicken"
                                        class="img-fluid rounded-3">
                                </td>
                                <td>Teriyaki Chicken</td>
                                <td>$30</td>
                                <td>12</td>
                                <td>
                                    <span class="badge rounded-pill text-bg-secondary px-3 py-2">
                                        Hide
                                    </span>
                                </td>
                                <td>Apr 23,2023</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm border-0" type="button" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="/restaurant-owners/meal-kits/details">Details</a></li>
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Hide</a></li>
                                            <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <img src="https://via.placeholder.com/100x75"
                                        alt="Sushi Roll Set"
                                        class="img-fluid rounded-3">
                                </td>
                                <td>Sushi Roll Set</td>
                                <td>$20</td>
                                <td>0</td>
                                <td>
                                    <span class="badge rounded-pill text-bg-danger px-3 py-2">
                                        Sold Out
                                    </span>
                                </td>
                                <td>Apr 23,2023</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm border-0" type="button" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Details</a></li>
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Hide</a></li>
                                            <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <img src="https://via.placeholder.com/100x75"
                                        alt="Chicken Rice Bowl"
                                        class="img-fluid rounded-3">
                                </td>
                                <td>Chicken Rice Bowl</td>
                                <td>$18</td>
                                <td>2</td>
                                <td>
                                    <span class="badge rounded-pill text-bg-success px-3 py-2">
                                        Active
                                    </span>
                                </td>
                                <td>Apr 23,2023</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm border-0" type="button" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Details</a></li>
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Hide</a></li>
                                            <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <img src="https://via.placeholder.com/100x75"
                                        alt="Chicken Rice Bowl"
                                        class="img-fluid rounded-3">
                                </td>
                                <td>Chicken Rice Bowl</td>
                                <td>$30</td>
                                <td>0</td>
                                <td>
                                    <span class="badge rounded-pill text-bg-danger px-3 py-2">
                                        Sold Out
                                    </span>
                                </td>
                                <td>Apr 23,2023</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm border-0" type="button" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Details</a></li>
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Hide</a></li>
                                            <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center align-items-center py-4">
                        <a href="#" class="text-decoration-none text-muted fs-5 me-4">&lt;</a>
                        <span class="fs-5">1</span>
                        <a href="#" class="text-decoration-none text-muted fs-5 ms-4">&gt;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection