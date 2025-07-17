<?php include __DIR__ . '/../../config/config.php'; ?>

<aside class="sidebar" id="sidebar">
        <button class="fas fa-times" id="close-menu"></button>
        <div class="user">
            <img src="<?= BASE_DASHBOARD_URL ?>assets/img/user.png" alt="Foto de Rafaela Nzola">
            <div>
                <h3>Rafaela Nzola</h3>
                <p>Admin</p>
            </div>
        </div>

        <div class="title"> 
            <h2> <i class="fas fa-blog"></i> Dashboard</h2>
        </div>

        <nav class="navbar">
            <a href="<?= BASE_SITE_URL ?>home" title="Ver Site"><i class="fas fa-display"></i> Ver Site</a>
            <a href="<?= BASE_DASHBOARD_URL ?>home" title="Home"><i class="fas fa-home"></i> Home</a>
            <a href="<?= BASE_DASHBOARD_URL ?>posts/" title="Posts"><i class="fas fa-newspaper"></i> Posts</a>
            <a href="<?= BASE_DASHBOARD_URL ?>categorias/" title="Categorias"><i class="fas fa-layer-group"></i> Categorias</a>
            <a href="<?= BASE_DASHBOARD_URL ?>usuarios/" title="Usuários"><i class="fas fa-users"></i> Usuários</a>
            <a href="<?= BASE_DASHBOARD_URL ?>relatorios/" title="Relatórios"><i class="fas fa-file-alt"></i> Relatórios</a>
            <a href="<?= BASE_DASHBOARD_URL ?>newsletter/" title="Newsletter"><i class="fas fa-envelope"></i> Neswletter</a>
            <a href="<?= BASE_DASHBOARD_URL ?>configuracoes/" title="Configurações"><i class="fas fa-cog"></i> Configurações</a>
        </nav>

        <div class="logout">
            <a href="<?= BASE_DASHBOARD_URL ?>sair" class="fas fa-arrow-right-to-bracket" title="Sair"></a>
        </div>
    </aside>

