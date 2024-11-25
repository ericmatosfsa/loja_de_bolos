<?php
$servername = "localhost"; // ou o IP do seu servidor MySQL
$username = "root"; // o nome de usuário do seu banco de dados
$password = "root"; // a senha do seu banco de dados
$dbname = "loja_doce_magia"; // o nome do seu banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
