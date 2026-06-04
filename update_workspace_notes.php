<?php
require_once __DIR__ . '/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$wsid = (int)($_POST['workspace_id'] ?? 0);
$notes = trim($_POST['notes'] ?? '');
if ($wsid <= 0) { header('Location: workspaces.php'); exit; }
$st = DB::pdo()->prepare('SELECT user_id FROM workspaces WHERE id = ? LIMIT 1');
$st->execute([$wsid]);
$w = $st->fetch(PDO::FETCH_ASSOC);
if (!$w || $w['user_id'] != $_SESSION['user_id']) { header('Location: workspaces.php'); exit; }
$up = DB::pdo()->prepare('UPDATE workspaces SET notes = ? WHERE id = ?');
$up->execute([$notes, $wsid]);
header('Location: workspace.php?id=' . $wsid);
exit;
