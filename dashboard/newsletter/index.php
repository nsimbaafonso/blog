<?php 
session_start();
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../includes/functions.php';
include 'actions/read.php';
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
                    <div class="numbers"><?= $totalNewletters ?></div>
                    <div class="title">Newsletter</div>
                </div>
                <div class="icon"><i class="fas fa-envelope"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers"><?= $totalAtivos ?></div>
                    <div class="title">Newsletter ativos</div>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers"><?= $totalInativos ?></div>
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
            <form action="javascript:void(0)" class="search-form">
                <input type="search" name="tbusca" id="search-box" placeholder="Busque aqui..." required>
                <button type="submit" class="fas fa-search" title="Pesquisar"></button>
            </form>
        </section>

        <!--table-->
        <?php if(!empty($newsletters)): ?>
        <section class="table-section">
            <table>
                <caption>Newsletter cadastrados</caption>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Criado</th>
                        <th>Atualizado</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($newsletters as $newsletter): ?>
                    <tr>
                        <td><?= htmlspecialchars($newsletter['email']) ?></td>
                        <td>
                            <span class="status <?= $newsletter['status'] === 'ativo' ? 'ativo' : 'inativo' ?>">
                                <?= ucfirst($newsletter['status']) ?>
                            </span>
                        </td>

                        <td><?= DataHora(htmlspecialchars($newsletter['criado_em'])) ?></td>
                        <td><?= DataHora(htmlspecialchars($newsletter['atualizado_em'])) ?></td>
                        <td><a href="editar?id=<?= $newsletter['id'] ?>" class="btn fas fa-pen" title="Editar"></a></td>
                        <td><a href="eliminar?id=<?= $newsletter['id'] ?>" class="btn fas fa-trash delete" title="Eliminar"></a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="pagination" id="pagination">
                <?php if ($pagina > 1): ?>
                    <a href="?pagina=<?= $pagina - 1 ?>" class="page-btn" title="Anterior">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <a href="?pagina=<?= $i ?>" class="page-btn <?= $i == $pagina ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($pagina < $totalPaginas): ?>
                    <a href="?pagina=<?= $pagina + 1 ?>" class="page-btn" title="Próximo">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </div>
        </section>
        <?php else: ?>
            <section class="table-section">
                <p class="none">Newsletters não encontrados</p>
            </section> 
        <?php endif; ?>

        <!--form-->
        <section class="section-form">
            <?php
                if (isset($_SESSION['msgs'])) {
                    foreach ($_SESSION['msgs'] as $msg) {
                        echo $msg;
                    }
                    unset($_SESSION['msgs']);
                }
                $formData = $_SESSION['form_data'] ?? [];
                unset($_SESSION['form_data']);
            ?>
            <form action="actions/create" method="POST" class="form" id="form">
                <h3>Cadastrar Newsletter</h3>
                <div class="inputBox">
                    <div>
                        <input type="email" name="email" placeholder="exemplo@gmail.com"  class="box" value="<?= htmlspecialchars($formData['email'] ?? '') ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <select name="status" id="status" class="box">
                        <option value="" disabled <?= empty($formData['status']) ? 'selected' : '' ?>>-- Selecione um status --</option>
                        <option value="ativo" <?= ($formData['status'] ?? '') === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="inativo" <?= ($formData['status'] ?? '') === 'inativo' ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>

                <button type="submit" class="btn">Cadastrar Newsletter</button>
            </form>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
    <script type="text/javascript" src="../assets/js/newsletterChart.js?<?= time(); ?>"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            const searchBox = document.getElementById('search-box');
            const pagination = document.getElementById('pagination');

            searchBox.addEventListener('keyup', function () {
                const query = this.value.trim();

                if (query === '') {
                    pagination.style.display = 'block'; 
                    location.reload() ;
                    return;
                }

                pagination.style.display = 'none';

                fetch(`actions/search.php?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(newsletters => {
                        const tbody = document.querySelector('table tbody');
                        tbody.innerHTML = '';

                        if (newsletters.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="6">Nenhum resultado encontrado.</td></tr>';
                            return;
                        }

                        newsletters.forEach(newsletter => {
                            const row = `
                                <tr>
                                    <td>${newsletter.email}</td>
                                    <td><span class="status ${newsletter.status === 'ativo' ? 'ativo' : 'inativo'}">${newsletter.status.charAt(0).toUpperCase() + newsletter.status.slice(1)}</span></td>
                                    <td>${newsletter.criado_em}</td>
                                    <td>${newsletter.atualizado_em}</td>
                                    <td><a href="editar?id=${newsletter.id}" class="btn fas fa-pen" title="Editar"></a></td>
                                    <td><a href="eliminar?id=${newsletter.id}" class="btn fas fa-trash delete" title="Eliminar"></a></td>
                                </tr>
                            `;
                            tbody.insertAdjacentHTML('beforeend', row);
                        });
                    })
                    .catch(error => {
                        console.error('Erro ao buscar:', error);
                    });
            });
        });
    </script>
</body>
</html>