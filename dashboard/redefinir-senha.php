<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha | Dashboard</title>
    <link href="assets/fonts/fontawesome-6.5.2/css/fontawesome.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/brands.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/solid.css?<?= time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?<?= time(); ?>">
    <link rel="stylesheet" href="assets/css/login.css?<?= time(); ?>">
</head>
<body>
    <!--login-->
    <section class="login">
        <form action="" method="POST" class="login-form">
            <h3>Redefinir senha</h3>
            <input type="password" name="senha" placeholder="Nova senha" class="box" value="" required>
            <input type="password" name="confirmaSenha" placeholder="Confirme sua nova senha" class="box" value="" required>

            <button type="submit" class="btn">Alterar Senha</button>
        </form>
    </section>
    <!--login end-->

</body>
</html>