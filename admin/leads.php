<?php

include("verificar_sessao.php");
include("../config_db/conexao.php");

// Verifica se existe pesquisa
$pesquisa = "";
if (isset($_GET['pesquisa']) && !empty(trim($_GET['pesquisa']))) {
    $pesquisa = mysqli_real_escape_string($conexao, trim($_GET['pesquisa']));
    $where = "WHERE nome LIKE '%$pesquisa%' OR telefone LIKE '%$pesquisa%'";
} else {
    $where = "";
}
// Busca os leads
$sql = "SELECT * FROM leads $where ORDER BY data_clientes DESC";
$resultado = mysqli_query($conexao, $sql);

// Conta os resultados
$sqlTotal = "SELECT COUNT(*) AS total FROM leads $where";
$total = mysqli_fetch_assoc(mysqli_query($conexao, $sqlTotal));


$paginaAtiva = "leads";
$tituloPagina = "Leads";
$subtituloPagina = "Gerencie todos os contatos recebidos pela landing page.";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Leads</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/sidebar-header.css">
    <link rel="stylesheet" href="assets/css/leads.css">
</head>

<body>

    <?php include("includes/sidebar.php"); ?>
    <?php include("includes/header.php"); ?>

    <main class="content">

        <section class="toolbar">

            <form class="search-box" method="GET">
                <input
                    type="text"
                    name="pesquisa"
                    placeholder="Pesquisar por nome ou telefone..."
                    value="<?= htmlspecialchars($pesquisa); ?>">
                <button type="submit" class="btn btn-search">Pesquisar</button>
                <a href="leads.php" class="btn btn-clear">Limpar</a>
            </form>

            <div class="lead-counter">
                <span>Total de Leads:</span>
                <strong><?= $total['total']; ?></strong>
            </div>
        </section>

        <section class="table-container">

            <table class="leads-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Serviço</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($lead = mysqli_fetch_assoc($resultado)) { ?>
                        <tr>
                            <td>#<?= $lead['id']; ?></td>

                            <td><?= htmlspecialchars($lead['nome']); ?></td>

                            <td><?= htmlspecialchars($lead['servicos']); ?></td>

                            <td>
                                <select class="status-select">
                                    <option value="Novo"
                                        <?= $lead['status'] == 'Novo' ? 'selected' : ''; ?>>
                                        Novo
                                    </option>

                                    <option value="Em contato"
                                        <?= $lead['status'] == 'Em contato' ? 'selected' : ''; ?>>
                                        Em contato
                                    </option>

                                    <option value="Perdido"
                                        <?= $lead['status'] == 'Perdido' ? 'selected' : ''; ?>>
                                        Perdido
                                    </option>
                                </select>
                            </td>

                            <td>
                                <?= date('d/m/Y', strtotime($lead['data_clientes'])); ?>
                            </td>

                            <td class="actions">

                                <button class="btn btn-save">
                                    Salvar
                                </button>

                                <button class="btn btn-details" data-id="<?= $lead['id']; ?>">Detalhes</button>

                                <button class="btn btn-convert">
                                    Converter
                                </button>


                            </td>

                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </section>
    </main>
</body>

</html>