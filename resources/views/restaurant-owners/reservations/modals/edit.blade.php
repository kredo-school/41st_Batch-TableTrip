<!-- Edit Reservation Modal -->
<div class="modal fade" id="editReservationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                    <form action="" method="POST" style="font-family: 'Sen', sans-serif;">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="reservation_date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="reservation_date" name="date"
                                value="">
                        </div>

                        <div class="mb-3">
                            <label for="reservation_time" class="form-label">Time</label>
                            <input type="time" class="form-control" id="reservation_time" name="time"
                                value="">
                        </div>

                        <div class="mb-3">
                            <label for="reservation_guests" class="form-label">Guests</label>
                            <input type="number" class="form-control" id="reservation_guests" name="guests"
                                min="1" value="">
                        </div>

                        <div class="mb-3">
                            <label for="reservation_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="reservation_name" name="name"
                                value="">
                        </div>

                        <div class="mb-3">
                            <label for="reservation_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="reservation_phone" name="phone"
                                value="">
                        </div>

                        <div class="mb-4">
                            <label for="reservation_requests" class="form-label">Special Requests</label>
                            <textarea class="form-control" id="reservation_requests" name="special_requests" rows="3"></textarea>
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