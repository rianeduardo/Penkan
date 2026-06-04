<?php
require_once __DIR__ . '/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || $password === '') {
        $errors[] = 'Preencha usuário e senha.';
    } else {
        $stmt = DB::pdo()->prepare('SELECT id, password, name, username FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($u && password_verify($password, $u['password'])) {
            $_SESSION['user_id'] = $u['id'];
            header('Location: workspaces.php');
            exit;
        } else {
            $errors[] = 'Credenciais inválidas.';
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
    <title>PENKAN | Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./assets/LOGOPENKAN 1.svg" type="image/x-icon">
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
                    <h2>Bem-vindo de volta!</h2>
                    <p>Faça login para acessar sua conta e continuar onde parou.</p>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="errors" style="color: #ff6b6b;margin-bottom:10px;">
                        <?php foreach ($errors as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="post">
                    <input type="text" name="username" placeholder="Usuário" required>
                    <input type="password" name="password" placeholder="Senha" required>
                    <button type="submit">Entrar</button>
                </form>

                <p class="signupText">Não tem uma conta? <a href="registro.php">Criar conta</a></p>
            </div>
        </div>
    </main>
</body>

</html>