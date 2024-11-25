<?php
// Função para criar a tabela "funcionarios"
function criarTabelaFuncionario() {
    // Conectar ao banco de dados
    try {
        // Substitua 'root' e 'root' pelos dados corretos do seu banco de dados
        $pdo = new PDO('mysql:host=localhost;dbname=loja_doce_magia', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL para criar a tabela "funcionarios"
        $sql = "
        CREATE TABLE IF NOT EXISTS funcionarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario VARCHAR(255) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL
        )";

        // Executar a query
        $pdo->exec($sql);

        echo "Tabela 'funcionarios' criada com sucesso ou já existe.";

    } catch (PDOException $e) {
        die("Erro ao criar a tabela: " . $e->getMessage());
    }
}

// Chama a função para criar a tabela
criarTabelaFuncionario();
?>
