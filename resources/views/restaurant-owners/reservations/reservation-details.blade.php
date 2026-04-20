@extends('layouts.owner')

@section('title', 'Reservation Details')

@section('content')
<div class="my-5 mx-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
      
        <div class="col-12 col-lg-9">
            <div class="row mb-3">
                <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 text-muted">
                    <p class="mb-0">Reservation / Reservation {{ $reservation->id }}</p>
                    <a href="{{ route('owner.reservations') }}" class="text-decoration-none">| Back to Reservations</a>
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
                                    <h2 class="mb-0">{{ $reservation->full_name }}</h2>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="row g-3">
                                        <div class="col-12 col-sm-4">
                                            <p class="text-muted mb-1">
                                                <i class="fa-regular fa-calendar me-1"></i>Date
                                            </p>
                                            <p class="mb-0 text-center">{{ $reservation->reservation_date->format('M d, Y') }}</p>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <p class="text-muted mb-1">
                                                <i class="fa-regular fa-clock me-1"></i>Time
                                            </p>
                                            <p class="mb-0 text-center">{{ $reservation->reservation_time->format('H:i')  }}</p>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <p class="text-muted mb-1">
                                                <i class="fa-solid fa-user-group me-1"></i>Guests
                                            </p>
                                            <p class="mb-0 text-center">{{ $reservation->number_of_people }}</p>
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
                                      <p class="mb-0">{{ $reservation->email }}</p>
                                </div>

                                <div class="col-12 col-md-6">
                                    <p class="text-muted mb-1">
                                        <i class="fa-solid fa-phone me-1"></i>Phone
                                    </p>
                                    
                                     <p class="mb-0">{{ $reservation->phone }}</p>
                                </div>

                                <div class="col-12 col-md-6">
                                    <p class="text-muted mb-1">
                                        <i class="fa-regular fa-comment me-1"></i>Special Requests
                                    </p>
                                      <p class="mb-0">{{ $reservation->special_requests }}</p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label text-muted mb-1"><i class="fa-regular fa-circle-check"></i>Status</label>
                                    <div class="row">
                                       <form action="{{ route('owner.reservations.update',$reservation->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <div class="col">
                                               <select class="form-select @error('status') is-invalid @enderror rounded mb-2 text-white border-0 px-2 py-0" style="background-color: #9FC6BC" name="status" id="status_{{ $reservation->id }}">
                                                    <option value="confirmed" {{ old('status', $reservation->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                    <option value="pending" {{ old('status', $reservation->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="visited" {{ old('status', $reservation->status) == 'visited' ? 'selected' : '' }}>Visited</option>
                                                    <option value="cancelled" {{ old('status', $reservation->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                    <option value="no-show" {{ old('status', $reservation->status) == 'no-show' ? 'selected' : '' }}>No-show</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-sm btn-outline-navy w-100 px-2 py-0">
                                                Update Status
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                       

                        {{-- footer --}}
                        <div class="card-footer border-top-0 bg-white pt-4 text-center ">
                            <a href="{{ route('owner.reservations') }}"  class="btn btn-sm btn-outline-orange me-3">
                                Back
                            </a>

                            <button type="button"
                                class="btn btn-sm btn-orange ms-3"
                                data-bs-toggle="modal"
                                data-bs-target="#editReservationModal-{{ $reservation->id }}">
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
@endsection