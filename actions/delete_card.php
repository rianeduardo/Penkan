<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../verifica_sessao.php';

// Pega o card_id oculto no form que tem o botão de deletar card
$card_id = (int)($_POST['card_id'] ?? 0);

// Se o id or menor ou igual a 0 redireciona para workspaces
if ($card_id <= 0) {
    header('Location: ../workspaces.php');
    exit;
}

// Prepara o select pra checar se o card está de fato em um workspace
$st = DB::pdo()->prepare('SELECT workspace_id FROM cards WHERE id = ? LIMIT 1');
$st->execute([$card_id]);
$c = $st->fetch(PDO::FETCH_ASSOC);

// Se não houver card, volta pra workspaces
if (!$c) {
    header('Location: ../workspaces.php');
    exit;
}

// Salva o id do workspace
$wsid = $c['workspace_id'];

// Prepara o select pra checar se o workspace PERTENCE ao usuário atual
$wst = DB::pdo()->prepare('SELECT user_id FROM workspaces WHERE id = ? LIMIT 1');
$wst->execute([$wsid]);
$w = $wst->fetch(PDO::FETCH_ASSOC);

// Se id do usuário for vazio OU for diferente do id da sessão, volta pra workspaces
if (!$w || $w['user_id'] != $_SESSION['user_id']) {
    header('Location: ../workspaces.php');
    exit;
}

// Se passar por TUDO isso, aí sim deleta o card
$del = DB::pdo()->prepare('DELETE FROM cards WHERE id = ?');
$del->execute([$card_id]);

// Recarrega a página
header('Location: ../workspace.php?id=' . $wsid);
exit;
