<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../verifica_sessao.php';

// Recebe os dados enviados pelo formulário
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');

// Checa se o título está vazio (obrigatório ter algo)
if ($title === '') {
    header('Location: ../workspaces.php?error=empty');
    exit;
}

// Prepara a criação do workspace e executa
$stmt = DB::pdo()->prepare('INSERT INTO workspaces (user_id, title, description) VALUES (?, ?, ?)');
$stmt->execute([$_SESSION['user_id'], $title, $description]);

// Redireciona para workspaces
header('Location: ../workspaces.php');
exit;
