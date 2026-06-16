<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/verifica_sessao.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: workspaces.php');
    exit;
}

$stmt = DB::pdo()->prepare('SELECT * FROM workspaces WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$workspace = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$workspace) {
    echo 'Workspace nao encontrado.';
    exit;
}

if ($workspace['user_id'] != $_SESSION['user_id']) {
    echo 'Acesso negado.';
    exit;
}

$getCards = DB::pdo();
$tstmt = $getCards->prepare('SELECT * FROM cards WHERE workspace_id = ? AND status = ? ORDER BY created_at DESC');
$tstmt->execute([$id, 'todo']);
$todo_cards = $tstmt->fetchAll(PDO::FETCH_ASSOC);
$tstmt->execute([$id, 'doing']);
$doing_cards = $tstmt->fetchAll(PDO::FETCH_ASSOC);
$tstmt->execute([$id, 'done']);
$done_cards = $tstmt->fetchAll(PDO::FETCH_ASSOC);

function h($value) {
    return htmlspecialchars((string)($value ?? ''));
}

function renderCards($cards, $emptyMessage) {
    if (empty($cards)) {
        echo '<p class="workspaceVazio">' . h($emptyMessage) . '</p>';
        return;
    }

    foreach ($cards as $card) {
        ?>
        <article class="kanbanCard">
            <div class="kanbanCardTopo">
                <h4><?php echo h($card['title']); ?></h4>
                <span><?php echo h($card['urgency']); ?></span>
            </div>

            <small>Preset: <?php echo h($card['preset']); ?></small>
            <p><?php echo nl2br(h($card['description'])); ?></p>
            <small>Criado: <?php echo h($card['created_at']); ?></small>

            <div class="kanbanAcoes">
                <?php if ($card['status'] === 'todo'): ?>
                    <form action="actions/move_card.php" method="post">
                        <input type="hidden" name="card_id" value="<?php echo $card['id']; ?>">
                        <input type="hidden" name="to" value="doing">
                        <button type="submit">Mover para Fazendo</button>
                    </form>
                    <form action="actions/move_card.php" method="post">
                        <input type="hidden" name="card_id" value="<?php echo $card['id']; ?>">
                        <input type="hidden" name="to" value="done">
                        <button type="submit">Mover para Feito</button>
                    </form>
                <?php elseif ($card['status'] === 'doing'): ?>
                    <form action="actions/move_card.php" method="post">
                        <input type="hidden" name="card_id" value="<?php echo $card['id']; ?>">
                        <input type="hidden" name="to" value="todo">
                        <button type="submit">Voltar</button>
                    </form>
                    <form action="actions/move_card.php" method="post">
                        <input type="hidden" name="card_id" value="<?php echo $card['id']; ?>">
                        <input type="hidden" name="to" value="done">
                        <button type="submit">Mover para Feito</button>
                    </form>
                <?php else: ?>
                    <form action="actions/move_card.php" method="post">
                        <input type="hidden" name="card_id" value="<?php echo $card['id']; ?>">
                        <input type="hidden" name="to" value="doing">
                        <button type="submit">Voltar</button>
                    </form>
                <?php endif; ?>

                <form action="actions/delete_card.php" method="post" onsubmit="return confirm('Deletar este card?');">
                    <input type="hidden" name="card_id" value="<?php echo $card['id']; ?>">
                    <button class="delete" type="submit">Excluir</button>
                </form>
            </div>
        </article>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PENKAN | Workspace - <?php echo h($workspace['title']); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./assets/logoPenkan.svg" type="image/x-icon">
</head>

<body>
    <?php include __DIR__ . '/components/header.php'; ?>

    <main class="paginaWorkspace">
        <div class="frase">
            <span>[root@penkan ~]$</span>
            <span>workspace --open</span>
            <span class="inputTerminal">&nbsp;</span>
        </div>

        <hr>

        <section class="workspaceHero">
            <div>
                <div class="wrap">
                    <div class="bolinhaIndicador"></div>
                    <span>Area de trabalho ativa</span>
                </div>
                <h2><?php echo h($workspace['title']); ?></h2>
                <p><?php echo h($workspace['description'] ?: 'Sem descricao.'); ?></p>
            </div>

            <button id="openCreateCard" class="btnWorkspaceCriar" type="button">
                + Criar Card
            </button>
        </section>

        <section class="kanbanBoard">
            <div class="kanbanColumn">
                <div class="kanbanColumnHeader">
                    <h3>A fazer</h3>
                    <span><?php echo count($todo_cards); ?></span>
                </div>
                <?php renderCards($todo_cards, 'Nenhum card nesta coluna.'); ?>
            </div>

            <div class="kanbanColumn">
                <div class="kanbanColumnHeader">
                    <h3>Fazendo</h3>
                    <span><?php echo count($doing_cards); ?></span>
                </div>
                <?php renderCards($doing_cards, 'Nenhum card nesta coluna.'); ?>
            </div>

            <div class="kanbanColumn">
                <div class="kanbanColumnHeader">
                    <h3>Feito</h3>
                    <span><?php echo count($done_cards); ?></span>
                </div>
                <?php renderCards($done_cards, 'Nenhum card nesta coluna.'); ?>
            </div>
        </section>

        <section class="workspaceNotas">
            <div class="kanbanColumnHeader">
                <h3>Notas</h3>
                <span>LOG</span>
            </div>

            <form action="actions/update_workspace_notes.php" method="post">
                <input type="hidden" name="workspace_id" value="<?php echo $workspace['id']; ?>">
                <textarea name="notes" placeholder="Anote evidencias, payloads, caminhos e ideias do projeto."><?php echo h($workspace['notes'] ?? ''); ?></textarea>
                <button type="submit">Salvar notas</button>
            </form>
        </section>

        <div id="createCardModal" class="modalCard">
            <div class="modalCardConteudo">
                <div class="kanbanColumnHeader">
                    <h3>Criar Card</h3>
                    <span>NEW</span>
                </div>

                <form action="actions/create_card.php" method="post">
                    <input type="hidden" name="workspace_id" value="<?php echo $id; ?>">

                    <input type="text" name="title" placeholder="Titulo" required>
                    <textarea name="description" placeholder="Descricao"></textarea>

                    <label for="preset">Preset</label>
                    <select id="preset" name="preset">
                        <option>Pentest Checklist</option>
                        <option>Vulnerability Patch</option>
                        <option>Threat Modeling</option>
                        <option>Incident Response</option>
                        <option>Phishing Simulation</option>
                    </select>

                    <label for="urgency">Urgencia</label>
                    <select id="urgency" name="urgency">
                        <option value="Low">Low</option>
                        <option value="Medium" selected>Medium</option>
                        <option value="High">High</option>
                        <option value="Critical">Critical</option>
                    </select>

                    <div class="modalCardAcoes">
                        <button type="submit">Criar</button>
                        <button type="button" id="closeCreateCard">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/components/footer.php'; ?>
    <script src="assets/app.js"></script>
    <script src="https://kit.fontawesome.com/9e07d1881e.js" crossorigin="anonymous"></script>
</body>

<script src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js"></script> 

<script>
    // Initialize Lenis
const lenis = new Lenis({
  autoRaf: true,
});

// Listen for the scroll event and log the event data
lenis.on('scroll', (e) => {
  console.log(e);
});
</script>

</html>
