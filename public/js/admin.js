document.querySelectorAll('.menu-title').forEach(item => {
    item.addEventListener('click', () => {
        item.parentElement.classList.toggle('active');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.clickable-row');

    rows.forEach(row => {
        row.addEventListener('click', function () {
            const id = this.dataset.id;
            const type = this.dataset.type;

            if (id && type) {
                window.location.href = `/admin/${type}/${id}`;
            }
        });
    });
});
