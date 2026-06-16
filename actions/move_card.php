<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../verifica_sessao.php';

// Pega os dados ocultos no form onde o botão de mover está
$card_id = (int)($_POST['card_id'] ?? 0);
$to = trim($_POST['to'] ?? '');

// Se o id do card for menor ou igual a 0, ou o valor de "to" não ser "todo", "doing" ou "done"
if ($card_id <= 0 || !in_array($to, ['todo', 'doing', 'done'])) {
    header('Location: ../workspaces.php');
    exit;
}

// Prepara um select para checar se o card está em um workspace
$st = DB::pdo()->prepare('SELECT workspace_id FROM cards WHERE id = ? LIMIT 1');
$st->execute([$card_id]);
$c = $st->fetch(PDO::FETCH_ASSOC);

// Checagem
if (!$c) {
    header('Location: ../workspaces.php');
    exit;
}

// Prepara um select para checagem de pertencimento do workspace
$wsid = $c['workspace_id'];
$wst = DB::pdo()->prepare('SELECT user_id FROM workspaces WHERE id = ? LIMIT 1');
$wst->execute([$wsid]);
$w = $wst->fetch(PDO::FETCH_ASSOC);

// Checagem
if (!$w || $w['user_id'] != $_SESSION['user_id']) {
    header('Location: ../workspaces.php');
    exit;
}

// Prepara o update (mover) e executa, com parametro sendo o $to que pegamos lá no começo
$up = DB::pdo()->prepare('UPDATE cards SET status = ? WHERE id = ?');
$up->execute([$to, $card_id]);

// Recarrega a página
header('Location: ../workspace.php?id=' . $wsid);
exit;
