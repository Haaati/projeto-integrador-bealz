<?php
include("config_db/conexao.php");

$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$servicos = $_POST["id"];
$mensagem = $_POST["mensagem"];

$sql = "INSERT INTO leads (nome, email, telefone, servicos, mensagem) VALUES('$nome', '$email', '$telefone', '$servicos', '$mensagem')";

mysqli_query($conexao, $sql);

header("Location:index.php");
exit();

?>