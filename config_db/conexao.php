<?php
    $host = "localhost";
    $user ="root";
    $password = "Bia@2008k";
    $banco = "berenice";

    $conexao = mysqli_connect($host, $user, $password, $banco);

    if(!$conexao){
        echo "Erro de conexão";
    }
?>