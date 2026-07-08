<?php

include("verificar_sessao.php");
include("../config_db/conexao.php");

// Verifica se existe pesquisa
$pesquisa = "";
if (isset($_GET['pesquisa']) && !empty(trim($_GET['pesquisa']))) {
    $pesquisa = mysqli_real_escape_string($conexao, trim($_GET['pesquisa']));
    $where = "WHERE clientes.nome LIKE '%$pesquisa%' OR clientes.telefone LIKE '%$pesquisa%'";
} else {
    $where = "";
}

// Busca os clientes já com o nome do serviço
$sql = "SELECT clientes.*, servicos.nome_servicos AS servico_nome
        FROM clientes
        INNER JOIN servicos ON clientes.servico_id = servicos.id
        $where
        ORDER BY clientes.data_cadastro DESC";

$resultado = mysqli_query($conexao, $sql);

// Conta os resultados
$sqlTotal = "SELECT COUNT(*) AS total FROM clientes $where";
$total = mysqli_fetch_assoc(mysqli_query($conexao, $sqlTotal));

// Mapa de status para exibição
$statusClientes = [
    1 => "Ativo",
    2 => "Inativo",
    3 => "Pausado",
    4 => "Finalizado",
    5 => "Aguardando pagamento",
    6 => "Proposta enviada",
];

$paginaAtiva = "clientes";
$tituloPagina = "Clientes";
$subtituloPagina = "Gerenciamento de clientes cadastrados no sistema.";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clientes</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/sidebar-header.css">
    <link rel="stylesheet" href="assets/css/clientes.css">
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
                <a href="clientes.php" class="btn btn-clear">Limpar</a>
            </form>

            <div class="lead-counter">
                <span>Total de Clientes:</span>
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
                        <th>Data de Cadastro</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($cliente = mysqli_fetch_assoc($resultado)) { ?>

                        <tr>
                            <td>#<?= $cliente['id']; ?></td>

                            <td><?= htmlspecialchars($cliente['nome']); ?></td>

                            <td><?= htmlspecialchars($cliente['servico_nome']); ?></td>

                            <td>
                                <select class="status-select" data-id="<?= $cliente['id']; ?>">
                                    <?php foreach ($statusClientes as $valor => $texto) { ?>
                                        <option value="<?= $valor; ?>"
                                            <?= $cliente['status_clientes'] == $valor ? 'selected' : ''; ?>>
                                            <?= $texto; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>

                            <td>
                                <?= date('d/m/Y', strtotime($cliente['data_cadastro'])); ?>
                            </td>

                            <td class="actions">
                                <button class="btn btn-save-status" data-id="<?= $cliente['id']; ?>">Salvar</button>
                                <button class="btn btn-edit" data-id="<?= $cliente['id']; ?>">Editar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <div id="modal-editar-cliente" class="modal-overlay" style="display:none;">
        <div class="modal-conteudo">
            <h2>Editar Cliente</h2>

            <input type="hidden" id="edit-cliente-id">

            <label>Nome</label>
            <input type="text" id="edit-nome" disabled>

            <label for="edit-email">E-mail</label>
            <input type="email" id="edit-email">

            <label for="edit-telefone">Telefone</label>
            <input type="text" id="edit-telefone">

            <label for="edit-instagram">Instagram</label>
            <input type="text" id="edit-instagram" placeholder="@usuario">

            <label for="edit-cpf">CPF</label>
            <input type="text" id="edit-cpf" placeholder="000.000.000-00">

            <label for="edit-servico">Serviço</label>
            <select id="edit-servico"></select>

            <label for="edit-sobre">Sobre o cliente</label>
            <textarea id="edit-sobre" rows="3"></textarea>

            <label for="edit-proposta">URL da proposta enviada</label>
            <input type="url" id="edit-proposta" placeholder="https://...">

            <label for="edit-status">Status do cliente</label>
            <select id="edit-status">
                <option value="1">Ativo</option>
                <option value="2">Inativo</option>
                <option value="3">Pausado</option>
                <option value="4">Finalizado</option>
                <option value="5">Aguardando pagamento</option>
                <option value="6">Proposta enviada</option>
            </select>

            <br><br>

            <button id="btn-confirmar-editar">Salvar Alterações</button>
            <button id="btn-fechar-editar">Cancelar</button>
        </div>
    </div>

    <script src="assets/js/clientes.js"></script>
</body>

</html>