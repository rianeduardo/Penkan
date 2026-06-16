<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../verifica_sessao.php';

// Pega o wsid e o campo de anotações
$wsid = (int)($_POST['workspace_id'] ?? 0);
$notes = trim($_POST['notes'] ?? '');

// Se wsid for igual or menor que 0, redireciona pra workspaces
if ($wsid <= 0) {
    header('Location: ../workspaces.php');
    exit;
}

// Prepara um select para checagem de pertencimento do ws ao user
$st = DB::pdo()->prepare('SELECT user_id FROM workspaces WHERE id = ? LIMIT 1');
$st->execute([$wsid]);
$w = $st->fetch(PDO::FETCH_ASSOC);

// Checagem
if (!$w || $w['user_id'] != $_SESSION['user_id']) {
    header('Location: ../workspaces.php');
    exit;
}

// Prepara o update pra atualizar as notas
$up = DB::pdo()->prepare('UPDATE workspaces SET notes = ? WHERE id = ?');
$up->execute([$notes, $wsid]);

header('Location: ../workspace.php?id=' . $wsid);
exit;
