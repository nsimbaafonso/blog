<?php include '../config/config.php'; ?>
<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Dashboard</title>
    <link href="assets/fonts/fontawesome-6.5.2/css/fontawesome.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/brands.css?<?= time(); ?>" rel="stylesheet">
    <link href="assets/fonts/fontawesome-6.5.2/css/solid.css?<?= time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?<?= time(); ?>">
    <link rel="stylesheet" href="assets/css/login.css?<?= time(); ?>">
</head>
<body>
    <!--login-->
    <section class="login">
        <form action="<?= BASE_DASHBOARD_URL ?>home" method="POST" class="login-form">
            <div class="logo">
                <i class="fas fa-blog"></i>
            </div>
            <h3>Painel Administrativo</h3>
            <input type="email" name="email" placeholder="exemplo@gmail.com" class="box" value="" required>
            <input type="password" name="senha" placeholder="Sua Palavra-Pass" class="box" value="" required>
            <!--<div class="remember">
               <input type="checkbox" name="lembrar" id="lembrar">
               <label for="lembrar">Lembrar de mim</label>
            </div>-->

            <button type="submit" class="btn">Entrar</button>
            <p>Esqueceu a senha? <a href="recuperar-senha">Recuperar senha</a></p>
        </form>
    </section>
    <!--login end-->

</body>
</html>