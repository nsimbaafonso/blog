<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Não autorizado</title>
    <link href="../assets/fonts/fontawesome-6.5.2/css/fontawesome.css?<?= time(); ?>" rel="stylesheet">
    <link href="../assets/fonts/fontawesome-6.5.2/css/brands.css?<?= time(); ?>" rel="stylesheet">
    <link href="../assets/fonts/fontawesome-6.5.2/css/solid.css?<?= time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css?<?= time(); ?>">
</head>
<body>
    <!--header-->
    <?php include '../includes/header.php'; ?>
    <!--header end-->

    <!--erro-->
    <section class="erro mt-6 d-flex">
        <div class="content">
            <h1>401</h1>
            <p>Ops! Você não está autorizado.</p>
            <div class="d-flex">
                <a href="home" class="btn">Voltar Para Home</a>
            </div>
        </div>
    </section>
    <!--erro end-->

   <!-- newsletter -->
   <?php include '../includes/newsletter.php'; ?>
   <!-- end -->

   <!--footer-->
   <?php include '../includes/footer.php'; ?>
   <!--footer end-->

   <script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>