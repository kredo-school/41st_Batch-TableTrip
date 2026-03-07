@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto my-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
       
        <div class="col-9">
            {{-- Stat Card --}}
            <div class="row g-3 mb-3">
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card stat-card position-relative">
                        <div class="card-body">
                            <i class="fa-regular fa-calendar stat-icon"></i>
                            <h5 class="card-title">Today's Reservations</h5>
                            <h2 class="text-center">3</h2>
                       </div>
                   </div>
                </div>
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card stat-card position-relative">
                        <div class="card-body">
                            <i class="fa-solid fa-clipboard-list stat-icon"></i>
                            <h5 class="card-title">Pending <br> Orders</h5>
                            <h2 class="text-center">3</h2>
                       </div>
                   </div>
                </div>
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card stat-card position-relative">
                        <div class="card-body">
                           <i class="fa-regular fa-bell stat-icon"></i>
                            <h5 class="card-title">Unread Notifications</h5>
                            <h2 class="text-center">3</h2>
                       </div>
                   </div>
                </div>
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card stat-card position-relative">
                        <div class="card-body">
                           <i class="fa-regular fa-calendar-plus stat-icon"></i>
                            <h5 class="card-title">New <br> Reservations</h5>
                            <h2 class="text-center">3</h2>
                       </div>
                   </div>
                </div>
            </div>

            {{-- Information cards --}}
            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-6">
                    <div class="card info-card">
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title text-center my-3">Upcoming Reservations</h3>
                            <div class="table-wrap mx-auto mb-3">
                                <table class="table table-borderless align-middle table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Guests</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>19:00</td>
                                            <td class="ps-4">4</td>
                                            <td>John Smith</td>
                                        </tr>
                                        <tr>
                                            <td>19:00</td>
                                            <td class="ps-4">4</td>
                                            <td>John Smith</td>
                                        </tr>
                                        <tr>
                                            <td>19:00</td>
                                            <td class="ps-4">4</td>
                                            <td>John Smith</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="" class="ms-auto pe-3 text-dark text-decoration-underline">View all</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card info-card">
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title text-center my-3">Latest Orders</h3>
                             <div class="table-wrap mb-3">
                                <table class="table table-borderless align-middle table-hover table-sm ">
                                    <thead class="table-middle text-muted">
                                        <tr>
                                            <th>Order _id</th>
                                            <th>ordered at</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#1234</td>
                                            <td>Mar 7 11:30</td>
                                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>#1235</td>
                                            <td>Mar 7 12:00</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>#1236</td>
                                            <td>Mar 7 12:30</td>
                                            <td><span class="badge bg-danger">Cancelled</span></td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="" class="ms-auto pe-3 text-dark text-decoration-underline">View all</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-2">This Week Revenue </h3>
                             <p class="fs-3 text-center" style="font-family: 'Sen',sans-serif;">$12,800 <span class="text-danger ps-3">+12%</span> from last week</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Top Selling</h3>
                             <p class="fs-3 text-center" style="font-family: 'Sen',sans-serif;">Teriyaki Chicken <span class="text-danger ps-3">32</span>orders</p>
                        </div>
                    </div>
                </div>
            </div>
           
    </div>

</div>
@endsection