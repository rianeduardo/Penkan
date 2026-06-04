<?php
require_once __DIR__ . '/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();
 $errors = [];
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $name = trim($_POST['name'] ?? '');
     $username = trim($_POST['username'] ?? '');
     $email = trim($_POST['email'] ?? '');
     $password = $_POST['password'] ?? '';
     $specialty = trim($_POST['specialty'] ?? '');
     if ($username === '' || $email === '' || $password === '') {
         $errors[] = 'Usuário, e-mail e senha são obrigatórios.';
     } else {
         // check existing username/email
         $st = DB::pdo()->prepare('SELECT id FROM users WHERE username = ? LIMIT 1');
         $st->execute([$username]);
         if ($st->fetch()) {
             $errors[] = 'Nome de usuário já existe.';
         }
         $st = DB::pdo()->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
         $st->execute([$email]);
         if ($st->fetch()) {
             $errors[] = 'E-mail já cadastrado.';
         }
         if (empty($errors)) {
             $hash = password_hash($password, PASSWORD_DEFAULT);
             $ins = DB::pdo()->prepare('INSERT INTO users (name, username, email, password, specialty) VALUES (?, ?, ?, ?, ?)');
             $ins->execute([$name, $username, $email, $hash, $specialty]);
             $_SESSION['user_id'] = DB::pdo()->lastInsertId();
             header('Location: workspaces.php');
             exit;
         }
     }
 }
include __DIR__ . '/components/header.php';
?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PENKAN | Criar conta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="containerLogin">
            <div class="logoSide">
                <img src="./assets/LOGOPENKAN 1.svg" alt="Logo do PENKAN" class="giantLogo">
                <h1 class="logoText">PENKAN</h1>
            </div>
            <div class="formSide">
                <div class="formHeader">
                    <h2>Crie sua conta</h2>
                    <p>Cadastre-se para criar workspaces e cards.</p>
                </div>
                <?php if (!empty($errors)): ?>
                    <div class="errors" style="color:#ff6b6b;margin-bottom:10px;">
                        <?php foreach ($errors as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
                    </div>
                <?php endif; ?>
                <form action="registro.php" method="post">
                    <input type="text" name="name" placeholder="Nome (opcional)">
                    <input type="text" name="username" placeholder="Usuário (ex: hacker123)" required>
                    <input type="email" name="email" placeholder="E-mail" required>
                    <input type="password" name="password" placeholder="Senha" required>
                    <div style="margin:8px 0;">
                        <label>Vetor primário:</label>
                        <select name="specialty" style="width:100%;padding:8px;margin-top:6px;">
                            <option value="webapp">Web App Sec</option>
                            <option value="network">Network / Infra</option>
                            <option value="cloud">Cloud / IAM</option>
                            <option value="hardware">Hardware / IoT</option>
                        </select>
                    </div>
                    <button type="submit">Criar conta</button>
                </form>
                <p class="signupText">Já tem uma conta? <a href="login.php">Entrar</a></p>
            </div>
        </div>
    </main>
</body>

</html>