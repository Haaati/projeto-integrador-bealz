<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo | Berenice Design</title>

    <link rel="stylesheet" href="assets/css/login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="login-body">

    <div class="login-container">

        <div class="login-card">

            <span class="login-tag">
                Área Restrita
            </span>

            <h1>Painel Administrativo</h1>

            <p>Faça login para gerenciar os projetos, conteúdos e informações do portfólio.</p>

            <form action="autenticar.php" method="POST">
                <div class="input-group">
                    <label>Usuário</label>
                    <input type="text" name="usuario" placeholder="Digite seu usuário" required>
                </div>

                <div class="input-group">
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="Digite sua senha" required>
                </div>

                <button type="submit" class="login-btn">
                    Entrar
                </button>
            </form>

            <?php if (isset($_SESSION['erro_login'])): ?>
                <div class="erro-login"><?= $_SESSION['erro_login']; ?></div>

                <?php unset($_SESSION['erro_login']); ?>
            <?php endif; ?>

            <a href="../index.php" class="voltar-site">
                ← Voltar ao site
            </a>
        </div>
    </div>
</body>
</html>