<?php

include("../../../config_db/conexao.php");

$id = $_POST['id'];
$status = $_POST['status_lead'];

$sql = "UPDATE leads 
        SET status_lead = ?
        WHERE id = ?";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "ii", $status, $id);

if (mysqli_stmt_execute($stmt)) {
    echo "sucesso";
} else {
    echo "erro";
}