<?php 
session_start();
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../includes/functions.php';

?>
<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter | Dashboard</title>
    <link href="../assets/fonts/fontawesome-6.5.2/css/fontawesome.css?<?= time(); ?>" rel="stylesheet">
    <link href="../assets/fonts/fontawesome-6.5.2/css/brands.css?<?= time(); ?>" rel="stylesheet">
    <link href="../assets/fonts/fontawesome-6.5.2/css/solid.css?<?= time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css?<?= time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
    <!--sidebar-->
    <?= include '../includes/sidebar.php'; ?>     
    <!--fim sidebar-->

    <!--overlay-->
    <div class="overlay" id="overlay"></div>
    <!--fim overlay-->

    <!--main-->
    <main class="main">
        <?= include '../includes/header.php'; ?>

        <!--cards-->
        <section class="cards">
            <div class="card">
                <div class="content">
                    <div class="numbers">20</div>
                    <div class="title">Newsletter</div>
                </div>
                <div class="icon"><i class="fas fa-envelope"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers">20</div>
                    <div class="title">Newsletter ativos</div>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers">20</div>
                    <div class="title">Newsletter inativos</div>
                </div>
                <div class="icon"><i class="fas fa-eye-slash"></i></div>
            </div>
        </section>

        <!--charts-->
        <section class="charts">
            <div class="chart-container w-100">
                <div class="chart-header">
                    <h3>Assinaturas do Site</h3>
                    <select>
                      <option>Últimos 7 dias</option>
                      <option>Últimos 30 dias</option>
                      <option>Este ano</option>
                    </select>
                </div>
                <canvas id="newsletterChart"></canvas>
            </div>
        </section>

        <!--section-search-->
        <section class="section-search">
            <form action="" class="search-form">
                <input type="search" name="tbusca" id="search-box" placeholder="Busque aqui..." required>
                <button type="submit" class="fas fa-search" title="Pesquisar"></button>
            </form>
        </section>

        <!--table-->
        <section class="table-section">
            <table>
                <caption>Newsletter cadastrados</caption>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>mateus@gmail.com</td>
                        <td><span class="status ativo">Ativo</span></td>
                        <td><a href="editar" class="btn fas fa-pen" title="Editar"></a></td>
                        <td><a href="eliminar" class="btn fas fa-trash delete" title="Eliminar"></a></td>
                    </tr>
                    <tr>
                        <td>joao@gmail.com</td>
                        <td><span class="status inativo">Inativo</span></td>
                        <td><a href="editar" class="btn fas fa-pen" title="Editar"></a></td>
                        <td><a href="eliminar" class="btn fas fa-trash delete" title="Eliminar"></a></td>
                    </tr>
                    <tr>
                        <td>nelson@gmail.com</td>
                        <td><span class="status ativo">Ativo</span></td>
                        <td><a href="editar" class="btn fas fa-pen edit" title="Editar"></a></td>
                        <td><a href="eliminar" class="btn fas fa-trash delete" title="Eliminar"></a></td>
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

        <!--form-->
        <section class="section-form">
            <form action="" method="POST" class="form" id="form">
                <h3>Cadastrar Newsletter</h3>
                <div class="inputBox">
                    <div>
                        <input type="email" name="email" placeholder="exemplo@gmail.com"  class="box" required>
                    </div>
                </div>

                <div class="inputBox">
                    <select name="cat" id="cat" class="box">
                        <option value="" disabled selected>-- Selecione um status --</option>
                        <option value="0">Inativo</option>
                        <option value="1">Ativo</option>
                    </select>
                </div>

                <button type="submit" class="btn">Cadastrar Newsletter</button>
            </form>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
    <script type="text/javascript" src="../assets/js/newsletterChart.js"></script>
</body>
</html>