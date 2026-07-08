<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include("../../../config_db/conexao.php");

$lead_id = $_POST['lead_id'];

$email = $_POST['email'];
$telefone = $_POST['telefone'];
$instagram = $_POST['instagram'] ?: null;
$cpf = $_POST['cpf'] ?: null;
$servico_id = $_POST['servico_id'];
$sobre = $_POST['sobre'] ?: null;
$proposta_url = $_POST['proposta_url'] ?: null;
$status_clientes = $_POST['status_clientes'];

try {
    mysqli_begin_transaction($conexao);

    // Busca nome e data original do lead direto do banco (não confia no formulário)
    $sqlLead = "SELECT nome, data_clientes FROM leads WHERE id = ?";
    $stmtLead = mysqli_prepare($conexao, $sqlLead);
    mysqli_stmt_bind_param($stmtLead, "i", $lead_id);
    mysqli_stmt_execute($stmtLead);
    $resultadoLead = mysqli_stmt_get_result($stmtLead);
    $lead = mysqli_fetch_assoc($resultadoLead);

    if (!$lead) {
        throw new Exception("Lead não encontrado.");
    }

    $nome = $lead['nome'];
    $data_cadastro = $lead['data_clientes'];

    // Insere o cliente
    $sqlInsert = "INSERT INTO clientes 
                    (nome, email, telefone, instagram, cpf, servico_id, sobre, proposta_url, data_cadastro, status_clientes)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmtInsert = mysqli_prepare($conexao, $sqlInsert);
    mysqli_stmt_bind_param(
        $stmtInsert,
        "ssssssssss",
        $nome,
        $email,
        $telefone,
        $instagram,
        $cpf,
        $servico_id,
        $sobre,
        $proposta_url,
        $data_cadastro,
        $status_clientes
    );
    mysqli_stmt_execute($stmtInsert);

    // Remove o lead original
    $sqlDelete = "DELETE FROM leads WHERE id = ?";
    $stmtDelete = mysqli_prepare($conexao, $sqlDelete);
    mysqli_stmt_bind_param($stmtDelete, "i", $lead_id);
    mysqli_stmt_execute($stmtDelete);

    mysqli_commit($conexao);

    echo "sucesso";

} catch (Exception $e) {
    mysqli_rollback($conexao);
    echo "erro";
}