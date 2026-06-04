<?php
require_once __DIR__ . '/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$card_id = (int)($_POST['card_id'] ?? 0);
if ($card_id <= 0) { header('Location: workspaces.php'); exit; }
$st = DB::pdo()->prepare('SELECT workspace_id FROM cards WHERE id = ? LIMIT 1');
$st->execute([$card_id]);
$c = $st->fetch(PDO::FETCH_ASSOC);
if (!$c) { header('Location: workspaces.php'); exit; }
$wsid = $c['workspace_id'];
$wst = DB::pdo()->prepare('SELECT user_id FROM workspaces WHERE id = ? LIMIT 1');
$wst->execute([$wsid]);
$w = $wst->fetch(PDO::FETCH_ASSOC);
if (!$w || $w['user_id'] != $_SESSION['user_id']) { header('Location: workspaces.php'); exit; }
$del = DB::pdo()->prepare('DELETE FROM cards WHERE id = ?');
$del->execute([$card_id]);
header('Location: workspace.php?id=' . $wsid);
exit;
