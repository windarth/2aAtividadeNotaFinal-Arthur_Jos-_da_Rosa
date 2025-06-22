<?php
$pdo = new PDO('sqlite:' . __DIR__ . '/database.db');

// Cria 
$pdo->exec("CREATE TABLE IF NOT EXISTS tarefas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    descricao TEXT NOT NULL,
    data_vencimento DATE NOT NULL,
    concluida INTEGER DEFAULT 0
)");

// pega as tarefas
$stmt = $pdo->query("SELECT * FROM tarefas ORDER BY data_vencimento ASC");
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
