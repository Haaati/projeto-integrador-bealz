<?php

include("../../../config_db/conexao.php");

$id = $_POST['id'];
$observacao = $_POST['observacao'];

$sql = "UPDATE leads SET mensagem = ? WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "si", $observacao, $id);

if (mysqli_stmt_execute($stmt)) {
    echo "sucesso";
} else {
    echo "erro";
}