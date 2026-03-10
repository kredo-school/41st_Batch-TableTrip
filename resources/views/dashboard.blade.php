@extends('layouts.app')

@section('title', 'Login')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
<div class="dashboard-container">
    <h2 class="welcome-text">Welcome, {{ Auth::user()->first_name }}!</h2>
    
    <div class="dashboard-grid">
        <section class="dashboard-card">
            <h3><i class="fa-regular fa-calendar-check"></i> Reservation</h3>
            <div class="card-content">
                <table class="table-sm">
                    <thead>...</thead>
                    <tbody>...</tbody>
                </table>
                <a href="#" class="view-all">View All</a>
            </div>
        </section>

        <section class="dashboard-card">
            <h3><i class="fa-solid fa-cart-shopping"></i> Cart</h3>
            <div class="card-content">
                <div class="item-grid">
                    </div>
            </div>
        </section>

        <section class="dashboard-card">
            <h3><i class="fa-solid fa-heart"></i> Favorite</h3>
            <div class="card-content">
                <div class="filter-options">
                    <label><input type="radio" name="fav" checked> Restaurants</label>
                    <label><input type="radio" name="fav"> Products</label>
                </div>
                </div>
        </section>

        <section class="dashboard-card">
            <h3><i class="fa-solid fa-bag-shopping"></i> Purchased</h3>
            <div class="card-content">
                </div>
        </section>
    </div>
</div>


@endsection
