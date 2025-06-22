<?php
$pdo = new PDO('sqlite:' . __DIR__ . '/database.db');
// adiciona a tarefa
$descricao = $_POST['descricao'];
$data_vencimento = $_POST['data_vencimento'];

$stmt = $pdo->prepare("INSERT INTO tarefas (descricao, data_vencimento) VALUES (?, ?)");
$stmt->execute([$descricao, $data_vencimento]);

?>