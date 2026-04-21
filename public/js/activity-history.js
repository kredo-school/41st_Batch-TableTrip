document.addEventListener('DOMContentLoaded', function () {
    const reviewModal = document.getElementById('reviewModal');
    if (!reviewModal) return;

    reviewModal.addEventListener('show.bs.modal', function (e) {
        const icon = e.relatedTarget;
        const productId = icon.dataset.productId;
        const productName = icon.dataset.productName;

        document.getElementById('reviewForm').action = '/products/' + productId + '/reviews';
        document.getElementById('reviewProductName').textContent = productName;
        document.getElementById('modal-rating-input').value = '';

        document.querySelectorAll('.modal-star').forEach(s => s.style.color = '#ddd');
    });

    const modalStars = document.querySelectorAll('.modal-star');
    const modalRatingInput = document.getElementById('modal-rating-input');

    modalStars.forEach(star => {
        star.addEventListener('mouseover', () => {
            modalStars.forEach(s => s.style.color = s.dataset.value <= star.dataset.value ? '#F5A623' : '#ddd');
        });
        star.addEventListener('mouseout', () => {
            const val = modalRatingInput.value;
            modalStars.forEach(s => s.style.color = s.dataset.value <= val ? '#F5A623' : '#ddd');
        });
        star.addEventListener('click', () => {
            modalRatingInput.value = star.dataset.value;
            modalStars.forEach(s => s.style.color = s.dataset.value <= star.dataset.value ? '#F5A623' : '#ddd');
        });
    });
});
