<?php 
session_start();
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../config/config.php';
include __DIR__ . '/../../includes/functions.php';
include 'actions/read.php';
include 'actions/funcao.php';
?>
<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários | Dashboard</title>
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
                    <div class="numbers"><?= $totalUsuarios ?></div>
                    <div class="title">Usuários</div>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers"><?= $totalAtivos ?></div>
                    <div class="title">Usuários ativos</div>
                </div>
                <div class="icon"><i class="fas fa-user-check"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers"><?= $totalInativos ?></div>
                    <div class="title">Usuários inativos</div>
                </div>
                <div class="icon"><i class="fas fa-user-slash"></i></div>
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
        <?php if(!empty($usuarios)): ?>
        <section class="table-section">
            <table>
                <caption>Usuários cadastrados</caption>
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Status</th>
                        <th>Função</th>
                        <th>Criado</th>
                        <th>Atualizado</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><img src="<?= BASE_SITE_URL . '/uploads/users/' . htmlspecialchars($usuario['imagem']) ?>" alt="<?= htmlspecialchars($usuario['nome']) ?>"></td>
                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td><?= htmlspecialchars($usuario['sobrenome']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td><?= htmlspecialchars($usuario['telefone']) ?></td>
                        <td>
                            <span class="status <?= $usuario['status'] === 'ativo' ? 'ativo' : 'inativo' ?>">
                                <?= ucfirst($usuario['status']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($usuario['funcao_usuario']) ?></td>
                        <td><?= DataHora(htmlspecialchars($usuario['criado_em'])) ?></td>
                        <td><?= DataHora(htmlspecialchars($usuario['atualizado_em'])) ?></td>
                        <td><a href="editar?id=<?= $usuario['id'] ?>" class="btn fas fa-pen" title="Editar"></a></td>
                        <td><a href="eliminar?id=<?= $usuario['id'] ?>" class="btn fas fa-trash delete" title="Eliminar"></a></td>
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
                <p class="none">Usuários não encontrados</p>
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
                <h3>Cadastrar Usuário</h3>
                <div class="inputBox">
                    <div>
                        <input type="text" name="nome" placeholder="Nome do usuário"  class="box" value="<?= htmlspecialchars($formData['nome'] ?? '') ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="text" name="sobrenome" placeholder="Sobrenome do usuário"  class="box" value="<?= htmlspecialchars($formData['sobrenome'] ?? '') ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="email" name="email" placeholder="exemplo@gmail.com"  class="box" value="<?= htmlspecialchars($formData['email'] ?? '') ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="tel" name="telefone" placeholder="+244 923 456 789"  class="box" value="<?= htmlspecialchars($formData['telefone'] ?? '') ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="password" name="senha" placeholder="Sua senha"  class="box" value="<?= htmlspecialchars($formData['senha'] ?? '') ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="password" name="confirmaSenha" placeholder="Confirma sua senha"  class="box" value="<?= htmlspecialchars($formData['confirmaSenha'] ?? '') ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <select name="funcao" id="funcao" class="box">
                        <option value="" disabled <?= empty($formData['funcao']) ? 'selected' : '' ?>>-- Selecione uma função --</option>
                        <?php if(!empty($funcoes)): ?>
                            <?php foreach ($funcoes as $funcao): ?>
                                <option value="<?= $funcao['id'] ?>" <?= (isset($formData['funcao']) && $formData['funcao'] == $funcao['id']) ? 'selected' : '' ?>>
                                    <?= $funcao['nome'] ?>
                                    </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Nenhuma função disponível</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="inputBox">
                    <select name="status" id="status" class="box">
                        <option value="" disabled <?= empty($formData['status']) ? 'selected' : '' ?>>-- Selecione um status --</option>
                        <option value="ativo" <?= ($formData['status'] ?? '') === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="inativo" <?= ($formData['status'] ?? '') === 'inativo' ? 'selected' : '' ?>>Inativo</option>
                        <option value="pendente" <?= ($formData['status'] ?? '') === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                        <option value="banido" <?= ($formData['status'] ?? '') === 'banido' ? 'selected' : '' ?>>Banido</option>
                    </select>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="file" name="imagem"  class="box" accept=".jpeg, .jpg, .png, .gif, .webp">
                    </div>
                </div>

                <button type="submit" class="btn">Cadastrar Usuário</button>
            </form>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
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
                    .then(usuarios => {
                        const tbody = document.querySelector('table tbody');
                        tbody.innerHTML = '';

                        if (usuarios.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="11">Nenhum resultado encontrado.</td></tr>';
                            return;
                        }

                        usuarios.forEach(usuario => {
                            const row = `
                                <tr>
                                    <td><img src="<?= BASE_SITE_URL?>/uploads/users/${usuario.imagem}" alt="${usuario.nome}"></td>
                                    <td>${usuario.nome}</td>
                                    <td>${usuario.sobrenome}</td>
                                    <td>${usuario.email}</td>
                                    <td>${usuario.telefone}</td>
                                    <td><span class="status ${usuario.status === 'ativo' ? 'ativo' : 'inativo'}">${usuario.status.charAt(0).toUpperCase() + usuario.status.slice(1)}</span></td>
                                    <td>${usuario.funcao_nome}</td>
                                    <td>${usuario.criado_em}</td>
                                    <td>${usuario.atualizado_em}</td>
                                    <td><a href="editar?id=${usuario.id}" class="btn fas fa-pen" title="Editar"></a></td>
                                    <td><a href="eliminar?id=${usuario.id}" class="btn fas fa-trash delete" title="Eliminar"></a></td>
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