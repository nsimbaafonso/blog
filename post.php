<?php
include 'actions/post.php';
include 'includes/functions.php'; 
?>
<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= clearInput($post['titulo']) ?> | Blog</title>
    <link href="assets/fonts/fontawesome-6.5.2/css/fontawesome.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/brands.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/solid.css?<?= time(); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/dist/css/lightgallery-bundle.min.css?<?= time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?<?= time(); ?>">
    <link rel="stylesheet" href="assets/css/post.css?<?= time(); ?>">
</head>
<body>
    <!--header-->
    <?php include 'includes/header.php'; ?>
    <!--header end-->

    <section></section>

    <!--post-->
    <section class="post-read">
        <?php if ($post): ?>
            <h1><?= clearInput($post['titulo']) ?></h1>
            <div class="data">
                <span><i class="fas fa-calendar"></i> Postado: <?= Data(clearInput($post['criado_em'])) ?></span>
                <span><i class="fas fa-calendar"></i> Última atualização: <?= Data(clearInput($post['atualizado_em'])) ?></span>
            </div>
            <div class="post-img">
                <a href="uploads/posts/<?= clearInput($post['imagem']) ?>">
                    <img src="uploads/posts/<?= clearInput($post['imagem']) ?>" alt="<?= clearInput($post['titulo']) ?>" title="<?= clearInput($post['titulo']) ?>">
                </a>
            </div>
            <div class="totais">
                <div class="total">
                    <i class="fas fa-eye"></i> 
                    <p><span><?= clearInput($post['visualizacoes']) ?></span> Visualizações</p>
                </div>
            </div>
            <p>
                <?= clearInput($post['texto']) ?>
            </p>
        <?php else: ?>
            <p class="none">Post não encontrado.</p>
        <?php endif; ?>
    </section>
    <!--posts end-->

   <!-- newsletter -->
   <?php include 'includes/newsletter.php'; ?>
   <!-- end -->

   <!--footer-->
   <?php include 'includes/footer.php'; ?>
   <!--footer end-->

   <script type="text/javascript" src="assets/js/script.js"></script>
   <script src="assets/dist/lightgallery.min.js"></script>
   <script type="text/javascript">
       lightGallery(document.querySelector('.post-read .post-img'));
   </script>
</body>
</html>