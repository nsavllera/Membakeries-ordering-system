document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('salesChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: window.salesLabels || [],
            datasets: [{
                label: 'Sales',
                data: window.salesData || [],
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: false,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
