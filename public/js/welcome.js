document .addEventListener('DOMContentLoaded', function(){
    const cards =document.querySelectorAll('.item-card');
    cards.forEach((card,index) =>{
        card.style.opacity = '0';
        card.style.transition = 'opacity 0.5s ease, transform 0.3s ease';
        setTimeout(() => {
            card.style.opacity = '1';
        }, index * 100);
    });
});