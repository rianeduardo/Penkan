<?php
require_once __DIR__ . '/db.php';
if (session_status() === PHP_SESSION_NONE)
    session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$user_id = $_SESSION['user_id'];
$stmt = DB::pdo()->prepare('SELECT * FROM workspaces WHERE user_id = ? ORDER BY created_at DESC');
$stmt->execute([$user_id]);
$workspaces = $stmt->fetchAll(PDO::FETCH_ASSOC);
include __DIR__ . '/components/header.php';
?>
<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PENKAN | Workspaces</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./assets/logoPenkan.svg" type="image/x-icon">
    <style>
        .ws-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 900px;
            margin: 24px auto;
        }

        .ws-item {
            padding: 12px;
            background: #0f0f0f;
            border-radius: 8px;
        }

        .new-ws {
            max-width: 900px;
            margin: 12px auto;
            padding: 12px;
            background: #090909;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <main class="container">
        <h2>Meus Workspaces</h2>

        <div class="new-ws">
            <form action="create_workspace.php" method="post">
                <input type="text" name="title" placeholder="Título do workspace" required
                    style="padding:8px;margin-right:8px;">
                <input type="text" name="description" placeholder="Descrição (opcional)"
                    style="padding:8px;margin-right:8px;">
                <button type="submit">Criar Workspace</button>
            </form>
        </div>

        <div class="ws-list">
            <?php if (empty($workspaces)): ?>
                <div>Nenhum workspace ainda. Crie um acima.</div>
            <?php else: ?>
                <?php foreach ($workspaces as $w): ?>
                    <div class="ws-item">
                        <h3 style="display:flex;gap:12px;align-items:center;"><a
                                href="workspace.php?id=<?php echo $w['id']; ?>"><?php echo htmlspecialchars($w['title']); ?></a>
                            <span
                                style="font-size:12px;color:#9e9e9e;">[<?php echo htmlspecialchars($w['status'] ?? 'active'); ?>]</span>
                        </h3>
                        <p><?php echo htmlspecialchars($w['description']); ?></p>
                        <small>Criado: <?php echo $w['created_at']; ?></small>
                        <div style="margin-top:8px;display:flex;gap:8px;">
                            <?php if (($w['status'] ?? 'active') === 'active'): ?>
                                <form action="update_workspace_status.php" method="post" style="display:inline;"><input
                                        type="hidden" name="workspace_id" value="<?php echo $w['id']; ?>"><input type="hidden"
                                        name="status" value="archived"><button type="submit">Arquivar</button></form>
                            <?php else: ?>
                                <form action="update_workspace_status.php" method="post" style="display:inline;"><input
                                        type="hidden" name="workspace_id" value="<?php echo $w['id']; ?>"><input type="hidden"
                                        name="status" value="active"><button type="submit">Ativar</button></form>
                            <?php endif; ?>
                            <form action="delete_workspace.php" method="post" style="display:inline;"
                                onsubmit="return confirm('Deletar workspace e todos os cards?');"><input type="hidden"
                                    name="workspace_id" value="<?php echo $w['id']; ?>"><button type="submit">Deletar</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
    <script src="https://kit.fontawesome.com/9e07d1881e.js" crossorigin="anonymous"></script>
</body>

</html>