

<!-- Modal -->
<div class="modal fade" id="deleteReservationModal" tabindex="-1" aria-labelledby="delete-reservationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <h1 class="modal-title fs-3 text-underline-accent text-center mb-3" id="deleteReservationModalLabel">Delete Reservation</h1>
            <p class="text-center mb-3" style="font-family: 'Sen',sans-serif;">
                Are you sure you want to delete this reservation? <br>
                This action cannot be undone.
            </p>
             <div class="w-50 mx-auto" style="font-family: 'Sen',sans-serif;">
                <ul>
                    <li class="mb-3">Name: <span class="fw-bold">John Doe</span></li>
                    <li class="mb-3">Date: Mar 3, 2026</li>
                    <li class="mb-3">Time: 17:00</li>
                    <li class="mb-3">Guests: 4</li>
                </ul>
             </div>
      </div>
      <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button type="button" class="btn btn-outline-orange" data-bs-dismiss="modal">Close</button>
        <form action="">
         @csrf
            <button type="submit" class="btn btn-orange">Delete</button>
        </form>
        
      </div>
    </div>
  </div>
</div>