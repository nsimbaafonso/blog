<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="assets/fonts/fontawesome-6.5.2/css/fontawesome.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/brands.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/solid.css?<?= time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?<?= time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
    <!--sidebar-->
    <?= include 'includes/sidebar.php'; ?>
    <!--fim sidebar-->

    <!--overlay-->
    <div class="overlay" id="overlay"></div>
    <!--fim overlay-->

    <!--main-->
    <main class="main">
        <?= include 'includes/header.php'; ?>

        <!--cards-->
        <section class="cards">
            <div class="card">
                <div class="content">
                    <div class="numbers">1.500</div>
                    <div class="title">Posts</div>
                </div>
                <div class="icon"><i class="fas fa-newspaper"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers">20</div>
                    <div class="title">Categorias</div>
                </div>
                <div class="icon"><i class="fas fa-layer-group"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers">10</div>
                    <div class="title">Usuários</div>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers">100</div>
                    <div class="title">Newsletter</div>
                </div>
                <div class="icon"><i class="fas fa-envelope"></i></div>
            </div>
        </section>

        <section>
            <div class="alert success">
                <i class="fas fa-check-circle"></i>
                <span class="message">Operação realizada com sucesso!</span>
                <button class="close-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="alert error">
                <i class="fas fa-exclamation-circle"></i>
                <span class="message">Ocorreu um erro inesperado.</span>
                <button class="close-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="alert warning">
                <i class="fas fa-exclamation-triangle"></i>
                <span class="message">Atenção: verifique os dados informados.</span>
                <button class="close-btn"><i class="fas fa-times"></i></button>
            </div>
        </section>

        <!--charts-->
        <section class="charts">
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Visitas ao Blog</h3>
                    <select>
                      <option>Últimos 7 dias</option>
                      <option>Últimos 30 dias</option>
                      <option>Este ano</option>
                    </select>
                </div>
                <canvas id="visitasChart"></canvas>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h3>Posts Mais Populares</h3>
                    <select>
                      <option>Últimos 7 dias</option>
                      <option>Últimos 30 dias</option>
                      <option>Este ano</option>
                    </select>
                </div>
                <canvas id="popularesChart"></canvas>
            </div>
        </section>

        <!--table-->
        <section class="table-section">
            <table>
                <caption>Últimos usuários cadastrados</caption>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Status</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Makiesse</td>
                        <td>João</td>
                        <td>makiesse@gmail.com</td>
                        <td>+244 923 456 789</td>
                        <td><span class="status ativo">Ativo</span></td>
                        <td><a href="#" class="btn fas fa-pen" title="Editar"></a></td>
                        <td><a href="#" class="btn fas fa-trash delete" title="Eliminar"></a></td>
                    </tr>
                    <tr>
                        <td>Makiesse</td>
                        <td>João</td>
                        <td>makiesse@gmail.com</td>
                        <td>+244 923 456 789</td>
                        <td><span class="status inativo">Inativo</span></td>
                        <td><a href="#" class="btn fas fa-pen" title="Editar"></a></td>
                        <td><a href="#" class="btn fas fa-trash delete" title="Eliminar"></a></td>
                    </tr>
                    <tr>
                        <td>Makiesse</td>
                        <td>João</td>
                        <td>makiesse@gmail.com</td>
                        <td>+244 923 456 789</td>
                        <td><span class="status ativo">Ativo</span></td>
                        <td><a href="#" class="btn fas fa-pen edit" title="Editar"></a></td>
                        <td><a href="#" class="btn fas fa-trash delete" title="Eliminar"></a></td>
                    </tr>
                </tbody>
            </table>

            <div class="pagination">
              <a href="#" class="page-btn" title="Anterior"><i class="fas fa-chevron-left"></i></a>
              <a href="#" class="page-btn active">1</a>
              <a href="#" class="page-btn">2</a>
              <a href="#" class="page-btn">3</a>
              <a href="#" class="page-btn" title="Próximo"><i class="fas fa-chevron-right"></i></a>
            </div>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="assets/js/script.js"></script>
    <script type="text/javascript" src="assets/js/homeCharts.js"></script>
</body>
</html>