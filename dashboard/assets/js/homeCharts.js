// 1. Visitas ao Blog
new Chart(document.getElementById('visitasChart'), {
  type: 'line',
  data: {
    labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
    datasets: [{
      label: 'Visitantes',
      data: [120, 150, 180, 170, 200, 220, 190],
      borderColor: 'blue',
      backgroundColor: 'rgba(0, 0, 255, 0.1)',
      fill: true,
      tension: 0.3
    }]
  },
  options: {
    responsive: true
  }
});

// 2. Posts Mais Populares
new Chart(document.getElementById('popularesChart'), {
  type: 'bar',
  data: {
    labels: ['Post A', 'Post B', 'Post C', 'Post D', 'Post E'],
    datasets: [{
      label: 'Visualizações',
      data: [850, 720, 680, 590, 500],
      backgroundColor: '#2196f3'
    }]
  },
  options: {
    responsive: true
  }
});