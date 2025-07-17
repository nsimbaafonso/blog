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
    <title>Configurações | Dashboard</title>
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

        <!--profile-->
        <section class="profile">
            <div class="profile-foto">
                <img src="../assets/img/user.png" alt="Imagem do usuário">
                <h2>Rafaela Nzola</h2>
            </div>
            <div class="profile-forms">
                <form action="" method="POST" class="form" id="form-info">
                    <h3>Editar Informações</h3>
                    <div class="inputBox">
                        <div>
                            <input type="text" name="nome" placeholder="Seu nome"  class="box" required>
                        </div>
                    </div>
                    <div class="inputBox">
                        <div>
                            <input type="text" name="sobrenome" placeholder="Seu sobrenome"  class="box" required>
                        </div>
                    </div>
                    <div class="inputBox">
                        <div>
                            <input type="email" name="email" placeholder="exemplo@gmail.com"  class="box" required>
                        </div>
                    </div>
                    <div class="inputBox">
                        <div>
                            <input type="tel" name="telefone" placeholder="+244 923 456 789"  class="box" required>
                        </div>
                    </div>

                    <button type="submit" class="btn">Salvar</button>
                </form>

                <form action="" method="POST" class="form" id="form-img">
                    <h3>Alterar imagem</h3>
                    <div class="inputBox" accept=".jpg, .jpeg, .png, .gif, .webp">
                        <div>
                            <input type="file" accept="image/*" name="imagem"  class="box" required>
                        </div>
                    </div>

                    <button type="submit" class="btn">Alterar Imagem</button>
                </form>

                <form action="" method="POST" class="form" id="form-senha">
                    <h3>Alterar senha</h3>
                    <div class="inputBox">
                        <div>
                            <input type="password" name="senha" placeholder="Sua senha atual"  class="box" required>
                        </div>
                    </div>
                    <div class="inputBox">
                        <div>
                            <input type="password" name="novaSenha" placeholder="Sua nova senha"  class="box" required>
                        </div>
                    </div>
                    <div class="inputBox">
                        <div>
                            <input type="password" name="confirmaSenha" placeholder="Confirma sua nova senha"  class="box" required>
                        </div>
                    </div>

                    <button type="submit" class="btn">Alterar Senha</button>
                </form>
            </div>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>