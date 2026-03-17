<!-- Modal -->
<div class="modal fade" id="addReservationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addReservationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center" style="border-bottom:none;">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body pt-3">
          <h1 class="fs-3 text-center mb-5  text-underline-accent" id="addReservationModalLabel">+ Add New Reservation</h1>
            <form action="{{ route('owner.reservations.store') }}" method="post">
                @csrf
            <div class="row g-3">

                {{-- Date --}}
                <div class="col-12 col-md-4">
                    <label class="form-label">
                        <i class="fa-regular fa-calendar me-1"></i>
                        Date
                    </label>
                    <input type="date" class="form-control" name="reservation_date" id="reservation_date">
                        @error('reservation_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                {{-- Time --}}
                <div class="col-12 col-md-4">
                    <label class="form-label">
                        <i class="fa-regular fa-clock me-1"></i>
                        Time
                    </label>
                    <input type="time" class="form-control" name="reservation_time" id="reservation_time">
                        @error('reservation_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                {{-- Guests --}}
                <div class="col-12 col-md-4">
                    <label class="form-label" >
                        <i class="fa-solid fa-users me-1"></i>
                        <span style="font-size: 0.75rem;">Number of Guests</span>
                    </label>
                    <input type="number" class="form-control" name="number_of_people" id="number_of_people"> 
                        @error('number_of_people')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                {{-- Name --}}
                <div class="col-12">
                    <label class="form-label">
                        <i class="fa-regular fa-user me-1"></i>
                        Full Name
                    </label>
                    <input type="text" class="form-control" name="full_name" id="full_name">
                      @error('full_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                     @enderror
                </div>

                {{-- Phone --}}
                <div class="col-12">
                    <label class="form-label">
                        <i class="fa-solid fa-phone me-1"></i>
                        Phone Number
                    </label>
                    <input type="text" class="form-control" name="phone" id="phone">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                {{-- Email --}}
                <div class="col-12">
                    <label class="form-label">
                        <i class="fa-regular fa-envelope me-1"></i>
                        Email Address
                    </label>
                    <input type="email" class="form-control" name="email" id="email">
                       @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                {{-- Requests --}}
                <div class="col-12">
                    <label class="form-label">
                        <i class="fa-regular fa-comment me-1"></i>
                        Special Requests
                    </label>
                    <textarea class="form-control" rows="4" name="special_request" id="special_request"></textarea>
                       @error('special_request')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                       @enderror
                </div>

                {{-- Status --}}
                <div class="col-12 col-md-4">
                    <label class="form-label">
                        <i class="fa-solid fa-circle-info me-1"></i>
                        Status
                    </label>
                    <select class="form-select" name="status" id="status">
                        <option value="confirmed">Confirmed</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled" >Cancelled</option>
                        <option value="no-show">No-show</option>
                    </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
            </div>
        </div>
      <div class="modal-footer border-top-0">
        <button type="button" class="btn btn-outline-orange" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-orange">Add Reservation</button>
      </div>
      </form>
    </div>
  </div>
</div>
