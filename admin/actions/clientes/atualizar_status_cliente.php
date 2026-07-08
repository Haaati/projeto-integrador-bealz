<?php

include("../../../config_db/conexao.php");

$id = $_POST['id'];
$status = $_POST['status_clientes'];

$sql = "UPDATE clientes SET status_clientes = ? WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "ii", $status, $id);

if (mysqli_stmt_execute($stmt)) {
    echo "sucesso";
} else {
    echo "erro";
}