document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star-btn');
    const ratingInput = document.getElementById('rating-input');
    if (!stars.length) return;

    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            stars.forEach(s => s.style.color = s.dataset.value <= star.dataset.value ? '#F5A623' : '#ddd');
        });
        star.addEventListener('mouseout', () => {
            const val = ratingInput.value;
            stars.forEach(s => s.style.color = s.dataset.value <= val ? '#F5A623' : '#ddd');
        });
        star.addEventListener('click', () => {
            ratingInput.value = star.dataset.value;
            stars.forEach(s => s.style.color = s.dataset.value <= star.dataset.value ? '#F5A623' : '#ddd');
        });
    });
});
