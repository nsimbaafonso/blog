<?php 
session_start();
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../includes/functions.php';
include 'actions/category.php';

$post = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "
        SELECT 
            titulo, texto, imagem, status, id_categoria 
        FROM post 
        WHERE id = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();
    }
} else {
    redirect("http://localhost/blog/dashboard/posts/");
}

?>
<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Post | Dashboard</title>
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
                <h3>Editar Post</h3>
                <input type="hidden" name="idpost" value="<?= $id ?>">
                <div class="inputBox">
                    <div>
                        <input type="text" name="titulo" placeholder="Título do post"  class="box" required value="<?= htmlspecialchars($post['titulo']) ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <select name="categoria" id="categoria" class="box">
                        <option value="" disabled selected>-- Selecione uma categoria --</option>
                        <?php if(!empty($categorias)): ?>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id'] ?>" <?= $post['id_categoria'] == $categoria['id'] ? 'selected' : '' ?>>
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
                        <option value="" disabled selected>-- Selecione um status --</option>
                        <option value="ativo" <?= $post['status'] == 'ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="inativo" <?= $post['status'] == 'inativo' ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>

                <div class="inputBox">
                    <textarea name="texto" placeholder="Texto do post" cols="30" rows="10" required>
                        <?= htmlspecialchars($post['texto']) ?>
                    </textarea>
                </div>

                <button type="submit" class="btn">Editar Post</button>
            </form>
        </section>

        <section class="section-form">
            <form action="actions/update-imagem-post" method="POST" class="form" id="form" enctype="multipart/form-data">
                <h3>Alterar Imagem do Post</h3>
                <input type="hidden" name="idpost" value="<?= $id ?>">

                <div class="inputBox">
                    <div>
                        <input type="file" name="imagem"  class="box" accept=".jpeg, .jpg, .png, .gif, .webp">
                        <?php if (!empty($post['imagem'])): ?>
                        <p><img src="<?= BASE_SITE_URL . '/uploads/posts/' . htmlspecialchars($post['imagem']) ?>" alt="<?= $post['titulo'] ?>" height="250px" width="100%"></p>
                         <?php endif; ?>
                    </div>
                </div>

                <button type="submit" class="btn">Alterar Imagem do Post</button>
            </form>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>