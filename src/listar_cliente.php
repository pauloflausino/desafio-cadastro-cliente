<?php
// src/listar_clientes.php

header('Content-Type: application/json');

// Configurações do banco de dados (idealmente via variáveis de ambiente)
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

try {
    // Busca todos os clientes
    $stmt = $pdo->query("SELECT id, nome, email, criado_em FROM clientes ORDER BY criado_em DESC");
    $clientes = $stmt->fetchAll();

    echo json_encode(['clientes' => $clientes]);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar clientes.']);
}
