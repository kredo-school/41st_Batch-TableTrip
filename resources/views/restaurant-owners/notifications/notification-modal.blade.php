<!-- Notification Detail Modal -->
<div class="modal fade"
     id="notificationModal"
     tabindex="-1"
     aria-labelledby="notificationModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">

            <!-- header -->
            <div class="modal-header border-bottom">
                <h5 class="modal-title d-flex align-items-center gap-2" id="notificationModalLabel">

                    <i class="fa-regular fa-calendar"></i>
                    [Reservation] Special request received

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>


            <!-- body -->
            <div class="modal-body px-4 py-4" style="font-family: 'Sen','sens-serif'">

                <p class="mb-3">
                    Dear Restaurant Owner,
                </p>

                <p>
                    You have received a new reservation for Feb 25th at 19:00.
                </p>

                <p>
                    The customer has informed us of a peanut allergy and requested a nut-free meal option.
                </p>

                <p>
                    Please review the request carefully and ensure that appropriate measures are taken in the kitchen to avoid cross-contamination.
                </p>

                <p>
                    Kindly confirm the reservation details at your earliest convenience.
                </p>

                <div class="text-end text-muted small mt-3">
                    2 hours ago
                </div>

            </div>


            <!-- footer -->
            <div class="modal-footer border-0 justify-content-center pb-4">

                <button type="button"
                        class="btn btn-outline-orange px-4"
                        data-bs-dismiss="modal">

                    Close

                </button>

            </div>

        </div>
    </div>
</div>