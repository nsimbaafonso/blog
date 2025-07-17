<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário | Dashboard</title>
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
            <form class="form" id="form">
                <h3>Editar Usuário</h3>
                <div class="inputBox">
                    <div>
                        <input type="text" name="nome" placeholder="Nome do usuário"  class="box" required>
                    </div>
                </div>

                <div class="inputBox">
                    <div>
                        <input type="text" name="sobrenome" placeholder="Sobrenome do usuário"  class="box" required>
                    </div>
                </div>

                <div class="inputBox">
                    <select name="cat" id="cat" class="box">
                        <option value="" disabled selected>-- Selecione uma função --</option>
                        <option value="1">Admin</option>
                        <option value="2">Editor</option>
                    </select>
                </div>

                <div class="inputBox">
                    <select name="cat" id="cat" class="box">
                        <option value="" disabled selected>-- Selecione um status --</option>
                        <option value="0">Inativo</option>
                        <option value="1">Ativo</option>
                    </select>
                </div>

                <button type="submit" class="btn">Editar Usuário</button>
            </form>
        </section>

        <section class="section-form">
            <form class="form" id="form">
                <h3>Alterar Imagem</h3>

                <div class="inputBox">
                    <div>
                        <input type="file" name="imagem"  class="box" required>
                    </div>
                </div>

                <button type="submit" class="btn">Alterar Imagem</button>
            </form>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
    <script type="text/javascript" src="../assets/js/usuariosChart.js"></script>
</body>
</html>