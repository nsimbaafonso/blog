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

// 2. Fontes de Tráfego
new Chart(document.getElementById('fontesChart'), {
  type: 'pie',
  data: {
    labels: ['Google', 'Facebook', 'Instagram', 'Direto', 'Outros'],
    datasets: [{
      data: [45, 25, 15, 10, 5],
      backgroundColor: ['#4285F4', '#3b5998', '#E1306C', '#aaa', '#ccc']
    }]
  }
});

// 3. Tempo Médio de Leitura
new Chart(document.getElementById('tempoChart'), {
  type: 'bar',
  data: {
    labels: ['Tecnologia', 'Estilo de Vida', 'Educação', 'Saúde', 'Negócios'],
    datasets: [{
      label: 'Minutos por Leitura',
      data: [3.5, 4.2, 5.1, 4.8, 3.9],
      backgroundColor: '#4caf50'
    }]
  },
  options: {
    indexAxis: 'y',
    responsive: true
  }
});

// 4. Posts Mais Populares
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

// 5. Localização dos Visitantes
new Chart(document.getElementById('localizacaoChart'), {
  type: 'bar',
  data: {
    labels: ['Brasil', 'Portugal', 'EUA', 'Angola', 'Moçambique'],
    datasets: [{
      label: 'Visitantes',
      data: [1200, 400, 300, 150, 100],
      backgroundColor: '#ff9800'
    }]
  },
  options: {
    responsive: true
  }
});

// 6. Dispositivos Usados
new Chart(document.getElementById('dispositivosChart'), {
  type: 'doughnut',
  data: {
    labels: ['Desktop', 'Mobile', 'Tablet'],
    datasets: [{
      data: [60, 35, 5],
      backgroundColor: ['#3f51b5', '#009688', '#9c27b0']
    }]
  }
});
