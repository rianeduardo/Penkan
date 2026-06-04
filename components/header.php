<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../db.php';
$user = null;
if (!empty($_SESSION['user_id'])) {
    $stmt = DB::pdo()->prepare('SELECT id, name, email, username, specialty FROM users WHERE id = ? LIMIT 1');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<link rel="stylesheet" href="components/headerstyle.css">

<header>
    <div class="containerHeader">
        <div class="logoArea">
            <img src="assets/LOGOPENKAN 1.svg" alt="Logo do PENKAN">
            <h1>PENKAN</h1>
        </div>
        <div class="itensHeader">
            <nav>
                <ul>
                    <li><a href="#">Recursos</a></li>
                    <li><a href="#">Como funciona</a></li>
                    <li><a href="#">Contato</a></li>
                    <li><a href="#">Sobre</a></li>
                    <li><a href="workspaces.php">Workspaces</a></li>
                </ul>
            </nav>
        </div>
        <div class="loginArea">
            <i class="fa-regular fa-moon" style="color: rgb(11, 229, 69);"></i>
            <?php if ($user): ?>
                <span>Olá, <?php echo htmlspecialchars($user['username'] ?: $user['name'] ?: $user['email']); ?></span>
                <a href="account.php">Conta</a>
                <a href="workspaces.php">Meus Workspaces</a>
                <a href="logout.php">Sair</a>
            <?php else: ?>
                <a href="login.php">Entrar</a>
                <a href="registro.php" class="btnPrimario">Criar conta</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<script src="https://kit.fontawesome.com/9e07d1881e.js" crossorigin="anonymous"></script>