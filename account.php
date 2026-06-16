<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/verifica_sessao.php';

// Carrega os dados do usuário
$stmt = DB::pdo()->prepare('SELECT id, name, username, email, specialty, created_at FROM users WHERE id = ? LIMIT 1');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Não deixa dar erro (Warning: Trying to access array offset on value of type bool), já que usuário falso do fetch não permite a gente manipular como array
if (!$user) $user = [];

// Função pra retornar os dados independentes
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
    <link rel="shortcut icon" href="./assets/logoPenkan.svg" type="image/x-icon">
    <style>.profile { max-width:800px;margin:24px auto;background:#0b0b0b;padding:16px;border-radius:8px; }</style>
</head>
<body>
    <main class="paginaConta">
    <div class="frase">
        <span>[root@penkan ~]$</span>
        <span>account --status</span>
        <span class="inputTerminal">&nbsp;</span>
    </div>

    <hr>

    <section class="containerConta">

        <div class="headerConta">
            <div class="wrap">
                <div class="bolinhaIndicador"></div>
                <span>Sessão autenticada</span>
            </div>

            <h1>Minha Conta</h1>
            <p>Gerencie suas informações e credenciais de acesso.</p>
        </div>

        <div class="gridConta">

            <div class="cardConta">
                <div class="tituloCardConta">
                    <span class="indicador">&gt;</span>
                    <h2>Informações do Operador</h2>
                </div>

                <div class="dadosConta">
                    <div class="linhaDado">
                        <span>Usuário</span>
                        <strong><?php echo h($user['username']); ?></strong>
                    </div>

                    <div class="linhaDado">
                        <span>Nome</span>
                        <strong><?php echo h($user['name']); ?></strong>
                    </div>

                    <div class="linhaDado">
                        <span>E-mail</span>
                        <strong><?php echo h($user['email']); ?></strong>
                    </div>

                    <div class="linhaDado">
                        <span>Vetor Primário</span>
                        <strong><?php echo h($user['specialty']); ?></strong>
                    </div>

                    <div class="linhaDado">
                        <span>Criado em</span>
                        <strong>
                            <?php
                            $ca = $user['created_at'] ?? null;
                            echo h($ca ? date('d/m/Y H:i', strtotime($ca)) : '2026');
                            ?>
                        </strong>
                    </div>
                </div>
            </div>

            <div class="cardConta">
                <div class="tituloCardConta">
                    <span class="indicador">&gt;</span>
                    <h2>Atualizar Perfil</h2>
                </div>

                <form class="formCadastro" action="actions/update_account.php" method="post">

                    <input
                        class="entrada"
                        type="text"
                        name="name"
                        placeholder="Nome"
                        value="<?php echo h($user['name']); ?>"
                    >

                    <input
                        class="entrada"
                        type="email"
                        name="email"
                        placeholder="E-mail"
                        value="<?php echo h($user['email']); ?>"
                    >

                    <select class="entrada" name="specialty">
                        <option value="webapp" <?php if(($user['specialty'] ?? '')=='webapp') echo 'selected'; ?>>
                            Web App Security
                        </option>

                        <option value="network" <?php if(($user['specialty'] ?? '')=='network') echo 'selected'; ?>>
                            Network / Infra
                        </option>

                        <option value="cloud" <?php if(($user['specialty'] ?? '')=='cloud') echo 'selected'; ?>>
                            Cloud / IAM
                        </option>

                        <option value="hardware" <?php if(($user['specialty'] ?? '')=='hardware') echo 'selected'; ?>>
                            Hardware / IoT
                        </option>
                    </select>

                    <input type="hidden" name="action" value="profile">

                    <button class="botaoSalvar" type="submit">
                        Salvar Perfil
                    </button>
                </form>
            </div>

            <div class="cardConta">
                <div class="tituloCardConta">
                    <span class="indicador">&gt;</span>
                    <h2>Alterar Senha</h2>
                </div>

                <form class="formCadastro" action="actions/update_account.php" method="post">

                    <input
                        class="entrada"
                        type="password"
                        name="current_password"
                        placeholder="Senha atual"
                    >

                    <input
                        class="entrada"
                        type="password"
                        name="new_password"
                        placeholder="Nova senha"
                    >

                    <input type="hidden" name="action" value="password">

                    <button class="botaoSalvar" type="submit">
                        Atualizar Senha
                    </button>
                </form>
            </div>

        </div>
    </section>
</main>
</body>
<?php
include __DIR__ . '/components/footer.php';
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
