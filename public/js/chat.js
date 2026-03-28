document.addEventListener('DOMContentLoaded', function () {
    const chatWindow = document.getElementById('chat-window');
    
function scrollToBottom() {
        if (chatWindow) {
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }
    }


    scrollToBottom();

    const chatForm = document.querySelector('.chat-form');
    if (chatForm) {
        chatForm.addEventListener('submit', function () {
            const btn = this.querySelector('.chat-submit-btn');
            setTimeout(() => {
                btn.disabled = true;
                btn.style.opacity = '0.5';
            }, 0);
        });
    }
});