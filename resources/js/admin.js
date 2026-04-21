document.querySelectorAll('.menu-title').forEach(item => {
    item.addEventListener('click', () => {
        item.parentElement.classList.toggle('active');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            if (!confirm('本当に削除していいですか？')) {
                e.preventDefault();
            }
        });
    });

});
