document.addEventListener('DOMContentLoaded', () => {
    const chartElement = document.getElementById('revenueChart');
    if (!chartElement) return;

    const labels = JSON.parse(chartElement.dataset.labels || '[]');
    const values = JSON.parse(chartElement.dataset.values || '[]');

    console.log(labels);
    console.log(values);

    if (window.revenueChart instanceof Chart) {
        window.revenueChart.destroy();
    }

    const ctx = chartElement.getContext('2d');

    window.revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue',
                data: values,
                borderColor: '#D96B52',
                backgroundColor: 'rgba(217,107,82,0.1)',
                fill: true,
                pointRadius: 0,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        }
    });
});

const ctx = document.getElementById('topProductsChart');

if (ctx) {
    const labels = JSON.parse(ctx.dataset.labels);
    const data = JSON.parse(ctx.dataset.values);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Orders',
                data: data,
                backgroundColor: '#D96B52',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            }
        }
    });
}