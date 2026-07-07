<aside class="sidebar">

   <div class="sidebar-top">
        <div class="admin-profile">
            <div class="admin-avatar">
                A
            </div>
            <div>
                <h1>Bealz</h1>
                <p>Administrador</p>
            </div>
        </div>
    </div>

    <nav class="sidebar-menu">
        <a href="painel.php" class="<?= $paginaAtiva == 'dashboard' ? 'active' : '' ?>">Dashboard</a>

        <a href="projetos.php" class="<?= $paginaAtiva == 'projetos' ? 'active' : '' ?>">Projetos</a>

        <a href="leads.php" class="<?= $paginaAtiva == 'leads' ? 'active' : '' ?>">Leads</a>

        <a href="clientes.php" class="<?= $paginaAtiva == 'clientes' ? 'active' : '' ?>">Clientes</a>

        <a href="servicos.php" class="<?= $paginaAtiva == 'servicos' ? 'active' : '' ?>">Serviços</a>

        <a href="categorias.php" class="<?= $paginaAtiva == 'categorias' ? 'active' : '' ?>">Categorias</a>
    </nav>

    <div class="sidebar-bottom">
        <a href="configuracoes.php" class="<?= $paginaAtiva == 'configuracoes' ? 'active' : '' ?>">
            Configurações
        </a>
        <a href="logout.php">
            Sair
        </a>
    </div>
</aside>