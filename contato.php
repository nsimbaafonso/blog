<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato | Blog</title>
    <link href="assets/fonts/fontawesome-6.5.2/css/fontawesome.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/brands.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/solid.css?<?= time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?<?= time(); ?>">
    <link rel="stylesheet" href="assets/css/contato.css?<?= time(); ?>">
</head>
<body>
    <!--header-->
    <?php include 'includes/header.php'; ?>
    <!--header end-->

    <!--contatos-->
    <section class="contatos">
        <div class="content">
         <h3>Nos Contate</h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
    </section>
    <!--contatos end-->

    <!--contato-->
    <section class="contato">
        <h1 class="heading">Nos <span>Contate</span></h1>

        <div class="info-container">
            <div class="info">
                <i class="fas fa-envelope"></i>
                <h3>Nosso Email</h3>
                <p>blog@gmail.com</p>
            </div>

            <div class="info">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Nosso Endereço</h3>
                <p>Angola, Luanda</p>
            </div>
        </div>

        <div class="row">
            <form action="" class="form">
                <h3>Vamos lá, nos contate</h3>

                <div class="inputBox">
                    <input type="text" name="r_nome" id="r_nome" class="box" placeholder="Seu nome" required>
                    <input type="email" name="r_email" id="r_email" class="box" placeholder="exemplo@gmail.com" required>
                </div>
                <div class="inputBox">
                    <input type="text" name="r_assunto" id="r_assunto" class="box2" placeholder="Seu assunto" required>
                </div>
                <div class="inputBox">
                    <textarea name="r_msg" id="r_msg" cols="30" rows="10" placeholder="Sua mensagem..." required></textarea>
                </div>

                <button type="submit" class="btn">Enviar Mensagem</button>
            </form>
        </div>
    </section>
    <!--end contato-->

   <!-- newsletter -->
   <?php include 'includes/newsletter.php'; ?>
   <!-- end -->

   <!--footer-->
   <?php include 'includes/footer.php'; ?>
   <!--footer end-->

   <script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>