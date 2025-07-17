<?php 
session_start();
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../config/config.php';
include __DIR__ . '/../../includes/functions.php';
include 'actions/read.php';
include 'actions/category.php';
?> 
<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts | Dashboard</title>
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
                    <div class="numbers"><?= $totalPosts ?></div>
                    <div class="title">Posts</div>
                </div>
                <div class="icon"><i class="fas fa-newspaper"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers"><?= $totalAtivos ?></div>
                    <div class="title">Posts ativos</div>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers"><?= $totalInativos ?></div>
                    <div class="title">Posts inativos</div>
                </div>
                <div class="icon"><i class="fas fa-eye-slash"></i></div>
            </div>
        </section>

        <!--charts-->
        <section class="charts">
            <div class="chart-container w-100">
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

        <!--section-search-->
        <section class="section-search">
            <form action="javascript:void(0)" class="search-form">
                <input type="search" name="tbusca" id="search-box" placeholder="Busque aqui..." required>
                <button type="submit" class="fas fa-search" title="Pesquisar"></button>
            </form>
        </section>

        <!--table-->
        <?php if(!empty($posts)): ?>
        <section class="table-section">
            <table>
                <caption>Pots cadastrados</caption>
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th>Texto</th>
                        <th>Visualizções</th>
                        <th>Status</th>
                        <th>Categoria</th>
                        <th>Autor</th>
                        <th>Criado</th>
                        <th>Atualizado</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><img src="<?= BASE_SITE_URL . '/uploads/posts/' . htmlspecialchars($post['imagem']) ?>" alt="<?= htmlspecialchars($post['titulo']) ?>"></td>
                        <td><?= htmlspecialchars($post['titulo']) ?></td>
                        <td><?= resumirTexto(htmlspecialchars($post['texto']), 5) ?></td>
                        <td><?= htmlspecialchars($post['visualizacoes']) ?></td>
                        <td>
                            <span class="status <?= $post['status'] === 'ativo' ? 'ativo' : 'inativo' ?>">
                                <?= ucfirst($post['status']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($post['categoria']) ?></td>
                        <td><?= htmlspecialchars($post['autor']) ?></td>
                        <td><?= DataHora(htmlspecialchars($post['criado_em'])) ?></td>
                        <td><?= DataHora(htmlspecialchars($post['atualizado_em'])) ?></td>
                        <td><a href="editar?id=<?= $post['id'] ?>" class="btn fas fa-pen" title="Editar"></a></td>
                        <td><a href="eliminar?id=<?= $post['id'] ?>" class="btn fas fa-trash delete" title="Eliminar"></a></td>
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
                <p class="none">Posts não encontrados</p>
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
            <form action="actions/create" method="POST" class="form" id="form" enctype="multipart/form-data">
                <h3>Cadastrar Post</h3>
                <input type="hidden" name="idusuario" value="1">
                <div class="inputBox">
                    <div>
                        <input type="text" name="titulo" placeholder="Título do post"  class="box" value="<?= htmlspecialchars($formData['titulo'] ?? '') ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <select name="categoria" id="categoria" class="box">
                        <option value="" disabled <?= empty($formData['categoria']) ? 'selected' : '' ?>>
                            -- Selecione uma categoria --
                        </option>
                        <?php if(!empty($categorias)): ?>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id'] ?>" <?= (isset($formData['categoria']) && $formData['categoria'] == $categoria['id']) ? 'selected' : '' ?>>
                                    <?= $categoria['titulo'] ?>
                                    </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Nenhuma categoria disponível</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="inputBox">
                    <select name="status" id="status" class="box">
                        <option value="" disabled <?= empty($formData['status']) ? 'selected' : '' ?>>
                            -- Selecione um status --
                        </option>
                        <option value="ativo" <?= ($formData['status'] ?? '') === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="inativo" <?= ($formData['status'] ?? '') === 'inativo' ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="file" name="imagem"  class="box" accept=".jpeg, .jpg, .png, .gif, .webp">
                    </div>
                </div>

                <div class="inputBox">
                    <textarea name="texto" placeholder="Texto do post" cols="30" rows="10">
                        <?= htmlspecialchars($formData['texto'] ?? '') ?>
                    </textarea>
                </div>

                <button type="submit" class="btn">Cadastrar Post</button>
            </form>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="../assets/js/postChart.js?<?= time(); ?>"></script>
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
                    .then(posts => {
                        const tbody = document.querySelector('table tbody');
                        tbody.innerHTML = '';

                        if (posts.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="11">Nenhum resultado encontrado.</td></tr>';
                            return;
                        }

                        posts.forEach(post => {
                            const row = `
                                <tr>
                                    <td><img src="<?= BASE_SITE_URL?>/uploads/posts/${post.imagem}" alt="${post.titulo}"></td>
                                    <td>${post.titulo}</td>
                                    <td>${post.texto.split(' ').slice(0, 5).join(' ')}...</td>
                                    <td>${post.visualizacoes}</td>
                                    <td><span class="status ${post.status === 'ativo' ? 'ativo' : 'inativo'}">${post.status.charAt(0).toUpperCase() + post.status.slice(1)}</span></td>
                                    <td>${post.categoria}</td>
                                    <td>${post.autor}</td>
                                    <td>${post.criado_em}</td>
                                    <td>${post.atualizado_em}</td>
                                    <td><a href="editar?id=${post.id}" class="btn fas fa-pen" title="Editar"></a></td>
                                    <td><a href="eliminar?id=${post.id}" class="btn fas fa-trash delete" title="Eliminar"></a></td>
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