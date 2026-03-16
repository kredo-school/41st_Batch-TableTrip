    
<!--Review reservation Modal -->
<div class="modal fade" id="reservationConfirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"              aria-labelledby="reservationConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="border-bottom:none;">
         <button type="button" class="btn-close justify-content-end" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body mb-4">
        <h5 class="modal-title mb-3 text-center" id="reservationConfirmModalLabel" style="text-decoration: underline; text-underline-offset: 6px; text-decoration-color:#D96B52;">Reservation Details</h5>
        <div class="container px-4 py-3">
            <ul style="font-family: 'Sen', sans-serif;">
                <li class="mb-2" >Date: July 20, 2026</li>
                <li class="mb-2">Time: 19:00</li>
                <li class="mb-2">Guests: 2</li>
                <li class="mb-2">Name: John Smith</li>
                <li class="mb-2">Phone: 090-1234-5678</li>
                <li class="mb-2">Special Requests: Birthday celebration</li>
            </ul>
        </div>
        <div class="container text-center mb-4">
            <button type="button" class="btn btn-outline-orange me-3" data-bs-dismiss="modal">Edit</button>
            <form action="">
            @csrf
             <button type="submit" class="btn btn-orange">Send Request</button>
            </form>
       </div>
     </div>
  </div>
</div>




