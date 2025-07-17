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
                    <div class="numbers">15</div>
                    <div class="title">Usuários</div>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers">5</div>
                    <div class="title">Usuário ativos</div>
                </div>
                <div class="icon"><i class="fas fa-user-check"></i></div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="numbers">6</div>
                    <div class="title">Usuários inativos</div>
                </div>
                <div class="icon"><i class="fas fa-user-slash"></i></div>
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
                <caption>Usuários cadastrados</caption>
                <thead>
                    <tr>
                        <th>Imagem</th>
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
                        <td><img src="../assets/img/user.png" alt="Usuário"></td>
                        <td>Makiesse</td>
                        <td>João</td>
                        <td>makiesse@gmail.com</td>
                        <td>+244 923 456 789</td>
                        <td><span class="status ativo">Ativo</span></td>
                        <td><a href="editar" class="btn fas fa-pen" title="Editar"></a></td>
                        <td><a href="eliminar" class="btn fas fa-trash delete" title="Eliminar"></a></td>
                    </tr>
                    <tr>
                        <td><img src="../assets/img/user.png" alt="Usuário"></td>
                        <td>Makiesse</td>
                        <td>João</td>
                        <td>makiesse@gmail.com</td>
                        <td>+244 923 456 789</td>
                        <td><span class="status inativo">Inativo</span></td>
                        <td><a href="editar" class="btn fas fa-pen" title="Editar"></a></td>
                        <td><a href="eliminar" class="btn fas fa-trash delete" title="Eliminar"></a></td>
                    </tr>
                    <tr>
                        <td><img src="../assets/img/user.png" alt="Usuário"></td>
                        <td>Makiesse</td>
                        <td>João</td>
                        <td>makiesse@gmail.com</td>
                        <td>+244 923 456 789</td>
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
            <form class="form" id="form">
                <h3>Cadastrar Usuário</h3>
                <div class="inputBox">
                    <div>
                        <input type="text" name="nome" placeholder="Nome do usuário"  class="box" required>
                    </div>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="text" name="sobrenome" placeholder="Sobrenome do usuário"  class="box" required>
                    </div>
                </div>

                <div class="inputBox">
                    <select name="cat" id="cat" class="box">
                        <option value="" disabled selected>-- Selecione uma função --</option>
                        <option value="1">Admin</option>
                        <option value="2">Editor</option>
                    </select>
                </div>

                <div class="inputBox">
                    <select name="cat" id="cat" class="box">
                        <option value="" disabled selected>-- Selecione um status --</option>
                        <option value="0">Inativo</option>
                        <option value="1">Ativo</option>
                    </select>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="file" name="imagem"  class="box" required>
                    </div>
                </div>

                <button type="submit" class="btn">Cadastrar Usuário</button>
            </form>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>