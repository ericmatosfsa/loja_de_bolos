<?php
session_start();  // Começando a sessão, se necessário

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Conectar ao banco de dados
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=loja_doce_magia', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar se o nome de usuário já existe
        $stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE usuario = :usuario");
        $stmt->execute([':usuario' => $usuario]);
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($funcionario) {
            // Se o funcionário já existir
            echo "<script>alert('Nome de usuário já existe!'); window.location.href='cadastro.php';</script>";
        } else {
            // Se o funcionário não existir, vamos cadastrar
            // **Remover o hash da senha** e salvar a senha diretamente
            // Não usar password_hash, apenas a senha em texto claro
            $stmt = $pdo->prepare("INSERT INTO funcionarios (usuario, senha) VALUES (:usuario, :senha)");
            $stmt->execute([
                ':usuario' => $usuario,
                ':senha' => $senha // Senha não criptografada
            ]);

            echo "<script>alert('Funcionário cadastrado com sucesso!'); window.location.href='painel.php';</script>";
        }
    } catch (PDOException $e) {
        die("Erro ao cadastrar funcionário: " . $e->getMessage());
    }
}
?>

