    
<!--Review reservation Modal -->
<div class="modal fade" id="reservationConfirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"              aria-labelledby="reservationConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="border-bottom:none;">
         <button type="button" class="btn-close justify-content-end" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body mb-4">
        <h5 class="modal-title mb-3 text-center" id="reservationConfirmModalLabel text-underline-accent">Reservation Details</h5>
        <div class="container px-4 py-3">
            <ul class="font-sen">
              <li class="mb-2">Date: <span id="confirm-date"></span></li>
              <li class="mb-2">Time: <span id="confirm-time"></span></li>
              <li class="mb-2">Guests: <span id="confirm-guests"></span></li>
              <li class="mb-2">Name: <span id="confirm-name"></span></li>
              <li class="mb-2">Phone: <span id="confirm-phone"></span></li>
              <li class="mb-2">Email: <span id="confirm-email"></span></li>
              <li class="mb-2">Special Requests: <span id="confirm-special-requests"></span></li>
          </ul>
        </div>
        <div class="container text-center mb-4">
            <button type="button" class="btn btn-outline-orange me-3" data-bs-dismiss="modal">Back</button>
          
             <button type="button" id="submitReservationBtn"  class="btn btn-orange">Send Request</button>
          
       </div>
     </div>
  </div>
</div>




