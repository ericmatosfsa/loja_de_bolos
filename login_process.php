<?php
session_start();  // Inicia a sessão

// Dados de conexão ao banco de dados
$host = 'localhost';
$user = 'root';
$password = 'root';
$dbname = 'loja_doce_magia';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Protegendo contra SQL Injection
$usuario = mysqli_real_escape_string($conn, $usuario);
$password = mysqli_real_escape_string($conn, $password);

// Verificando se o usuário existe no banco de dados
$sql = "SELECT * FROM funcionarios WHERE usuario = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verificando a senha em texto simples
    if ($password == $row['senha']) {
        // Senha correta
        $_SESSION['usuario'] = $usuario;  // Definindo a variável de sessão
        $_SESSION['message'] = "Login efetuado com sucesso!";  // Mensagem de sucesso

        header("Location: painel.php");  // Redireciona para o painel
        exit();
    } else {
        // Se a senha estiver incorreta, definimos a mensagem de erro na sessão
        $_SESSION['error'] = "Senha incorreta!";
        header("Location: login.php");  // Redireciona de volta para a página de login
        exit();
    }
} else {
    // Se o usuário não for encontrado, definimos a mensagem de erro na sessão
    $_SESSION['error'] = "Usuário não encontrado!";
    header("Location: login.php");  // Redireciona de volta para a página de login
    exit();
}

$conn->close();
?>
