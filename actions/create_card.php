<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../verifica_sessao.php';

// Recebe os dados enviados pelo formulário
$workspace_id = (int)($_POST['workspace_id'] ?? 0);
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$preset = trim($_POST['preset'] ?? '');
$urgency = trim($_POST['urgency'] ?? 'Medium');
$status = trim($_POST['status'] ?? 'todo');

// Verifica se o título foi informado e se o ID do workspace é válido
if ($title === '' || $workspace_id <= 0) {
    // Se não for válido, retorna para a página do workspace
    header('Location: ../workspace.php?id=' . $workspace_id);
    exit;
}

// Busca o workspace no banco de dados
$st = DB::pdo()->prepare('SELECT id, user_id FROM workspaces WHERE id = ? LIMIT 1');
$st->execute([$workspace_id]);

// Obtém os dados do workspace encontrado
$ws = $st->fetch(PDO::FETCH_ASSOC);

// Verifica se o workspace existe e se pertence ao usuário logado
if (!$ws || $ws['user_id'] != $_SESSION['user_id']) {
    // Caso contrário, redireciona para a lista de workspaces
    header('Location: ../workspaces.php');
    exit;
}
// Prepara a inserção de um novo card no banco
$ins = DB::pdo()->prepare('INSERT INTO cards (workspace_id, user_id, title, description, preset, urgency, status) VALUES (?,?,?,?,?,?,?)');

// Executa a inserção dos dados do card
$ins->execute([$workspace_id, $_SESSION['user_id'], $title, $description, $preset, $urgency, $status]);

// No fim, vai para a página do workspace
header('Location: ../workspace.php?id=' . $workspace_id);
exit;
