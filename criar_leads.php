<?php
include("conexao.php");

$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$servicos = $_POST["id"];
$observacao = $_POST["observacao"];

$sql = "INSERT INTO clientes(nome, email, telefone, servicos, observacao) VALUES('$nome', '$email', '$telefone', '$servicos', '$observacao')";

mysqli_query($conexao, $sql);

header("Location:index.php");
exit();

?>