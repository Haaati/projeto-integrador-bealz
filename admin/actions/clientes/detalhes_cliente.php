<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include("../../../config_db/conexao.php");

header('Content-Type: application/json');

$id = $_GET['id'];

$sql = "SELECT * FROM clientes WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$cliente = mysqli_fetch_assoc($resultado);

if ($cliente) {
    echo json_encode(["sucesso" => true, "cliente" => $cliente]);
} else {
    echo json_encode(["sucesso" => false]);
}