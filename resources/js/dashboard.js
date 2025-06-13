import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('chart-container');
    if (!container) return;

    const labels = JSON.parse(container.dataset.labels);
    const data = JSON.parse(container.dataset.values);

    const ctx = document.getElementById('chart-canvas').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Sales (RM)',
                data: data,
                borderColor: 'rgba(60,141,188,0.8)',
                backgroundColor: 'rgba(60,141,188,0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
