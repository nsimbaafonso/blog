<?php 
session_start();
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../includes/functions.php';

$post = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT titulo, descricao, status FROM categoria WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $categoria = $result->fetch_assoc();
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
    <title>Editar Categoria | Dashboard</title>
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
                <h3>Editar Categoria</h3>
                <input type="hidden" name="idcategoria" value="<?= $id ?>">
                <div class="inputBox">
                    <div>
                        <input type="text" name="titulo" placeholder="Título da categoria"  class="box" value="<?= htmlspecialchars($categoria['titulo']) ?>">
                    </div>
                </div>

                <div class="inputBox">
                    <select name="status" id="status" class="box">
                        <option value="" disabled selected>-- Selecione um status --</option>
                        <option value="ativo" <?= $categoria['status'] == 'ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="inativo" <?= $categoria['status'] == 'inativo' ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>

                <div class="inputBox">
                    <textarea name="descricao" placeholder="Descrição da categoria" cols="30" rows="10">
                        <?= htmlspecialchars($categoria['descricao']) ?>
                    </textarea>
                </div>

                <button type="submit" class="btn">Editar Categoria</button>
            </form>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>