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

    <link rel="shortcut icon" href="./assets/logoPenkan.svg" type="image/x-icon">


<header>
    <div class="containerHeader">
        <div class="logoArea">
            <img src="assets/logoPenkan.svg" alt="Logo do PENKAN">
            <a href="index.php"><h1>PENKAN</h1></a>
        </div>
        <div class="itensHeader">
            <nav>
                <ul>
                    <li><a href="index.php#recursos">Recursos</a></li>
                    <li><a href="index.php#fluxo">Como funciona</a></li>
                    <li><a href="index.php#contato">Contato</a></li>
                    <li><a href="workspaces.php">Workspaces</a></li>
                </ul>
            </nav>
        </div>
        <div class="loginArea">
            <?php if ($user): ?>
                <a href="account.php" class="btnPrimario">Conta</a>
                <a href="logout.php" class="btnSecundario">Sair</a>
            <?php else: ?>
                <a href="login.php" class="btnSecundario">Entrar</a>
                <a href="registro.php" class="btnPrimario">Criar conta</a>
            <?php endif; ?>
        </div>
    </div>
</header>
