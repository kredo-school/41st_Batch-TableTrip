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
    document.querySelector('input[name="card_number"]').addEventListener('input', function (e) {
    this.value = this.value.replace(/\D/g, '').substring(0, 16);
});

document.querySelector('input[name="expire"]').addEventListener('input', function (e) {
    let v = this.value.replace(/\D/g, '').substring(0, 4);
    if (v.length >= 3) {
        v = v.substring(0, 2) + '/' + v.substring(2);
    }
    this.value = v;
});
});