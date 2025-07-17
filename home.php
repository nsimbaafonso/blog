<?php 
include 'actions/list-post.php';
include 'includes/functions.php'; 
?>
<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="assets/fonts/fontawesome-6.5.2/css/fontawesome.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/brands.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/solid.css?<?= time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css?<?= time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?<?= time(); ?>">
</head>
<body>
    <!--header-->
    <?php include 'includes/header.php'; ?>
    <!--header end-->

    <!--home-->
    <section class="home">
        <div class="content">
         <h3>Fique Atualizado</h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
    </section>
    <!--home end-->

    <!--last posts-->
    <section class="post">
        <h1 class="heading">Últimos <span>Posts</span></h1>

        <div class="box-container">
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <article class="box">
                        <div class="image">
                            <img src="uploads/posts/<?= clearInput($post['imagem']) ?>" alt="<?= clearInput($post['titulo']) ?>" title="<?= clearInput($post['titulo']) ?>">
                        </div>
                        <div class="content">
                            <h3><?= clearInput($post['titulo']) ?></h3>
                            <p>
                                <?= resumirTexto(clearInput($post['texto']), 15) ?>
                            </p>
                            <a href="post?slug=<?= clearInput($post['slug']) ?>" class="btn">Leia mais</a>
                            <div class="icons">
                                <a href="#"><i class="fas fa-calendar"></i> <?= Data(clearInput($post['criado_em'])) ?></a>
                                <a href="#"><i class="fas fa-user"></i> Por <?= clearInput($post['autor']) ?></a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="none">Nenhum post encontrado no momento.</p>
            <?php endif; ?>
        </div>
    </section>
    <!--last posts end-->

    <!--parallax-->
    <section class="parallax">
        <div class="content">
            <h3>Dê a Visibilidade que o Seu Negócio Precisa</h3>
            <p>
                Investir em publicidade de qualidade pode trazer retornos significativos para o seu negócio, aumentando sua visibilidade online e atraindo novos clientes.
            </p>
            <a href="contato" class="btn">Solicitar um Orçamento</a>
        </div>
    </section>
    <!--parallax end-->

    <!--blogs-->
    <section class="blogs" id="blogs">
        <h1 class="heading">Outros <span>Posts</span></h1>

        <div class="swiper blogs-slider">
            <div class="swiper-wrapper">
                <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <article class="swiper-slide slide">
                        <div class="image">
                            <img src="uploads/posts/<?= clearInput($post['imagem']) ?>" alt="<?= clearInput($post['titulo']) ?>" title="<?= clearInput($post['titulo']) ?>">
                        </div>
                        <div class="content">
                            <h3><?= clearInput($post['titulo']) ?></h3>
                            <p>
                                <?= resumirTexto(clearInput($post['texto']), 15) ?>
                            </p>
                            <a href="post?slug=<?= clearInput($post['slug']) ?>" class="btn">Leia mais</a>
                            <div class="icons">
                                <a href="#"><i class="fas fa-calendar"></i> <?= Data(clearInput($post['criado_em'])) ?></a>
                                <a href="#"><i class="fas fa-user"></i> Por <?= clearInput($post['autor']) ?></a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="padding: 1rem; font-size: 1.2rem;">Nenhum post encontrado no momento.</p>
            <?php endif; ?>
            </div>
            
            <div class="swiper-pagination"></div>
        </div>
     </section>
    <!--blogs end-->

   <!-- newsletter -->
   <?php include 'includes/newsletter.php'; ?>
   <!-- end -->

   <!--footer-->
   <?php include 'includes/footer.php'; ?>
   <!--footer end-->

   <script src="assets/js/swiper-bundle.min.js"></script>
   <script type="text/javascript" src="assets/js/script.js"></script>
   <script type="text/javascript" src="assets/js/blogs-slide.js"></script>
</body>
</html>