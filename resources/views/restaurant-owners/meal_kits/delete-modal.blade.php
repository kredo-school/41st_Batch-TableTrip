<!-- Delete Reservation Modal -->
<div class="modal fade" id="deleteMealKitModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deleteMealKitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <button type="button" class="btn-close justify-content-end" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body mb-4 text-center">
                <h3 class="modal-title mb-4" id="deleteMealKitModalLabel"
                    style="text-decoration: underline; text-underline-offset: 6px; text-decoration-color:#D96B52;">
                    Delete Meal Kit?
                </h3>

                <div class="container px-4 py-2" style="font-family: 'Sen', sans-serif;">
                    <p class="mb-4">
                        Are you sure you want to delete this meal kit?<br>
                        This action cannot be undone.
                    </p>

                       <div class="mb-5">
                           <img src="{{ asset('images/journykit.png') }}" alt="Journey Kit" class="img-fluid w-75 mx-auto">

                           <div class="d-flex justify-content-between w-75 mx-auto">
                            <h5>Journey Kit</h5>
                            <h5>$20.5</h5>
                           </div>
                        </div>
                  

                    <div class="text-center">
                        <button type="button" class="btn btn-outline-navy me-3" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <form action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-orange">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>