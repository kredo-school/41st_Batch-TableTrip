document.addEventListener('DOMContentLoaded', function() {
    const paymentForm = document.getElementById('payment-form');
    const deleteButtons = document.querySelectorAll('.btn-delete-card');

    // delete alart
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this payment?')) {
                e.preventDefault();
            }
        });
    });

    if (paymentForm) {
        paymentForm.addEventListener('submit', function(e) {
            console.log("Saving payment method...");
        });
    }

    // default setting
    const defaultBadges = document.querySelectorAll('.badge-default');
    defaultBadges.forEach(badge => {
        badge.style.cursor = 'pointer';
    });
});