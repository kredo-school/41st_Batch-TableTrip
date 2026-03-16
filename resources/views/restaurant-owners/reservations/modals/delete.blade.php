<!-- Delete Reservation Modal -->
<div class="modal fade" id="deleteReservationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deleteReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <button type="button" class="btn-close justify-content-end" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body mb-4 text-center">
                <h3 class="modal-title mb-4" id="deleteReservationModalLabel"
                    style="text-decoration: underline; text-underline-offset: 6px; text-decoration-color:#D96B52;">
                    Cancel Reservation
                </h3>

                <div class="container px-4 py-2" style="font-family: 'Sen', sans-serif;">
                    <p class="mb-4">
                        Are you sure you want to cancel this reservation?
                    </p>

                    <ul class="text-start d-inline-block mb-4">
                        <li class="mb-2">Date: July 20, 2026</li>
                        <li class="mb-2">Time: 19:00</li>
                        <li class="mb-2">Guests: 2</li>
                        <li class="mb-2">Name: John Smith</li>
                    </ul>

                    <div class="text-center">
                        <button type="button" class="btn btn-outline-orange me-3" data-bs-dismiss="modal">
                            Back
                        </button>

                        <form action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-orange">
                                Yes, Cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>