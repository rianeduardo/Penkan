<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../verifica_sessao.php';

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');

if ($title === '') {
    header('Location: ../workspaces.php?error=empty');
    exit;
}

$stmt = DB::pdo()->prepare('INSERT INTO workspaces (user_id, title, description) VALUES (?, ?, ?)');
$stmt->execute([$_SESSION['user_id'], $title, $description]);

header('Location: ../workspaces.php');
exit;
