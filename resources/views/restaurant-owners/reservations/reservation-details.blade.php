@extends('layouts.app')

@section('title', 'Reservation Details')

@section('content')
<div class="container my-5 mx-auto">
    <div class="row">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">
            <div class="row mb-3">
                <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 text-muted">
                    <p class="mb-0">Reservation / Reservation #1234</p>
                    <a href="#" class="text-decoration-none">| Back to Reservations</a>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col">
                    <h1 class="text-underline-accent text-center">Reservation Details</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 mx-auto w-100 w-lg-75 p-4 p-md-5 reservation-details-card">

                        {{-- top --}}
                        <div class="card-header bg-white border-bottom-0 pb-3">
                            <div class="row g-3 align-items-start">
                                <div class="col-12 col-md-6">
                                    <p class="text-muted mb-1">Name</p>
                                    <h2 class="mb-0">John Doe</h2>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="row g-3">
                                        <div class="col-12 col-sm-4">
                                            <p class="text-muted mb-1">
                                                <i class="fa-regular fa-calendar me-1"></i>Date
                                            </p>
                                            <p class="mb-0">2024-05-15</p>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <p class="text-muted mb-1">
                                                <i class="fa-regular fa-clock me-1"></i>Time
                                            </p>
                                            <p class="mb-0">7:00 PM</p>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <p class="text-muted mb-1">
                                                <i class="fa-solid fa-user-group me-1"></i>Guests
                                            </p>
                                            <p class="mb-0">4</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- body --}}
                        <div class="card-body pt-2 mb-2">
                            <div class="row gy-3">
                                
                                <div class="col-12 col-md-6">
                                    <p class="text-muted mb-1">
                                        <i class="fa-regular fa-envelope me-1"></i>Email
                                    </p>
                                    <p class="mb-0">john.doe@example.com</p>
                                </div>

                                <div class="col-12 col-md-6">
                                    <p class="text-muted mb-1">
                                        <i class="fa-solid fa-phone me-1"></i>Phone
                                    </p>
                                    <p class="mb-0">(123) 456-7890</p>
                                </div>

                                <div class="col-12 col-md-6">
                                    <p class="text-muted mb-1">
                                        <i class="fa-regular fa-comment me-1"></i>Special Requests
                                    </p>
                                    <p class="mb-0">Window seat, if possible</p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label text-muted mb-1"><i class="fa-regular fa-circle-check"></i>Status</label>
                                    <div class="row">
                                        <div class="col">
                                             <select class="form-select rounded mb-2 text-white border-0 px-2 py-0" style="background-color: #9FC6BC">
                                                <option>Confirmed</option>
                                                <option>Pending</option>
                                                <option>Completed</option>
                                                <option>Cancelled</option>
                                                <option>No-show</option>
                                             </select>
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-sm btn-outline-navy w-100 px-2 py-0">
                                                Update Status
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        {{-- footer --}}
                        <div class="card-footer border-top-0 bg-white pt-4 text-center ">
                            <button type="button" class="btn btn-sm btn-outline-orange me-3" data-bs-toggle="modal"
                                data-bs-target="#deleteReservationModal">
                                Cancel Reservation
                            </button>

                            <button type="button"
                                class="btn btn-sm btn-orange ms-3"
                                data-bs-toggle="modal"
                                data-bs-target="#editReservationModal">
                                Edit Reservation
                            </button>
                                  
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('restaurant-owners.reservations.modals.edit')
@include('restaurant-owners.reservations.modals.delete')
@endsection