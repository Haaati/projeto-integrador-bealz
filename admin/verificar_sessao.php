<?php 

session_start();

header("cache-control: no-store, no-cache, must-revalidate");
header("pragma: no-cache");
header("expires: 0");
//trecho corrigido porque estavamos armazenando a sessa com o nome do usário ao invés do nome que verificamos na verdade, ai da conflito nessa inhaca
if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header("Location: login.php");
    exit();
}

?>