<?php

include("../../config_db/conexao.php");

if(isset($_POST['id'])){

    $id = intval($_POST['id']);

    $sql = "DELETE FROM leads WHERE id = $id";

    if(mysqli_query($conexao, $sql)){
        echo "sucesso";
    } else {
        echo "erro";
    }

}=
?>