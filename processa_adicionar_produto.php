<?php
// Conectar ao banco de dados
try {
    $pdo = new PDO('mysql:host=localhost;dbname=loja_doce_magia', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Receber dados do formulário
$nome = $_POST['nome'];
$imagem_url = $_POST['imagem_url'];

// Verificar se o URL é válido
if (!filter_var($imagem_url, FILTER_VALIDATE_URL)) {
    die("Erro: URL inválido.");
}

// Verificar se o URL aponta para uma imagem
$headers = get_headers($imagem_url, 1);
if (isset($headers['Content-Type']) && strpos($headers['Content-Type'], 'image/') === false) {
    die("Erro: O URL fornecido não aponta para uma imagem.");
}

// Inserir produto no banco de dados
try {
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, imagem) VALUES (:nome, :imagem)");
    $stmt->execute([
        ':nome' => $nome,
        ':imagem' => $imagem_url
    ]);
    echo "<script>alert('Produto adicionado com sucesso!'); window.location.href='painel.php';</script>";
} catch (PDOException $e) {
    die("Erro ao adicionar produto: " . $e->getMessage());
}
?>

