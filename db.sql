-- Criação do banco de dados 'loja_doce_magia' caso ele não exista
CREATE DATABASE IF NOT EXISTS loja_doce_magia;

-- Seleciona o banco de dados onde as tabelas serão criadas
USE loja_doce_magia;

-- Criação da tabela 'funcionarios'
CREATE TABLE IF NOT EXISTS funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Criação da tabela 'produtos' com apenas os campos especificados
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    imagem VARCHAR(255) NOT NULL
);

-- Exibe mensagem informando sucesso na criação
SELECT 'Banco de dados e tabelas criados com sucesso ou já existentes.' AS status;
