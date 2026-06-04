<?php
require_once __DIR__ . '/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$workspace_id = (int)($_POST['workspace_id'] ?? 0);
 $title = trim($_POST['title'] ?? '');
 $description = trim($_POST['description'] ?? '');
 $preset = trim($_POST['preset'] ?? '');
 $urgency = trim($_POST['urgency'] ?? 'Medium');
 $status = trim($_POST['status'] ?? 'todo');
if ($title === '' || $workspace_id <= 0) {
    header('Location: workspace.php?id=' . $workspace_id);
    exit;
}
$st = DB::pdo()->prepare('SELECT id, user_id FROM workspaces WHERE id = ? LIMIT 1');
$st->execute([$workspace_id]);
$ws = $st->fetch(PDO::FETCH_ASSOC);
if (!$ws) {
    header('Location: workspaces.php');
    exit;
}
if ($ws['user_id'] != $_SESSION['user_id']) {
    header('Location: workspaces.php');
    exit;
}
$ins = DB::pdo()->prepare('INSERT INTO cards (workspace_id, user_id, title, description, preset, urgency, status) VALUES (?,?,?,?,?,?,?)');
$ins->execute([$workspace_id, $_SESSION['user_id'], $title, $description, $preset, $urgency, $status]);
header('Location: workspace.php?id=' . $workspace_id);
exit;
