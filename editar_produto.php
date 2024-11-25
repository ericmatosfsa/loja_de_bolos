<?php
session_start();  // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Conectar ao banco de dados
try {
    $pdo = new PDO('mysql:host=localhost;dbname=loja_doce_magia', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Verificar se o id do produto foi passado na URL
if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    // Buscar o produto no banco de dados
    try {
        $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $id_produto, PDO::PARAM_INT);
        $stmt->execute();

        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$produto) {
            die("Produto não encontrado.");
        }
    } catch (PDOException $e) {
        die("Erro ao buscar produto: " . $e->getMessage());
    }
} else {
    die("ID do produto não fornecido.");
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $imagem_url = $_POST['imagem'];  // Usando URL para a imagem

    // Atualizar os dados no banco de dados
    try {
        $stmt = $pdo->prepare("UPDATE produtos SET nome = :nome, imagem = :imagem WHERE id = :id");
        $stmt->execute([
            ':nome' => $nome,
            ':imagem' => $imagem_url,
            ':id' => $id_produto
        ]);
        echo "<script>alert('Produto atualizado com sucesso!'); window.location.href='painel.php';</script>";
    } catch (PDOException $e) {
        die("Erro ao atualizar produto: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Editar Produto - Loja Doce Magia</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Produto</h2>

        <!-- Formulário de Edição -->
        <form action="editar_produto.php?id=<?php echo $produto['id']; ?>" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem URL</label>
                <input type="url" class="form-control" id="imagem" name="imagem" value="<?php echo htmlspecialchars($produto['imagem']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Produto</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
