<?php
session_start();  // Inicia a sessão no começo do arquivo
 // Verifica se o usuário está logado
 if (!isset($_SESSION['usuario'])) {
    // Se não estiver logado, redireciona para o login
    header("Location: login.php");
    exit();
}


// Conexão com o banco de dados
try {
    $pdo = new PDO('mysql:host=localhost;dbname=loja_doce_magia', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Busca produtos do banco de dados
    $stmt = $pdo->prepare("SELECT * FROM produtos");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Busca funcionários do banco de dados
    $stmt_funcionarios = $pdo->prepare("SELECT * FROM funcionarios");
    $stmt_funcionarios->execute();
    $funcionarios = $stmt_funcionarios->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());


}
   
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>LOJA DOCE MAGIA - Gerenciar Produtos</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/tag.webp" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style-catalogo.css" rel="stylesheet">
    <link href="css/style-funcionarios.css" rel="stylesheet">

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="painel.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <img src="img/tag.webp" alt="Logo" class="logo-img me-2" width="70">
                <h1 class="m-0 text-primary">Doce Magia</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="painel.php" class="nav-item nav-link">PAGINA DO FUNCIONARIO</a>
                </div>
                <a href="logout.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">SAIR<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Lista de Funcionários Start -->
        <div class="container py-5">
            <h1 class="text-center mb-5">Lista de Funcionários</h1>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome de Usuário</th>
                                <th>Senha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($funcionarios) {
                                foreach ($funcionarios as $funcionario) {
                                    echo "<tr>
                                            <td>" . htmlspecialchars($funcionario['usuario']) . "</td>
                                            <td>" . htmlspecialchars($funcionario['senha']) . "</td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2' class='text-center'>Nenhum funcionário encontrado.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Lista de Funcionários End -->

        <!-- Gerenciar Produtos Start -->
        <div class="container py-5">
            <h1 class="text-center mb-5">Gerenciar Produtos</h1>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php foreach ($produtos as $produto): ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="cat-item">
                                    <img src="<?= htmlspecialchars($produto['imagem']) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($produto['nome']) ?>">
                                    <div class="text-center p-4">
                                        <h5 class="mb-3"><?= htmlspecialchars($produto['nome']) ?></h5>
                                        <div class="d-flex justify-content-center">
                                            <a href="editar_produto.php?id=<?= $produto['id'] ?>" class="btn btn-warning mx-1">Editar</a>
                                            <a href="remover_produto.php?id=<?= $produto['id'] ?>" class="btn btn-danger mx-1">Remover</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Botão Adicionar Produto -->
                    <div class="text-center mt-4">
                        <a href="adicionar_produto.php" class="btn btn-primary">Adicionar Novo Produto</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gerenciar Produtos End -->

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Contatos</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Rua Quiteria, Bahia, BRASIL</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+55 75999453211</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>magiabolos@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
