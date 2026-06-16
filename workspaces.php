<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/verifica_sessao.php';
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
</head>

<body>
    <main class="paginaWorkspaces">

    <div class="headerWorkspaces">
        <h2>Meus Workspaces</h2>
        <p>Gerencie seus projetos e organize seus cards.</p>
    </div>

    <div class="novoWorkspace">
        <form class="formWorkspace" action="actions/create_workspace.php" method="post">
            <input
                type="text"
                name="title"
                placeholder="Título do workspace"
                required>

            <input
                type="text"
                name="description"
                placeholder="Descrição (opcional)">

            <button type="submit">
                Criar Workspace
            </button>
        </form>
    </div>

    <div class="listaWorkspaces">

        <?php if (empty($workspaces)): ?>

            <div class="semWorkspaces">
                Nenhum workspace ainda. Crie um acima.
            </div>

        <?php else: ?>

            <?php foreach ($workspaces as $w): ?>

                <div class="workspaceCard">

                    <a
                        class="workspaceCardLink"
                        href="workspace.php?id=<?php echo $w['id']; ?>"
                        aria-label="Abrir workspace <?php echo htmlspecialchars($w['title']); ?>"></a>

                    <div class="workspaceHeader">

                        <a
                            class="workspaceTitulo"
                            href="workspace.php?id=<?php echo $w['id']; ?>">

                            <?php echo htmlspecialchars($w['title']); ?>

                        </a>

                        <span class="workspaceStatus <?php echo (($w['status'] ?? 'active') === 'active') ? 'ativo' : 'arquivado'; ?>">
                            <?php echo htmlspecialchars($w['status'] ?? 'active'); ?>
                        </span>

                    </div>

                    <p class="workspaceDescricao">
                        <?php echo htmlspecialchars($w['description'] ?: 'Sem descrição.'); ?>
                    </p>

                    <div class="workspaceData">
                        Criado em:
                        <?php echo date('d/m/Y H:i', strtotime($w['created_at'])); ?>
                    </div>

                    <div class="workspaceAcoes">

                        <?php if (($w['status'] ?? 'active') === 'active'): ?>

                            <form action="actions/update_workspace_status.php" method="post">
                                <input
                                    type="hidden"
                                    name="workspace_id"
                                    value="<?php echo $w['id']; ?>">

                                <input
                                    type="hidden"
                                    name="status"
                                    value="archived">

                                <button class="btnWorkspace" type="submit">
                                    Arquivar
                                </button>
                            </form>

                        <?php else: ?>

                            <form action="actions/update_workspace_status.php" method="post">
                                <input
                                    type="hidden"
                                    name="workspace_id"
                                    value="<?php echo $w['id']; ?>">

                                <input
                                    type="hidden"
                                    name="status"
                                    value="active">

                                <button class="btnWorkspace" type="submit">
                                    Ativar
                                </button>
                            </form>

                        <?php endif; ?>

                        <form
                            action="actions/delete_workspace.php"
                            method="post"
                            onsubmit="return confirm('Deletar workspace e todos os cards?');">

                            <input
                                type="hidden"
                                name="workspace_id"
                                value="<?php echo $w['id']; ?>">

                            <button
                                class="btnWorkspace delete"
                                type="submit">

                                Deletar

                            </button>

                        </form>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</main>
    <script src="https://kit.fontawesome.com/9e07d1881e.js" crossorigin="anonymous"></script>
</body>

<?php
include('./components/footer.php')
    ?>

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
