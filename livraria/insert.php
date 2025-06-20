<?php
try {
    $pdo = new PDO('sqlite:' . __DIR__ . '/database.db');
    
    $sql = "CREATE TABLE IF NOT EXISTS livros (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo TEXT NOT NULL,
            autor TEXT NOT NULL,
            ano INTEGER NOT NULL
        )";
$pdo->exec($sql);

$action = isset($_GET['action']) ? $_GET['action'] : '';
//criar registro
if($action == 'create') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];
    $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (:titulo, :autor, :ano)");
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':autor', $autor);
    $stmt->bindParam(':ano', $ano);
    if ($stmt->execute()) {
        echo "Registro criado com sucesso!";
    }else {
        echo "Erro ao criado registro!";
    }
}
//ler 
if ($action == 'read') {
    $stmt = $pdo->query("SELECT * FROM livros");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

//atualiza
if($action == 'update') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];
    $stmt = $pdo->prepare("UPDATE livros SET titulo = :titulo, autor = :autor, ano = :ano WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':autor', $autor);
    $stmt->bindParam(':ano', $ano);
    if ($stmt->execute()) {
        echo "Registro atualizado com sucesso!";
    }else {
        echo "Erro ao atualizado registro!";
    }
}
//deletar
if ($action == 'delete') {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id");
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        echo "Registro deletado com sucesso";
    }else {
        echo "Erro ao deletar";
    }
}
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>

