// 1. Visitas ao Blog
let categoriasChart;

function carregarGraficoCategorias() {
  fetch('http://localhost/blog/dashboard/categorias/actions/get_categorias_populares.php')
    .then(response => response.json())
    .then(dados => {
      const labels = dados.map(item => item.categoria);
      const valores = dados.map(item => item.total_posts);

      const cores = [
        '#FF6384', // rosa
        '#36A2EB', // azul
        '#FFCE56', // amarelo
        '#4BC0C0', // verde-água
        '#9966FF'  // roxo
      ];

      const data = {
        labels: labels,
        datasets: [{
          label: 'Posts por Categoria',
          data: valores,
          backgroundColor: cores.slice(0, labels.length),
          hoverOffset: 8
        }]
      };

      if (categoriasChart) {
        categoriasChart.destroy();
      }

      categoriasChart = new Chart(document.getElementById('categoriasChart').getContext('2d'), {
        type: 'doughnut',
        data: data,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom'
            },
            title: {
              display: true,
              text: 'Posts por Categoria'
            }
          }
        }
      });
    })
    .catch(error => {
      console.error('Erro ao carregar categorias:', error);
    });
}

document.addEventListener('DOMContentLoaded', () => {
  carregarGraficoCategorias();
});

