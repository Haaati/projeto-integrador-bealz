<?php 

session_start();

header("cache-control: no-store, no-cache, must-revalidate");
header("pragma: no-cache");
header("expires: 0");

if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header("Location: login.php");
    exit();
}

?>