<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../verifica_sessao.php';

// Pega o workspace_id oculto no form onde o btn de excluir está
$wsid = (int)($_POST['workspace_id'] ?? 0);

// Checagem de id menor ou igual 0
if ($wsid <= 0) {
    header('Location: ../workspaces.php');
    exit;
}

// Prepara um select pra checagem de usuário, padrão dos outros arquivos
$st = DB::pdo()->prepare('SELECT user_id FROM workspaces WHERE id = ? LIMIT 1');
$st->execute([$wsid]);
$w = $st->fetch(PDO::FETCH_ASSOC);

// Checagem
if (!$w || $w['user_id'] != $_SESSION['user_id']) {
    header('Location: ../workspaces.php');
    exit;
}

// Finalmente, deleta o workspace
$del = DB::pdo()->prepare('DELETE FROM workspaces WHERE id = ?');
$del->execute([$wsid]);

header('Location: ../workspaces.php');
exit;
