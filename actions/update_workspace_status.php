<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../verifica_sessao.php';

$wsid = (int)($_POST['workspace_id'] ?? 0);
$status = trim($_POST['status'] ?? '');

if ($wsid <= 0 || !in_array($status, ['active', 'archived'])) {
    header('Location: ../workspaces.php');
    exit;
}

$st = DB::pdo()->prepare('SELECT user_id FROM workspaces WHERE id = ? LIMIT 1');
$st->execute([$wsid]);
$w = $st->fetch(PDO::FETCH_ASSOC);

if (!$w || $w['user_id'] != $_SESSION['user_id']) {
    header('Location: ../workspaces.php');
    exit;
}

$up = DB::pdo()->prepare('UPDATE workspaces SET status = ? WHERE id = ?');
$up->execute([$status, $wsid]);

header('Location: ../workspaces.php');
exit;
