<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="img/tag.webp" rel="icon">
    <title>Cadastro de Funcionário</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Barra de navegação com botão Home -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="d-flex ms-auto">
                <a href="index.php" class="btn btn-secondary">Home</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Cadastro de Funcionário</h2>
        <form action="processa_cadastro_funcionario.php" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Funcionário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
