<?php
include("verificar_sessao.php");
?>
<!-- resto do HTML do painel -->
<p>Bem-vindo, <?= htmlspecialchars($_SESSION['admin_usuario']) ?>!

</p>