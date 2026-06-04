<?php
require_once __DIR__ . '/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: workspaces.php');
    exit;
}
$stmt = DB::pdo()->prepare('SELECT * FROM workspaces WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$workspace = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$workspace) {
    echo 'Workspace não encontrado.';
    exit;
}
if ($workspace['user_id'] != $_SESSION['user_id']) {
    echo 'Acesso negado.';
    exit;
}
// fetch cards by status for kanban
$getCards = DB::pdo();
$tstmt = $getCards->prepare('SELECT * FROM cards WHERE workspace_id = ? AND status = ? ORDER BY created_at DESC');
$tstmt->execute([$id, 'todo']);
$todo_cards = $tstmt->fetchAll(PDO::FETCH_ASSOC);
$tstmt->execute([$id, 'doing']);
$doing_cards = $tstmt->fetchAll(PDO::FETCH_ASSOC);
$tstmt->execute([$id, 'done']);
$done_cards = $tstmt->fetchAll(PDO::FETCH_ASSOC);
include __DIR__ . '/components/header.php';
?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PENKAN | <?php echo htmlspecialchars($workspace['title']); ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        .cards { display:flex; flex-wrap:wrap; gap:12px; }
        .card { background:#0f0f0f; padding:12px; border-radius:8px; width:240px; }
        #createCardModal { display:none; }
    </style>
</head>
<body>
    <main class="container">
        <h2><?php echo htmlspecialchars($workspace['title']); ?></h2>
        <p><?php echo htmlspecialchars($workspace['description']); ?></p>

        <p><a href="#" id="openCreateCard" class="btn">+ Criar Card</a></p>

        <div class="kanban" style="display:flex;gap:12px;align-items:flex-start;">
            <div class="column" style="flex:1;background:#0b0b0b;padding:12px;border-radius:8px;min-height:200px;">
                <h3>A fazer</h3>
                <?php if (empty($todo_cards)): ?>
                    <p>Nenhum card nesta coluna.</p>
                <?php else: ?>
                    <?php foreach ($todo_cards as $card): ?>
                        <div class="card">
                            <h4><?php echo htmlspecialchars($card['title']); ?></h4>
                            <small>Urgência: <?php echo htmlspecialchars($card['urgency']); ?></small>
                            <small>Preset: <?php echo htmlspecialchars($card['preset']); ?></small>
                            <p><?php echo nl2br(htmlspecialchars($card['description'])); ?></p>
                            <small>Criado: <?php echo $card['created_at']; ?></small>
                            <div style="margin-top:8px;display:flex;gap:6px;">
                                <form action="move_card.php" method="post" style="display:inline;"><input type="hidden" name="card_id" value="<?php echo $card['id']; ?>"><input type="hidden" name="to" value="doing"><button type="submit">Mover → Fazendo</button></form>
                                <form action="move_card.php" method="post" style="display:inline;"><input type="hidden" name="card_id" value="<?php echo $card['id']; ?>"><input type="hidden" name="to" value="done"><button type="submit">Mover → Feito</button></form>
                                <form action="delete_card.php" method="post" style="display:inline;margin-left:auto;" onsubmit="return confirm('Deletar este card?');"><input type="hidden" name="card_id" value="<?php echo $card['id']; ?>"><button type="submit">Excluir</button></form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="column" style="flex:1;background:#0b0b0b;padding:12px;border-radius:8px;min-height:200px;">
                <h3>Fazendo</h3>
                <?php if (empty($doing_cards)): ?>
                    <p>Nenhum card nesta coluna.</p>
                <?php else: ?>
                    <?php foreach ($doing_cards as $card): ?>
                        <div class="card">
                            <h4><?php echo htmlspecialchars($card['title']); ?></h4>
                            <small>Urgência: <?php echo htmlspecialchars($card['urgency']); ?></small>
                            <small>Preset: <?php echo htmlspecialchars($card['preset']); ?></small>
                            <p><?php echo nl2br(htmlspecialchars($card['description'])); ?></p>
                            <small>Criado: <?php echo $card['created_at']; ?></small>
                            <div style="margin-top:8px;display:flex;gap:6px;">
                                <form action="move_card.php" method="post" style="display:inline;"><input type="hidden" name="card_id" value="<?php echo $card['id']; ?>"><input type="hidden" name="to" value="todo"><button type="submit">← Voltar</button></form>
                                <form action="move_card.php" method="post" style="display:inline;margin-left:auto;"><input type="hidden" name="card_id" value="<?php echo $card['id']; ?>"><input type="hidden" name="to" value="done"><button type="submit">Mover → Feito</button></form>
                                <form action="delete_card.php" method="post" style="display:inline;" onsubmit="return confirm('Deletar este card?');"><input type="hidden" name="card_id" value="<?php echo $card['id']; ?>"><button type="submit">Excluir</button></form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="column" style="flex:1;background:#0b0b0b;padding:12px;border-radius:8px;min-height:200px;">
                <h3>Feito</h3>
                <?php if (empty($done_cards)): ?>
                    <p>Nenhum card nesta coluna.</p>
                <?php else: ?>
                    <?php foreach ($done_cards as $card): ?>
                        <div class="card">
                            <h4><?php echo htmlspecialchars($card['title']); ?></h4>
                            <small>Urgência: <?php echo htmlspecialchars($card['urgency']); ?></small>
                            <small>Preset: <?php echo htmlspecialchars($card['preset']); ?></small>
                            <p><?php echo nl2br(htmlspecialchars($card['description'])); ?></p>
                            <small>Criado: <?php echo $card['created_at']; ?></small>
                            <div style="margin-top:8px;display:flex;gap:6px;">
                                <form action="move_card.php" method="post" style="display:inline;"><input type="hidden" name="card_id" value="<?php echo $card['id']; ?>"><input type="hidden" name="to" value="doing"><button type="submit">← Voltar</button></form>
                                <form action="delete_card.php" method="post" style="display:inline;margin-left:auto;" onsubmit="return confirm('Deletar este card?');"><input type="hidden" name="card_id" value="<?php echo $card['id']; ?>"><button type="submit">Excluir</button></form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Notas do workspace -->
        <section style="max-width:900px;margin:18px auto;padding:12px;background:#0b0b0b;border-radius:8px;">
            <h3>Notas</h3>
            <form action="update_workspace_notes.php" method="post">
                <input type="hidden" name="workspace_id" value="<?php echo $workspace['id']; ?>">
                <textarea name="notes" style="width:100%;min-height:140px;padding:8px;border-radius:6px;margin-bottom:8px;"><?php echo htmlspecialchars($workspace['notes'] ?? ''); ?></textarea>
                <div><button type="submit">Salvar notas</button></div>
            </form>
        </section>

        <!-- Modal -->
        <div id="createCardModal" style="display:none; position:fixed; left:0; top:0; right:0; bottom:0; background:rgba(0,0,0,0.5); z-index:9999;">
            <div style="background:#fff; color:#111; max-width:600px; margin:6% auto; padding:20px; border-radius:8px;">
                <h3>Criar Card</h3>
                <form action="create_card.php" method="post">
                    <input type="hidden" name="workspace_id" value="<?php echo $id; ?>">
                    <div><input type="text" name="title" placeholder="Título" required style="width:100%;padding:8px;margin-bottom:8px;"></div>
                    <div><textarea name="description" placeholder="Descrição" style="width:100%;padding:8px;margin-bottom:8px;"></textarea></div>
                    <div>
                        <label>Preset:</label>
                        <select name="preset" style="width:100%;padding:8px;margin-bottom:8px;">
                            <option>Pentest Checklist</option>
                            <option>Vulnerability Patch</option>
                            <option>Threat Modeling</option>
                            <option>Incident Response</option>
                            <option>Phishing Simulation</option>
                        </select>
                    </div>
                    <div style="margin-top:6px;">
                        <label>Urgência:</label>
                        <select name="urgency" style="width:100%;padding:8px;margin-bottom:8px;">
                            <option value="Low">Low</option>
                            <option value="Medium" selected>Medium</option>
                            <option value="High">High</option>
                            <option value="Critical">Critical</option>
                        </select>
                    </div>
                    <div style="display:flex;gap:8px;">
                        <button type="submit">Criar</button>
                        <button type="button" id="closeCreateCard">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

    </main>
    <script src="assets/app.js"></script>
    <script src="https://kit.fontawesome.com/9e07d1881e.js" crossorigin="anonymous"></script>
</body>
</html>