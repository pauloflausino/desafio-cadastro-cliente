<?php
// src/cadastro_cliente.php

header('Content-Type: application/json');

// Configurações do banco de dados (idealmente vindo de variáveis de ambiente)
#$host = 'localhost';
#$db   = 'desafio_cliente';
#$user = 'root';
#$pass = '';
#$charset = 'utf8mb4';
$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'desafio';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'senha';
$charset = 'utf8mb4';

// Conexão com o banco de dados usando PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Falha na conexão com o banco de dados.']);
    exit;
}

// Recebe os dados enviados (espera JSON)
$input = json_decode(file_get_contents('php://input'), true);

// Validação básica
if (
    !isset($input['nome']) || empty(trim($input['nome'])) ||
    !isset($input['email']) || !filter_var($input['email'], FILTER_VALIDATE_EMAIL)
) {
    http_response_code(400);
    echo json_encode(['error' => 'Nome e email válidos são obrigatórios.']);
    exit;
}

// Prepara os dados
$nome = trim($input['nome']);
$email = trim($input['email']);

try {
    // Insere o cliente no banco de dados
    $stmt = $pdo->prepare("INSERT INTO clientes (nome, email) VALUES (:nome, :email)");
    $stmt->execute(['nome' => $nome, 'email' => $email]);

    http_response_code(201);
    echo json_encode(['message' => 'Cliente cadastrado com sucesso!']);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao cadastrar o cliente.']);
}
