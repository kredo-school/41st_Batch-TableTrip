document.addEventListener('DOMContentLoaded', function () {
    const chatWindow = document.getElementById('chat-window');
    
    function scrollToBottom() {
        if (chatWindow) {
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }
    }

    scrollToBottom();

    let isSubmitting = false;

    const chatForm = document.querySelector('.chat-input-area form'); 
    if (chatForm) {
        chatForm.addEventListener('submit', function (e) {
            if (isSubmitting) {
                e.preventDefault();
                return false;
            }

            isSubmitting = true;

            const btn = this.querySelector('.chat-submit-btn');
            if (btn) {
                btn.disabled = true;
                btn.style.opacity = '0.5';
                btn.innerText = 'Sending...'; 
            }
        });
    }
});