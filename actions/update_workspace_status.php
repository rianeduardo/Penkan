<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../verifica_sessao.php';

// Pega o wsid e o status atual
$wsid = (int)($_POST['workspace_id'] ?? 0);
$status = trim($_POST['status'] ?? '');

// Se o wsid for menor ou igual a 0, ou status não for "active" ou "archived" ele redireciona pra workspaces
if ($wsid <= 0 || !in_array($status, ['active', 'archived'])) {
    header('Location: ../workspaces.php');
    exit;
}

// Prepara um select pra checagem de pertencimento do wsid ao user
$st = DB::pdo()->prepare('SELECT user_id FROM workspaces WHERE id = ? LIMIT 1');
$st->execute([$wsid]);
$w = $st->fetch(PDO::FETCH_ASSOC);

// Checagem
if (!$w || $w['user_id'] != $_SESSION['user_id']) {
    header('Location: ../workspaces.php');
    exit;
}

// Atualiza o status
$up = DB::pdo()->prepare('UPDATE workspaces SET status = ? WHERE id = ?');
$up->execute([$status, $wsid]);

header('Location: ../workspaces.php');
exit;
