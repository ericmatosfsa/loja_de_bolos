<?php
session_start();  // Inicia a sessão

// Verifica se há uma mensagem de erro na sessão
if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";  // Exibe a mensagem de erro
    unset($_SESSION['error']);  // Remove a mensagem da sessão após exibir
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link href="img/tag.webp" rel="icon">
    <title>Login - Loja Doce Magia</title>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style-login.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <div class="container-fluid">
        <!-- Botão do menu responsivo (hamburger) -->
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu de navegação -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto p-4 p-lg-0"> <!-- ms-auto alinha à direita -->
                <li class="nav-item">
                    <a href="index.php" class="nav-item nav-link active">HOME</a>
                </li>
               
            </ul>
        </div>
    </div>
</nav>

<div class="container-login">
    <div class="login-header">
        <h1>Login de Funcionário</h1>
        <p>Acesso exclusivo para funcionários da loja.</p>
    </div>

    <div class="login-restriction">
        <p>Somente funcionários autorizados podem realizar o login. Verifique suas credenciais antes de continuar.</p>
    </div>

    <form action="login_process.php" method="POST">
        <div class="form-group">
            <label for="usuario">Nome de usuário:</label>
            <input type="text" id="usuario" name="usuario" required placeholder="Digite seu nome de usuário">
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required placeholder="Digite sua senha">
        </div>
        <div class="form-group">
            <input type="submit" value="Entrar">
        </div>
    </form>

    <div class="footer-login">
        <p>&copy; 2024 Loja Doce Magia. <a href="#">Termos de Uso</a> | <a href="#">Privacidade</a></p>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
