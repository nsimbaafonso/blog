<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre | Blog</title>
    <link href="assets/fonts/fontawesome-6.5.2/css/fontawesome.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/brands.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/solid.css?<?= time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?<?= time(); ?>">
    <link rel="stylesheet" href="assets/css/sobre.css?<?= time(); ?>">
</head>
<body>
    <!--header-->
    <?php include 'includes/header.php'; ?>
    <!--header end-->

    <!--sobre-->
    <section class="sobre">
        <div class="content">
         <h3>Sobre o Blog</h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
    </section>
    <!--sobre end-->

    <!--sobre-->
    <section class="about">
        <h1 class="heading">Sobre <span>Nós</span></h1>
        <div class="row">
            <div class="image">
                <img src="assets/img/sobre.jpg" alt="Sobre nós" title="Sobre nós">
            </div>

            <div class="content">
                <span>Seja bem-vindo ao nosso blog</span>
                <h3>Desde 2024. Acreditamos que o jornalismo transparente é importante.</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse nesciunt impedit voluptatibus! Ipsam veniam, amet aliquid mollitia odio, aliquam iure error deserunt sint nobis eius vitae, blanditiis ex commodi molestias! Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis consequatur nostrum culpa rem debitis sequi accusantium pariatur placeat, facere, accusamus ullam. Facilis alias consequuntur natus voluptates. Commodi incidunt asperiores a.
                </p>
            </div>
        </div>
    </section>
    <!--end sobre-->

   <!-- newsletter -->
   <?php include 'includes/newsletter.php'; ?>
   <!-- end -->

   <!--footer-->
   <?php include 'includes/footer.php'; ?>
   <!--footer end-->

   <script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>