<?php 
session_start();
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../includes/functions.php';
include 'actions/funcao.php';

$usuario = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT nome, sobrenome, email, telefone, status, id_funcao, imagem 
    FROM usuario WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
    }
} else {
    redirect("http://localhost/blog/dashboard/usuarios/");
}
?>
<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário | Dashboard</title>
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

        <!--form-->
        <section class="section-form">
            <?php
                if (isset($_SESSION['msgs'])) {
                    foreach ($_SESSION['msgs'] as $msg) {
                        echo $msg;
                    }
                    unset($_SESSION['msgs']);
                }
            ?>
            <form action="actions/update" method="POST" class="form" id="form">
                <h3>Editar Usuário</h3>
                <input type="hidden" name="idusuario" value="<?= $id ?>">
                <div class="inputBox">
                    <div>
                        <input type="text" name="nome" placeholder="Nome do usuário"  class="box" value="<?= htmlspecialchars($usuario['nome']) ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="text" name="sobrenome" placeholder="Sobrenome do usuário"  class="box" value="<?= htmlspecialchars($usuario['sobrenome']) ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="email" name="email" placeholder="exemplo@gmail.com"  class="box" value="<?= htmlspecialchars($usuario['email']) ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="tel" name="telefone" placeholder="+244 923 456 789"  class="box" value="<?= htmlspecialchars($usuario['telefone']) ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <select name="funcao" id="funcao" class="box">
                        <option value="" disabled selected>-- Selecione uma função --</option>
                        <?php if(!empty($funcoes)): ?>
                            <?php foreach ($funcoes as $funcao): ?>
                                <option value="<?= $funcao['id'] ?>" <?= $usuario['id_funcao'] == $funcao['id'] ? 'selected' : '' ?>>
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
                        <option value="" disabled selected>-- Selecione um status --</option>
                        <option value="ativo" <?= $usuario['status'] === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="inativo" <?= $usuario['status'] === 'inativo' ? 'selected' : '' ?>>Inativo</option>
                        <option value="pendente" <?= $usuario['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                        <option value="banido" <?= $usuario['status'] === 'banido' ? 'selected' : '' ?>>Banido</option>
                    </select>
                </div>

                <button type="submit" class="btn">Editar Usuário</button>
            </form>
        </section>

        <section class="section-form">
            <form action="actions/update-senha" method="POST" class="form" id="form">
                <h3>Alterar Senha</h3>
                <input type="hidden" name="idusuario" value="<?= $id ?>">
                <div class="inputBox">
                    <div>
                        <input type="password" name="senha" placeholder="Sua senha"  class="box">
                    </div>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="password" name="confirmaSenha" placeholder="Confirme sua senha"  class="box">
                    </div>
                </div>

                <button type="submit" class="btn">Alterar Senha</button>
            </form>
        </section>

        <section class="section-form">
            <form action="actions/update-imagem-usuario" method="POST" class="form" id="form" enctype="multipart/form-data">
                <h3>Alterar Imagem do Post</h3>
                <input type="hidden" name="idusuario" value="<?= $id ?>">

                <div class="inputBox">
                    <div>
                        <input type="file" name="imagem"  class="box" accept=".jpeg, .jpg, .png, .gif, .webp">
                        <?php if (!empty($usuario['imagem'])): ?>
                        <p><img src="<?= BASE_SITE_URL . '/uploads/users/' . htmlspecialchars($usuario['imagem']) ?>" alt="<?= $usuario['nome'] ?>" height="250px" width="100%"></p>
                         <?php endif; ?>
                    </div>
                </div>

                <button type="submit" class="btn">Alterar Imagem do Usuário</button>
            </form>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>