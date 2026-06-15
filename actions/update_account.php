<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../verifica_sessao.php';

$action = $_POST['action'] ?? 'profile';
$uid = $_SESSION['user_id'];

if ($action === 'profile') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $specialty = trim($_POST['specialty'] ?? '');

    if ($email === '') {
        header('Location: ../account.php');
        exit;
    }

    $st = DB::pdo()->prepare('SELECT id FROM users WHERE email = ? AND id != ? LIMIT 1');
    $st->execute([$email, $uid]);

    if ($st->fetch()) {
        header('Location: ../account.php');
        exit;
    }

    $up = DB::pdo()->prepare('UPDATE users SET name = ?, email = ?, specialty = ? WHERE id = ?');
    $up->execute([$name, $email, $specialty, $uid]);

    header('Location: ../account.php');
    exit;
}

if ($action === 'password') {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';

    if ($new === '' || $current === '') {
        header('Location: ../account.php');
        exit;
    }

    $st = DB::pdo()->prepare('SELECT password FROM users WHERE id = ? LIMIT 1');
    $st->execute([$uid]);
    $u = $st->fetch(PDO::FETCH_ASSOC);

    if (!$u || !password_verify($current, $u['password'])) {
        header('Location: ../account.php');
        exit;
    }

    $hash = password_hash($new, PASSWORD_DEFAULT);
    $up = DB::pdo()->prepare('UPDATE users SET password = ? WHERE id = ?');
    $up->execute([$hash, $uid]);

    header('Location: ../account.php');
    exit;
}

header('Location: ../account.php');
exit;
