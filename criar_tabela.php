<?php
// Conexão com o banco de dados
try {
    $pdo = new PDO('mysql:host=localhost;dbname=loja_doce_magia', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL para criar uma tabela
    $sql = "CREATE TABLE IF NOT EXISTS produtos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        imagem VARCHAR(255) NOT NULL
    )";

    // Executa a criação da tabela
    $pdo->exec($sql);
    echo "Tabela 'produtos' criada com sucesso!";
} catch (PDOException $e) {
    die("Erro ao criar tabela: " . $e->getMessage());
}
?>
