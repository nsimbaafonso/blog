<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria | Blog</title>
    <link href="assets/fonts/fontawesome-6.5.2/css/fontawesome.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/brands.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/solid.css?<?= time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?<?= time(); ?>">
    <link rel="stylesheet" href="assets/css/busca.css?<?= time(); ?>">
</head>
<body>
    <!--header-->
    <?php include 'includes/header.php'; ?>
    <!--header end-->

    <!--busca-->
    <section class="busca">
        <div class="content">
         <h3>Categoria</h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
    </section>
    <!--busca end-->

    <!--categoria-->
    <section class="post">
        <h3>Categoria: Notícias</h3>

        <div class="box-container">
            <div class="box">
                <div class="image">
                    <img src="assets/img/blog-1.jpg" alt="Blog 1">
                </div>
                <div class="content">
                    <h3>Duis aute irure dolor</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <a href="post.html" class="btn">Leia mais</a>
                    <div class="icons">
                        <a href="#"><i class="fas fa-calendar"></i> Dia 2 de Setembro de 2024</a>
                        <a href="#"><i class="fas fa-user"></i> Por Admin</a>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="assets/img/blog-2.jpg" alt="Blog 2">
                </div>
                <div class="content">
                    <h3>Duis aute irure dolor</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <a href="post.html" class="btn">Leia mais</a>
                    <div class="icons">
                        <a href="#"><i class="fas fa-calendar"></i> Dia 2 de Setembro de 2024</a>
                        <a href="#"><i class="fas fa-user"></i> Por Admin</a>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="assets/img/blog-3.jpg" alt="Blog 3">
                </div>
                <div class="content">
                    <h3>Duis aute irure dolor</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <a href="post.html" class="btn">Leia mais</a>
                    <div class="icons">
                        <a href="#"><i class="fas fa-calendar"></i> Dia 2 de Setembro de 2024</a>
                        <a href="#"><i class="fas fa-user"></i> Por Admin</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="d-flex">
            <nav class="nav-page">
                <ul class="pagination">
                   <li class="page-item">
                      <a class="page-link" href="#" title="Anterior">
                         <i class="fas fa-chevron-left"></i>
                      </a>
                   </li>
                   <li class="page-item"><a class="page-link" href="#">1</a></li>
                   <li class="page-item"><a class="page-link" href="#">2</a></li>
                   <li class="page-item"><a class="page-link" href="#">3</a></li>
                   <li class="page-item"><a class="page-link" href="#">4</a></li>
                   <li class="page-item"><a class="page-link" href="#">5</a></li>
                   <li class="page-item"><a class="page-link" href="#">6</a></li>
                   <li class="page-item">
                      <a class="page-link" href="#" title="Próximo">
                         <i class="fas fa-chevron-right"></i>
                      </a>
                   </li>
                </ul>
            </nav>
        </div>
    </section>
    <!--busca end-->

   <!-- newsletter -->
   <?php include 'includes/newsletter.php'; ?>
   <!-- end -->

   <!--footer-->
   <?php include 'includes/footer.php'; ?>
   <!--footer end-->    

   <script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>