<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../verifica_sessao.php';

// Pega a ação (atualizar perfil ou senha) e o id do usuário
$action = $_POST['action'] ?? 'profile';
$uid = $_SESSION['user_id'];

// Se ação for do perfil
if ($action === 'profile') {
    // Pega os dados do form
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $specialty = trim($_POST['specialty'] ?? '');

    // Se email for vazio, redireciona
    if ($email === '') {
        header('Location: ../account.php');
        exit;
    }

    // Prepara um select para ver se o email já existe em outro id de user
    $st = DB::pdo()->prepare('SELECT id FROM users WHERE email = ? AND id != ? LIMIT 1');
    $st->execute([$email, $uid]);

    if ($st->fetch()) {
        header('Location: ../account.php');
        exit;
    }

    // Prepara o update do usuário
    $up = DB::pdo()->prepare('UPDATE users SET name = ?, email = ?, specialty = ? WHERE id = ?');
    $up->execute([$name, $email, $specialty, $uid]);

    header('Location: ../account.php');
    exit;
}

// Se a ação for mudança de senha
if ($action === 'password') {
    // Pega senha atual e a nova
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';

    // Se a nova ou a atual estiverem vazias, cancela
    if ($new === '' || $current === '') {
        header('Location: ../account.php');
        exit;
    }

    // Prepara um select pra pegar a senha do usuário
    $st = DB::pdo()->prepare('SELECT password FROM users WHERE id = ? LIMIT 1');
    $st->execute([$uid]);
    $u = $st->fetch(PDO::FETCH_ASSOC);

    // Verifica se a senha atual está correta com a senha do banco
    if (!$u || !password_verify($current, $u['password'])) {
        header('Location: ../account.php');
        exit;
    }

    // Transforma a nova senha em hash e atualiza no banco
    $hash = password_hash($new, PASSWORD_DEFAULT);
    $up = DB::pdo()->prepare('UPDATE users SET password = ? WHERE id = ?');
    $up->execute([$hash, $uid]);

    header('Location: ../account.php');
    exit;
}

header('Location: ../account.php');
exit;
