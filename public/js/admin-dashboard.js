document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('salesChart');
    if (!ctx) return;

    const labels = JSON.parse(ctx.dataset.labels);
    const data = JSON.parse(ctx.dataset.data);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Orders',
                data: data,
                borderWidth: 2,
                borderColor:'#B8D9D0',
                backgroundColor:'rgba(184,217,208,0.2)',
                tension:0.4,
                fill:true
            }]
        }
    });

});