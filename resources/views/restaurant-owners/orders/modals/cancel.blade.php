<!-- Cancel Order Modal -->
<div class="modal fade" id="cancelOrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="cancelOrderModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header" style="border-bottom:none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center mb-4">

                <h3 class="modal-title mb-4"
                    id="cancelOrderModalLabel"
                    style="text-decoration: underline; text-underline-offset: 6px; text-decoration-color:#D96B52;">
                    Cancel Order
                </h3>

                <p class="mb-4" style="font-family: 'Sen', sans-serif;">
                    Are you sure you want to cancel this order?
                </p>

                <div class="d-flex justify-content-center gap-3">

                    <button
                        type="button"
                        class="btn btn-outline-orange"
                        data-bs-dismiss="modal">
                        Back
                    </button>

                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-orange">
                            Yes, Cancel
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>