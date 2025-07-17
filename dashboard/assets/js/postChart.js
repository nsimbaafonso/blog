let chart;

function carregarGrafico(periodo = '7') {
  fetch(`http://localhost/blog/dashboard/posts/actions/get_posts_populares.php?periodo=${periodo}`)
    .then(response => response.json())
    .then(dados => {
      const labels = dados.map(post => post.titulo);
      const visualizacoes = dados.map(post => post.visualizacoes);

      const data = {
        labels: labels,
        datasets: [{
          label: 'Visualizações',
          data: visualizacoes,
          backgroundColor: '#2196f3'
        }]
      };

      if (chart) {
        chart.data = data;
        chart.update();
      } else {
        chart = new Chart(document.getElementById('popularesChart'), {
          type: 'bar',
          data: data,
          options: {
            responsive: true
          }
        });
      }
    });
}

// Mudar gráfico conforme select
document.querySelector('.chart-header select').addEventListener('change', function () {
  const texto = this.value;
  let periodo;

  switch (texto) {
    case 'Últimos 30 dias':
      periodo = '30';
      break;
    case 'Este ano':
      periodo = 'ano';
      break;
    default:
      periodo = '7';
  }

  carregarGrafico(periodo);
});

// Carrega inicialmente
carregarGrafico();