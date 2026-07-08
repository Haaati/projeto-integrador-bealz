<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include("../../../config_db/conexao.php");

$id = $_POST['id'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$instagram = $_POST['instagram'] ?: null;
$cpf = $_POST['cpf'] ?: null;
$servico_id = $_POST['servico_id'];
$sobre = $_POST['sobre'] ?: null;
$proposta_url = $_POST['proposta_url'] ?: null;
$status_clientes = $_POST['status_clientes'];

$sql = "UPDATE clientes SET
            email = ?,
            telefone = ?,
            instagram = ?,
            cpf = ?,
            servico_id = ?,
            sobre = ?,
            proposta_url = ?,
            status_clientes = ?
        WHERE id = ?";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "ssssisssi",
    $email,
    $telefone,
    $instagram,
    $cpf,
    $servico_id,
    $sobre,
    $proposta_url,
    $status_clientes,
    $id
);

if (mysqli_stmt_execute($stmt)) {
    echo "sucesso";
} else {
    echo "erro";
}