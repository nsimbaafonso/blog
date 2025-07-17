<?php 
session_start();
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../includes/functions.php';

$categoria = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT titulo FROM categoria WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $categoria = $result->fetch_assoc();
    }
} else {
    redirect("/blog/dashboard/categorias/");
}

?>

<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Categoria | Dashboard</title>
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
            <form action="actions/delete" method="POST" class="form" id="form">
                <h3>Eliminar Categoria?</h3>
                <p>Tem a certeza que deseja eliminar a categoria <?= $categoria["titulo"]?>?</p>
                <input type="hidden" name="idcategoria" value="<?= $id?>" required>
                <div class="d-flex-2">
                    <a href="/blog/dashboard/categorias" class="btn">Cancelar</a>
                    <button type="submit" class="btn red">Eliminar Categoria</button>
                </div>
            </form>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>