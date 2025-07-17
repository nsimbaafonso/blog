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
    <title>Categorias | Dashboard</title>
    <link href="../assets/fonts/fontawesome-6.5.2/css/fontawesome.css?<?= time(); ?>" rel="stylesheet">
    <link href="../assets/fonts/fontawesome-6.5.2/css/brands.css?<?= time(); ?>" rel="stylesheet">
    <link href="../assets/fonts/fontawesome-6.5.2/css/solid.css?<?= time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css?<?= time(); ?>">
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
                    <div class="numbers"><?= $totalCategorias ?></div>
                    <div class="title">Categorias</div>
                </div>
                <div class="icon"><i class="fas fa-layer-group"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers"><?= $totalAtivos ?></div>
                    <div class="title">Categorias ativos</div>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers"><?= $totalInativos ?></div>
                    <div class="title">Categorias inativos</div>
                </div>
                <div class="icon"><i class="fas fa-eye-slash"></i></div>
            </div>
        </section>

        <!--charts-->
        <section class="charts">
            <div class="chart-container w-100">
                <div class="chart-header">
                    <h3>Categorias com mais posts</h3>
                </div>
                <canvas id="categoriasChart"></canvas>
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
        <?php if(!empty($categorias)): ?>
        <section class="table-section">
            <table>
                <caption>Categorias cadastrados</caption>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Criado</th>
                        <th>Atualizado</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?= htmlspecialchars($categoria['titulo']) ?></td>
                        <td><?= htmlspecialchars($categoria['descricao']) ?></td>
                        <td>
                            <span class="status <?= $categoria['status'] === 'ativo' ? 'ativo' : 'inativo' ?>">
                                <?= ucfirst($categoria['status']) ?>
                            </span>
                        </td>
                        <td><?= DataHora(htmlspecialchars($categoria['criado_em'])) ?></td>
                        <td><?= DataHora(htmlspecialchars($categoria['atualizado_em'])) ?></td>
                        <td><a href="editar?id=<?= $categoria['id'] ?>" class="btn fas fa-pen" title="Editar"></a></td>
                        <td><a href="eliminar?id=<?= $categoria['id'] ?>" class="btn fas fa-trash delete" title="Eliminar"></a></td>
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
                <p class="none">Categorias não encontrados</p>
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
                <h3>Cadastrar Categoria</h3>
                <div class="inputBox">
                    <div>
                        <input type="text" name="titulo" placeholder="Título da categoria"  class="box" value="<?= htmlspecialchars($formData['titulo'] ?? '') ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <select name="status" id="status" class="box">
                        <option value="" disabled <?= empty($formData['status']) ? 'selected' : '' ?>>-- Selecione um status --</option>
                        <option value="ativo"  <?= ($formData['status'] ?? '') === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="inativo"  <?= ($formData['status'] ?? '') === 'inativo' ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>

                <div class="inputBox">
                    <textarea name="descricao" placeholder="Descrição da categoria" cols="30" rows="10" required>
                        <?= htmlspecialchars($formData['descricao'] ?? '') ?>
                    </textarea>
                </div>

                <button type="submit" class="btn">Cadastrar Categoria</button>
            </form>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="../assets/js/categoriasChart.js?<?= time(); ?>"></script>
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
                    .then(categorias => {
                        const tbody = document.querySelector('table tbody');
                        tbody.innerHTML = '';

                        if (categorias.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="7">Nenhum resultado encontrado.</td></tr>';
                            return;
                        }

                        categorias.forEach(categoria => {
                            const row = `
                                <tr>
                                    <td>${categoria.titulo}</td>
                                    <td>${categoria.descricao}</td>
                                    <td><span class="status ${categoria.status === 'ativo' ? 'ativo' : 'inativo'}">${categoria.status.charAt(0).toUpperCase() + categoria.status.slice(1)}</span></td>
                                    <td>${categoria.criado_em}</td>
                                    <td>${categoria.atualizado_em}</td>
                                    <td><a href="editar?id=${categoria.id}" class="btn fas fa-pen" title="Editar"></a></td>
                                    <td><a href="eliminar?id=${categoria.id}" class="btn fas fa-trash delete" title="Eliminar"></a></td>
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