<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include("../../config_db/conexao.php");

header('Content-Type: application/json');

$id = $_GET['id'];

$sql = "SELECT 
            leads.id,
            leads.nome,
            leads.email,
            leads.telefone,
            leads.mensagem,
            leads.data_clientes,
            leads.observacao,
            servicos.nome_servicos AS servico_nome,
            status_lead.lead_status AS status_nome,
            leads.status_lead AS status_id
        FROM leads
        INNER JOIN servicos ON leads.servicos = servicos.id
        INNER JOIN status_lead ON leads.status_lead = status_lead.id
        WHERE leads.id = ?";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$lead = mysqli_fetch_assoc($resultado);

if ($lead) {
    $lead['data_clientes'] = date('d/m/Y H:i', strtotime($lead['data_clientes']));
    echo json_encode(["sucesso" => true, "lead" => $lead]);
} else {
    echo json_encode(["sucesso" => false]);
}