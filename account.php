<?php
require_once __DIR__ . '/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$stmt = DB::pdo()->prepare('SELECT id, name, username, email, specialty, created_at FROM users WHERE id = ? LIMIT 1');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) $user = [];
function h($v) { return htmlspecialchars((string)($v ?? '')); }
include __DIR__ . '/components/header.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Conta - Penkan</title>
    <link rel="stylesheet" href="style.css">
    <style>.profile { max-width:800px;margin:24px auto;background:#0b0b0b;padding:16px;border-radius:8px; }</style>
</head>
<body>
    <main class="container">
        <div class="profile">
            <h2>Minha Conta</h2>
            <p><strong>Usuário:</strong> <?php echo h($user['username'] ?? ''); ?></p>
            <p><strong>Nome:</strong> <?php echo h($user['name'] ?? ''); ?></p>
            <p><strong>E-mail:</strong> <?php echo h($user['email'] ?? ''); ?></p>
            <p><strong>Vetor primário:</strong> <?php echo h($user['specialty'] ?? ''); ?></p>
            <p><strong>Criado em:</strong> <?php $ca = $user['created_at'] ?? null; echo h($ca ? date('Y-m-d H:i', strtotime($ca)) : '—'); ?></p>

            <h3>Atualizar perfil</h3>
            <form action="update_account.php" method="post">
                <input type="text" name="name" placeholder="Nome" value="<?php echo h($user['name'] ?? ''); ?>"><br>
                <input type="email" name="email" placeholder="E-mail" value="<?php echo h($user['email'] ?? ''); ?>"><br>
                <label>Vetor primário:</label>
                <select name="specialty">
                    <option value="webapp" <?php if(($user['specialty'] ?? '')=='webapp') echo 'selected'; ?>>Web App Sec</option>
                    <option value="network" <?php if(($user['specialty'] ?? '')=='network') echo 'selected'; ?>>Network / Infra</option>
                    <option value="cloud" <?php if(($user['specialty'] ?? '')=='cloud') echo 'selected'; ?>>Cloud / IAM</option>
                    <option value="hardware" <?php if(($user['specialty'] ?? '')=='hardware') echo 'selected'; ?>>Hardware / IoT</option>
                </select>
                <input type="hidden" name="action" value="profile">
                <div><button type="submit">Salvar perfil</button></div>
            </form>

            <h3>Mudar senha</h3>
            <form action="update_account.php" method="post">
                <input type="password" name="current_password" placeholder="Senha atual"><br>
                <input type="password" name="new_password" placeholder="Nova senha"><br>
                <input type="hidden" name="action" value="password">
                <div><button type="submit">Alterar senha</button></div>
            </form>
        </div>
    </main>
</body>
</html>
