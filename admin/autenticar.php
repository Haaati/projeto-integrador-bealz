<?php
session_start();
include("../config_db/conexao.php");

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM administradores WHERE usuario = '$usuario'";
$resultado = mysqli_query($conexao, $sql);
$admin = mysqli_fetch_assoc($resultado);

if ($admin && $senha === $admin['senha']) {
    // login certo
    $_SESSION['admin_logado'] = true;
    $_SESSION['admin_usuario'] = $admin['usuario'];
    header("Location: painel.php");
    exit;
} else {
    // login errado
    $_SESSION['erro_login'] = "⚠︎ Usuário ou senha inválidos.";
    header("Location: login.php");
    exit;
}
?>