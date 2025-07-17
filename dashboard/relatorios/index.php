<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios | Dashboard</title>
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


        <!--charts 1-->
        <section class="charts">
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Visitas ao Blog</h3>
                    <select>
                      <option>Últimos 7 dias</option>
                      <option>Últimos 30 dias</option>
                      <option>Este ano</option>
                    </select>
                </div>
                <canvas id="visitasChart"></canvas>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h3>Fontes de tráfego</h3>
                </div>
                <canvas id="fontesChart"></canvas>
            </div>
        </section>

        <!--charts 2-->
        <section class="charts">
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Tempo Médio de Leitura</h3>
                    <select>
                      <option>Últimos 7 dias</option>
                      <option>Últimos 30 dias</option>
                      <option>Este ano</option>
                    </select>
                </div>
                <canvas id="tempoChart"></canvas>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h3>Posts Mais Populares</h3>
                    <select>
                      <option>Últimos 7 dias</option>
                      <option>Últimos 30 dias</option>
                      <option>Este ano</option>
                    </select>
                </div>
                <canvas id="popularesChart"></canvas>
            </div>
        </section>

        <!--charts 3-->
        <section class="charts">
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Localização dos Visitantes</h3>
                </div>
                <canvas id="localizacaoChart"></canvas>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h3>Dispositivos Usados</h3>
                </div>
                <canvas id="dispositivosChart"></canvas>
            </div>
        </section>
    </main>
    <!--fim main-->
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
    <script type="text/javascript" src="../assets/js/charts.js"></script>
</body>
</html>