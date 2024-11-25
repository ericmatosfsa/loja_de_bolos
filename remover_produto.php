<?php
// Função para excluir produto
function excluirProduto($id) {
    try {
        // Conectar ao banco de dados
        $pdo = new PDO('mysql:host=localhost;dbname=loja_doce_magia', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar a query para excluir o produto
        $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Executar a query
        $stmt->execute();

        // Exibir mensagem de sucesso e redirecionar para a página do painel
        echo "<script>alert('Produto excluído com sucesso!'); window.location.href='painel.php';</script>";

    } catch (PDOException $e) {
        die("Erro ao excluir produto: " . $e->getMessage());
    }
}

// Verificar se o parâmetro id está presente na URL
if (isset($_GET['id'])) {
    $id_produto = $_GET['id']; // Recebe o ID do produto pela URL
    excluirProduto($id_produto); // Chama a função para excluir o produto
} else {
    echo "Produto não encontrado.";
}
?>
