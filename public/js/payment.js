document.addEventListener('DOMContentLoaded', function() {
    const paymentForm = document.getElementById('payment-form');
    const deleteButtons = document.querySelectorAll('.btn-delete-card');
    const editButtons = document.querySelectorAll('.edit-button');
    const formTitle = document.getElementById('form-title');
    const submitBtn = document.getElementById('submit-button');
    const cancelBtn = document.getElementById('cancel-edit');
    const methodField = document.getElementById('method-field');
    const cardNumberInput = document.querySelector('input[name="card_number"]');
    const holderNameInput = document.querySelector('input[name="holder_name"]');
    const expMonthSelect = document.getElementById('exp_month');
    const expYearSelect = document.getElementById('exp_year');

    // delete alart
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this payment?')) {
                e.preventDefault();
            }
        });
    });

    // 2. Edit（
editButtons.forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const month = this.dataset.month;
        const year = this.dataset.year;
        const holder = this.dataset.holder;
        const last4 = this.dataset.last4;

        paymentForm.action = `/user/payment_method/${id}`;
        if (methodField) methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';

        if (expMonthSelect) expMonthSelect.value = month;
        if (expYearSelect) expYearSelect.value = year;
        if (holderNameInput) holderNameInput.value = holder;

        if (formTitle) formTitle.innerText = "Edit Card Setting";
        if (submitBtn) {
            submitBtn.innerText = "Update Card";
            submitBtn.className = "btn-update";
        }
        if (cancelBtn) cancelBtn.style.display = "inline-block";
        
        if (cardNumberInput) {
            cardNumberInput.disabled = false; 
            cardNumberInput.value = ""; 
            cardNumberInput.placeholder = `Current: **** ${last4} (Enter only if changing)`;
        }

        paymentForm.scrollIntoView({ behavior: 'smooth' });
    });
});

    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            paymentForm.action = "/user/payment_method"; 
            if (methodField) methodField.innerHTML = '';
            paymentForm.reset();
            
            if (formTitle) formTitle.innerText = "Register / Edit";
            if (submitBtn) {
                submitBtn.innerText = "Add Card";
                submitBtn.className = "btn-add";
            }
            cancelBtn.style.display = "none";
            
            if (cardNumberInput) {
                cardNumberInput.disabled = false;
                cardNumberInput.placeholder = "";
            }
        });
    }

    if (paymentForm) {
        paymentForm.addEventListener('submit', function(e) {
            console.log("Saving payment method...");
        });
    }

    const defaultBadges = document.querySelectorAll('.badge-default');
    defaultBadges.forEach(badge => {
        badge.style.cursor = 'pointer';
    });

    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, '').substring(0, 16);
        });
    }

    const expireInput = document.querySelector('input[name="expire"]');
    if (expireInput) {
        expireInput.addEventListener('input', function (e) {
            let v = this.value.replace(/\D/g, '').substring(0, 4);
            if (v.length >= 3) {
                v = v.substring(0, 2) + '/' + v.substring(2);
            }
            this.value = v;
        });
    }
});