<?php
include("config_db/conexao.php");

$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$servicos = $_POST["id"];
$mensagem = $_POST["mensagem"];

$sql = "INSERT INTO leads (nome, email, telefone, servicos, mensagem) VALUES('$nome', '$email', '$telefone', '$servicos', '$mensagem')";

if (mysqli_query($conexao, $sql)) {
    echo "sucesso";
} else {
    echo "erro: " . mysqli_error($conexao);
}
?>