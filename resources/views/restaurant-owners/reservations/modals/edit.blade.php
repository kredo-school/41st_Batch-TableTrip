<!-- Edit Reservation Modal -->
<div class="modal fade" id="editReservationModal-{{ $reservation->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <button type="button" class="btn-close justify-content-end" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body mb-4">
                <h3 class="modal-title mb-4 text-center" id="editReservationModalLabel"
                    style="text-decoration: underline; text-underline-offset: 6px; text-decoration-color:#D96B52;">
                    Edit Reservation
                </h3>

                <div class="container px-4 py-2">
                    <form action="{{ route('owner.reservations.update',['id' => $reservation->id]) }}" method="post" style="font-family: 'Sen', sans-serif;">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="reservation_date" class="form-label">Date</label>
                            <input type="date" class="form-control @error('reservation_date') is-invalid @enderror" id="reservation_date_{{ $reservation->id }}" name="reservation_date"
                                value="{{ old('reservation_date',  \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d')) }}">
                                 @error('reservation_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="reservation_time" class="form-label">Time</label>
                            <input type="time" class="form-control @error('reservation_time') is-invalid @enderror" id="reservation_time_{{ $reservation->id }}" name="reservation_time"
                                value="{{ old('reservation_time',$reservation->reservation_time->format('H:i'))}}">
                                 @error('reservation_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="reservation_guests" class="form-label">Guests</label>
                            <input type="number" class="form-control @error('number_of_people') is-invalid @enderror" id="reservation_guests_{{ $reservation->id }}" name="number_of_people"
                                min="1" value="{{ old('number_of_people', $reservation->number_of_people) }}">
                                 @error('number_of_people')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="reservation_name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="reservation_name_{{ $reservation->id }}" name="full_name"
                                value="{{ old('full_name',$reservation->full_name)}}">
                                 @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="reservation_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="reservation_phone_{{ $reservation->id }}" name="phone"
                                value="{{ old('phone',$reservation->phone) }}">
                                 @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                         {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fa-regular fa-envelope me-1"></i>
                                Email Address
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email_{{ $reservation->id }}" value="{{ old('email',$reservation->email) }}">
                              @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-4">
                            <label for="reservation_requests" class="form-label">Special Requests</label>
                            <textarea class="form-control @error('special_request') is-invalid @enderror" id="reservation_requests_{{ $reservation->id }}" name="special_requests" rows="3">{{ old('special_requests',$reservation->special_requests) }}</textarea>
                             @error('special_requests')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                         {{-- Status --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fa-solid fa-circle-info me-1"></i>
                                Status
                            </label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status_{{ $reservation->id }}">
                                <option value="confirmed" {{ old('status', $reservation->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="pending" {{ old('status', $reservation->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ old('status', $reservation->status) == 'visited' ? 'selected' : '' }}>Visited</option>
                                <option value="cancelled" {{ old('status', $reservation->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="no-show" {{ old('status', $reservation->status) == 'no-show' ? 'selected' : '' }}>No-show</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-outline-navy me-3" data-bs-dismiss="modal">
                                Back
                            </button>
                            <button type="submit" class="btn btn-navy">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>