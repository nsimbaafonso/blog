// 1. Visitas ao Blog
new Chart(document.getElementById('usuariosChart'), {
  type: 'line',
  data: {
    labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
    datasets: [{
      label: 'Usuários',
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