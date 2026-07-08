<?php

include("../../../config_db/conexao.php");

header('Content-Type: application/json');

$sql = "SELECT id, nome_servicos FROM servicos ORDER BY nome_servicos ASC";
$resultado = mysqli_query($conexao, $sql);

$servicos = [];
while ($linha = mysqli_fetch_assoc($resultado)) {
    $servicos[] = $linha;
}

echo json_encode($servicos);