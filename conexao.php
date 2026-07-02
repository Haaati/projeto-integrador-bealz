<?php
    $host = "localhost";
    $user ="root";
    $password = "1234";
    $banco = "berenice";

    $conexao = mysqli_connect($host, $user, $password, $banco);

    if(!$conexao){
        echo "Erro de conexão";
    }
?>