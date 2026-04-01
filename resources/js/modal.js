document.addEventListener('DOMContentLoaded', function () {
    const modalId = document.body.dataset.modalId;

    if (modalId) {
        const modalElement = document.getElementById(modalId);

        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }
    }
});