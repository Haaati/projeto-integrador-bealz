<?php

include("verificar_sessao.php");
include("../config_db/conexao.php");
include("config/status.php");

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

// $sql = "SELECT leads.*,servicos.nome AS servico, status_lead.nome AS status_nome FROM leads INNER JOIN servicos ON leads.servico_id = servicos.id
// INNER JOIN status_lead ON leads.status_id = status_lead.id $where ORDER BY leads.data_cadastro DESC";

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

                                <select class="status-select" data-id="<?= $lead['id']; ?>">
                                    <option value="1"
                                        <?= $lead['status_lead'] == 1 ? 'selected' : ''; ?>>
                                        Novo Lead
                                    </option>

                                    <option value="2"
                                        <?= $lead['status_lead'] == 2 ? 'selected' : ''; ?>>
                                        Em Contato
                                    </option>

                                    <option value="3"
                                        <?= $lead['status_lead'] == 3 ? 'selected' : ''; ?>>
                                        Perdido
                                    </option>

                                </select>
                            </td>

                            <td>
                                <?= date('d/m/Y', strtotime($lead['data_clientes'])); ?>
                            </td>

                            <td class="actions">

                                <button class="btn btn-save" data-id="<?= $lead['id']; ?>">Salvar</button>

                                <button class="btn btn-delete" data-id="<?= $lead['id']; ?>">Excluir</button>

                                <button class="btn btn-details" data-id="<?= $lead['id']; ?>">Detalhes</button>

                                <button class="btn btn-convert" data-id="<?= $lead['id']; ?>">Converter</button>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <div id="modal-detalhes" class="modal-overlay" style="display:none;">
        <div class="modal-conteudo">
            <h2>Detalhes do Lead</h2>

            <p><strong>Nome:</strong> <span id="modal-nome"></span></p>
            <p><strong>E-mail:</strong> <span id="modal-email"></span></p>
            <p><strong>Telefone:</strong> <span id="modal-telefone"></span></p>

            <hr>

            <p><strong>Serviço solicitado:</strong> <span id="modal-servico"></span></p>
            <p><strong>Mensagem:</strong></p>
            <p id="modal-mensagem"></p>

            <hr>

            <p><strong>Status atual:</strong> <span id="modal-status"></span></p>
            <p><strong>Data de criação:</strong> <span id="modal-data"></span></p>

            <hr>

            <label for="modal-observacao">Observação:</label>
            <textarea id="modal-observacao" rows="3"></textarea>
            <button id="btn-salvar-observacao">Salvar observação</button>

            <br><br>

            <button id="btn-fechar-modal">↩ Voltar para lista</button>
        </div>
    </div>

    <div id="modal-converter" class="modal-overlay" style="display:none;">
        <div class="modal-conteudo">
            <h2>Converter Lead em Cliente</h2>

            <input type="hidden" id="conv-lead-id">

            <label>Nome</label>
            <input type="text" id="conv-nome" disabled>

            <label for="conv-email">E-mail</label>
            <input type="email" id="conv-email">

            <label for="conv-telefone">Telefone</label>
            <input type="text" id="conv-telefone">

            <label for="conv-instagram">Instagram</label>
            <input type="text" id="conv-instagram" placeholder="@usuario">

            <label for="conv-cpf">CPF</label>
            <input type="text" id="conv-cpf" placeholder="000.000.000-00">

            <label for="conv-servico">Serviço</label>
            <select id="conv-servico"></select>

            <label for="conv-sobre">Sobre o cliente</label>
            <textarea id="conv-sobre" rows="3" placeholder="Descrição, observações sobre esse cliente..."></textarea>

            <label for="conv-proposta">URL da proposta enviada</label>
            <input type="url" id="conv-proposta" placeholder="https://...">

            <label for="conv-status">Status do cliente</label>
            <select id="conv-status">
                <option value="1" selected>Proposta enviada</option>
                <option value="2">Aguardando pagamento</option>
                <option value="3">Entregue</option>
                <option value="4">Inativo</option>
                <option value="5">Ativo</option>
                <option value="6">Pausado</option>
                <option value="7">Finalizado</option>
            </select>


            <br><br>

            <button id="btn-confirmar-converter">Converter em Cliente</button>
            <button id="btn-fechar-converter">Cancelar</button>

        </div>
    </div>

    <script src="assets/js/leads.js"></script>
</body>

</html>