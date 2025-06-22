<?php
$pdo = new PDO('sqlite:' . __DIR__ . '/database.db');

$id = $_GET['id'];

$stmt = $pdo->prepare("UPDATE tarefas SET concluida = 1 WHERE id = ?");
$stmt->execute([$id]);

?>
