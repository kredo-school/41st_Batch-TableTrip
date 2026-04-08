document.querySelectorAll('.menu-title').forEach(item => {
    item.addEventListener('click', () => {
        item.parentElement.classList.toggle('active');
    });
});