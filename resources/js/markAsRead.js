
  window.markAsRead = function (id) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/owner/notifications/${id}/read`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': token,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to mark as read');
        }
        return response.json();
    })
    .then(data => {
        const dot = document.getElementById(`notification-dot-${id}`);
        if (dot) {
            dot.classList.remove('unread');
            dot.classList.add('read');
        }
    })
    .catch(error => {
        console.error(error);
    });
};