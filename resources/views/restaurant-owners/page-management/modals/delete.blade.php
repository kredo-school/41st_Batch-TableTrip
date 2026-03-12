<!-- Delete Menu Modal -->
<div class="modal fade"
     id="deleteMenuModal"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     aria-labelledby="deleteMenuModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3">

            <div class="modal-header border-0 pb-0">
                <button type="button"
                        class="btn-close ms-auto"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <div class="modal-body text-center px-4 pb-4 pt-2">

                <h3 class="mb-3"
                    id="deleteMenuModalLabel"
                    style="text-decoration: underline; text-underline-offset: 6px; text-decoration-color:#D96B52;">
                    Delete Menu
                </h3>

                <p class="small mb-4">
                    Are you sure you want to delete this menu?<br>
                    This action cannot be undone.
                </p>

                {{-- menu preview --}}
                <div class="mb-4">

                    <img
                        src="{{ asset('images/menu3.png') }}"
                        alt="Assorted Sushi Plate"
                        class="img-fluid rounded mb-2"
                        style="width:120px;height:120px;object-fit:cover;">

                    <p class="mb-0">Assorted Sushi Plate</p>
                    <small class="text-muted">$5</small>

                </div>

                <div class="d-flex justify-content-center gap-3">

                    <button
                        type="button"
                        class="btn btn-outline-navy px-4"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-orange px-4">
                            Delete
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>

</div>