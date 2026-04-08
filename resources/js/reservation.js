console.log("JS動いてるよ");

document.addEventListener('DOMContentLoaded', function () {
    const confirmModal = document.getElementById('reservationConfirmModal');
    const reservationForm = document.getElementById('reservationForm');
    const submitReservationBtn = document.getElementById('submitReservationBtn');

    if (confirmModal) {
        confirmModal.addEventListener('show.bs.modal', function () {
            const reservationDate = document.getElementById('reservation_date').value;
            const reservationTime = document.getElementById('reservation_time').value;
            const numberOfPeople = document.getElementById('number_of_people').value;
            const fullName = document.getElementById('full_name').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const specialRequests = document.getElementById('special_requests').value;

            document.getElementById('confirm-date').textContent = reservationDate || '-';
            document.getElementById('confirm-time').textContent = reservationTime || '-';
            document.getElementById('confirm-guests').textContent = numberOfPeople || '-';
            document.getElementById('confirm-name').textContent = fullName || '-';
            document.getElementById('confirm-phone').textContent = phone || '-';
            document.getElementById('confirm-email').textContent = email || '-';
            document.getElementById('confirm-special-requests').textContent = specialRequests || '-';
        });
    }

    if (submitReservationBtn) {
        submitReservationBtn.addEventListener('click', function () {
            reservationForm.submit();
        });
    }
});